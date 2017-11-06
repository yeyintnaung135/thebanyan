<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Member;
use App\Related;
use App\Activemember;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class MembersapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //this is api token middleware
        $this->middleware('jwt.refresh', ['only' => 'edit_info']);//auth with token


    }
    public function index()
    {
        // $members = Member::all();// really bad practice
        //     return Response::json([
        //         'data' => $members
        //         ], 200);// 200 = OK
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    //android register
    public function store(Request $request)
    {

        $rules = array(
            'sponsor_id' => 'required|numeric',
            'agent_id' => 'numeric',
            'main_sponsor_id' => 'numeric',
            'username' => 'required|unique:members|unique:activemembers',
            'father_name' => 'required|max:40',
            'password' => 'required|max:40',
            'nrc_no' => 'required|unique:members|unique:activemembers|max:40',
            'phone_no' => 'required|max:11',
            'address' => 'required|max:200',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $sponsor = Input::get('sponsor_id');
            if (empty($sponsor) || ($sponsor == '-')) {
                $sponsor_id = '1';
            } else {
                $sponsor_id = $sponsor;
            }
            if(empty(Input::get('main_sponsor_id'))){
                $main_sponsor='1';
            }else{
                $main_sponsor=Input::get('main_sponsor_id');
            }

            $results = DB::select("select * from activemembers where id = '$sponsor_id' ");

            if (!empty($results)) {

                date_default_timezone_set("Asia/Rangoon");
                $year = date('Y-m-d h:i:s');
                $date = date('m/Y');

                $member = New Member();
                $member->sponsor_id = $sponsor_id;
                $member->main_sponsor_id = $main_sponsor;
                $member->username = Input::get('username');
                $member->agent_id= Input::get('agent_id');

                $member->child_count = '0';
                $member->password = Input::get('password');
                $member->father_name = Input::get('father_name');
                $member->nrc_no = Input::get('nrc_no');
                $member->phone = Input::get('phone_no');
                $member->address = Input::get('address');
                $member->status = 'pending';
                $member->balance = '0';
                $member->date = $date;
                $member->save();

                return Response::json([
                    'Success' => '1',
                    'Message' => 'Created Registration Success!'
                ], 400);

            } else {

                return Response::json([
                    'Success' => '2',
                    'Message' => 'sponsor_id does not match!'
                ], 400);
            }
        } else {
            $e_r=$validator->errors()->all();//this is fail validation message

            return Response::json([
                'Success' => '0',
                'Message' =>$e_r[0]//if y want to show all message response that $e_r the whole array
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function edit_info(Request $request)
    {

        $id = $request->id;
        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('m/Y');
        $member = Activemember::find($id);
        if (!empty($request->father_name)) {
            $member->father_name = $request->father_name;
        }
        if (!empty($request->nrc_no)) {
            $member->nrc_no = $request->nrc_no;
        }
        if (!empty($request->phone_no)) {
            $member->phone = $request->phone_no;
        }
        if (!empty($request->address)) {
            $member->address = $request->address;
        }
        $member->date = $date;
        if ($member->save()) {
            return Response::json([
                'Success' => '1',
                'Message' => 'member info updated!'
            ], 400);
        } else {
            return Response::json([
                'Success' => '0',
                'Message' => 'member info update failed!'
            ], 400);
        }
    }

    public function reload_balance(Request $request)
    {

        $id = $request->id;

          $results = Activemember::find($id);
        if($results['main_balance'] == 0){
           $main_balance=0;
         }
         else{
        $main_balance=$results['main_balance'];
          }
        if (count($results) > 0) {
            return Response::json([
                'Success' => '1',
                'Balance' => $main_balance,
                'Bonus'=>$results['balance']
            ], 400);
        } else {
            return Response::json([
                'Success' => '0',
                'Balance' => 'Member balance loaded fail!'
            ], 400);
        }
    }


    public function check_parent(Request $request)
    {
        $cid = $request->child_id;
        $bonus = "600";

        $parent = Related::where('cid', '=', $cid)->get();
        foreach ($parent as $data) {
            //echo "parent_id".$data['pid'];
            $id = $data['pid'];
            echo $id;
            echo "<br>";
            $par = Activemember::find($id);
            //echo 'parent'.$par['username'];
            //echo 'balance'.$par['balance'];
            //print_r($par);
            $old_balance = $par['balance'];
            $balance = $old_balance + $bonus;


            if ($data['pid'] == $cid) {
                //echo "not added";

            } else {
                /*DB::table('activemembers')
                   ->where('id',$id)
                   ->update(array('balance' => $balance));*/
            }
        }
    }

    public function check_child(Request $request)
    {
        $pid = $request->parent_id;

        echo "<strong>Child ID</strong>";
        $parent = Related::where('pid', '=', $pid)->get();
        $count = Related::where('pid', '=', $pid)->count();
        foreach ($parent as $data) {
            //echo "parent_id".$data['cid'];
            $id = $data['cid'];
            echo "<br>";
            echo $id;
        }
        return 'Count'.' '.$count;
    }
    public function check_active(Request $request)
    {
        $pid = $request->parent_id;
        $point = $request->point;
        $count=0;
        echo "<strong>Child ID    </strong>";
        $parent = Related::where('pid', '=', $pid);
        foreach ($parent->distinct()->get(['cid']) as $data) {
            //echo "parent_id".$data['cid'];
            $id = $data['cid'];
            $totalused = DB::select("SELECT SUM(amount) AS amount,member_id FROM incomes WHERE member_id='$id' AND status='new'");//updated
            $used = $totalused [0]->amount;
            $member = $totalused [0]->member_id;
            if ($used >= $point) {
                $count++;

                echo "<p>" . $member . "  " . $used . "</p>";
            }
        }
        echo 'count:'.$count;


    }
    public function check_mainsponsor($id){
        $main_sponsor=Activemember::where('main_sponsor_id',$id);
        foreach($main_sponsor->get() as $main){
            echo "<p>" .'TB'. $main->id . "  " . $main->balance . "</p>";
        }

    }
    public function check_use(Request $request) {
        $result = DB::table('incomes')->where([['member_id','=', $request->id],['status','=','new']])->sum('amount');
        return $result;
    }
    public function check_member_by_date(Request $request){
        $mem_count=DB::table('relateds')->where('pid',$request->tb)->get();

          $rcount=0;
        foreach($mem_count as $mc){
            $hs=DB::table('activemembers')->where('id',$mc->cid)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->count();
            if($hs > 0) {

                    $checkreach = DB::table('relateds')->where('cid', $mc->cid)->orderBy('pid', 'desc')->limit(13)->get();
                    $check_array = array();
                    foreach ($checkreach as $cr) {
                        $check_array[] = $cr->pid;
                    }
                    if (in_array($request->tb, $check_array)) {
                        echo $mc->cid;
                        echo '<br>';
                        $rcount++;

                    } else {
                    }

            }


        }
        return $rcount;

    }
    public function sec_nmsi(Request $request){
        $all_nmsi = DB::table('activemembers')->where('main_sponsor_id',$request->tb)->get();
        $ac=0;
        foreach($all_nmsi as $an){
            $all_count=DB::table('activemembers')->where('main_sponsor_id',$an->id)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->count();
            $ac+=$all_count;

        }
        return $ac;


    }
    public function thi_nmsi(Request $request){
        $all_nmsi = DB::table('activemembers')->where('main_sponsor_id',$request->tb)->get();
        $ac=0;
        foreach($all_nmsi as $an){
            $se_all_count=DB::table('activemembers')->where('main_sponsor_id',$an->id)->get();
            foreach($se_all_count as $sac) {
                $th_all_count = DB::table('activemembers')->where('main_sponsor_id', $sac->id)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->count();
                $ac+=$th_all_count;


            }

        }
           return $ac;

    }
    public function buy_topup(Request $request){
        $all_card = DB::table('incomes')->where('member_id',$request->tb)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->get();
        foreach($all_card as $an){
        echo  $an->card.''.'date:'.$an->created_at.'  '.$an->amount.'<br>';

        }

    }
    public function get_tran(Request $request){
        $amount=DB::table('transfers')->where('transfer_id',$request->tb)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->get();
        $sum=DB::table('transfers')->where('transfer_id',$request->tb)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->sum('amount');
        foreach ($amount as $a){
            echo  $a->member_id . '  ' .$a->amount.'<br>';

        }
        return $sum;
    }
    public function tran_to(Request $request){
        $amount=DB::table('transfers')->where('member_id',$request->tb)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->get();
        $sum=DB::table('transfers')->where('member_id',$request->tb)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->sum('amount');
        foreach ($amount as $a){
            echo  $a->transfer_id . '  ' .$a->amount.'<br>';

        }
        return $sum;
    }
  public function approved(Request $request){
        $amount=DB::table('approvemembers')->where('member_id',$request->tb)->whereBetween('created_at', [Carbon::parse($request->from)->toDateString()." 00:00:00", Carbon::parse($request->to)->toDateString().' 23:59:59'])->get();
        $sum=0;
        foreach ($amount as $a){
            echo  $a->username .'   '.$a->created_at.'<br>';
            $sum+= 20000;

        }
        return $sum;

    }

}
