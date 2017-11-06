@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Today Income Datatable

            </h1>
        </div>
    </div>


    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => 'totalincome', 'method' => 'post'))  }}
            <div class="panel panel-default">
                <div class="panel-heading">Daily Debit</div>

                <div class="panel-body">
                    @include('flash::message')
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Cashdown</label>
                        <div class="col-sm-10">
                        {{$cash_down}}
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Debit</label>
                        <div class="col-sm-10">
                            {{$credit}}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pay</label>
                        <div class="col-sm-10">
                            {{$pay}}
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
                        <span class="caption-subject bold uppercase">ToDay Debit List</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>TB ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Approved By</th>
                            <th>Date</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>TB ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Approved By</th>
                            <th>Date</th>
                            <th>View</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($credit_list as $cl)
                            <tr>
                                <td>{{ $cl->member_id }}</td>
                                <td>  <?php
                                    $username = \Illuminate\Support\Facades\DB::table('activemembers')->where('id', '=', $cl->member_id)->first();
                                    echo $username->username;
                                    ?>
                                </td>
                                <td>{{ $cl->amount }}</td>
                                <td>{{ $cl->approved_by }}</td>
                                <td>{{ $cl->approved_date }}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="location.href='{{url('debit_list_by_id/'.$cl->member_id)}}';">  View  </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">ToDay Pay List</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>TB ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Approved By</th>
                            <th>Date</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>TB ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Approved By</th>
                            <th>Date</th>
                            <th>View</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($paylist as $pl)
                            <tr>
                                <td>{{ $pl->member_id }}</td>
                                <td>  <?php
                                    $username = \Illuminate\Support\Facades\DB::table('activemembers')->where('id', '=', $pl->member_id)->first();
                                    echo $username->username;
                                    ?>
                                </td>
                                <td>{{ $pl->amount }}</td>
                                <td>{{ $pl->approved_by }}</td>
                                <td>{{ $pl->approved_date }}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="location.href='{{url('debit_list_by_id/'.$pl->member_id)}}';">  View  </button>
                                </td>
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