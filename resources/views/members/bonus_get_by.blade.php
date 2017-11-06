@if($bonus == '')
    {{'Error'}}
@else

@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>TB     {{$id}}
            </h1>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->

    <!-- END PAGE BREADCRUMB -->







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

                            <th>Amount</th>
                            <th>Created_at</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>TB</th>
                            <th>status</th>

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

                                <td>{{ $message->amount }}</td>
                                <td>{{ $message->created_at }}</td>
                                <?php
                                $total += $message->amount;
                                ?>

                            </tr>
                        @endforeach

                        </tbody>

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
                            <th>By</th>
                            <th>Amount</th>
                            <th>Created_at</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>TB</th>
                            <th>status</th>
                            <th>By</th>
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
@endif