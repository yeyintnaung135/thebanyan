<?php

namespace App\Http\Controllers;

use App\topup_transfer;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Income;
use App\Activemember;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class TotopupController extends Controller
{
    //
    public function __construct()
    {
        //this is api token middleware
        $this->middleware('jwt.refresh', ['only' => 'store']);//auth with token


    }

    public function index(Request $request)
    {
        //
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
        $member_id = $_REQUEST['member_id'];


        $balance = DB::table('activemembers')->where('id', '=', $member_id)->pluck('main_balance');
        $tdata = DB::table('activemembers')->where('id', '=', $member_id)->first();
        $gtoken=$_GET['token'];
        if($gtoken !== $tdata->token){
            return Response::json([
                'Success' => '0',
                'Message' => 'cannot buy',

            ], 200);// 200 = OK
        }
        $pickbalance = $balance['0'];

        $cardprice = $_REQUEST['CardPrice'];

        if ($pickbalance >= $cardprice) {
            $ctype = $_REQUEST['CardType'];
            $cardprice = $_REQUEST['CardPrice'];
            $member_id = $_REQUEST['member_id'];


            switch ($cardprice) {
                case "1000":
                    $cp = 1;
                    break;
                case "3000":
                    $cp = 2;
                    break;
                case "5000":
                    $cp = 3;
                    break;
                default:
                    $cp = 4;
                    break;

            }
            switch ($ctype) {
                case "101":
                    $ct = 1;
                    $ctname = 'MPT';
                    break;
                case "121":
                    $ct = 2;
                    $ctname = 'Ooredoo';
                    break;
                default:
                    $ct = 3;
                    $ctname = 'Telenor';

                    break;

            }

            $params = array(
                "merchantID" => "0165061407975147",
                "secret" => "F31X6YH5CMMO0AV5",
                "card" => $ct,
                "price" => $cp,
                "user" => $member_id
            );
            $postData = '';
            //create name value pairs seperated by &
            foreach ($params as $k => $v) {
                $postData .= $k . '=' . $v . '&';
            }
            $postData = rtrim($postData, '&');
            // post data to topup server
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'http://topup.thebanyanmm.org/public/buying-topup');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, count($postData));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            $output = curl_exec($ch);
            //$ouput is result return from topup server
            $jo = json_decode($output);

            curl_close($ch);


            if ($jo->status == 1) {
                $pin = $jo->topup_code;

                date_default_timezone_set("Asia/Rangoon");
                $year = date('Y-m-d h:i:s');
                $date = date('m/Y');

                $balance = DB::table('activemembers')->where('id', '=', $member_id)->pluck('main_balance');
                $pickbalance = $balance['0'];

                $returnbalance = $pickbalance - $cardprice;


                $income = New Income();
                $income->member_id = $member_id;
                $income->card = $_REQUEST['CardType'];
                $income->amount = trim($cardprice);
                $income->topup_code = trim($pin);
                $income->monthly = $date;
                $income->status = 'new';
                $income->save();

                $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where member_id=$member_id and status='new' ");
                $useamount = $totalamount[0]->amount;

                DB::table('activemembers')
                    ->where('id', $member_id)
                    ->update(array('main_balance' => $returnbalance));

                $control = DB::table('activemembers')->where('id', '=', $member_id)->pluck('control');
                $pickcontrol = $control['0'];

                if ($pickcontrol == '0') {

                    $monthlyactivepoint = DB::table('activepoints')->where('monthly', '=', $date)->pluck('activepoint');

                    if (!empty($monthlyactivepoint)) {
                        $resultactivepoint = $monthlyactivepoint['0'];

                        if ($useamount >= $resultactivepoint) {
                            DB::table('activemembers')
                                ->where('id', $member_id)
                                ->update(array('control' => '1'));
                            $parent = DB::select(DB::raw("SELECT pid from relateds WHERE cid=$member_id ORDER BY id DESC LIMIT 13"));//notice that
                            foreach ($parent as $data) {
                                $pid = $data->pid;
                                $par = Activemember::find($pid);
                                $active_count = $par['active_count'];

                                $totalactive_count = $active_count + 1;

                                $active = 'active';

                                DB::table('activemembers')
                                    ->where('id', $pid)
                                    ->update(array('active_count' => $totalactive_count, 'bonus_status' => $active));
                            }
                        }
                    }
                }
                return Response::json([
                    'Success' => '1',
                    'Message' => 'TopUp Success',
                    'Topup' => trim($jo->topup_code),
                    'Main_Balance' => $returnbalance,
                    'CardType' => $ctype,
                    'MonthlyUse' => $useamount,
                ], 200);// 200 = OK


            } else {
                return Response::json([
                    'Success' => '0',
                    'Message' => 'cannot buy',

                ], 200);// 200 = OK
            }
        } else {
            return Response::json([
                'Success' => '0',
                'Message' => 'No enough balance for topup!',
            ], 200);// 200 = OK
        }
    }
  public function topup_transfer(Request $request){
    date_default_timezone_set("Asia/Rangoon");

    $request['date']=date('d/m/Y');
    topup_transfer::create($request->all());
    return Response::json([
        'Success' => '1',
        'phone_no' => $request->phone_no,
        'amount'=>$request->amount,
        'member_id'=>$request->member_id
    ],200);// 200 = OK
}
public function topup_by_phone(){
      if(Input::get('date')==''){
         $d= DB::table('topup_transfer')->get();
          return view('topup.topup_by_phone',['tbp'=>$d]);

      }else{
          $date=Carbon::parse(Input::get('date'))->format('Y-m-d');
          $d= DB::table('topup_transfer')->whereDate('created_at','=',$date)->get();
          return view('topup.topup_by_phone',['tbp'=>$d]);

      }
}
public function topup_balance(){

    if(Input::get('month')==''){
        $data=DB::connection('mysql1')->table('topup')->select('date')->distinct()->whereMonth('created_at','=',Carbon::now()->month)->whereYear('created_at','=',Carbon::now()->year)->get();
    }else{
        $month=Carbon::parse(Input::get('month'))->month;
        $data=DB::connection('mysql1')->table('topup')->select('date')->distinct()->whereMonth('created_at','=',$month)->whereYear('created_at','=',Carbon::parse(Input::get('month'))->year)->get();

    }
 return view('topup.topup_profit',['data'=>$data]);
}
public function topup_cal(Request $request){
    $mpt=$request->mpt;
    $oo=$request->oo;
    $tel=$request->tel;
    $mptper=$request->mptper;
    $ooper=$request->ooper;
    $telper=$request->telper;
    $mptpercent=$mptper/100;
    $oopercent=$ooper/100;
    $telpercent=$telper/100;
    $mptprofit=$mpt * $mptpercent;
    $ooprofit=$oo * $oopercent;
    $telprofit=$tel * $telpercent;
    $total=$mptprofit+$telprofit+$ooprofit;

    if(DB::table('topup_profit')->insert(['mpt'=>$mpt,'ooredoo'=>$oo,'telenor'=>$tel,'mptprofit'=>$mptprofit,'mptper'=>$mptper,'telper'=>$telper,'ooper'=>$ooper,'amount'=>$total,'ooprofit'=>$ooprofit,'teleprofit'=>$telprofit,'date'=>$request->date,'month'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]))
    return redirect()->back();

}

}
