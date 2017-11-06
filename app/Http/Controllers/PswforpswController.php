<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class PswforpswController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
                $this->middleware('LockStaff');

    }


    public function create_psw_for_psw_form()
    {
        if(Auth::user()->role=='SuperAdmin') {
            $pas = DB::table('psw_for_psw')->where('id', 0)->first();
            return view('psw_for_psw.create', ['pas' => $pas]);
        }
        else{
            return 'Error';
        }

    }

    public function create_psw_for_psw(Request $request)
    {
        $rules = ['password' => 'required|max:12'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);

        }

        DB::table('psw_for_psw')->where('id', 0)->update(['psw' => $request->password, 'updated_at' => Carbon::now()]);
        flash('Updated success!');

        return redirect()->back();

    }

    public function check_psw_for_psw($id)
    {
        return view('psw_for_psw.check', ['mem_id' => $id]);
    }

    public function check_psw(Request $request)
    {
        $rules = ['password' => 'required|max:12'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);

        }
        $check=DB::table('psw_for_psw')->where('psw',$request->password)->count();
        if($check == 1 and (Auth::user()->role=='SuperAdmin' or Auth::user()->role=='Admin')){
            $psw=DB::table('activemembers')->where('id',$request->id)->first();
if($psw->plain_psw == '')
{
$showpps=$psw->password;
}
else
{
$showpps=$psw->plain_psw;

}
            return view('psw_for_psw.showpsw',['psw'=>$showpps,'tb'=>$psw->id,'name'=>$psw->username]);

        }
        else{
            return 'You cannot see this password';
        }



    }
}
