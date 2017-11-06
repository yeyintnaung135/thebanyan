<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class BonusTransactionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Bonus($id){
        $bonus_fi=DB::table('bonus_transaction')->where('tb',$id)->whereYear('created_at','=',Carbon::now()->year)->whereMonth('created_at','=',Carbon::now()->month)->get();//get transfer amount
        $exb_fi=DB::table('messages')->where([['tb_id','=',$id],['subject','=','Get 1000 bonus']])->whereYear('created_at','=',Carbon::now()->year)->whereMonth('created_at','=',Carbon::now()->month)->get();//get transfer amount
        return view('members.membonustra',['bonus'=>$bonus_fi,'ext'=>$exb_fi,'id'=>$id,'date'=>'']);



    }
    public function Bonus_by_month(Request $request){
        $id=$request->id;
        $date=$request->date;

        $bonus_fi=DB::table('bonus_transaction')->where('tb',$id)->whereYear('created_at','=',Carbon::parse($date)->year)->whereMonth('created_at','=',Carbon::parse($date)->month)->get();//get transfer amount
        $exb_fi=DB::table('messages')->where([['tb_id','=',$id],['subject','=','Get 1000 bonus']])->whereYear('created_at','=',Carbon::parse($date)->year)->whereMonth('created_at','=',Carbon::parse($date)->month)->get();//get transfer amount
        return view('members.membonustra',['bonus'=>$bonus_fi,'ext'=>$exb_fi,'id'=>$id,'date'=>$date]);



    }
      public function Bonus_by_tb($id){
        $get_nrc=DB::table('activemembers')->where('id',$id)->first();
        $nrc=$get_nrc->nrc_no;
        $cna=DB::table('bonus_transaction')->where('by_whom',$get_nrc->username);
        if($cna->count()!= 0){
            $bonus_fi=$cna->get();
        }else{
            $bonus_fi=DB::table('bonus_transaction')->where('nrc',$nrc);//get transfer amount
            if($bonus_fi->count() == 0){
                $bonus_fi='';
            }

        }
        $exb_fi=DB::table('messages')->where([['description','=','You have received 1000 bonus for approving &nbsp;&nbsp;TB'.$id]])->get();//get transfer amount
        return view('members.bonus_get_by',['bonus'=>$bonus_fi,'ext'=>$exb_fi,'id'=>$id,'date'=>'']);


    }
}
