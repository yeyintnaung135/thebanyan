<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ResetpasswordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //this is api token middleware
        $this->middleware('jwt.refresh');//auth with token


    }
    public function index()
    {
        //
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
    public function getpassword()
    {
        $nrc_no = Input::get('nrc_no');

        $results = DB::select("select * from activemembers where nrc_no = '$nrc_no'");

        if (!empty($results)) {
                return Response::json([
                    'Success' => '1',
                    'Message' => 'Forget password success!'
                ], 400);// 
            }else{
               return Response::json([
                    'Success' => '0',
                    'Message' => 'Nrc_no does not match!'
                ], 400);//  
            }      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nrc_no     = Input::get('nrc_no');
        $password = Input::get('password');
	

        DB::table('activemembers')
            ->where('nrc_no',$nrc_no)
            ->update(array('password' => $password));
            
        return Response::json([
            'Success' => '1',
            'Message' => 'Reset password success!'
        ], 400);//

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
