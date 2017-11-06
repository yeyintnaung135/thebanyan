@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')


    <script type="text/javascript">
        $(document).ready(function () {
            $('#extra').keyup(function (ev) {
                var total = $('#income').val() - $('#extra').val();
                $('#total').html((total).toFixed(2));
            });
        });
    </script>
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Monthly Report of {{$date}}
            </h1>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->

    <!-- END PAGE BREADCRUMB -->

    @include('flash::message')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Search Monthlyreport</div>
                <div class="panel-body">
                    {{ Form::open(array('url' => 'searchmonthlyreport', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker2'>
                                <input type='text' name="monthly" class="form-control"/>
                                <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN PAGE BASE CONTENT -->
    {{ Form::open(array('url' => 'monthly/saved-report', 'method' => 'post'))  }}
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Phone Billing</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-9 control-label text-info">Phone Billing Income </label>
                        <div class="col-sm-3">
                            <?php


                            $totalphoneamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date'");
                            $phoneamount = $totalphoneamount[0]->amount;
                            ?>
                            <span class="text-danger">:{{ $phoneamount }}</span>

                            <input type="hidden" name="phone_income" value="{{ $phoneamount }}"/>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-9 control-label text-info">Phone Billing Profits</label>
                        <div class="col-sm-3">
                            <?php

                            $mptamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and card = '101' ");
                            $MPT = $mptamount[0]->amount;

                            $mptpercent = DB::table('cards')->where('id', '=', 1)->pluck('bonuspercent');
                            $pickmptpercent = $mptpercent['0'];

                            $totalmpt = $MPT * ($pickmptpercent / 100);



                            $telenoramount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and card = '111' ");
                            $telenor = $telenoramount[0]->amount;

                            $telenorpercent = DB::table('cards')->where('id', '=', 2)->pluck('bonuspercent');
                            $picktelenorpercent = $telenorpercent['0'];

                            $totaltelenor = $telenor * ($picktelenorpercent / 100);

                            $ooredooamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and card = '121' ");
                            $Ooredoo = $ooredooamount[0]->amount;

                            $ooredoopercent = DB::table('cards')->where('id', '=', 3)->pluck('bonuspercent');
                            $pickooredoopercent = $ooredoopercent['0'];

                            $totalooredoo = $Ooredoo * ($pickooredoopercent / 100);

                            $totalphonebillbonus = $totalmpt + $totaltelenor + $totalooredoo;
                            ?>
                            <span class="text-danger">:{{ $totalphonebillbonus }}</span>

                            <input type="hidden" name="phone_profit" value="{{ $totalphonebillbonus }}"/>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-9 control-label text-info">Phone Billing Outcome</label>
                        <div class="col-sm-3">
                            <span class="text-danger">:</span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-9 control-label text-success">Total Income</label>
                        <div class="col-sm-3">
                            <?php
                            $total = $phoneamount + $totalphonebillbonus;
                            ?>
                            <span class="text-danger">:{{$total}}
				                </span>

                            <input type="hidden" name="total_income" value="{{ $total }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Membering</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-9 control-label text-info">Membering Fee Income</label>
                        <div class="col-sm-3">
                            <?php

                            $totalamount = DB::select("SELECT SUM(fee) AS fee FROM memberfees where approved_date='$date'");
                            $amount = $totalamount[0]->fee;
                            ?>
                            <span class="text-danger">:{{ $amount }}</span>
                            <input type="hidden" name="member_income" value="{{ $amount }}"/>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-9 control-label text-info">Membering Bonus Outcome</label>
                        <div class="col-sm-3">
                            <?php

                            $bonusoutcome = DB::select("SELECT bonusoutcome FROM bonusoutcome WHERE curdate='$date'");
                            $outcome = $bonusoutcome[0]->bonusoutcome;

                            $activeoutcome = DB::select("SELECT * FROM activemembers WHERE date='$date'");
                            $memout = count($activeoutcome) * 300;
                            ?>
                            <span class="text-danger">:{{$outcome + $memout }}</span>

                            <input type="hidden" name="member_outcome" value="{{$outcome + $memout }}"/>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-9 control-label text-info">Balance Transfer fee</label>
                        <div class="col-sm-3">
                            <?php
                            $transferbonus = DB::select("SELECT transferbonus FROM bonusoutcome WHERE curdate='$date'");
                            $outcometransfer = $transferbonus[0]->transferbonus;
                            ?>
                            <span class="text-danger">:{{ $outcometransfer }}</span>

                            <input type="hidden" name="transfer_fee" value="{{$outcometransfer }}"/>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-9 control-label text-success">Total Income</label>
                        <div class="col-sm-3">
                            <?php
                            $feeincome = $amount + $outcometransfer - $outcome - $memout;
                            ?>
                            <span class="text-danger">:{{ $feeincome}}</span>

                            <input type="hidden" name="member_total_income" value="{{$feeincome }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Profits</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-6 control-label text-info">Total Income </label>
                        <div class="col-sm-6">
                            <input type="text" name="income" id="income" value="{{$total + $feeincome}}"
                                   class="form-control">
                            <input type="hidden" name="total_incomeamount" id="income" value="{{$total + $feeincome}}"
                                   class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-6 control-label text-info">Extra Outcome</label>
                        <div class="col-sm-6">
                            <input type="text" name="extra" id="extra" placeholder="Enter extra outcome"
                                   class="form-control">
                            <input type="hidden" name="date" value="{{$date}}">
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <hr>
                        <label class="col-sm-6 control-label text-success">Total Profits</label>
                        <div class="col-sm-6">
                            <span class="text-danger" id="total">:0.00</span>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-actions pull-right" style="margin-right: -250px;">
                                <button type="submit" class="btn green">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    {{ Form::close() }}
    <!-- row -->
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    </div>
@stop
