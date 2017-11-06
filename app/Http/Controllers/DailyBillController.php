<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class DailyBillController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function daily_debit()
    {
        date_default_timezone_set("Asia/Rangoon");
        $date = date('d/m/Y');
        $cash_down=DB::table('dailyreports')->where([['payment','=',0],['approved_date','=',$date]])->sum('amount');
        $credit=DB::table('dailyreports')->where([['payment','=',1],['approved_date','=',$date]])->sum('amount');
        $credit_list=DB::table('dailyreports')->where([['payment','=',1],['approved_date','=',$date]])->get();
        $pay=DB::table('dailyreports')->where([['payment','=',2],['approved_date','=',$date]])->sum('amount');
        $paylist=DB::table('dailyreports')->where([['payment','=',2],['approved_date','=',$date]])->get();
        return view('daily.daily_debit',['cash_down'=>$cash_down,'credit'=>$credit,'pay'=>$pay,'credit_list'=>$credit_list,'paylist'=>$paylist]);
    }
}
