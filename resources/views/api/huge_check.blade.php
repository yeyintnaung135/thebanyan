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
                                        <span class="caption-subject bold uppercase">All Staff</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Old Balance</th>
                                            <th>Old Bonus</th>
                                            <th>GetBonus</th>
                                            <th>Add by STAFF</th>
                                            <th>Extra Bo</th>
                                            <th>Get Tran</th>
                                            <th>Buy Topup</th>
                                            <th>Transfer To</th>
                                            <th>Remaining Balance</th>
                                            <th>Now Balance</th>
                                            <th>Now Bonus</th>
                                            <th>Now Total</th>
                                            <th>True </th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Old Balance</th>
                                            <th>Old Bonus</th>
                                            <th>GetBonus</th>
                                            <th>Add by STAFF</th>
                                            <th>Extra Bo</th>
                                            <th>Get Tran</th>
                                            <th>Buy Topup</th>
                                            <th>Transfer To</th>
                                            <th>Remaining Balance</th>
                                            <th>Now Balance</th>
                                            <th>Now Bonus</th>
                                            <th>Now Total</th>
                                            <th>True </th>

                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                            $all_id=DB::table('activemembers')->where([['id','<=',$id],['id','>=',$from_id]])->get();
                                            foreach ($all_id as $ai){
                                            $tgb=DB::connection('mysql3')->table('activemembers')->where([['id','=',$ai->id]])->first();
                                            $or_b=$tgb->balance;
                                            $or_bo=$tgb->main_balance;



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
                                            $bt = DB::table('bonus_transaction')->where([['tb', '=', $ai->id], ['status','=', 'second nmsi']])->whereBetween('created_at', [$from, $to])->get();
                                            $s_bt_a = 0;
                                            foreach ($bt as $bo_tr) {
                                            $s_bt_a += $bo_tr->amount;//bonus amount of sn

                                            }



                                            $t_all_nmsi = DB::table('activemembers')->where('main_sponsor_id',$ai->id)->get();
                                            $t_ac=0;
                                            foreach($t_all_nmsi as $an){
                                            $t_all_count=DB::table('activemembers')->where('main_sponsor_id',$an->id)->get();
                                            foreach($t_all_count as $ttac) {
                                            $th_all_count = DB::table('activemembers')->where('main_sponsor_id', $ttac->id)->whereBetween('created_at', [$from, $to])->count();
                                            $t_ac+=$th_all_count;//third nmsi count

                                            }

                                            }

                                            $tbt = DB::table('bonus_transaction')->where([['tb', '=',$ai->id], ['status','=', 'third nmsi']])->whereBetween('created_at', [$from, $to])->get();
                                            $t_bt_a = 0;
                                            foreach ($tbt as $tbo_tr) {
                                            $t_bt_a += $tbo_tr->amount;//bonus amount of tn

                                            }
                                            $monthly_bonus_count=DB::table('messages')->where([['tb_id','=',$ai->id],['subject','=','Your Bonus for this month']])->whereMonth('created_at','=',\Carbon\Carbon::now()->month)->whereYear('created_at','=',\Carbon\Carbon::now()->year)->count();
                                            $monthly_bonus=DB::table('messages')->where([['tb_id','=',$ai->id],['subject','=','Your Bonus for this month']])->whereMonth('created_at','=',\Carbon\Carbon::now()->month)->whereYear('created_at','=',\Carbon\Carbon::now()->year)->first();
                                            if($monthly_bonus_count > 0){
                                                $str=$monthly_bonus->description;
                                                preg_match_all('!\d+!', $str, $matches);
                                                $mob = $matches[0][0];
                                            }
                                            else{
                                                $mob=0;
                                            }

                                            $main_sponsor= DB::table('activemembers')->where('main_sponsor_id', $ai->id)->whereBetween('created_at', [$from, $to]);
                                            $main_sponsor_count=$main_sponsor->count();
                                            $main_sponsor_count=$main_sponsor->count();
                                            $fbt = DB::table('bonus_transaction')->where([['tb', '=', $ai->id], ['status','=', 'first nmsi']])->whereBetween('created_at', [$from, $to])->get();
                                            $f_bt_a = 0;
                                            foreach ($fbt as $fbo_tr) {
                                            $f_bt_a += $fbo_tr->amount;//bonus amount of fn

                                            }

                                            $all_card = DB::table('incomes')->where('member_id', $ai->id)->whereBetween('created_at', [$from, $to])->get();
                                            $all_card_amount=0;
                                            foreach($all_card as $an){
                                            $all_card_amount += $an->amount;//amount of topup card

                                            }

                                            $aamount=DB::table('approvemembers')->where('member_id',$ai->id)->whereBetween('created_at', [$from, $to])->get();
                                            $asum=0;
                                            foreach ($aamount as $aa){

                                            $asum+= 20000;

                                            }

                                            $add_by_staff=DB::table('dailyreports')->where([['member_id','=',$ai->id],['description','=','Added Balance']])->whereBetween('created_at', [$from, $to])->sum('amount');


                                            $gtsum=DB::table('transfers')->where('transfer_id',$ai->id)->whereBetween('created_at', [$from, $to])->sum('amount');//get transfer amount

                                            $ttsum=DB::table('transfers')->where('member_id',$ai->id)->whereBetween('created_at', [$from, $to])->sum('amount');//transfer to amount
                                            $ttpar=$ttsum/100;
                                            $getmsgbo=DB::table('messages')->where('tb_id',$ai->id)->where('subject','Get 1000 bonus')->whereBetween('created_at', [$from, $to]);
                                            $exbonus =$getmsgbo->count() * 1000;
                                            $getmoney=$add_by_staff + $gtsum + $f_bt_a + $s_bt_a + $t_bt_a +$mb +$or_b +$or_bo +$exbonus+$mob;
                                            $usemoney=($ttsum + $all_card_amount + $asum+$ttpar);
                                            $remain = $getmoney - $usemoney;
                                            $nowb=DB::table('activemembers')->where('id',$ai->id)->first();
                                            $now=$nowb->balance + $nowb->main_balance + $nowb->amount_for_approve;


                                            if(floor($remain) == floor($now))
                                            {
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
                                                $result='yes';
                                            }

                                            elseif(ceil($remain) == ceil($now)) {
                                                $result='yes';

                                                echo 'good';

                                            }
                                            else
                                            {
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
                                                $result='no';


                                            }
                                            ?>
                                            <tr>
                                            <th>{{$ai->id}}</th>
                                            <th>{{$or_b}}</th>
                                            <th>{{$or_bo}}</th>
                                            <th><?php echo $f_bt_a + $s_bt_a + $t_bt_a +$mb+$mob;?> </th>
                                            <th>{{$add_by_staff}}</th>
                                            <th>{{$exbonus}}</th>
                                            <th>{{$gtsum}}</th>
                                            <th>{{$all_card_amount}}</th>
                                            <th>
                                            {{$ttsum}}-{{$ttpar}}
                                            {{$ttsum - $ttpar}}
                                            </th>
                                            <th>{{$remain}}</th>
                                            <th>{{$nowb->main_balance+$nowb->amount_for_approve}}</th>
                                            <th>{{$nowb->balance}} </th>
                                            <th>{{($nowb->main_balance+$nowb->amount_for_approve+$nowb->balance)}} </th>
                                            <th>{{$result}} </th>

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
                    </div>


                    <!-- END CONTAINER -->
                @endsection
