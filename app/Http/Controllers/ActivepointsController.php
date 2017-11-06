<?php

namespace App\Http\Controllers;

use App\Activepoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class ActivepointsController extends Controller
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
            'activepoint' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {

                    date_default_timezone_set("Asia/Rangoon");
                    $year = date('Y-m-d h:i:s');
                    $date = date('m/Y');

                    $pickdate = DB::table('activepoints')->where('monthly','=',$date)->pluck('monthly');

                    if(empty($pickdate)){

                        $activepoint = New Activepoint();
                        $activepoint->activepoint = Input::get('activepoint');
                        $activepoint->monthly = $date;
                        $activepoint->save();

                        flash('Member Activepoint is created success!');

                        return redirect('bonuspercent');
                    }else{
			$activepoint = Input::get('activepoint');
                    	DB::table('activepoints')
				->where('monthly',$date)
            			->update(array('activepoint' =>$activepoint ));
                        flash('Member Activepoint updated for this month!');
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
