@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
<div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Total Income Datatable
                                
                            </h1>
                        </div>
                    </div>
                    
                    
                    <!-- END PAGE BREADCRUMB -->

                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                        {{ Form::open(array('url' => 'totalincome', 'method' => 'post'))  }}
                            <div class="panel panel-default">
                            <div class="panel-heading">Monthly Total Income</div>

                            <div class="panel-body">
                            @include('flash::message')
                                <div class="form-group">
                                <?php 
                                    date_default_timezone_set("Asia/Rangoon");
                                    $year = date('Y-m-d h:i:s');
                                    $date = date('m/Y');
                                    $totalphoneamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date'"); 
                                    $phoneamount = $totalphoneamount[0]->amount;
                                ?>
                                <label class="col-sm-2 control-label">Phone Bill</label>
                                <div class="col-sm-10">
                                    {{ $phoneamount }}
                                    <input type="hidden" name="phone_bill" value="{{ $phoneamount }}" />
                                </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                <?php 
                                    date_default_timezone_set("Asia/Rangoon");
                                    $year = date('Y-m-d h:i:s');
                                    $date = date('m/Y');
                                    $totalamount = DB::select("SELECT SUM(fee) AS fee FROM memberfees where approved_date='$date'"); 
                                    $amount = $totalamount[0]->fee;
                                ?>
                                        
                                <label class="col-sm-2 control-label">Member Fee</label>
                                <div class="col-sm-10">
                                    {{ $amount }}
                                    <input type="hidden" name="member_fee" value="<?php echo $amount; ?>" />
                                </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                <?php 
                                    $total = $phoneamount + $amount;
                                 ?>
                                <label class="col-sm-2 control-label">Total Income</label>
                                <div class="col-sm-10">
                                    {{ $total }}
                                    <input type="hidden" name="total_income" value="{{ $total }}" />
                                </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="form-actions pull-left" style="margin-left:175px;">                                   
                                        <button type="submit" class="btn green">Submit</button>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        {{ Form::close() }} 
                        </div>
                    </div>
<div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Buttons</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Phone Bill</th>
                                                <th>Member Fee</th>
                                                <th>Total Income</th>
                                                <th>Monthly</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Phone Bill</th>
                                                <th>Member Fee</th>
                                                <th>Total Income</th>
                                                <th>Monthly</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($totalincomes as $totalincome)
                                            <tr>
                                                <td>{{ $totalincome->id }}</td>
                                                <td>{{ $totalincome->phone_bill }}</td>
                                                <td>{{ $totalincome->member_fee }}</td>
                                                <td>{{ $totalincome->total_income }}</td>
                                                <td>{{ $totalincome->monthly }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
@endsection