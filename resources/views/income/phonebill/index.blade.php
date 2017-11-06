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
            
                            <div class="panel panel-default">
                            <div class="panel-heading">Monthly Phone Bill Income</div>

                            <div class="panel-body">
                            
                                <div class="col-md-4">
                                    <?php 
                                        date_default_timezone_set("Asia/Rangoon");
                                        $year = date('Y-m-d h:i:s');
                                        $date = date('m/Y');
                                        $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and card = '101' "); 
                                        $MPT = $totalamount[0]->amount;
                                    ?>
                                    <span class="text-info">MPT - {{ $MPT }} </span>
                                </div>
                                <div class="col-md-4">
                                    <?php 
                                        date_default_timezone_set("Asia/Rangoon");
                                        $year = date('Y-m-d h:i:s');
                                        $date = date('m/Y');
                                        $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and card = '111' "); 
                                        $telenor = $totalamount[0]->amount;
                                    ?>
                                    <span class="text-info">Telenor - {{ $telenor }} </span>
                                </div>
                                <div class="col-md-4">
                                    <?php 
                                        date_default_timezone_set("Asia/Rangoon");
                                        $year = date('Y-m-d h:i:s');
                                        $date = date('m/Y');
                                        $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and card = '121' "); 
                                        $Ooredoo = $totalamount[0]->amount;
                                    ?>
                                    <span class="text-info">Ooredoo - {{ $Ooredoo }} </span>
                                </div>

                            </div>                            
                        </div>
                        
                        </div>
                    </div>
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

                                        <span class="caption-subject bold">Bill Total Income =
                                            <?php 
                                            date_default_timezone_set("Asia/Rangoon");
                                            $year = date('Y-m-d h:i:s');
                                            $date = date('m/Y');
                                                $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date'"); 
                                                $amount = $totalamount[0]->amount;
                                             ?>
                                             {{ $amount }}
                                        </span>
                                        <a onClick="location.href='{{ URL::to('monthlyincome') }}'">
                                            <span style="padding-left:5px;">
                                                Show Monthly Income
                                            </span>
                                        </a>

                                    </div>
                                </div>
                                    
                                    <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>NRC_No</th>
                                                <th>TopUp_Code</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>NRC_No</th>
                                                <th>TopUp_Code</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($incomes as $income)
                                            <tr>
                                                <td>
                                                    <?php 
                                                        $member_id = $income->member_id;
                                                        $username = DB::table('activemembers')->where('id','=',$member_id)->pluck('username');
                                                        $pickusername = $username['0'];

                                                     ?>
                                                     {{ $pickusername }}
                                                </td>
                                                <td>
                                                <?php 
                                                        $member_id = $income->member_id;
                                                        $nrc_no = DB::table('activemembers')->where('id','=',$member_id)->pluck('nrc_no');
                                                        $picknrc_no = $nrc_no['0'];

                                                     ?>
                                                     {{ $picknrc_no }}
                                                </td>
                                                <td>
                                                	{{ $income->topup_code}}
                                                </td>
                                                <td>
                                                    <?php 
                                                        $card_id = $income->card;
                                                        if($card_id == '101'){
                                                            echo "MPT";
                                                        }elseif ($card_id == '111') {
                                                            echo "Telenor";
                                                        }else{
                                                            echo "Ooredoo";
                                                        }  
                                                     ?>
                                                </td>
                                                <td>{{ $income->created_at}}</td>
                                                <td>{{ $income->amount }}</td>
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