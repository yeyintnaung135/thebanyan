<?php

namespace App\Http\Controllers;

use App\Bonuspercent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class BonuspercentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonus = Bonuspercent::all();
        return view('monthly.bonuspercent')->with('bonus', $bonus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monthly.createbonuspercent');
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
            'bonuspercent' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {

                    date_default_timezone_set("Asia/Rangoon");
                    $year = date('Y-m-d h:i:s');
                    $date = date('m/Y');

                    $pickdate = DB::table('bonuspercents')->where('monthly','=',$date)->pluck('monthly');

                    if(empty($pickdate)){

                        $bonu = New Bonuspercent();
                        $bonu->bonuspercent = Input::get('bonuspercent');
                        $bonu->monthly = $date;
                        $bonu->save();

                        flash('Monthly Bonuspercent created success!');

                        return redirect('bonuspercent');
                    }else{

                        flash('Monthly Bonuspercent created for this month! So can not create!');
                        return redirect('bonuspercent/create');
                    }                 
                
            }else{
                return Redirect::intended('bonuspercent/create')
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
