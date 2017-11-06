@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title" style="float:left;">
            <h1>Daily Report
                <small>Search by date</small>
            </h1>
            {!! Form::open(['method'=>'GET','class'=> 'form-horizontal','url'=>'debit_credit'])  !!}
            <div class="form-group">
                <label class="col-md-2 control-label">Payment Type</label>
                <div class="col-md-12">
                    <select class="form-control" name="type">
                        <option value="1">Cash Down</option>
                        <option value="0">Credit</option>
                    </select>
                </div>
            </div>
            <input type="number" name="id" placeholder="&nbsp;&nbsp;&nbsp;TB"/>
            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Session::has('A'))
        <div class="row">
            <div class="alert alert-info">

                Updated success!
            </div>
        </div>
    @endif
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>

                        <span class="caption-subject bold">Daily Report
                                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>Member_id</th>
                            <th>Username</th>
                            <th>Description</th>
                            <th>Approved By</th>
                            <th>Amount</th>
                            <th>Approved Date</th>
                            <th>Payment</th>
                            <th>Signature</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Member_id</th>
                            <th>Username</th>
                            <th>Description</th>
                            <th>Approved By</th>
                            <th>Amount</th>
                            <th>Approved Date</th>
                            <th>Payment</th>
                            <th>Signature</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($all_data as $daily)
                            <tr>
                                <td>
                                    TB{{ $daily->member_id }}
                                </td>
                                <td>
                                    <?php
                                    $username = \Illuminate\Support\Facades\DB::table('activemembers')->where('id', '=', $daily->member_id)->first();
                                    echo $username->username;
                                    ?>
                                </td>
                                <td>{{ $daily->description }}</td>
                                <td>{{ $daily->approved_by }}</td>

                                <td>{{ $daily->amount }}</td>
                                <td>{{ $daily->approved_date }}</td>
                                <td>@if($daily->payment==0)
                                        <p> Cash Down </p>

                                    @endif

                                    @if ($daily->payment==1)
                                        <button class="btn btn-primary" onclick="location.href='{{url('change-debt/'.$daily->id)}}';">  Indepts  </button>
                                    @endif
                                </td>
                                <td></td>
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