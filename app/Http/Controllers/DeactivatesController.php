<?php

namespace App\Http\Controllers;

use App\Member;
use App\Activemember;
use App\Related;
use App\Bonus;
use App\Bonusoutcome;
use Carbon\Carbon;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class DeactivatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return view('members.index')->with('members', $members);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the product
        $member = Member::find($id);

        // show the view and pass the product to it
        return View('members.show')
            ->with('member', $member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the member
        $member = Member::find($id);

        // show the edit form and pass the member
        return View('members.edit')
            ->with('member', $member);
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

        $main_bonus = DB::table('bonus')->where('id', '=', 1)->pluck('bonus');
        $bonus =$main_bonus['0'];
        $nmsi_bonus = DB::table('nmsi_bonus')->where('id', 1)->first();


//check this pending member name is already has
        $ap_data=DB::table('members')->where('id',$id);
        if($ap_data->count() == 0){
            return 'This member name is already taken';
        }


        $already_has=DB::table('activemembers')->where('username',$ap_data->first()->username)->count();
        if($already_has > 0){
            return 'This member name is already taken';
        }

//end same name


        $inputbalance = Input::get('balance');
        $balance =  $inputbalance;


        $sponsor = Input::get('sponsor_id');
        $main_sponsor_id = Input::get('main_sponsor_id');

        $rules = array(
            'child_count' => 'required',
            'main_sponsor_id' => 'required|numeric',
            'username' => 'required',
            'father_name' => 'required',
            'password' => 'required',
            'nrc_no' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'balance' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            $status = Input::get('status');

            $result = DB::table('activemembers')->select('child_count')
                ->where('id', $sponsor);
            $members = $result->addSelect('child_count')->first();
            $child = $members->child_count;

            if ($child == 3) {
                //  nmsi_bonus_section
                $get_nmsi_id_bonus = DB::table('activemembers')->where('id', $main_sponsor_id)->first();
                //this section is for checking this nmsi has directly 3 childs
                $all_childs_of_nmsi=DB::table('relateds')->where([['pid','=',$main_sponsor_id],['cid','!=',$main_sponsor_id]])->get();
                $count_tree=0;
                foreach($all_childs_of_nmsi as $acon){

                    $noti=0;
                    $p_of_childs_of_nmsi=DB::table('relateds')->where([['cid','=',$acon->cid],['pid','!=',$acon->cid]])->get();
                    foreach($p_of_childs_of_nmsi as $pocon){
                        $has=DB::table('relateds')->where([['pid','=',$main_sponsor_id],['cid','=',$pocon->pid],['cid','!=',$main_sponsor_id]])->count();
                        if($has >0){
                            $noti=1;
                            break;
                        }else{
                            $noti=0;
                        }

                    }
                    if($noti != 1){

                        $count_tree++;
                    }else{
                        continue;
                    }


                }
                if($count_tree >= 3){
                    $done_nmsi_bonus=$nmsi_bonus->nmsi_bonus;

                }else{
                    $done_nmsi_bonus=$nmsi_bonus->small_nmsi_bonus;
                }

                //if has directly childs3
                $ot_bonus=0;

                $add_nmsi_bonus = $get_nmsi_id_bonus->balance + $done_nmsi_bonus;
                $ot_bonus+=$done_nmsi_bonus;

                //add bonus to nmsi of new active member
                DB::table('activemembers')->where('id', $main_sponsor_id)->update(['balance' => $add_nmsi_bonus]);
                DB::table('bonus_transaction')->insert(['tb'=>$main_sponsor_id,'amount'=>$done_nmsi_bonus,'status'=>'first nmsi','by_whom'=>Input::get('username'),'nrc'=>Input::get('nrc_no'),'created_at'=>Carbon::now()]);
                //for nmsi of nmsi of new active member(first active member)
                $for_fst_nmsi_data = DB::table('activemembers')->where('id', $main_sponsor_id)->first();
                if ($for_fst_nmsi_data->main_sponsor_id != '') {
                    $first_nmsi = DB::table('activemembers')->where('id', $for_fst_nmsi_data->main_sponsor_id)->first();
                    $frst_nmsi_bonus = $first_nmsi->balance + $nmsi_bonus->first_nmsi;
                    $ot_bonus+=$nmsi_bonus->first_nmsi;

                    DB::table('activemembers')->where('id', $for_fst_nmsi_data->main_sponsor_id)->update(['balance' => $frst_nmsi_bonus]);
                    DB::table('bonus_transaction')->insert(['tb'=>$for_fst_nmsi_data->main_sponsor_id,'amount'=>$nmsi_bonus->first_nmsi,'status'=>'second nmsi','by_whom'=>Input::get('username'),'nrc'=>Input::get('nrc_no'),'created_at'=>Carbon::now()]);

                    //for second nmsi bonus
                    if ($first_nmsi->main_sponsor_id != '') {
                        $for_snd_nmsi_data = DB::table('activemembers')->where('id', $first_nmsi->main_sponsor_id)->first();
                        $snd_nmsi_bonus = $for_snd_nmsi_data->balance + $nmsi_bonus->second_nmsi;
                        $ot_bonus+=$nmsi_bonus->second_nmsi;

                        DB::table('activemembers')->where('id', $first_nmsi->main_sponsor_id)->update(['balance' => $snd_nmsi_bonus]);
                        DB::table('bonus_transaction')->insert(['tb'=>$first_nmsi->main_sponsor_id,'amount'=>$nmsi_bonus->second_nmsi,'status'=>'third nmsi','by_whom'=>Input::get('username'),'nrc'=>Input::get('nrc_no'),'created_at'=>Carbon::now()]);

                    }

                }
                //nmsi_bonus
                $results = DB::select(DB::raw("SELECT cid from relateds WHERE pid=$sponsor"));
                $childcount = count($results);

                $i = '';
                $arr = array();
                for ($i = 1; $i < $childcount; $i++) {
                    $chid = $results[$i]->cid;
                    $childarr = DB::select(DB::raw("SELECT id,child_count from activemembers WHERE id=$chid"));
                    $ccount1 = $childarr[0]->child_count;
                    $cid1 = $childarr[0]->id;
                    //echo $cid1."- count".$ccount1;
                    if ($ccount1 < 3) {
                        array_push($arr, $results[$i]->cid);
                    }

                }
                $sponsor = $arr[0]; /*selected sponsor_id*/
                /*generated sponsor id*/
                $firstchild = DB::select(DB::raw("SELECT child_count from activemembers WHERE id=$sponsor"));
                $childcount = $firstchild[0]->child_count; /* selected child count*/

                echo "inserted sponsor id " . $sponsor;
                date_default_timezone_set("Asia/Rangoon");
                $daily = date('d/m/Y');
                $date = date('m/Y');

                $vars = Auth::user();
                $approved_by = $vars->username;

                $pickfee = 20000;

                //created active member

                $activemember = New Activemember();
                $activemember->child_count = Input::get('child_count');
                $activemember->username = Input::get('username');
                $activemember->main_sponsor_id = $main_sponsor_id;
                $activemember->password = Input::get('password');
                $activemember->father_name = Input::get('father_name');
                $activemember->nrc_no = Input::get('nrc_no');
                $activemember->phone = Input::get('phone');
                $activemember->address = Input::get('address');
                $activemember->status = "active";
                $activemember->agent_id= Input::get('agent_id');

                $activemember->total_child = 1;
                $activemember->active_count = 0;
                $activemember->bonus_status = "inactive";
                $activemember->control = 0;
                $activemember->balance = $bonus;
                $activemember->main_balance = $balance;
                $activemember->date = $date;
                if ($activemember->save()) {
                    $var = $childcount + 1;
                    DB::table('activemembers')
                        ->where('id', $sponsor)
                        ->update(array('child_count' => $var));
                }

                $query = DB::table('activemembers')->select('id')
                    ->where('username', Input::get('username'))
                    ->where('father_name', Input::get('father_name'))
                    ->where('nrc_no', Input::get('nrc_no'))
                    ->where('phone', Input::get('phone'))
                    ->where('address', Input::get('address'));

                $members = $query->addSelect('id')->first();
                $num = $members->id;
                $ct=Carbon::now();
                DB::insert("INSERT INTO memberfees (member_id, fee,status,approved_by,approved_date)
                                        VALUES ('$num', '$pickfee', 'active','$approved_by','$date')");

                DB::insert("INSERT INTO dailyreports (member_id, description ,approved_by ,amount,approved_date,created_at,updated_at)
                                        VALUES ('$num', 'Approved User', '$approved_by','20000','$daily','$ct','$ct')");
                                        

                DB::insert("INSERT INTO
                        relateds (pid , cid) SELECT pid,$num 
                        FROM relateds 
                        WHERE cid ='$sponsor ' 
                        UNION ALL SELECT $num,$num");

                DB::table('members')
                    ->where('id', $id)
                    ->delete();


                //$parent = Related::where('cid','=',$sponsor)->get();
                $parent = DB::select(DB::raw("SELECT pid from relateds WHERE cid=$sponsor ORDER BY id DESC LIMIT 12"));
                foreach ($parent as $data) {
                    $pid = $data->pid;
                    echo "<br>";
                    echo $pid;

                    $par = Activemember::find($pid);
                    $old_balance = $par['balance'];
                    $nbalance = $old_balance + $bonus;

                    $old_child = $par['total_child'];
                    $newchild = $old_child + 1;

                    DB::table('activemembers')
                        ->where('id', $pid)
                        ->update(array('balance' => $nbalance, 'total_child' => $newchild));
                    DB::table('bonus_transaction')->insert(['tb'=>$pid,'amount'=>$bonus,'status'=>'member bonus','by_whom'=>Input::get('username'),'nrc'=>Input::get('nrc_no'),'created_at'=>Carbon::now()]);



                    $outcome = Bonusoutcome::where('curdate', '=', $date)->get();
                    $count = count($outcome);
                    if ($count > 0) {
                        $old = $outcome['0']['bonusoutcome']; //2000
                        $new = $old + $bonus; //2600
                        DB::update("UPDATE bonusoutcome SET bonusoutcome='$new' WHERE curdate='$date'");
                    } else {
                        $new = $bonus;
                        DB::insert("INSERT INTO bonusoutcome (bonusoutcome,curdate)
                                        VALUES ('$new','$date')");
                    }
                }
                flash('member updated access!');
                return redirect('member');


            }
            else {
                //nmsi_bonus_section
                $get_nmsi_id_bonus = DB::table('activemembers')->where('id', $main_sponsor_id)->first();
                //this section is for checking this nmsi has directly 3 childs
                $all_childs_of_nmsi=DB::table('relateds')->where([['pid','=',$main_sponsor_id],['cid','!=',$main_sponsor_id]])->get();
                $count_tree=0;
                foreach($all_childs_of_nmsi as $acon){

                    $noti=0;
                    $p_of_childs_of_nmsi=DB::table('relateds')->where([['cid','=',$acon->cid],['pid','!=',$acon->cid]])->get();
                    foreach($p_of_childs_of_nmsi as $pocon){
                        $has=DB::table('relateds')->where([['pid','=',$main_sponsor_id],['cid','=',$pocon->pid],['cid','!=',$main_sponsor_id]])->count();
                        if($has >0){
                            $noti=1;
                            break;
                        }else{
                            $noti=0;
                        }

                    }
                    if($noti != 1){

                        $count_tree++;
                    }else{
                        continue;
                    }


                }
                if($count_tree >= 3){
                    $done_nmsi_bonus=$nmsi_bonus->nmsi_bonus;

                }else{
                    $done_nmsi_bonus=$nmsi_bonus->small_nmsi_bonus;
                }
                $ot_bonus=0;




                //if has directly childs3

                $add_nmsi_bonus = $get_nmsi_id_bonus->balance + $done_nmsi_bonus;
                //add bonus to nmsi of new active member
                DB::table('activemembers')->where('id', $main_sponsor_id)->update(['balance' => $add_nmsi_bonus]);
                DB::table('bonus_transaction')->insert(['tb'=>$main_sponsor_id,'amount'=>$done_nmsi_bonus,'status'=>'first nmsi','by_whom'=>Input::get('username'),'nrc'=>Input::get('nrc_no'),'created_at'=>Carbon::now()]);

                $ot_bonus+=$done_nmsi_bonus;

                //for nmsi of nmsi of new active member(first active member)
                $for_fst_nmsi_data = DB::table('activemembers')->where('id', $main_sponsor_id)->first();
                if ($for_fst_nmsi_data->main_sponsor_id != '') {
                    $first_nmsi = DB::table('activemembers')->where('id', $for_fst_nmsi_data->main_sponsor_id)->first();
                    $frst_nmsi_bonus = $first_nmsi->balance + $nmsi_bonus->first_nmsi;
                    $ot_bonus+=$nmsi_bonus->first_nmsi;
                    DB::table('activemembers')->where('id', $for_fst_nmsi_data->main_sponsor_id)->update(['balance' => $frst_nmsi_bonus]);
                    DB::table('bonus_transaction')->insert(['tb'=>$for_fst_nmsi_data->main_sponsor_id,'amount'=>$nmsi_bonus->first_nmsi,'status'=>'second nmsi','by_whom'=>Input::get('username'),'nrc'=>Input::get('nrc_no'),'created_at'=>Carbon::now()]);

                    //for second nmsi bonus
                    if ($first_nmsi->main_sponsor_id != '') {
                        $for_snd_nmsi_data = DB::table('activemembers')->where('id', $first_nmsi->main_sponsor_id)->first();
                        $snd_nmsi_bonus = $for_snd_nmsi_data->balance + $nmsi_bonus->second_nmsi;
                        $ot_bonus+=$nmsi_bonus->second_nmsi;

                        DB::table('activemembers')->where('id', $first_nmsi->main_sponsor_id)->update(['balance' => $snd_nmsi_bonus]);
                        DB::table('bonus_transaction')->insert(['tb'=>$first_nmsi->main_sponsor_id,'amount'=>$nmsi_bonus->second_nmsi,'status'=>'third nmsi','by_whom'=>Input::get('username'),'nrc'=>Input::get('nrc_no'),'created_at'=>Carbon::now()]);

                    }

                }
                //nmsi_bonus_section

                date_default_timezone_set("Asia/Rangoon");
                $daily = date('d/m/Y');
                $date = date('m/Y');

                $vars = Auth::user();
                $approved_by = $vars->username;

                $pickfee = 20000;

                //created active member

                $activemember = New Activemember();
                $activemember->child_count = Input::get('child_count');
                $activemember->username = Input::get('username');
                $activemember->password = Input::get('password');
                $activemember->father_name = Input::get('father_name');
                $activemember->main_sponsor_id = $main_sponsor_id;
                $activemember->nrc_no = Input::get('nrc_no');
                $activemember->phone = Input::get('phone');
                $activemember->address = Input::get('address');
                $activemember->agent_id= Input::get('agent_id');

                $activemember->status = "active";
                $activemember->balance = $bonus;
                $activemember->total_child = 1;
                $activemember->active_count = 0;
                $activemember->bonus_status = "inactive";
                $activemember->control = 0;
                $activemember->date = $date;
                if ($activemember->save()) {
                    $var = $child + 1;
                    DB::table('activemembers')
                        ->where('id', $sponsor)
                        ->update(array('child_count' => $var));
                }

                $query = DB::table('activemembers')->select('id')
                    ->where('username', Input::get('username'))
                    ->where('father_name', Input::get('father_name'))
                    ->where('nrc_no', Input::get('nrc_no'))
                    ->where('phone', Input::get('phone'))
                    ->where('address', Input::get('address'));

                $members = $query->addSelect('id')->first();
                $num = $members->id;

                DB::insert("INSERT INTO memberfees (member_id, fee,status,approved_by,approved_date)
                                    VALUES ('$num', '$pickfee', 'active','$approved_by','$date')");

                DB::insert("INSERT INTO dailyreports (member_id, description ,approved_by ,amount,approved_date)
                                        VALUES ('$num', 'Approved User', '$approved_by','20000','$daily')");

                DB::insert("INSERT INTO 
                    relateds (pid , cid) SELECT pid,$num 
                    FROM relateds 
                    WHERE cid ='$sponsor ' 
                    UNION ALL SELECT $num,$num");

                DB::table('members')
                    ->where('id', $id)
                    ->delete();


                $parent = DB::select(DB::raw("SELECT pid from relateds WHERE cid=$sponsor ORDER BY id DESC LIMIT 12"));
                foreach ($parent as $data) {
                    $pid = $data->pid;
                    echo "<br>";
                    echo $pid;

                    $par = Activemember::find($pid);
                    $old_balance = $par['balance'];
                    $nbalance = $old_balance + $bonus;

                    $old_child = $par['total_child'];
                    $newchild = $old_child + 1;

                    DB::table('activemembers')
                        ->where('id', $pid)
                        ->update(array('balance' => $nbalance, 'total_child' => $newchild));
                    DB::table('bonus_transaction')->insert(['tb'=>$pid,'amount'=>$bonus,'status'=>'member bonus','by_whom'=>Input::get('username'),'nrc'=>Input::get('nrc_no'),'created_at'=>Carbon::now()]);


                    $outcome = Bonusoutcome::where('curdate', '=', $date)->get();
                    $count = count($outcome);
                    if ($count > 0) {
                        $old = $outcome['0']['bonusoutcome']; //2000
                        $new = $old + $bonus +$ot_bonus; //2600
                        DB::update("UPDATE bonusoutcome SET bonusoutcome='$new' WHERE curdate='$date'");
                    } else {
                        $new = $bonus;
                        DB::insert("INSERT INTO bonusoutcome (bonusoutcome,curdate)
                                        VALUES ('$new','$date')");
                    }
                }


                flash('member updated access!');
                return redirect('member');
            }


        } else {
            return Redirect::back()->withInput()->withErrors($validator);
        }
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
}
