<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Transfer;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('jwt.refresh');//auth with token
    }

    public function index()
    {
        $active_id = Input::get('active_id');

        $inactive_id = Input::get('inactive_id');

        if (!empty($active_id)) {
            $results = DB::table('activemembers')->where('id',$active_id)->first();
            $results->nrc_no='**********';

            if (!empty($results)) {
                return Response::json([
                    'Success' => '1',
                    'Balance' => [$results]
                ], 200);// 200 = OK
            } else {
                return Response::json([
                    'Success' => '0',
                    'Message' => 'ID does not found!'
                ], 200);// 200 = OK
            }
        }
        if (!empty($inactive_id)) {
            $results = DB::table('members')->where('id',$inactive_id)->first();
            $results->nrc_no='*********';



            if (!empty($results)) {
                return Response::json([
                    'Success' => '1',
                    'Balance' => [$results]
                ], 200);// 200 = OK
            } else {
                return Response::json([
                    'Success' => '0',
                    'Message' => 'ID does not found!'
                ], 200);// 200 = OK
            }
        }
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start_t=Carbon::now();
        if(Carbon::now() < $start_t->addSecond(3)) {
            $from_id = Input::get('from_id');
            $to_id = Input::get('to_id');
            $tdata = DB::table('activemembers')->where('id', '=', $from_id)->first();
            $gtoken=$_GET['token'];
            if($gtoken !== $tdata->token){
             return Response::json([
                    'Success' => '0',
                    'Message' => 'No Enough Balance for Transfer!',
                ], 200);// 200 = OK
             }
        


            $transferamount = Input::get('amount');


            $amount = $transferamount * 0.01;

            $totalamount = $transferamount + $amount;


            $balance = DB::table('activemembers')->where('id', '=', $from_id)->pluck('main_balance');

            $pickbalance = $balance['0'];

            if ($pickbalance >= $totalamount) {

                $tobalance = DB::table('activemembers')->where('id', '=', $to_id)->pluck('main_balance');
                $picktobalance = $tobalance['0'];

                $from_amount = $pickbalance - $totalamount;

                DB::table('activemembers')
                    ->where('id', $from_id)
                    ->update(array('main_balance' => $from_amount));

                $tobalance = DB::table('activemembers')->where('id', '=', $to_id)->pluck('main_balance');
                $picktobalance = $tobalance['0'];

                $to_amount = $picktobalance + $transferamount;

                DB::table('activemembers')
                    ->where('id', $to_id)
                    ->update(array('main_balance' => $to_amount));

                date_default_timezone_set("Asia/Rangoon");
                $year = date('Y-m-d h:i:s');
                $date = date('m/Y');

                $transfer = New Transfer();
                $transfer->member_id = $from_id;
                $transfer->transfer_id = $to_id;
                $transfer->amount = $transferamount;
                $transfer->monthly = $date;
                $transfer->save();


                $balance = DB::table('activemembers')->where('id', '=', $from_id)->pluck('main_balance');
                $from_balance = $balance['0'];

                $pickdate = DB::table('bonusoutcome')->where('curdate', '=', $date)->pluck('curdate');

                if (empty($pickdate)) {
                    DB::insert("INSERT INTO bonusoutcome (curdate,transferbonus)
                                VALUES ('$date','$amount')");
                } else {

                    $transferbonus = DB::table('bonusoutcome')->where('curdate', '=', $date)->pluck('transferbonus');

                    if (empty($transferbonus)) {

                        DB::table('bonusoutcome')
                            ->where('curdate', $date)
                            ->update(array('transferbonus' => $amount));
                    } else {

                        $picktransferbonus = $transferbonus['0'];

                        $tolamount = $picktransferbonus + $amount;

                        DB::table('bonusoutcome')
                            ->where('curdate', $date)
                            ->update(array('transferbonus' => $tolamount));
                    }
                }


                return Response::json([
                    'Success' => '1',
                    'Message' => 'Successfull',
                    'Balance' => $from_balance
                ], 200);// 200 = OK


            } else {
                return Response::json([
                    'Success' => '0',
                    'Message' => 'No Enough Balance for Transfer!',
                ], 200);// 200 = OK
            }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function transfer_bo(Request $request)
    {
        $amount=Input::get('amount');
        $gtoken=$_GET['token'];
        //
       
        $data=DB::table('activemembers')->where('id',$request->member_id)->first();
        if($gtoken !== $data->token){
            return Response::json([
                'Success' => '0',
                'Message' => 'Your Bonus balance is not necessary',

            ], 200);// 200 = OK
        }
       if($data->balance < 5000)
       {
            return Response::json([
                'Success' => '0',
                'Message' => 'Your Bonus balance is lower than 5000 ',

            ], 200);// 200 = OK
        }
        if($amount<=$data->balance){
            $new=$data->balance - $amount;
            $new_main=$data->main_balance + $amount;
            DB::table('activemembers')->where('id',$request->member_id)->update(['balance'=>$new,'main_balance'=>$new_main]);

              $request['created_at']=Carbon::now();
            $request['updated_at']=Carbon::now();
            DB::table('bonus_transfer')->insert([Input::except('token')]);//get tansaction records
            return Response::json([
                'Success' => '1',
                'Message' => 'Successfully transfer',
                'Main_balance'=>$new_main,
                'bonus'=>$new
            ], 200);// 200 = OK


        }
        else{
            return Response::json([
                'Success' => '0',
                'Message' => 'Your Bonus balance is not necessary',
            ], 200);// 200 = OK


        }
    }

    public function gettransaction()
    {

        $member_id = Input::get('member_id');


      
        $topups = DB::table('incomes')
            ->select('card', 'amount', 'topup_code', 'created_at')
            ->where('member_id', $member_id)
            ->orderBy('created_at', 'desc')
            ->limit('100')
            ->get();

        $transfers = DB::table('transfers')
            ->select('transfer_id', 'amount', 'created_at')
            ->where('member_id', $member_id)
            ->orderBy('created_at', 'desc')
            ->limit('100')
            ->get();

        $withdraws = DB::table('withdraws')
            ->select('amount', 'created_at')
            ->where('member_id', $member_id)
            ->orderBy('created_at', 'desc')
            ->limit('100')
            ->get();


        $approvemembers = DB::table('approvemembers')
            ->select('approve_id', 'created_at')
            ->where('member_id', $member_id)
            ->orderBy('created_at', 'desc')
            ->limit('100')
            ->get();


        return Response::json([
            'Success' => '1',
            'Message' => 'Transaction Success !',
            'TopUp' => $topups,
            'Transfer' => $transfers,
            'Withdraw' => $withdraws,
            'Approvemember' => $approvemembers
        ], 200);// 200 = OK

    }
}
