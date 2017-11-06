<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class HugeCheckController extends Controller
{
    //
    public function huge_check_by_id(Request $request)
    {
        return view ('api.huge_check_by_id',['id'=>$request->tb,'from'=>Carbon::parse($request->from)->toDateTimeString(),'to'=>Carbon::parse($request->to)->toDateTimeString()]);


    }
}
