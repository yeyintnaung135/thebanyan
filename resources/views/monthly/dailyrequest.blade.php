@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Daily Withdraw Request Report
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

                                        <span class="caption-subject bold">Daily Withdraw Request Report
                                        </span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Member_id</th>
                                                <th>Username</th>
                                                <th>Approved By</th>
                                                <th>Amount</th>
                                                <th>Approved Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Member_id</th>
                                                <th>Username</th>
                                                <th>Approved By</th>
                                                <th>Amount</th>
                                                <th>Approved Date</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($dailyrequests as $dailyrequest)
                                            <tr>
                                                <td>
                                                    TB{{ $dailyrequest->member_id }}
                                                </td>
                                                <td>{{ $dailyrequest->username }}</td>
                                                <td>{{ $dailyrequest->approved_by }}</td>
                                                <td>{{ $dailyrequest->amount }}</td>
                                                <td>{{ $dailyrequest->approved_date }}</td>
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