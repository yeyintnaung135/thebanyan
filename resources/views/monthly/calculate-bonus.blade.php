@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Phone Billing Bonus Calculate
            </h1>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Phone Billing Bonus Calculate </span>
        </li>
    </ul>

    <!-- END PAGE BREADCRUMB -->


    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
        @include('flash::message')
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject uppercase text-info">
                                        <?php
                            date_default_timezone_set("Asia/Rangoon");
                            $year = date('Y-m-d h:i:s');
                            $date = date('m/Y');
                            $totalamount = DB::select("SELECT * FROM activepoints where monthly='$date'");
                            $point = $totalamount[0]->activepoint;


                            $billing = DB::select("SELECT * FROM billingbonus where id='1'");
                            $billbonus = $billing[0]->billbonus;
                            $extrabonus = $billing[0]->extra;

                            ?>
                            Active Point: {{$point}}</span>
                        <?php
                        $day = date('d');
                        if($day >= 25){ ;?>
                        <button onClick="(location.href='{{ URL::to('monthly/calculation') }}')"
                                class="btn btn-primary">Calculation
                        </button>
                        <?php } ;?>
                    </div>

                    <div class="tools">

                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Username</th>
                            <th>Balance</th>
                            <th>Total Used</th>
                            <th>Active Bonus</th>
                            <th>Extra Bonus</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Member ID</th>
                            <th>Username</th>
                            <th>Balance</th>
                            <th>Total Used</th>
                            <th>Active Bonus</th>
                            <th>Extra Bonus</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $totalphoneamount = DB::select("SELECT DISTINCT member_id FROM incomes WHERE status='new'");//get all incomes member id and amount
                        foreach($totalphoneamount as $phonebill){
                        $mid = $phonebill->member_id; //set member id to $mid




                        $totalamount = DB::table('incomes')->where([['member_id',$mid],['status','new']])->sum('amount');//member use amount
                        $amount = $totalamount;



                        if($amount >= $point){


                        $result = DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$mid "));
                        $var = $result[0]->total;





                        ?>
                        <tr>
                            <td>
                                {{$mid}}
                                <?php

                                $mems = DB::select("SELECT * FROM activemembers WHERE id='$mid'");
                                /*echo "<pre>";
                                print_r($mems);
                                echo "</pre>";*/
                                $name = $mems[0]->username;
                                $balance = $mems[0]->balance;
                                $active = $mems[0]->active_count;

                                ?>
                            </td>
                            <td>
                                {{$name}}
                            </td>
                            <td><span class="text-info">{{$balance}}</span></td>
                            <td><span class="text-info">{{$amount}}</span></td>
                            <td>
                                                    <span class="text-success">
                                                    <?php echo($billbonus * $active);?>
                                                    </span>
                            </td>
                            <td>
                                                	<span class="text-success">
                                             <?php
                                                        $user_amount_id = \Illuminate\Support\Facades\DB::table('incomes')->where([['member_id', '=', $mid], ['status', '=', 'new']])->get();
                                                        $use_amount_to_check = 0;
                                                        $limit_id = 0;
                                                        $all_external_am = 0;
                                                        $use_amount_to_check=0;
                                                        $rem_id=0;


                                                        foreach ($user_amount_id as $uai) {

                                                            if ($use_amount_to_check < 20000) {
                                                                $use_amount_to_check += $uai->amount;
                                                                if($use_amount_to_check > 20000){
                                                                    $rem_a=$use_amount_to_check - 20000;
                                                                    $take_per=\Illuminate\Support\Facades\DB::table('topup_profit')->whereDate('created_at','=',\Carbon\Carbon::parse($uai->created_at)->toDateString());
                                                                    if($take_per->count() != 0){
                                                                    if($uai->card = '101'){
                                                                        if($take_per->first()->mptper != ''){
                                                                            $all_external_am +=($rem_a * ($take_per->first()->mptper / 100));
                                                                        }
                                                                        else{
                                                                            $all_external_am +=($rem_a * (4 / 100));

                                                                        }


                                                                    }
                                                                    elseif($uai->card = '121'){
                                                                        if($take_per->first()->telper != ''){

                                                                            $all_external_am +=($rem_a * ($take_per->first()->telper / 100));
                                                                        }
                                                                        else{
                                                                            $all_external_am +=($rem_a * (4 / 100));

                                                                        }


                                                                    }
                                                                    else{
                                                                        if($take_per->first()->ooper != '')
                                                                        {

                                                                            $all_external_am +=($rem_a * ($take_per->first()->ooper / 100));
                                                                        }
                                                                        else{
                                                                            $all_external_am +=($rem_a * (4 / 100));

                                                                        }


                                                                    }
                                                                    }
                                                                    else{
                                                                        $all_external_am +=($rem_a * (4 / 100));

                                                                    }

                                                                }


                                                            }
                                                            else {
                                                                $limit_id = $uai->id;
                                                                $take_per=\Illuminate\Support\Facades\DB::table('topup_profit')->whereDate('created_at','=',\Carbon\Carbon::parse($uai->created_at)->toDateString());
                                                                if($take_per->count() != 0){

                                                                    if($uai->card = '101'){
                                                                        if($take_per->first()->mptper != ''){
                                                                            $all_external_am +=($uai->amount * ($take_per->first()->mptper / 100));
                                                                        }
                                                                        else{
                                                                            $all_external_am +=($uai->amount * (4 / 100));

                                                                        }


                                                                    }
                                                                    elseif($uai->card = '121'){
                                                                        if($take_per->first()->telper != ''){

                                                                            $all_external_am +=($uai->amount * ($take_per->first()->telper / 100));
                                                                        }
                                                                        else{
                                                                            $all_external_am +=($uai->amount * (4 / 100));

                                                                        }


                                                                    }
                                                                    else{
                                                                        if($take_per->first()->ooper != '')
                                                                        {

                                                                            $all_external_am +=($uai->amount * ($take_per->first()->ooper / 100));
                                                                        }
                                                                        else{
                                                                            $all_external_am +=($uai->amount * (4 / 100));

                                                                        }


                                                                    }
                                                                }
                                                                else{
                                                                    $all_external_am +=($uai->amount * (4 / 100));
                                                                   
                                                                }







                                                            }
                                                        }
                                                        echo $all_external_am;


                                                        ?>




                                                    </span>
                            </td>
                        </tr>
                        <?php } }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@stop