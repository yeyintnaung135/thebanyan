@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Phone Bill
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
                                        <span class="caption-subject bold">Monthly Phone Bill Income
                                        </span>
                                        
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                    
                                    <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>MPT</th>
                                                <th>Telenor</th>
                                                <th>Ooredoo</th>
                                                <th>Monthly</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>MPT</th>
                                                <th>Telenor</th>
                                                <th>Ooredoo</th>
                                                <th>Monthly</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($incomes as $income)
                                            <tr>
                                                <td>
                                                    <?php 
                                                        $monthly = $income->monthly;
                                                        $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$monthly'and card= '101' "); 
                                                        $amount = $totalamount[0]->amount;

                                                     ?>
                                                     {{ $amount }}
                                                </td>
                                                <td>
                                                    <?php 
                                                        $monthly = $income->monthly;
                                                        $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$monthly'and card= '111' "); 
                                                        $amount = $totalamount[0]->amount;

                                                     ?>
                                                     {{ $amount }}
                                                </td>
                                                <td>
                                                    <?php 
                                                        $monthly = $income->monthly;
                                                        $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$monthly'and card= '121' "); 
                                                        $amount = $totalamount[0]->amount;

                                                     ?>
                                                     {{ $amount }}
                                                </td>
                                                <td>{{ $income->monthly }}</td>
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