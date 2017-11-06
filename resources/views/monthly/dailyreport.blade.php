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
            {!! Form::open(['method'=>'GET','url'=>'dailyreport'])  !!}

            <input type="date" name="date"/>
            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>

        <div class="page-title" style="margin-left:12px;">
            <h1>Daily Report
                <small>Search by Id</small>

            </h1>
            {!! Form::open(['method'=>'GET','url'=>'dailyreport'])  !!}

            <input type="number" name="id" placeholder="&nbsp;&nbsp;&nbsp;TB"/>
            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>
        <div class="caption font-dark">




            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="float:left">
                <h5 class="widget-thumb-heading">All</h5>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-users"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Total</span><br>
                        <?php

                        $total = 0;

                        foreach ($dailys as $daily)

                        {
                            $total += $daily->amount;
                        }



                        ?>

                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $total; ?>">

                                        {{$total}}

                        </span>

                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->

            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="float:left">
                <h5 class="widget-thumb-heading">Cash Down</h5>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-users"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Total</span><br>
                        <?php

                        $Cash_Down = 0;

                        foreach ($dailys as $daily)
                        {



                            if ($daily->payment==0 or $daily->payment=='' or $daily->payment=='3')

                            {


                                $Cash_Down += $daily->amount;

                            }


                        }



                        ?>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $Cash_Down; ?>">
                                        {{$Cash_Down}}

                                        </span>

                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-20 " style="float:left;">
                <h5 class="widget-thumb-heading">Indepts</h5>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-users"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Total</span><br>
                        <?php

                        $Indepts = 0;

                        foreach ($dailys as $daily)
                        {



                            if ($daily->payment==1 or $daily->payment == 4){


                                $Indepts += $daily->amount;
                            }


                        }



                        ?>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $Indepts; ?>">
                                            {{$Indepts}}
                                        </span>
                    </div>
                </div>
            </div>
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-20 " style="float:left;">
                <h5 class="widget-thumb-heading">Repay</h5>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-users"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Total</span><br>
                        <?php

                        $repay = 0;

                        foreach ($dailys as $daily)
                        {



                            if ($daily->description=='Paying'){


                                $repay += $daily->amount;
                            }


                        }



                        ?>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $repay; ?>">
                                            {{$repay}}
                                        </span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->

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
                        @foreach ($dailys as $daily)
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
                                <td>@if($daily->payment==0 or $daily->payment == 3)
                                    <p> Cash Down </p> 
                                     @endif
                                    @if ($daily->payment==1 or $daily->payment == 4)
                                    <button class="btn btn-primary" >  Indepts  </button>
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