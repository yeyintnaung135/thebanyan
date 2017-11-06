<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ApiController extends Controller
{
    //
    public function member_api()
    {
        return view('api.memberapi');
    }

    public function topup_api()
    {
        return view('api.topupapi');
    }

    public function check_agent_by_agent(Request $request)
    {
        $geta = DB::table('activemembers')->where('agent_id', $request->id);
        foreach ($geta->get() as $ga) {
            echo 'TB:' . $ga->id . ' Date:' . $ga->created_at .  '  Name:' . $ga->username .'<br>';
        }
        echo  'Total Count:'.$geta->count();

    }
    public function check_agent_by_mem(Request $request)
    {
        $mem = DB::table('activemembers')->where('id', $request->id)->first();
        echo 'Agent Id:'. $mem->agent_id;


    }
      public function huge_check(Request $request)
    {
        return view ('api.huge_check',['id'=>$request->tb,'from_id'=>$request->from_id,'date'=>$request->to,'from'=>Carbon::parse($request->from)->toDateTimeString(),'to'=>Carbon::parse($request->to)->toDateTimeString()]);


    }
}
