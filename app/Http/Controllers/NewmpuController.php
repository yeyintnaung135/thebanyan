<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;



class NewmpuController extends Controller
{
    /**show
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('mpu.checkout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function to_gateway(Request $request){

       return view('mpu.checkout_processing',['p'=>$request->all()]);
    }
     public function return_front(Request $request){
     if($request->respCode == '00'){

             $get_user= DB::table('activemembers')->where('id',$request->userDefined3)->first();
             $old_balance=$get_user->main_balance;
             if($request->userDefined2 > 25000){
                 $new_balance=($get_user->main_balance + $request->userDefined2) - ($request->userDefined2 * 0.01);
                 $difb=$request->userDefined2 * 0.01;
                 $fee='1%';
             }
             else{
        $new_balance=($get_user->main_balance + $request->userDefined2) - 250;
        $difb=$request->userDefined2 - 250;
         $fee=250;


             }

            if(DB::table('activemembers')->where('id',$request->userDefined3)->update(['main_balance'=>$new_balance]))
            {
            DB::table('mpu_request')->insert(['rd'=>'no','userid'=>$request->userDefined3,'amount'=>$request->userDefined2,'old_balance'=>$old_balance,'status'=>'finished','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
            DB::table('messages')->insert(['tb_id'=>$request->userDefined3,'description'=>'You have added '.$difb.' coins with mpu.Transfer Fee '.$fee,'subject'=>'pay with mpu','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);


            }

         }
      return view('mpu.mpu_result_fe',['re'=>$request->all()]);

    }
      public function return_bk(){
        return view('mpu.mpu_result_b');
    }
    
    public function show_mpu_requests()
    {
        if (Input::get('date') == '') {
            $date = Carbon::now()->toDateString();
        }
        else {
            $date = Input::get('date');
        }
        $mpu_data = DB::table('mpu_request')->whereDate('created_at','=', $date)->get();
        return view('mpu.show_mpu_requests', ['mpu_data' => $mpu_data]);
    }

    public function show_unread_requests()
    {
        $mpu_data = DB::table('mpu_request')->where('rd', '=', 'no')->get();
        return view('mpu.show_mpu_requests', ['mpu_data' => $mpu_data]);
    }
    
    public function mark_as_read($id){
        DB::table('mpu_request')->where('id',$id)->update(['rd'=>'yes']);
        return redirect()->back();
    }
    
    public function mark_all_as_read(){
        DB::table('mpu_request')->update(['rd'=>'yes']);
        return redirect()->back();
    }
}
