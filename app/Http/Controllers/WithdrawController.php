<?php

namespace App\Http\Controllers;

use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('jwt.refresh',['only'=>'store']);
    }

    public function index()
    {
    	$date = Carbon::parse(Input::get('pickdate'))->format('Y-m-d');

        $withdraws = DB::table('withdraws')->whereDate('created_at','=',$date)->get();
        return view('withdraw.index')->with('withdraws', $withdraws);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member_id = Input::get('member_id');
    
        $withdraw_amount = Input::get('amount');

        if ($withdraw_amount >= '50000') {

        $bank_branch= Input::get('bank_branch');
        $balance= DB::table('activemembers')->where('id','=',$member_id)->pluck('balance');
        $pickbalance = $balance['0'];

            if($pickbalance >= $withdraw_amount) {

                $remainbalance = $pickbalance - $withdraw_amount;

                $results = DB::select("select * from withdraws where member_id = $member_id");

                if(empty($results)){

                    date_default_timezone_set("Asia/Rangoon");
                    $year = date('Y-m-d h:i:s');
                    $date = date('d/m/Y');

                    $withdraw = New Withdraw();
                    $withdraw->member_id = $member_id;
                    $withdraw->bank_branch= $bank_branch;
                    $withdraw->amount = $withdraw_amount;
                    $withdraw->status = 'pending';
                    $withdraw->date = $date;
                    $withdraw->save();

                    DB::table('activemembers')
                        ->where('id',$member_id)
                        ->update(array('balance' => $remainbalance));


                    return Response::json([
                        'Success' => '1',
                        'Message' => 'Withdraw request successfully! Please wait admin response to you!'
                    ], 400);
                }else{
                    
                    $pending = DB::select("select * from withdraws where member_id = $member_id and status='pending'");

                if(!empty($pending)){

                    return Response::json([
                        'Success' => '0',
                        'Message' => 'Sorry your first request is pending state!'
                    ], 400);
                }else{
                        date_default_timezone_set("Asia/Rangoon");
                        $year = date('Y-m-d h:i:s');
                        $date = date('d/m/Y');

                        $withdraw = New Withdraw();
                        $withdraw->member_id = $member_id;
                        $withdraw->bank_branch = $bank_branch;
                        $withdraw->amount = $withdraw_amount;
                        $withdraw->status = 'pending';
                        $withdraw->date = $date;
                        $withdraw->save();

                        DB::table('activemembers')
                            ->where('id',$member_id)
                            ->update(array('balance' => $remainbalance));

                    return Response::json([
                        'Success' => '1',
                        'Message' => 'Withdraw request successfully! Please wait admin response to you!'
                    ], 400);
                    }
                }
                
            }else{
                return Response::json([
                        'Success' => '0',
                        'Message' => 'No enough your bonus'
                    ], 400);
            }
        }else{
        return Response::json([
                'Success' => '0',
                'Message' => 'Please Withdraw Request at least 50000',
            ], 200);// 200 = OK
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($member_id)
    {
	$amount= DB::table('withdraws')->where('member_id','=',$member_id)->where('status','=','pending')->pluck('amount');
       	$pickamount = $amount['0'];
       	
       	$username= DB::table('activemembers')->where('id','=',$member_id)->pluck('username');
       	$pickusername = $username['0'];
       
        $vars = Auth::user();
        $approved_by = $vars->username;

        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('d/m/Y');
        
        DB::insert("INSERT INTO dailyrequests (member_id, username,approved_by ,amount,approved_date)
                                        VALUES ('$member_id', '$pickusername', '$approved_by','$pickamount','$date')");

        DB::table('withdraws')
            ->where('member_id',$member_id)
            ->update(array('status' => "received", 'approved_by' => $approved_by, 'approved_date' => $date));

        flash('Withdraw Approved Success!');
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
