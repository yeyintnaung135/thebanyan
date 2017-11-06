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
            {!! Form::open(['method'=>'GET','url'=>'daily_by_staff'])  !!}

            <input type="date" name="date"/>
            <input type="submit" value="search"/>
            {!! Form::close() !!}
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

                        <span class="caption-subject bold">Daily Report
                                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Total Amount </th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Total Amount</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @php
                        $staff=DB::table('users')->get();
                        $all_total=0;
                        @endphp

                        @foreach ($staff as $stf)
                            <tr>
                                <td>
                                    {{ $date }}
                                </td>
                                <td>
                                    <?php

                                    echo $stf->username;
                                    ?>

                                </td>
                                <td>
                                    @php
                                    $getstaff=DB::table('dailyreports')->where([['approved_by','=',$stf->username],['description','!=','Paying']])->whereBetween('created_at',[$date.' 00.00.00',$date.' 23.59.59'])->sum('amount');
                                    echo $getstaff;
                                    $all_total+=$getstaff;
                                    @endphp
                                </td>

                            </tr>

                        @endforeach
                        <tr>
                            <td>

                            </td>
                            <td style="text-align: center;">
                             <span style="font-weight:bolder;font-size:17px;">All Total Amount</span>

                            </td>
                            <td>
                                <span style="font-weight:bolder;font-size:14px;">{{$all_total}}</span>
                            </td>

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