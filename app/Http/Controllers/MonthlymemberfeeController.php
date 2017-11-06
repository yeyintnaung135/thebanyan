<?php

namespace App\Http\Controllers;

use App\Registerfee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class MonthlymemberfeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
        $rules = array(
            'memberfee' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {

                    date_default_timezone_set("Asia/Rangoon");
                    $year = date('Y-m-d h:i:s');
                    $date = date('m/Y');

                    $pickdate = DB::table('registerfees')->where('date','=',$date)->pluck('date');

                    if(empty($pickdate)){

                        $register = New Registerfee();
                        $register->fee = Input::get('memberfee');
                        $register->date = $date;
                        $register->save();

                        flash('Monthlymemberfee created success!');

                        return redirect('bonuspercent');
                    }else{
                    	$fee = Input::get('memberfee');
                    	DB::table('registerfees')
				->where('date',$date)
            			->update(array('fee' =>$fee ));

                        flash('Monthlymemberfee updated for this month!');
                        return redirect('bonuspercent');
                    }                 
                
            }else{
                return Redirect::intended('bonuspercent')
                    ->withErrors($validator)
                    ->withInput();
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
