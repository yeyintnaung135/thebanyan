@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Member bonus transaction
            </h1>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->

    <!-- END PAGE BREADCRUMB -->

    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title" style="float:left;">
            <h1>Search By Month

            </h1>
            {!! Form::open(['method'=>'post','url'=>url('bonusm')])  !!}

            <input type="month" name="date"/>
            <input type="hidden" name="id" value="{{$id}}"/>


            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>
    </div>
    <?php
            if($date==''){
    $user_amount_id = \Illuminate\Support\Facades\DB::table('incomes')->where([['member_id', '=', $id], ['status', '=', 'new']])->get();
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
                $total_sum = \Illuminate\Support\Facades\DB::table('incomes')->where([['member_id', '=', $id],['status','=','new']])->sum('amount');

            }
else{
    $f=\Carbon\Carbon::parse($date)->subMonthNoOverflow()->year.'-'.\Carbon\Carbon::parse($date)->subMonthNoOverflow()->month.'-'.'26 00.00.00';
    $t=\Carbon\Carbon::parse($date)->year.'-'.\Carbon\Carbon::parse($date)->month.'-'.'25 23.59.59';

    $user_amount_id = \Illuminate\Support\Facades\DB::table('incomes')->where([['member_id', '=', $id]])->whereBetween('created_at', [$f, $t])->get();
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
    $total_sum = \Illuminate\Support\Facades\DB::table('incomes')->where([['member_id', '=', $id]])->whereBetween('created_at', [$f, $t])->sum('amount');

}

    ?>




    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
        @include('flash::message')
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>TB</th>
                            <th>status</th>
                            <th>By</th>
                                                        <th>NRC</th>

                            <th>Amount</th>
                            <th>Created_at</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>TB</th>
                            <th>status</th>
                            <th>By</th>
                                                        <th>NRC</th>

                            <th>Amount</th>
                            <th>Created_at</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $total=0;
?>
                        @foreach( $bonus as $message)
                            <tr>
                                <td>{{ $message->tb }}</td>
                                <td>{{ $message->status }}</td>
                                <td>{{ $message->by_whom }}</td>
                                  <td>{{ $message->nrc }}</td>
                                <td>{{ $message->amount }}</td>
                                <td>{{ $message->created_at }}</td>
                                <?php
                                $total += $message->amount;
                                ?>

                            </tr>
                        @endforeach

                        </tbody>
                        <div style="float:left;margin-right:123px;"><span style="color:deepskyblue;font-weight:bolder;">Bonus Total</span>: {{$total}}</div>
                        <div style="float:left;margin-right:123px;"><span style="color:deepskyblue;font-weight:bolder;">Topup Profit</span>: {{$all_external_am}}</div>
                        <div style="float:left;margin-right:123px;"><span style="color:deepskyblue;font-weight:bolder;">Total use amount</span>:    <?php  ?> {{$total_sum}}
                        </div>
                    </table>
                </div>
            </div>
            <div class="portlet light bordered">

                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>TB</th>
                            <th>status</th>
                            <th>description</th>
                            <th>Amount</th>
                            <th>Created_at</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>TB</th>
                            <th>status</th>
                            <th>description</th>
                            <th>Amount</th>
                            <th>Created_at</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $etotal=0;
                        ?>
                        @foreach( $ext as $message)
                            <tr>
                                <td>{{ $message->tb_id }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->description }}</td>
                                <td>{{ 1000 }}</td>
                                <td>{{ $message->created_at }}</td>
                                <?php
                                $etotal += 1000;
                                ?>

                            </tr>
                        @endforeach

                        </tbody>
                        <div><span style="color:deepskyblue;font-weight:bolder;">Extra Bonus Total</span>: {{$etotal}}</div>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@stop