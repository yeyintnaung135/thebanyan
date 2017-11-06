@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Mpu Requests

            </h1>
        </div>
    </div>

    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Requests</a>
            <i class="fa fa-circle"></i>
        </li>

    </ul>
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
                        <span class="caption-subject bold uppercase"><Requests></Requests></span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">

                    <?php
                    //echo "<pre>";
                    //print_r($approves);
                    //echo "</pre>";
                    ?>
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>

                        <tr>

                            <th>ID</th>

                            <th>Member ID</th>

                            <th>Amount</th>

                            <th>Old Balance</th>

                            <th>Status</th>

                            <th>Read</th>

                            <th>Date</th>

                            <th>Mark As Read</th>

                        </tr>
                        </thead>

                        <tfoot>

                        <tr>

                            <th>ID</th>

                            <th>Member ID</th>

                            <th>Amount</th>

                            <th>Old Balance</th>

                            <th>Status</th>

                            <th>Read</th>

                            <th>Date</th>

                            <th>Mark As Read</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        <a href="{{'mark_all_as_read'}}"
                           class="btn btn-inline btn-success btn-sm ladda-button rightEdge">Mark all as Read</a>
                        @foreach($mpu_data as $md)

                            <tr>
                                <td>{{$md->id}}</td>

                                <td>{{$md->userid}}</td>

                                <td>{{$md->amount}}</td>

                                <td>{{$md->old_balance}}</td>

                                <td>{{$md->status}}</td>

                                <td>@if($md->rd == 'yes')
                                        <span style="color:red;font-weight:bolder;">{{$md->rd}}</span>
                                @else
                                        <span style="color:blue;font-weight:bolder;">{{$md->rd}}</span>
                                @endif
                                </td>

                                <td>{{$md->created_at}}</td>
                                <td>
                                    @if($md->rd != 'yes')
                                        <a href="{{'mark_as_read/'.$md->id}}"
                                           class="btn btn-inline btn-primary btn-sm ladda-button">Mark</a>

                                    @endif
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


    <!-- END CONTAINER -->
@endsection