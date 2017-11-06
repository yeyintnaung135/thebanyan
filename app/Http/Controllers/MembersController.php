<?php

namespace App\Http\Controllers;

use App\Member;
use App\Activepoint;
use App\Activemember;
use Carbon\Carbon;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'getagents']);
        $this->middleware('LockStaff',['except'=>'getagents']);
    }

    public function index()
    {
        $members = Activemember::orderBy('id', 'ASC')->get();

        return view('members.activeshow', compact('payment'))->with('members', $members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required|unique:members|unique:activemembers',
            'father_name' => 'required',
            'password' => 'required',
            //'bank_branch' => 'required',
            'nrc_no' => 'required|unique:members|unique:activemembers',
            'phone_no' => 'required',
            'address' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $sponsor = Input::get('sponsor_id');
            if (empty($sponsor) || ($sponsor == '-')) {
                $sponsor_id = '1';
            } else {
                $sponsor_id = $sponsor;
            }
            if (empty(Input::get('main_sponsor_id'))) {
                $main_sponsor_id = 1;
            } else {
                $main_sponsor_id = Input::get('main_sponsor_id');
            }

            $results = DB::select("select * from activemembers where id = '$sponsor_id' ");

            if (!empty($results)) {

                date_default_timezone_set("Asia/Rangoon");
                $year = date('Y-m-d h:i:s');
                $date = date('m/Y');

                $member = New Member();
                $member->sponsor_id = $sponsor_id;
                $member->main_sponsor_id = $main_sponsor_id;
                $member->username = Input::get('username');
                $member->child_count = '0';
                $member->password = Input::get('password');
                $member->father_name = Input::get('father_name');
                //$member->bank_branch = Input::get('bank_branch');
                $member->nrc_no = Input::get('nrc_no');
                $member->agent_id = Input::get('agent_id');
                $member->phone = Input::get('phone_no');
                $member->address = Input::get('address');
                $member->status = 'pending';
                $member->balance = '0';
                $member->date = $date;
                $member->save();

                flash('member registration succefully!');

                return redirect('deactivemember');

            } else {
                flash('sponsor_id no access create member!');
                return Redirect::intended('member/create');
            }


        } else {
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the product
        $member = Activemember::find($id);

        // show the view and pass the product to it
        return View('members.show')
            ->with('member', $member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // get the member
        $member = Activemember::find($id);

        //return $member;
        if((Auth::user()->id == '17') or (Carbon::now()->hour < 9) or (Carbon::now()->hour > 17)  or (\Carbon\Carbon::now()->dayOfWeek == '7')){
            if(Auth::user()->role == 'SuperAdmin'){
                return View('members.editbalance', compact('member'));
            }else{
                return 'Time OUT';

            }
        }
    else{
        // show the edit form and pass the member
        return View('members.editbalance', compact('member'));
       }
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
        $memberID = $request->memberId;

        $member = Activemember::find($memberID);

        $add_balance = $request->balance + $request->addBalance;
        $org_balance = $request->addBalance;

        Activemember::whereId($memberID)->update(['username'=>$request->memberName,'main_balance' => $add_balance]);

        date_default_timezone_set("Asia/Rangoon");
        $daily = date('d/m/Y');
        $month = date('m/Y');
        $ct=Carbon::now();

        $payment = $request->payment;

        $vars = Auth::user();

        $approved_by = $vars->username;
        if ($add_balance != '0') {

            if ($payment == 0) {
                DB::insert("INSERT INTO dailyreports (member_id, description ,approved_by ,payment,amount,approved_date,month,created_at,updated_at)
            VALUES ('$memberID', 'Added Balance', '$approved_by','$payment','$org_balance','$daily','$month','$ct','$ct')");
            } else {
                $is_or_not = DB::table('debit_list')->where('member_id', $memberID)->count();
                if ($is_or_not > 0) {
                    $old_sum_amount = DB::table('debit_list')->where('member_id', $memberID)->first();
                    $new_sum_amount = $old_sum_amount->sum_amount + $request->addBalance;
                    DB::table('debit_list')->where('member_id', $memberID)->update(['sum_amount' => $new_sum_amount, 'updated_at' => Carbon::now()]);


                } else {
                    DB::table('debit_list')->insert(['member_id' => $memberID, 'sum_amount' => $request->addBalance, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);


                }
                DB::insert("INSERT INTO dailyreports (member_id, description ,approved_by ,payment,amount,approved_date,month,created_at,updated_at)
            VALUES ('$memberID', 'Added Balance', '$approved_by','$payment','$org_balance','$daily','$month','$ct','$ct')");
            }
        }
        flash('Updated success!');
        return redirect('member');

        //return redirect('member')->with('status','Successfully Updated');


        //

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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function member_status()
    {
        return view('members.status');
    }

    public function getnewmember()
    {
        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('m/Y');

        $newmembers = DB::select("select * from activemembers where date = '$date'");

        return view('members.newmember')->with('newmembers', $newmembers);
    }

    public function getoldmember()
    {
        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('m/Y');

        $oldmembers = DB::select("select * from activemembers where NOT date = '$date'");

        return view('members.oldmember')->with('oldmembers', $oldmembers);
    }

    public function getactivemember()
    {
        return view('members.activemember');
    }

    public function getinactivemember()
    {
        return view('members.inactivemember');
    }

    public function addbonus($id)
    {

        $memberbonus = DB::table('incomes')
            ->where('member_id', '=', $id)
            ->first();

        return view('members.addbonus')->with('memberbonus', $memberbonus);
    }

    public function membering_bonus(Request $request)
    {
        $bonus = $request->bonus;
        DB::table('bonus')
            ->where('id', '1')
            ->update(array('bonus' => $bonus));

        flash('membering bonus updated!');
        return redirect('bonuspercent');
    }

    public function billing_bonus(Request $request)
    {
        $bonus = $request->bonus;
        $extra = $request->extra;
        DB::table('billingbonus')
            ->where('id', '1')
            ->update(array('billbonus' => $bonus, 'extra' => $extra));

        flash('billing bonus updated!');
        return redirect('bonuspercent');
    }

    public function nmsi_bonus(Request $request)
    {
        $bonus = $request->nmsi_bonus;
        DB::table('nmsi_bonus')
            ->where('id', '1')
            ->update(array('nmsi_bonus' => $bonus, 'small_nmsi_bonus' => $request->small_nmsi_bonus, 'first_nmsi' => $request->first_nmsi, 'second_nmsi' => $request->second_nmsi));

        flash('Nmsi bonus updated!');
        return redirect('bonuspercent');
    }

    public function setagent($id)
    {
        DB::table('agents')->insert(['tb' => $id, 'set_by' => Auth::user()->username]);
        flash('successfully set an agent!');

        return redirect()->back();

    }

    public function getagents()
    {
        $agents = DB::table('agents')->orderBy('created_at','asc')->get();
        return Response::json([
            'Success' => '1',
            'agents_id' => $agents
        ], 400);
    }
   public function login_timer(){
        $data=DB::table('login_time')->get();
        return view('login.timer',['data'=>$data]);
    }
    
        public function locked_members()
    {
      $lm=DB::table('password_wrong')->where('status','new')->groupBy('username')->get();
      return view('members.locked',['data'=>$lm]);
    }
    public function reactive($id)
    {
       
       
            DB::table('password_wrong')->where('username',$id)->update(['status'=>'old','by_who'=>Auth::user()->username,'updated_at'=>Carbon::now()]);
            return redirect('locked_members');
      

    }

   
    

}
