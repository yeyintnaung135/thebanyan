<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Income;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PhonebillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::all();
        return view('income.phonebill.index')->with('incomes', $incomes);
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
        // $rules = array(
        //     'member_id' => 'required',
        //     'card_type' => 'required',
        //     'card_price' => 'required',
        //     'status' => '',
        // );

        // $validator = Validator::make(Input::all(), $rules);

        //     if ($validator->passes()) {

        //             $status = Input::get('status');

        //             if ( $status == 'success') {
        //                 date_default_timezone_set("Asia/Rangoon");
        //                 $year = date('Y-m-d h:i:s');
        //                 $date = date('m/Y');

        //                 $income = New Income();
        //                 $member_id = Input::get('member_id');
        //                 $income->member_id = $member_id;
        //                 $income->card = Input::get('card_type');
        //                 $amount = Input::get('card_price');
        //                 $income->amount = $amount;
        //                 $income->monthly = $date;
        //                 $income->save();

        //                 $memberbalance = DB::table('activemembers')->where('id','=',$member_id)->pluck('balance');

        //                 $pickbalance= $memberbalance['0'];

        //                 $var = $pickbalance - $amount;

        //                 DB::table('activemembers')
        //                     ->where('id',$member_id)
        //                     ->update(array('balance' => $var));


        //                 return Response::json([
        //                         'Success' => '1',
        //                     ], 400);

        //             }else{
        //                 return Response::json([
        //                     'Success' => '0',
        //                 ], 400);
        //             }
                
        //     }else{
        //         return Response::json([
        //                     'Success' => '2',
        //                 ], 400);
        //     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function getmonthlyincome()
    {
        $incomes = DB::table('incomes')
                    ->select('card','monthly')
                    ->groupBy('monthly')
                    ->get();
        return view('income.phonebill.monthlyincome')->with('incomes', $incomes);
    }
}
