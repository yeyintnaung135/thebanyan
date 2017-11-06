@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Member Fee
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
                                        <span class="caption-subject bold uppercase"><?php 
                                        date_default_timezone_set("Asia/Rangoon");
                                        $year = date('Y-m-d h:i:s');
                                        $date = date('M-Y');
                                        echo $date;
                                        ?></span>

                                        <span class="caption-subject bold">Member Fee Total Income =
                                            <?php 
                                            date_default_timezone_set("Asia/Rangoon");
                                            $year = date('Y-m-d h:i:s');
                                            $date = date('m/Y');
                                                $totalamount = DB::select("SELECT SUM(fee) AS fee FROM memberfees where approved_date='$date'"); 
                                                $amount = $totalamount[0]->fee;
                                             ?>
                                             {{ $amount }}
                                        </span>
					<a onClick="location.href='{{ URL::to('monthlymemberfee') }}'">
                                            <span style="padding-left:5px;">
                                                Show Monthly Member Fee
                                            </span>
                                        </a>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Fee</th>
                                                <th>Status</th>
                                                <th>Approved By</th>
                                                <th>Approved Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Fee</th>
                                                <th>Status</th>
                                                <th>Approved By</th>
                                                <th>Approved Date</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($memberfees as $memberfee)
                                            <tr>
                                                <td>
                                                    <?php 
                                                        $member_id = $memberfee->member_id;
                                                        $username = DB::table('activemembers')->where('id','=',$member_id)->pluck('username');
                                                        $pickusername = $username['0'];
                                                       // print_r($username);
                                                     ?>
                                                    {{$pickusername }}
                                                </td>
                                                <td>{{ $memberfee->fee }}</td>
                                                <td class="text-success">{{ $memberfee->status }}</td>
                                                <td>{{ $memberfee->approved_by }}</td>
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