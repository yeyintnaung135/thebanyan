<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TransactionController extends Controller
{
    //
    public function post_tran_mem(Request $request)
    {if(Input::get('member_id')=='') {
        if (Input::get('date') == '') {
            $date = Carbon::now()->toDateString();

        } else {
            $date = Carbon::parse(Input::get('date'))->toDateString();
        }
        $data = DB::table('incomes')->whereDate('created_at', '=', $date)->orderBy('created_at', 'desc')->get();
    }
    else{
        if (Input::get('date') == '') {
            $data = DB::table('incomes')->where('member_id','=',Input::get('member_id'))->orderBy('created_at', 'desc')->get();

        } else {
            $date = Carbon::parse(Input::get('date'))->toDateString();
            $data = DB::table('incomes')->where('member_id','=',Input::get('member_id'))->whereDate('created_at', '=', $date)->orderBy('created_at', 'desc')->get();

        }


    }
        return view('transaction.all',['data'=>$data,'member_id'=>Input::get('member_id')]);


    }
  public function tran_transfer(Request $request){
      if(Input::get('member_id')=='') {
          if (Input::get('date') == '') {
              $date = Carbon::now()->toDateString();

          } else {
              $date = Carbon::parse(Input::get('date'))->toDateString();
          }
          $data = DB::table('transfers')->whereDate('created_at', '=', $date)->orderBy('created_at', 'desc')->get();
      }else{
          if (Input::get('date') == '') {
              $data = DB::table('transfers')->where('member_id',Input::get('member_id'))->orderBy('created_at', 'desc')->get();

          } else {
              $date = Carbon::parse(Input::get('date'))->toDateString();
              $data = DB::table('transfers')->where('member_id',Input::get('member_id'))->whereDate('created_at', '=', $date)->orderBy('created_at', 'desc')->get();

          }

      }
        return view('transaction.transfer',['data'=>$data,'member_id'=>Input::get('member_id')]);
    }


}
