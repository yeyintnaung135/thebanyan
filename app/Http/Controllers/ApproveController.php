<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Approvemember;
use App\Member;
use App\Bonus;
use App\Related;
use App\Bonusoutcome;
use App\Activemember;
use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApproveController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        $approve_id = $request->approve_id;
        $gtoken=$_GET['token'];
         $complex = DB::table('members')->where('id', $approve_id)->count();
        if ($complex == 0) {


            return Response::json([
                'Success' => '0',
                'Message' => 'Wrong id',
            ], 200);// 200 = OK

        }

        $to_check_name = DB::table('members')->where('id', $approve_id)->first();
        $is_exit = DB::table('activemembers')->where('username', $to_check_name->username)->count();
        if ($is_exit > 0) {
            return Response::json([
                'Success' => '0',
                'Message' => 'Duplicate Username',
            ], 200);// 200 = OK
        }

        $pickfee = 20000;


        $member_id = $request->member_id;
        $tdata = DB::table('activemembers')->where('id', '=', $member_id)->first();

        if($gtoken !== $tdata->token){
            return Response::json([
                'Success' => '0',
                'Message' => 'No enough balance for approve memberww!',

            ], 200);// 200 = OK
        }
        $apv_balance = DB::table('activemembers')->where('id', '=', $member_id)->pluck('amount_for_approve');
        $balance = DB::table('activemembers')->where('id', '=', $member_id)->pluck('main_balance');
        $pickbalance = $balance['0'];


        if ($apv_balance['0'] < $pickfee) {
            $need_balance = $pickfee - $apv_balance['0'];
            if ($balance['0'] >= $need_balance) {
                $resultbalance = $pickbalance - $need_balance;
                $rm_ab = 0;
            } else {
                return Response::json([
                    'Success' => '0',
                    'Message' => 'No enough balance for approve member!',
                ], 200);// 200 = OK

            }

        } else {
            $rm_ab = $apv_balance['0'] - $pickfee;
            $resultbalance = $pickbalance;

        }
        $nmsi_bonus = DB::table('nmsi_bonus')->where('id', 1)->first();

        $main_bonus = DB::table('bonus')->where('id', '=', 1)->pluck('bonus');
        date_default_timezone_set("Asia/Rangoon");
        $date = date('m/Y');
        /*
        $pickregisterfee = DB::table('registerfees')->where('date','=',$date)->pluck('fee');
        $pickfee= $pickregisterfee['0'];*/


        $member = Member::find($approve_id);
      
        /*echo "<pre>";
        print_r($member);
        echo "</pre>";*/
        $approve = New Approvemember();
        $approve->member_id = $member_id;
        $approve->approve_id = $approve_id;
        $approve->sponsor_id = $member['sponsor_id'];

        $approve->child_count = $member['child_count'];
        $approve->username = $member['username'];
        $approve->father_name = $member['father_name'];
        $approve->password = $member['password'];
        $approve->nrc_no = $member['nrc_no'];
        $approve->phone = $member['phone'];
        $approve->address = $member['address'];
        $approve->status = 'pending';
        //$approve->save();

        if ($approve->save()) {

            //opreation continued
            // $update_balance = $pickbalance - $pickfee;
            /*===============================*/
            $activemember = New Activemember();
            $activemember->child_count = $member['child_count'];
            $activemember->username = $member['username'];
            $activemember->password = $member['password'];
            $activemember->father_name = $member['father_name'];
            $activemember->agent_id = $member['agent_id'];

            $activemember->nrc_no = $member['nrc_no'];
            $activemember->phone = $member['phone'];
            if (empty($member['main_sponsor_id'])) {
                $main_sponsor = 1;

            } else {
                $main_sponsor = $member['main_sponsor_id'];
            }
            $activemember->main_sponsor_id = $main_sponsor;
            $activemember->address = $member['address'];
            $activemember->status = "active";
            $activemember->balance = $main_bonus['0'];
            $activemember->total_child = 1;
            $activemember->active_count = 0;
            $activemember->bonus_status = "inactive";
            $activemember->control = 0;
            $activemember->date = $date;

            //nmsi bonus function

            $get_nmsi_id_bonus = DB::table('activemembers')->where('id', $main_sponsor)->first();
            //this section is for checking this nmsi has directly 3 childs
            $all_childs_of_nmsi = DB::table('relateds')->where([['pid', '=', $main_sponsor], ['cid', '!=', $main_sponsor]])->get();
            $count_tree = 0;
            foreach ($all_childs_of_nmsi as $acon) {

                $noti = 0;
                $p_of_childs_of_nmsi = DB::table('relateds')->where([['cid', '=', $acon->cid], ['pid', '!=', $acon->cid]])->get();
                foreach ($p_of_childs_of_nmsi as $pocon) {
                    $has = DB::table('relateds')->where([['pid', '=', $main_sponsor], ['cid', '=', $pocon->pid], ['cid', '!=', $main_sponsor]])->count();
                    if ($has > 0) {
                        $noti = 1;
                        break;
                    } else {
                        $noti = 0;
                    }

                }
                if ($noti != 1) {

                    $count_tree++;
                } else {
                    continue;
                }


            }
            if ($count_tree == 3) {
                $done_nmsi_bonus = $nmsi_bonus->nmsi_bonus;

            } else {
                $done_nmsi_bonus = $nmsi_bonus->small_nmsi_bonus;
            }


            //if has directly childs3

            $add_nmsi_bonus = $get_nmsi_id_bonus->balance + $done_nmsi_bonus;
            //add bonus to nmsi of new active member
            DB::table('activemembers')->where('id', $main_sponsor)->update(['balance' => $add_nmsi_bonus]);
            DB::table('bonus_transaction')->insert(['tb' => $main_sponsor, 'amount' => $done_nmsi_bonus, 'status' => 'first nmsi', 'by_whom' => $member['username'],'nrc'=>$member['nrc_no'], 'created_at' => Carbon::now()]);

            //for nmsi of nmsi of new active member(first active member)
            $for_fst_nmsi_data = DB::table('activemembers')->where('id', $main_sponsor)->first();
            if ($for_fst_nmsi_data->main_sponsor_id != '') {
                $first_nmsi = DB::table('activemembers')->where('id', $for_fst_nmsi_data->main_sponsor_id)->first();
                $frst_nmsi_bonus = $first_nmsi->balance + $nmsi_bonus->first_nmsi;
                DB::table('activemembers')->where('id', $for_fst_nmsi_data->main_sponsor_id)->update(['balance' => $frst_nmsi_bonus]);
                DB::table('bonus_transaction')->insert(['tb' => $for_fst_nmsi_data->main_sponsor_id, 'amount' => $nmsi_bonus->first_nmsi, 'status' => 'second nmsi', 'by_whom' => $member['username'],'nrc'=>$member['nrc_no'], 'created_at' => Carbon::now()]);

                //for second nmsi bonus
                if ($first_nmsi->main_sponsor_id != '') {
                    $for_snd_nmsi_data = DB::table('activemembers')->where('id', $first_nmsi->main_sponsor_id)->first();
                    $snd_nmsi_bonus = $for_snd_nmsi_data->balance + $nmsi_bonus->second_nmsi;
                    DB::table('activemembers')->where('id', $first_nmsi->main_sponsor_id)->update(['balance' => $snd_nmsi_bonus]);
                    DB::table('bonus_transaction')->insert(['tb' => $first_nmsi->main_sponsor_id, 'amount' => $nmsi_bonus->second_nmsi, 'status' => 'third nmsi', 'by_whom' => $member['username'],'nrc'=>$member['nrc_no'], 'created_at' => Carbon::now()]);

                }

            }

            //end for nmsi of nmsi of new active memberr

            //end nmsi bonus

            if ($activemember->save()) {
                /*
                     DB::table('approvemembers')
                         ->where('approve_id',$approve_id)
                         ->delete();
                         */

            }
            $sponsor = $member['sponsor_id'];

            $results = DB::table('activemembers')->select('child_count')
                ->where('id', $sponsor);
            $members = $results->addSelect('child_count')->first();
            $child = $members->child_count;

            if ($child == 3) {
                $result = DB::select(DB::raw("SELECT cid from relateds WHERE pid=$sponsor"));
                $childcount = count($result);

                $i = '';
                $arr = array();
                for ($i = 1; $i < $childcount; $i++) {
                    $chid = $result[$i]->cid;
                    $childarr = DB::select(DB::raw("SELECT id,child_count from activemembers WHERE id=$chid"));
                    $ccount1 = $childarr[0]->child_count;
                    $cid1 = $childarr[0]->id;
                    //echo $cid1."- count".$ccount1;
                    if ($ccount1 < 3) {
                        array_push($arr, $result[$i]->cid);
                    }

                }
                $sponsor = $arr[0]; /*selected sponsor_id*/
                /*generated sponsor id*/
                //echo $sponsor;
                $firstchild = DB::select(DB::raw("SELECT child_count from activemembers WHERE id=$sponsor"));
                $child = $firstchild[0]->child_count; /* selected child count*/


            } else {

                $sponsor = $member['sponsor_id'];
                /* added child count */
            }

            $var = $child + 1;

            DB::table('activemembers')
                ->where('id', $sponsor)
                ->update(array('child_count' => $var));


            $status = 'active';//Input::get('status');


            $query = DB::table('activemembers')->select('id')
                ->where('username', $member['username'])
                ->where('father_name', $member['father_name'])
                ->where('nrc_no', $member['nrc_no'])
                ->where('phone', $member['phone'])
                ->where('address', $member['address']);

            $members = $query->addSelect('id')->first();
            $num = $members->id;

            /*
            $vars = Auth::user();
            $approved_by = $vars->username;
    */
            $approved_by = "admin";
            DB::insert("INSERT INTO memberfees (member_id, fee,status,approved_by,approved_date)
                                VALUES ('$num', '$pickfee', 'active','$approved_by','$date')");

            DB::insert("INSERT INTO
                                relateds (pid , cid) SELECT pid,$num
                                FROM relateds
                                WHERE cid ='$sponsor'
                                UNION ALL SELECT $num,$num");


            DB::table('activemembers')
                ->where('id', $member_id)
                ->update(array('main_balance' => $resultbalance));
            DB::table('activemembers')
                ->where('id', $member_id)
                ->update(array('amount_for_approve' => $rm_ab));

            /* add bonus parent section */
            /*$addbonus = Bonus::find('1');
            $bonus = $addbonus ['bonus'];
            echo $sponsor;*/
            $bonus = $main_bonus['0'];

            //$parent = Related::where('cid','=',$sponsor)->get();
            $parent = DB::select(DB::raw("SELECT pid from relateds WHERE cid=$sponsor ORDER BY id DESC LIMIT 12"));

            foreach ($parent as $data) {
                $pid = $data->pid;

                $par = Activemember::find($pid);
                $old_balance = $par['balance'];
                $nbalance = $old_balance + $bonus;

                $old_child = $par['total_child'];
                $newchild = $old_child + 1;

                DB::table('activemembers')
                    ->where('id', $pid)
                    ->update(array('balance' => $nbalance, 'total_child' => $newchild));
                DB::table('bonus_transaction')->insert(['tb' => $pid, 'amount' => $bonus, 'status' => 'member bonus', 'by_whom' => $member['username'],'nrc'=>$member['nrc_no'], 'created_at' => Carbon::now()]);


                $outcome = Bonusoutcome::where('curdate', '=', $date)->get();
                $count = count($outcome);
                if ($count > 0) {
                    $old = $outcome['0']['bonusoutcome']; //2000
                    $new = $old + $bonus; //2600
                    DB::update("UPDATE bonusoutcome SET bonusoutcome='$new' WHERE curdate='$date'");
                } else {
                    DB::insert("INSERT INTO bonusoutcome (bonusoutcome,curdate)
			        VALUES ('$bonus','$date')");
                }
            }//endforeach loop


            /*================================*/
            $member->delete();
        }


        return Response::json([
            'Success' => '1',
            'Message' => 'Your member approved have been successful!',
        ], 200);// 200 = OK


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
    public function test()
    {
        //
        $aife = [];
        $c = 0;
        global $c;


        $t = 9;
        DB::table('relateds')->where('pid', 1)->chunk(100, function ($c) {
            $c = 1;


        });
        return dd($c);


    }

}
