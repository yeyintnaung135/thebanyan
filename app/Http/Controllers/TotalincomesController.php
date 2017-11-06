<?php

namespace App\Http\Controllers;
use App\Totalincome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class TotalincomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalincomes = Totalincome::all();
        return view('monthly.totalincome')->with('totalincomes', $totalincomes);
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
        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('m/Y');

        $pickdate = DB::table('totalincomes')->where('monthly','=',$date)->pluck('monthly');
        if(empty($pickdate)){

            $totalincome = New Totalincome();
            $totalincome->phone_bill = Input::get('phone_bill');
            $totalincome->member_fee = Input::get('member_fee');
            $totalincome->total_income = Input::get('total_income');
            $totalincome->monthly = $date;
            $totalincome->save();

            flash('Insert Totalincome succefully!');

            return redirect('totalincome');
        }else{
       	 	$phone_bill = Input::get('phone_bill');
            	$member_fee = Input::get('member_fee');
            	$total_income = Input::get('total_income');
        
        	DB::table('totalincomes')
			->where('monthly',$date)
            		->update(array('phone_bill' => $phone_bill,'member_fee'=>$member_fee,'total_income'=>$total_income));

            flash('Updated Success!');
            return Redirect::back();
        }
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
}
