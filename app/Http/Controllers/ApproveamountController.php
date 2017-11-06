<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ApproveamountController extends Controller
{
    //
       public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('LockedStaff');
    }
    public function add_amount_view($id)
    {
        $data = DB::table('activemembers')->where('id', $id)->first();


        return view('approve_balance.add_approve_amount',['data'=>$data]);


    }

    public function add_amount(Request $request)
    {
        $rule = ['id' => 'required', 'amount' => 'required'];
        $validator = Validator::make(Input::all(), $rule);
        if ($validator->fails()) {
            return 'error';

        }
        date_default_timezone_set("Asia/Rangoon");
        $daily = date('d/m/Y');
        $month = date('m/Y');
        $old = DB::table('activemembers')->where('id', $request->id)->first();
        $new = $old->amount_for_approve + $request->amount;
        DB::table('activemembers')->where('id', $request->id)->update(['amount_for_approve' => $new]);
        DB::table('dailyreports')->insert(['member_id'=>$request->id,'payment'=>$request->payment,'description'=>'approve balance','month'=>$month,'approved_by'=>Auth::user()->username,'amount'=>$request->amount,'approved_date'=>$daily]);
       if($request->payment == 4){
            $old_sum= DB::table('debit_list')->where('member_id', $request->id)->first();
            $new_sum_amount=$old_sum->sum_amount + $request->amount;

            DB::table('debit_list')->where('member_id', $request->id)->update(['sum_amount' => $new_sum_amount, 'updated_at' => Carbon::now()]);

        }
        flash('Updated success!');
        return redirect('member/'.$request->id);


    }

}
