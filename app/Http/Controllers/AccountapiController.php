<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AccountapiController extends Controller
{
    //
    public function index()
    {
        return view('api/account_api');
    }

    public function add_balance(Request $request)
    {
        $f = Carbon::parse($request->from)->toDateTimeString() . '000000';
        $t = Carbon::parse($request->to)->toDateTimeString() . '000000';
        $data = DB::table('dailyreports')->where('description', 'Added Balance')->whereBetween('created_at', [$f, $t])->get();
        $approve_b = DB::table('dailyreports')->where('description', 'approve balance')->whereBetween('created_at', [$f, $t])->get();
        $ap_data = DB::table('dailyreports')->where('description', 'Approved User')->whereBetween('created_at', [$f, $t])->get();
        $p_data = DB::table('dailyreports')->where('description', 'paying')->whereBetween('created_at', [$f, $t])->get();
        $total_amount = 0;
        foreach ($data as $d) {
            echo $d->amount . '   ' . $d->created_at . ' '.$d->approved_by.'<br>';
            $total_amount += $d->amount;
        }
        echo '<br> Add Amount  '.$total_amount.'<br><br><br>';
        $ap_total_amount=0;

        foreach ($ap_data as $ap) {
            echo $ap->amount . '   ' . $ap->created_at . ' '.$ap->approved_by.'<br>';
            $ap_total_amount += $ap->amount;
        }
        echo '<br>Approved Amount  '.$ap_total_amount.'<br><br><br>';
        $p_total_amount=0;

        foreach ($p_data as $p) {
            echo $p->amount . '   ' . $p->created_at . ' '.$p->approved_by.'<br>';
            $p_total_amount += $p->amount;
        }
        echo '<br>Paying Amount  '.$p_total_amount.'<br><br><br>';
        $approve_total_amount=0;

        foreach ($approve_b as $app) {
            echo $app->amount . '   ' . $app->created_at . ' '.$app->approved_by.'<br>';
            $approve_total_amount += $app->amount;
        }

        echo '<br>Approve Amount  '.$approve_total_amount.'<br><br><br>';
   }
    public function see_b(Request $request){
        $f = Carbon::parse($request->from)->toDateTimeString() . '000000';
        $t = Carbon::parse($request->to)->toDateTimeString() . '000000';
        $data = DB::table('dailyreports')->where('description', 'Added Balance')->whereBetween('created_at', [$f, $t])->get();
        $total_amount = 0;
        foreach ($data as $d) {
            //echo $d->amount . '   ' . $d->created_at . ' '.$d->approved_by.'<br><br><br>';
            $total_amount += $d->amount;
        }

        $all_amount=DB::table('activemembers')->get();
        $balance=0;
        $bonus=0;
        foreach($all_amount as $am){
            $balance += $am->main_balance;
            $bonus += $am->balance;

        }
        $bill_one=DB::connection('mysql1')->table('topup')->where('amount',1000)->whereBetween('created_at',[$f,$t])->count();
        $bill_three=DB::connection('mysql1')->table('topup')->where('amount',3000)->whereBetween('created_at',[$f,$t])->count();
        $bill_five=DB::connection('mysql1')->table('topup')->where('amount',5000)->whereBetween('created_at',[$f,$t])->count();
        $bill_ten=DB::connection('mysql1')->table('topup')->where('amount',10000)->whereBetween('created_at',[$f,$t])->count();
        echo 'One Thousand ' .$bill_one . '<br><br><br>';
        echo 'Three Thousand ' . $bill_three .'<br><br><br>';
        echo 'Five Thousand '.$bill_five.'<br><br><br>';
        echo 'Ten Thousand '.$bill_ten.'<br><br><br>';
        echo 'Add Balance '.$total_amount .'<br><br><br>';
        echo 'Balance  '.$balance.'<br><br><br>';
        echo 'Bonus  '.$bonus.'<br><br><br>';

    }
    public function see_b_without_date(){
        $f = Carbon::now()->toDateString() .' 09:00:00 000000';
        $t = Carbon::now()->toDateString() .' 17:00:00 000000';
        $data = DB::table('dailyreports')->where('description', 'Added Balance')->whereBetween('created_at', [$f, $t])->get();
        $total_amount = 0;
        foreach ($data as $d) {
            //echo $d->amount . '   ' . $d->created_at . ' '.$d->approved_by.'<br><br><br>';
            $total_amount += $d->amount;
        }

        $all_amount=DB::table('activemembers')->get();
        $balance=0;
        $bonus=0;
        foreach($all_amount as $am){
            $balance += $am->main_balance;
            $bonus += $am->balance;

        }
        $bill_one=DB::connection('mysql1')->table('topup')->where([['amount','=',1000],['status','=',1]])->count();
        $bill_three=DB::connection('mysql1')->table('topup')->where([['amount','=',3000],['status','=',1]])->count();
        $bill_five=DB::connection('mysql1')->table('topup')->where([['amount','=',5000],['status','=',1]])->count();
        $bill_ten=DB::connection('mysql1')->table('topup')->where([['amount','=',10000],['status','=',1]])->count();
        echo 'One Thousand ' .$bill_one . ' Amount: '.($bill_one * 1000) .'<br><br><br>';
        echo 'Three Thousand ' . $bill_three . ' Amount: '.($bill_three * 3000) .'<br><br><br>';
        echo 'Five Thousand '.$bill_five. ' Amount: '.($bill_five * 5000) .'<br><br><br>';
        echo 'Ten Thousand '.$bill_ten.' Amount: '.($bill_ten * 10000) .'<br><br><br>';
        echo 'Add Balance '.$total_amount .'<br><br><br>';
        echo 'Balance  '.$balance.'<br><br><br>';
        echo 'Bonus  '.$bonus.'<br><br><br>';

    }
        public function see_equal_balance(Request $request){
        $from=Carbon::parse($request->from)->toDateTimeString();
        $to=Carbon::parse($request->to)->toDateTimeString();
        $all_balance_data=DB::table('activemembers')->get();
        $all_b=0;
        $all_bonus=0;
        $amount_approve=0;
        $s_bt_a = 0;
        $t_ac=0;
        $t_bt_a = 0;
        $mob=0;
                $asum=0;

        $f_bt_a = 0;
        $add_by_staff=0;
        $mb=0;
        $all_card_amount=0;
        $all_past_amount=DB::connection('mysql3')->table('activemembers')->sum('main_balance');
        $all_bonus=DB::connection('mysql3')->table('activemembers')->sum('balance');
        $amount_approve=DB::connection('mysql3')->table('activemembers')->sum('amount_for_approve');


        $all_amount=$all_past_amount + $all_bonus +$amount_approve;//all amount

        foreach($all_balance_data as $abd){




            $mem_count = DB::table('relateds')->where('pid',$abd->id )->get();

            $rcount = 0;
            foreach ($mem_count as $mc) {
                $hs = DB::table('activemembers')->where('id', $mc->cid)->whereBetween('created_at', [$from, $to])->count();
                if ($hs > 0) {

                    $checkreach = DB::table('relateds')->where('cid', $mc->cid)->orderBy('pid', 'desc')->limit(13)->get();
                    $check_array = array();
                    foreach ($checkreach as $cr) {
                        $check_array[] = $cr->pid;
                    }
                    if (in_array($abd->id, $check_array)) {

                        $rcount++;

                    } else {
                    }

                }


            }
            $mb += $rcount * 300;//member bonus total
             




        $all_nmsi = DB::table('activemembers')->where('main_sponsor_id', $abd->id)->get();
        $ac = 0;
        foreach ($all_nmsi as $an) {
            $all_count = DB::table('activemembers')->where('main_sponsor_id', $an->id)->whereBetween('created_at', [$from, $to])->count();
            $ac += $all_count;//count of sect_nmsi

        }
        $bt = DB::table('bonus_transaction')->where([['tb', '=', $abd->id], ['status','=', 'second nmsi']])->whereBetween('created_at', [$from, $to])->get();

        foreach ($bt as $bo_tr) {
            $s_bt_a += $bo_tr->amount;//bonus amount of sn

        }



        $t_all_nmsi = DB::table('activemembers')->where('main_sponsor_id',$abd->id)->get();
        foreach($t_all_nmsi as $an){
            $t_all_count=DB::table('activemembers')->where('main_sponsor_id',$an->id)->get();
            foreach($t_all_count as $ttac) {
                $th_all_count = DB::table('activemembers')->where('main_sponsor_id', $ttac->id)->whereBetween('created_at', [$from, $to])->count();
                $t_ac+=$th_all_count;//third nmsi count

            }

        }

        $tbt = DB::table('bonus_transaction')->where([['tb', '=',$abd->id], ['status','=', 'third nmsi']])->whereBetween('created_at', [$from, $to])->get();
        foreach ($tbt as $tbo_tr) {
            $t_bt_a += $tbo_tr->amount;//bonus amount of tn

        }



        $monthly_bonus_count=DB::table('messages')->where([['tb_id','=',$abd->id],['subject','=','Your Bonus for this month']])->whereBetween('created_at', [$from, $to])->count();
        $monthly_bonus=DB::table('messages')->where([['tb_id','=',$abd->id],['subject','=','Your Bonus for this month']])->whereBetween('created_at', [$from, $to])->first();
        if($monthly_bonus_count > 0){
            $str=$monthly_bonus->description;
            preg_match_all('!\d+!', $str, $matches);
            $mob  += $matches[0][0];
        }
        else{
            $mob  +=0;//bonus amount of tn
        }

        $main_sponsor= DB::table('activemembers')->where('main_sponsor_id', $abd->id)->whereBetween('created_at', [$from, $to]);
        $main_sponsor_count=$main_sponsor->count();

        $fbt = DB::table('bonus_transaction')->where([['tb', '=', $abd->id], ['status','=', 'first nmsi']])->whereBetween('created_at', [$from, $to])->get();
        foreach ($fbt as $fbo_tr) {
            $f_bt_a += $fbo_tr->amount;//bonus amount of fn

        }
            $add_by_staff+=DB::table('dailyreports')->where([['member_id','=',$abd->id],['description','=','Added Balance']])->whereBetween('created_at', [$from, $to])->sum('amount');

            $all_card = DB::table('incomes')->where('member_id', $abd->id)->whereBetween('created_at', [$from, $to])->get();
            foreach($all_card as $an){
                $all_card_amount += $an->amount;//amount of topup card

            }


        }
        $ttsum=DB::table('transfers')->whereBetween('created_at', [$from, $to])->sum('amount');//transfer to amount
        $ttpar=0;
        $ttpar=$ttsum/100;
         $aamount=DB::table('approvemembers')->whereBetween('created_at', [$from, $to])->get();
            foreach ($aamount as $aa){

                $asum+= 20000;

            }



         $now_amount_b=DB::table('activemembers')->sum('main_balance');
         $now_amount_bb=DB::table('activemembers')->sum('balance');
         $now_amount_bbb=DB::table('activemembers')->sum('amount_for_approve');
         $now_amount=$now_amount_b + $now_amount_bb + $now_amount_bbb;
       // echo 'Get amount ' .  ($mob + $f_bt_a + $t_bt_a + $s_bt_a + $mb + $add_by_staff).'<br>';
        echo 'Use Topup amount '. ($all_card_amount).'<br><br><br>';
        echo 'Transaction Percent '. $ttpar.'<br><br><br>';
        echo 'Approved Amount ' .$asum.'<br><br><br>';
       // echo $ttsum.'<br>';
        echo 'Add balance by staff '.$add_by_staff.'<br><br><br>';
        echo 'First Main sponsor bonus '.$f_bt_a.'<br><br><br>';
        echo 'Second Main sponsor bonus '.$s_bt_a.'<br><br><br>';
        echo 'Third Main sponsor bonus '.$t_bt_a.'<br><br><br>';
        echo 'Members bonus 300 kyats ' .$mb.'<br><br><br>';
        echo 'Bonus for end of month  ' .$mob.'<br><br><br>';
        echo 'Now Balance ' .$now_amount_b.'<br><br><br>';
        echo 'Now bonus ' .$now_amount_bb.'<br><br><br>';
        echo 'Now Amount for approve '. $now_amount_bbb;


    }

}
