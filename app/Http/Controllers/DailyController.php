<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Dailyreport;
use App\Dailyrequest;
use App\Activemember;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class DailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdailyreport(Request $request)
    {
        if(Input::get('date')==''){
            if(Input::get('id')!=''){
                $dailys = Dailyreport::where('member_id', Input::get('id'))->get();

            }else {
                $date = Carbon::now()->format('d/m/Y');
                $dailys = Dailyreport::where('approved_date', $date)->orderBy('id', 'DESC')->get();

            }
        }
        else {
            $date = Carbon::parse(Input::get('date'))->format('d/m/Y');
            $dailys = Dailyreport::where('approved_date', $date)->orderBy('id', 'DESC')->get();

        }
        return view('monthly.dailyreport')->with('dailys', $dailys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdailyrequest()
    {
        $dailyrequests = Dailyrequest::orderBy('id', 'DESC')->get();
        return view('monthly.dailyrequest')->with('dailyrequests', $dailyrequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function get_approve()
    {
        if(Input::get('date')=='') {
            $all_approve = DB::table('approvemembers')->orderBy('created_at', 'desc')->get();
        }
        else{
            $month=Carbon::parse(Input::get('date'))->month;
            $year=Carbon::parse(Input::get('date'))->year;
            $all_approve = DB::table('approvemembers')->orderBy('created_at', 'desc')->whereMonth('created_at','=',$month)->whereYear('created_at','=',$year)->get();
        }
        return view('approve_list.approve_list',['all_approve'=>$all_approve]);
    }
    public function get_approvebystaff()
    {

        $by_staff = DB::table('dailyreports')->where('description', 'Approved User')->orderBy('id', 'desc')->get();

        return view('approve_list.approve_bystaff',['by_staff'=>$by_staff]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //a
    }
    public function debit_list()
    {
        //
        //   if(Input::get('month')=='') {

        $debit_list = DB::table('debit_list')->where('sum_amount','!=',0)->orderBy('id', 'desc')->get();
        //   }
        /*  else{
              $month = Carbon::parse(Input::get('month'))->month;
              $year = Carbon::parse(Input::get('month'))->year;

              $debit_list = DB::table('debit_list')->whereMonth('created_at','=',$month)->whereYear('created_at','=',$year)->orderBy('id', 'desc')->get();

          }*/
        return view('monthly.debit_list', ['debit_list' => $debit_list]);

    }

    public function debit_list_by_id($id)
    {
        //
        if (Input::get('month') == '') {
            $debit_list_by_id = DB::table('dailyreports')->where([['member_id', '=', $id], ['payment', '=', 1]])->orWhere([['member_id', '=', $id], ['payment', '=', 4]])->get();
            $pay_list = DB::table('dailyreports')->where([['member_id', '=', $id], ['payment', '=', 2]])->get();
            $month = '';
            $sum = \Illuminate\Support\Facades\DB::table('dailyreports')->where([['member_id', '=', $id], ['payment', '=', 1]])->orWhere([['member_id', '=', $id], ['payment', '=', 4]])->sum('amount');
            $pay=\Illuminate\Support\Facades\DB::table('dailyreports')->where([['member_id','=',$id],['payment','=',2]])->sum('amount');


        } else {
            $month = Carbon::parse(Input::get('month'))->format('m/Y');

            $debit_list_by_id = DB::table('dailyreports')->where([['member_id', '=', $id], ['payment', '=', 1]])->orWhere([['member_id', '=', $id], ['payment', '=', 4]])->where('month', $month)->get();
            $pay_list = DB::table('dailyreports')->where([['member_id', '=', $id], ['payment', '=', 2]])->where('month', $month)->get();
            $sum = DB::table('dailyreports')->where([['member_id', '=', $id], ['payment', '=', 1]])->orWhere([['member_id', '=', $id], ['payment', '=', 4]])->where('month', $month)->sum('amount');
            $pay=DB::table('dailyreports')->where([['member_id','=',$id],['payment','=',2]])->where('month', $month)->sum('amount');


        }
        $remain_debit = DB::table('debit_list')->where('member_id', $id)->first();
        return view('monthly.debit_list_by_id', ['debit_list' => $debit_list_by_id, 'pay_list' => $pay_list, 'id' => $id, 'remain_debit' => $remain_debit->sum_amount, 'member_id' => $id, 'date' => $month,'sum'=>$sum,'pay'=>$pay]);

    }

    public function get_paying($id)
    {
        $member = Activemember::find($id);
        $balance = DB::table('debit_list')->where('member_id', $id)->first();


        return view('monthly.pay', ['member' => $member, 'balance' => $balance->sum_amount]);

    }

    public function paying(Request $request)
    {
        //
        $rules = array(
            'amount' => 'required|numeric',

        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return 'error';
        }
        date_default_timezone_set("Asia/Rangoon");
        $daily = date('d/m/Y');
        $month = date('m/Y');
        $vars = Auth::user();
        $approved_by = $vars->username;
        $ct=Carbon::now();

        DB::insert("INSERT INTO dailyreports (member_id, description ,approved_by ,payment,amount,approved_date,month,created_at,updated_at)
            VALUES ($request->member_id, 'Paying', '$approved_by','2',$request->amount,'$daily','$month','$ct','$ct')");
        $old_all_credit = DB::table('debit_list')->where('member_id', $request->member_id)->first();
        $new_all_credit = $old_all_credit->sum_amount - $request->amount;
        DB::table('debit_list')->where('member_id', $request->member_id)->update(['sum_amount' => $new_all_credit, 'updated_at' => Carbon::now()]);
        flash('successfully paid!');

        return redirect('debit_list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
      
    public function credit_debit()
    {
        if(Input::get('id')==''){
            if(Input::get('type')==''){
                $all_data=DB::table('dailyreports')->where([['member_id','=',1],['payment','=',1]])->get();
                return view('monthly.debit_credit',['all_data'=>$all_data,'id'=>1,'name'=>'Auonkhay']);
            }
            else{
                $all_data=DB::table('dailyreports')->where([['member_id','=',1],['payment','=',Input::get('type')]])->get();
                return view('monthly.debit_credit',['all_data'=>$all_data,'id'=>1,'name'=>'Auonkhay']);
            }
        }
        else{
            if(Input::get('type')==''){
                $mem_data=DB::table('activemembers')->where('id',Input::get('id'))->first();
                $all_data=DB::table('dailyreports')->where([['member_id','=',Input::get('id')],['payment','=',1]])->get();
                return view('monthly.debit_credit',['all_data'=>$all_data,'id'=>Input::get('id'),'name'=>$mem_data->username]);
            }
            else{
                $mem_data=DB::table('activemembers')->where('id',Input::get('id'))->first();
                $all_data=DB::table('dailyreports')->where([['member_id','=',Input::get('id')],['payment','=',Input::get('type')]])->get();
                return view('monthly.debit_credit',['all_data'=>$all_data,'id'=>Input::get('id'),'name'=>$mem_data->username]);
            }
        }
    }



    public function getbonus_transfer()
    {
        //
        if(Input::get('date')==''){
            $date = Carbon::now()->format('Y/m/d');

            if(Input::get('id')!=''){
                $dailys = DB::table('bonus_transfer')->where('member_id', Input::get('id'))->get();

            }else {
                $dailys = DB::table('bonus_transfer')->whereDate('created_at','=',$date)->orderBy('id', 'DESC')->get();

            }
        }
        else {
            $date = Carbon::parse(Input::get('date'))->format('Y/m/d');
            if(Input::get('id')!=''){
                $dailys = DB::table('bonus_transfer')->where('member_id', Input::get('id'))->whereDate('created_at','=',$date)->get();

            }else {
                $dailys = DB::table('bonus_transfer')->whereDate('created_at','=',$date)->orderBy('id', 'DESC')->get();

            }

        }
        return view('monthly.bonus_transfer')->with('dailys', $dailys);
    }
    public function gettopup_tran(Request $request)
    {
        if(Input::get('date')==''){
            $date = Carbon::now()->format('d/m/Y');

            if(Input::get('id')!=''){
                $dailys = DB::table('topup_transfer')->where('member_id', Input::get('id'))->get();

            }else {
                $dailys = DB::table('topup_transfer')->where('date','=',$date)->orderBy('id', 'DESC')->get();

            }
        }
        else {
            $date = Carbon::parse(Input::get('date'))->format('d/m/Y');
            if(Input::get('id')!=''){
                $dailys = DB::table('topup_transfer')->where([['member_id','=', Input::get('id')],['date','=',$date]])->get();

            }else {
                $dailys = DB::table('topup_transfer')->where('date',$date)->orderBy('id', 'DESC')->get();

            }

        }
        return view('monthly.topup_transfer')->with('dailys', $dailys);
    }
   public function daily_by_staff()
    {
        if(Input::get('date')==''){
            $date= Carbon::now()->toDateString();
            $getstaff=DB::table('dailyreports')->whereBetween('created_at',[$date.' 00.00.00',$date.' 23.59.59'])->get();
        }else{
            $date= Carbon::parse(Input::get('date'))->toDateString();
            $getstaff=DB::table('dailyreports')->whereBetween('created_at',[$date.' 00.00.00',$date.' 23.59.59'])->get();
        }
        return view('monthly.daily_by_staff',['daily'=>$getstaff,'date'=>$date]);

    }




}
