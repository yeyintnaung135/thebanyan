@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')

    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>All Staff Datatable
            </h1>
        </div>
    </div>
    <!-- END PAGE BREADCRUMB -->
    @include('flash::message')
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Bonus </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <th class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mem bonus</th>

                            <th>First Nmsi</th>
                            <th>Second Nmsi</th>
                            <th>Third Nmsi</th>
                            <th>Extra Bonus</th>


                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Mem bonus</th>


                            <th>First Nmsi</th>
                            <th>Second Nmsi</th>
                            <th>Third Nmsi</th>
                            <th>Extra Bonus</th>





                        </tr>
                        </tfoot>
                        <tbody>

                        <?php
                        $all_id = DB::table('activemembers')->where('id', '=', $id)->get();
                        foreach ($all_id as $ai){




                        $mem_count = DB::table('relateds')->where('pid', $ai->id)->get();

                        $rcount = 0;
                        foreach ($mem_count as $mc) {
                            $hs = DB::table('activemembers')->where('id', $mc->cid)->whereBetween('created_at', [$from, $to])->count();
                            if ($hs > 0) {

                                $checkreach = DB::table('relateds')->where('cid', $mc->cid)->orderBy('pid', 'desc')->limit(13)->get();
                                $check_array = array();
                                foreach ($checkreach as $cr) {
                                    $check_array[] = $cr->pid;
                                }
                                if (in_array($ai->id, $check_array)) {

                                    $rcount++;

                                } else {
                                }

                            }


                        }
                        $mb = $rcount * 300;//member bonus

                        $all_nmsi = DB::table('activemembers')->where('main_sponsor_id', $ai->id)->get();
                        $ac = 0;
                        foreach ($all_nmsi as $an) {
                            $all_count = DB::table('activemembers')->where('main_sponsor_id', $an->id)->whereBetween('created_at', [$from, $to])->count();
                            $ac += $all_count;//count of sect_nmsi

                        }
                        $bt = DB::table('bonus_transaction')->where([['tb', '=', $ai->id], ['status', '=', 'second nmsi']])->whereBetween('created_at', [$from, $to])->get();
                        $s_bt_a = 0;
                        foreach ($bt as $bo_tr) {
                            $s_bt_a += $bo_tr->amount;//bonus amount of sn

                        }



                        $t_all_nmsi = DB::table('activemembers')->where('main_sponsor_id', $ai->id)->get();
                        $t_ac = 0;
                        foreach ($t_all_nmsi as $an) {
                            $t_all_count = DB::table('activemembers')->where('main_sponsor_id', $an->id)->get();
                            foreach ($t_all_count as $ttac) {
                                $th_all_count = DB::table('activemembers')->where('main_sponsor_id', $ttac->id)->whereBetween('created_at', [$from, $to])->count();
                                $t_ac += $th_all_count;//third nmsi count

                            }

                        }

                        $tbt = DB::table('bonus_transaction')->where([['tb', '=', $ai->id], ['status', '=', 'third nmsi']])->whereBetween('created_at', [$from, $to])->get();
                        $t_bt_a = 0;
                        foreach ($tbt as $tbo_tr) {
                            $t_bt_a += $tbo_tr->amount;//bonus amount of tn

                        }

                        $main_sponsor = DB::table('activemembers')->where('main_sponsor_id', $ai->id)->whereBetween('created_at', [$from, $to]);
                        $main_sponsor_count = $main_sponsor->count();
                        $main_sponsor_count = $main_sponsor->count();
                        $fbt = DB::table('bonus_transaction')->where([['tb', '=', $ai->id], ['status', '=', 'first nmsi']])->whereBetween('created_at', [$from, $to])->get();
                        $f_bt_a = 0;
                        foreach ($fbt as $fbo_tr) {
                            $f_bt_a += $fbo_tr->amount;//bonus amount of fn

                        }

                        $all_card = DB::table('incomes')->where('member_id', $ai->id)->whereBetween('created_at', [$from, $to])->get();
                        $all_card_amount = 0;
                        foreach ($all_card as $an) {
                            $all_card_amount += $an->amount;//amount of topup card

                        }

                        $aamount = DB::table('approvemembers')->where('member_id', $ai->id)->whereBetween('created_at', [$from, $to])->get();
                        $asum = 0;
                        foreach ($aamount as $aa) {

                            $asum += 20000;

                        }

                        $add_by_staff = DB::table('dailyreports')->where([['member_id', '=', $ai->id], ['description', '!=', 'Paying']])->whereBetween('created_at', [$from, $to])->sum('amount');


                        $gtsum = DB::table('transfers')->where('transfer_id', $ai->id)->whereBetween('created_at', [$from, $to])->sum('amount');//get transfer amount

                        $ttsum = DB::table('transfers')->where('member_id', $ai->id)->whereBetween('created_at', [$from, $to])->sum('amount');//transfer to amount
                        $ttpar = $ttsum / 100;
                        $getmsgbo = DB::table('messages')->where('tb_id', $ai->id)->whereBetween('created_at', [$from, $to]);
                        $exbonus = $getmsgbo->count() * 1000;
                        $getmoney = $add_by_staff + $gtsum + $f_bt_a + $s_bt_a + $t_bt_a + $mb + $exbonus;
                        $usemoney = ($ttsum + $all_card_amount + $asum + $ttpar);
                        $remain = $getmoney - $usemoney;
                        $nowb = DB::table('activemembers')->where('id', $ai->id)->first();
                        $now = $nowb->balance + $nowb->main_balance + $nowb->amount_for_approve;


                        if (floor($remain) == floor($now)) {
                            /*
                            echo '<div>';
                            echo 'TB:'.$ai->id;
                            echo 'member_bonus:'. $mb . '.second ' . $s_bt_a . ' third'. $t_bt_a . '   first :' . $f_bt_a . ' card :' . $all_card_amount . '  gettr  :' . $gtsum . '  totran  ' . $ttsum.'  addbystaff  '.$add_by_staff.' '.'Approve: '.$asum."  transfer percent :".$ttpar.'<br>';
                            echo  'mem_count:' . $rcount . '  ' . 'second:'  .   $ac . ' third:'.$t_ac.' first '.$main_sponsor_count.' ';
                            echo '<br>';

                            echo 'Getmoney :'.$getmoney . '  Use Money : '.$usemoney.' Remain :'.$remain.'  Nowbalance :'.$now.' '.'<br>';
                            echo 'good';
                            echo '</div>';
                            echo '<br>';

                             */
                            $result = 'yes';
                        } elseif (ceil($remain) == ceil($now)) {
                            $result = 'yes';


                        } else {
                            /*
                            foreach($getmsgbo->get() as $gmb){
                            echo $gmb->description.'<br>';
                            }
                            echo '<tr>';
                            echo 'TB:'.$ai->id;
                            echo 'member_bonus:'. $mb . '.second ' . $s_bt_a . ' third'. $t_bt_a . '   first : ' . $f_bt_a . ' card :' . $all_card_amount . '  gettr  :' . $gtsum . '  totran  ' . $ttsum.'  addbystaff  '.$add_by_staff.' '.'Approve: '.$asum."  transfer percent :".$ttpar.'<br>';
                            echo  'mem_count:' . $rcount . '  ' . 'second:'  .   $ac . ' third:'.$t_ac.' first '.$main_sponsor_count.' ';
                            echo '<br>';

                            echo 'Getmoney :'.$getmoney . '  Use Money : '.$usemoney.' Remain :'.$remain.'  Nowbalance :'.$now.' '.'<br>';
                            echo 'No';
                            echo '</div>';
                            echo '<br>';
                            */
                            $result = 'no';


                        }
                        ?>
                        <tr>
                            <th>{{$ai->id}}</th>
                            <th><span style="color:#337ab7;font-weight:bolder;">Mem:</span> {{$mb}}<br>
                                @php
                                    $ee=DB::table('relateds')->where('pid',$ai->id)->get();//will start here
                                    $mcount=0;

                                foreach($ee as $me){

                                $cisindate= DB::table('activemembers')->where('id',$me->cid)->whereBetween('created_at',[$from,$to]);
                                 if($cisindate->count() != 0){
                                 $checktwel=DB::table('relateds')->where('cid',$me->cid)->orderBy('id','desc')->limit(13)->get();
                                 $c_ar=[];
                                 foreach($checktwel as $ckt){
                                 $c_ar[]=$ckt->pid;
                                 }
                                 if(in_array($ai->id,$c_ar)){
                                 $mcount+= 1;
  echo 'TB'.$me->cid .'  '.$cisindate->first()->created_at.'<br>';
                                 }

                                 }

                                  }

                                @endphp
                            </th>

                            <th><span style="color:#337ab7;font-weight:bolder;">First Nmsi:</span> {{$f_bt_a}}<br>
                                @php
                                    if($f_bt_a != 0){
                                    $get_last_mem=DB::table('activemembers')->where('main_sponsor_id',$ai->id)->whereBetween('created_at',[$from,$to])->get();
                                    foreach ($get_last_mem as $glm){
                                    echo 'TB '.$get_last_mem->id;
                                    }

                                       }
                                @endphp </th>

                            <th><span style="color:#337ab7;font-weight:bolder;">Second Nmsi:</span>{{$s_bt_a}} <br>
                                @php
                                    if($s_bt_a != 0){
                                    $sget_last_mem=DB::table('activemembers')->whereBetween('created_at',[$from,$to])->get();
                                    foreach ($sget_last_mem as $sglm){
                                    $slm=DB::table('activemembers')->where('id',$sglm->main_sponsor_id)->get();
                                    foreach($slm as $sllm){
                                    $sck=DB::table('activemembers')->where([['id','=',$sllm->main_sponsor_id],['id','=',$ai->id]])->count();
                                    if($sck != 0){
                                    echo 'TB'.$sglm->id .'  '.$sglm->created_at.'<br>';
                                    }

                                    }

                                    }

                                       }
                                @endphp</th>
                            <th>
                                <span style="color:#337ab7;font-weight:bolder;">Third Nmsi:</span> {{$t_bt_a}} <br>
                                @php
                                    if($t_bt_a != 0){
                                    $tget_last_mem=DB::table('activemembers')->whereBetween('created_at',[$from,$to])->get();
                                    foreach ($tget_last_mem as $tglm){
                                    $tlm=DB::table('activemembers')->where('id',$tglm->main_sponsor_id)->get();
                                    foreach($tlm as $tllm){
                                    $ttlm=DB::table('activemembers')->where([['id','=',$tllm->main_sponsor_id]])->get();
                                    foreach($ttlm as $ttsllm){
                                     $ttllmc=DB::table('activemembers')->where([['id','=',$ttsllm->main_sponsor_id],['id','=',$ai->id]])->count();

                                    if($ttllmc != 0){
                                    echo 'TB'.$tglm->id.'  '.$tglm->created_at.'<br>';
                                    }

                                    }

                                    }

                                    }
                                }
                                @endphp
                            </th>
                            <th><span style="color:#337ab7;font-weight:bolder;">EX:</span> {{$exbonus}}</th>

                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                        </tbody>
                    </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Balance and Usage</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>TB ID</th>
                            <th>Add By Staff</th>
                            <th>Get Transfer</th>
                            <th>Buy Topup</th>
                            <th>Transfer To</th>
                            <th>Approve Amount</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>TB ID</th>
                            <th>Add By Staff</th>
                            <th>Get Transfer</th>
                            <th>Buy Topup</th>
                            <th>Transfer To</th>
                            <th>Approve Amount</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <th>{{$ai->id}}</th>
                                <th><span style="color:#ff7d1a;font-weight:bolder;">{{$add_by_staff}}</span><br>
                                    @php
                                        $get_adder=DB::table('dailyreports')->where('member_id',$ai->id)->whereBetween('created_at',[$from,$to])->get();
                                        foreach($get_adder as $ga){
                                        echo $ga->approved_by.'  '. $ga->created_at.'<br>';
                                        }
                                    @endphp
                                </th>
                                <th><span style="color:#ff7d1a;font-weight:bolder;">{{$gtsum}}
                                </span>
                                    @php
                                        if($gtsum != ''){
                                          $get_tr_to_him=DB::table('transfers')->where('transfer_id',$ai->id)->whereBetween('created_at',[$from,$to])->get();
                                          foreach($get_tr_to_him as $gtth){
                                          echo 'TB'.$gtth->member_id;
                                         }


                                          }
                                          else{
                                          echo "<span style='color:#ff7d1a;font-weight:bolder;'>0</span>";
                                          }



                                    @endphp</th>
                                <th><span style="color:#ff7d1a;font-weight:bolder;">{{$all_card_amount}}</span></th>
                                <th><span style="color:#ff7d1a;font-weight:bolder;">{{$ttsum}}<br></span>
                                    @php
                                        if($ttsum != ''){
                                        $tt_tr_to_him=DB::table('transfers')->where('member_id',$ai->id)->whereBetween('created_at',[$from,$to])->get();
                                        foreach($tt_tr_to_him as $tth){
                                        echo 'TB'.$tth->transfer_id.' '.$tth->amount.' '.$tth->created_at.'<br>';
                                        }


                                       }
                                      else{
                                      echo 0;
                                       }
                                    @endphp
                                </th>
                                <th><span style="color:#ff7d1a;font-weight:bolder;">{{$nowb->amount_for_approve}}
                                </span>
                                    @php
                                        $app_mem=DB::table('approvemembers')->where('member_id',$ai->id)->whereBetween('created_at',[$from,$to])->get();
                                        foreach($app_mem as $ama){
                                        $getat=DB::table('activemembers')->where('nrc_no',$ama->nrc_no)->first();
                                        echo 'TB'.$getat->id.' '.$getat->created_at.'<br>';

                                        }
                                    @endphp
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>


    <!-- END CONTAINER -->
@endsection
