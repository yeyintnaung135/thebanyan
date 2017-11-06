@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Buttons Datatable
                                <small>buttons extension demos</small>
                            </h1>
                        </div>
                    </div>
                    
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="#">Tables</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Datatables</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->

                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Buttons</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>NRC</th>
                                                <th>Total Balance</th>
                                                <th>Monthly Bonus</th>
                                                <th>Payroll By</th>
                                                <th>Payroll Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>NRC</th>
                                                <th>Total Balance</th>
                                                <th>Monthly Bonus</th>
                                                <th>Payroll By</th>
                                                <th>Payroll Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($bonus as $bonu)
                                            <tr>
                                                <td>{{ $bonu->id }}</td>
                                                <td>
                                                    <?php 
                                                        $member_id = $bonu->member_id;
                                                        $username = DB::table('activemembers')->where('id','=',$member_id)->pluck('username');

                                                        echo $pickusername = $username['0'];

                                                     ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $NRC = DB::table('activemembers')->where('id','=',$member_id)->pluck('nrc_no');

                                                        echo $picknrc = $NRC['0'];
                                                     ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                        $balance = DB::table('activemembers')->where('id','=',$member_id)->pluck('balance');

                                                        echo $pickbalance = $balance['0'];
                                                     ?> 
                                                </td>
                                                <td>
                                                    {{ $bonu->totalbonus }}
                                                </td>
                                                <td>
                                                    {{ $bonu->payroll_by }}
                                                </td>
                                                <td>
                                                    {{ $bonu->payroll_date }}
                                                </td>
                                                <td>
                                                    <?php 
                                                        $monthlystatus = $bonu->status;
                                                        if($monthlystatus == 'added'){
                                                            ?>
                                                            <p style="color:green;">{{ $monthlystatus }}</p>
                                                            <?php
                                                        }else{
                                                           ?>
                                                            <p style="color:red;">{{ $monthlystatus }}</p>
                                                            <?php 
                                                        }
                                                     ?>
                                                </td>
                                                <td>
                                                    <?php $status = $bonu->status;
                                                        if($status == 'added'){
                                                            ?>
                                                            <button class="btn btn-success pull-left" style="padding:0px 10px !important;" disabled type="button" >{{ 'Added' }}</button>
                                                            <?php
                                                        }else{
                                                           ?>
                                                            <button class="btn btn-info pull-left" style="padding:0px 10px !important;" type="button" onClick="location.href='{{ action('MonthlybonusController@show', array($bonu->member_id)) }}'">{{ 'Add' }}</button>
                                                            <?php 
                                                        }
                                                     ?>
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