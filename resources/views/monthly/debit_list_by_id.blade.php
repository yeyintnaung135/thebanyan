@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
    @include('flash::message')


        <div class="page-title" style="float:left;">
            <h1>Debit Report
              For TB {{$member_id}} {{$date}}
            </h1>
            {!! Form::open(['method'=>'GET','url'=>'debit_list_by_id/'.$member_id])  !!}
            <input type="month" name="month"/>
            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>


            <div class="row"></div>
        <div class="caption font-dark">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="float:left">
                <h5 class="widget-thumb-heading">All Credit</h5>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-users"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Total</span>


                        <span class="widget-thumb-subtitle">{{$sum}}</span>


                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->

            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="float:left">
                <h5 class="widget-thumb-heading">Pay</h5>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-users"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Total</span>
                        <?php
                        ?>
                        <span class="widget-thumb-subtitle">{{$pay}}</span>


                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-20 " style="float:left;">
                <h5 class="widget-thumb-heading">Remaining Balance</h5>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-users"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Total</span>
                        <span class="widget-thumb-subtitle">{{$remain_debit}}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->

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

                        <span class="caption-subject bold">Debit list
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
                            <th>Amount</th>
                            <th>Approve By</th>
                            <th>Date</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Member_id</th>
                            <th>Username</th>
                            <th>Amount</th>
                            <th>Approve By</th>
                            <th>Date</th>
                            <th>Edit</th>


                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($debit_list as $dl)
                            <tr>
                                <td>
                                    TB{{ $dl->member_id }}
                                </td>
                                <td>
                                    <?php
                                    $username = \Illuminate\Support\Facades\DB::table('activemembers')->where('id', '=', $dl->member_id)->first();
                                    echo $username->username;
                                    ?>
                                </td>
                                <td>
                                  {{$dl->amount}}
                                </td>
                                <td>
                                   {{ $dl->approved_by }}
                                </td>
                                <td>
                                  {{$dl->approved_date}}
                                </td>
                                <td>@if($dl->payment==0 or $dl->payment == 3 )
                                        <p> Cash Down </p>

                                    @endif

                                    @if ($dl->payment==1 or $dl->payment == 4)
                                        <button class="btn btn-primary" onclick="location.href='{{url('change-debt/'.$dl->id)}}';">  Indepts  </button>
                                    @endif
                                </td>
                                <td>

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

                        <span class="caption-subject bold">Paying list
                                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>Member_id</th>
                            <th>Username</th>
                            <th>Amount</th>
                            <th>Approve By</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Member_id</th>
                            <th>Username</th>
                            <th>Amount</th>
                            <th>Approve By</th>
                            <th>Date</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($pay_list as $dl)
                            <tr>
                                <td>
                                    TB{{ $dl->member_id }}
                                </td>
                                <td>
                                    <?php
                                    $username = \Illuminate\Support\Facades\DB::table('activemembers')->where('id', '=', $dl->member_id)->first();
                                    echo $username->username;
                                    ?>
                                </td>
                                <td>
                                    {{$dl->amount}}
                                </td>
                                <td>
                                    {{ $dl->approved_by }}
                                </td>
                                <td>
                                    {{$dl->approved_date}}
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