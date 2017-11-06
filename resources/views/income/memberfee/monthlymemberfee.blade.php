@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Monthly Member Fee
                                <small>buttons extension demos</small>
                            </h1>
                        </div>
                    </div>
                    <!-- END PAGE BREADCRUMB -->

                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Monthly Income Total Fee</span>

                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Total Fee</th>
                                                <th>Monthly</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Total Fee</th>
                                                <th>Monthly</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($memberfees as $memberfee)
                                            <tr>
                                                <td>
                                                	<?php 
                                            		$date = $memberfee->approved_date;
                                                	$totalamount = DB::select("SELECT SUM(fee) AS fee FROM memberfees where approved_date='$date'"); 
                                                	$amount = $totalamount[0]->fee;
                                             ?>
                                             {{ $amount }}
                                                </td>
                                                <td>{{ $memberfee->approved_date }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    
                   
        <!-- END CONTAINER -->
@endsection