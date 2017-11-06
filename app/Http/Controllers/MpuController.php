<?php

namespace App\Http\Controllers;

use App\Mpu;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class MpuController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_data(Request $request)
    {
    	$request->status= 'success';
    	$request->token = rand();
    	
    	$mpu = new Mpu;
    	$mpu->response = date('Y-m-d h:m:i');
    	$mpu->amount   = '1000';
    	$mpu->status     = $request->status;
    	$mpu->token     = $request->token;
    	if($mpu->save()){
    		echo "data request page with ";
    		echo "random_token - ".$request->token;
    	}
    }
    
    public function mpu(Request $request)
    {
	$mpu           = new Mpu;
        return view('mpu.mpu',$mpu);
    }

}
