<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    public function search_by_id_form()
    {
        return view('accessories.id_active_date');
    }

    public function search_by_id(Request $request)
    {

            $amount = DB::table('activemembers')->where('main_sponsor_id',$request->tb)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->count();


        return 'NMSI count &nbsp;&nbsp;' . $amount;


    }
    public function search_by_user(Request $request)
    {

        $his = DB::table('activemembers')->where('id',$request->tb)->first();
        $nmsi=DB::table('activemembers')->where('id',$his->main_sponsor_id)->first();


        return 'NMSI &nbsp;&nbsp;' . $nmsi->username.'&nbsp;&nbsp;'.$nmsi->created_at.'<br>'. 'member&nbsp;&nbsp;'.$his->username.'&nbsp;&nbsp;'.$his->created_at;


    }
    public function search_2by_user(Request $request)
    {

        $his = DB::table('activemembers')->where('id',$request->tb)->first();
        $fnmsi=DB::table('activemembers')->where('id',$his->main_sponsor_id)->first();
        $fcount=DB::table('activemembers')->where('id',$his->main_sponsor_id)->count();
        if(empty($fcount)){
            $fname='';
            $fca='';
        }else {
            $fname=$fnmsi->username;
            $fca=$fnmsi->created_at;
            $snmsi = DB::table('activemembers')->where('id', $fnmsi->main_sponsor_id)->first();
            $scount=DB::table('activemembers')->where('id', $fnmsi->main_sponsor_id)->count();
            if(empty($scount)){
                $sname='';
                $sca='';
            }else{
                $sname=$snmsi->username;
                $sca=$snmsi->created_at;
            }
        }


        return 'first NMSI &nbsp;&nbsp;'.$fname.'&nbsp;&nbsp;'.$fca.'<br>'.'2nd NMSI &nbsp;&nbsp;' . $sname.'&nbsp;&nbsp;'.$sca.'<br>'. 'member&nbsp;&nbsp;'.$his->username.'&nbsp;&nbsp;'.$his->created_at;


    }
    public function search_3by_user(Request $request)
    {

        $his = DB::table('activemembers')->where('id',$request->tb)->first();
        $fnmsi=DB::table('activemembers')->where('id',$his->main_sponsor_id)->first();
        $fcount=DB::table('activemembers')->where('id',$his->main_sponsor_id)->count();
        if(empty($fcount)){
            $fname='';
            $fca='';
        }else {
            $fname=$fnmsi->username;
            $fca=$fnmsi->created_at;
            $snmsi = DB::table('activemembers')->where('id', $fnmsi->main_sponsor_id)->first();
            $scount=DB::table('activemembers')->where('id', $fnmsi->main_sponsor_id)->count();
            if(empty($scount)){
                $sname='';
                $sca='';
                $tname='';
                $tca='';
            }else{
                $sname=$snmsi->username;
                $sca=$snmsi->created_at;
                $tnmsi = DB::table('activemembers')->where('id', $snmsi->main_sponsor_id)->first();
                $tcount=DB::table('activemembers')->where('id', $snmsi->main_sponsor_id)->count();
                if(empty($tcount)){
                    $tname='';
                    $tca='';

                }else{
                    $tname=$tnmsi->username;
                    $tca=$tnmsi->created_at;

                }
            }
        }


        return 'first NMSI &nbsp;&nbsp;'.$fname.'&nbsp;&nbsp;'.$fca.'<br>'.'2nd NMSI &nbsp;&nbsp;' . $sname.'&nbsp;&nbsp;'.$sca.'<br>'.'Third NMSI &nbsp;&nbsp;' . $tname.'&nbsp;&nbsp;'.$tca.'<br>'. 'member&nbsp;&nbsp;'.$his->username.'&nbsp;&nbsp;'.$his->created_at;


    }
}
