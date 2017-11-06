<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class TopupdeleteController extends Controller
{
    //
    public function __construct()
    {
        //this is api token middleware
        $this->middleware('auth');//auth with token


    }
    public function delete($date){
        DB::table('topup_profit')->where('date',$date)->delete();
        return redirect()->back();

    }

}
