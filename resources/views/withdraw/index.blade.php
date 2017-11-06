@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Withdraw
                                <small>buttons extension demos</small>
                            </h1>
                        </div>
                    </div>
                    @include('flash::message')
                   

                    <!-- BEGIN PAGE BASE CONTENT -->
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                            <div class="panel-heading">Search Withdraw Request with Date</div>
                            <div class="panel-body">
                            {{ Form::open(array('url' => 'withdraw', 'method' => 'get','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <div class='input-group date' >
                                        <input type='date' name="pickdate" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info">Search</button>
                                </div>
                                </div>
                                {{ Form::close() }}
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
                                        <span class="caption-subject bold uppercase">Member's Withdraw Table</span>
                                        
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>NRC_NO</th>
                                                <th>Phone</th>
                                                <th>Back_Branch</th>
                                                <th>Withdraw</th>
                                                <th>Status</th>
                                          	     <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>NRC_NO</th>
                                                <th>Phone</th>
                                                <th>Back_Branch</th>
                                                <th>Withdraw</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($withdraws as $withdraw)
                                            <tr>
                                                <td>
                                                    <?php 
                                                        $member_id = $withdraw->member_id;
                                                        $username = DB::table('activemembers')->where('id','=',$member_id)->pluck('username');
                                                        $pickusername = $username['0'];

                                                     ?>
                                                     {{ $pickusername }}
                                                </td>
                                                <td>
                                                    <?php 
                                                        $member_id = $withdraw->member_id;
                                                        $nrc = DB::table('activemembers')->where('id','=',$member_id)->pluck('nrc_no');
                                                        $picknrc = $nrc['0'];

                                                     ?>
                                                     {{ $picknrc }}
                                                </td>
                                                <td>
                                                    <?php 
                                                        $member_id = $withdraw->member_id;
                                                        $phone= DB::table('activemembers')->where('id','=',$member_id)->pluck('phone');
                                                        $pickphone = $phone['0'];

                                                     ?>
                                                     {{ $pickphone }}
                                                </td>
                                                <td>{{ $withdraw->bank_branch}}</td>
                                                <td>{{ $withdraw->amount }}</td>
                                                <td>
                                                    <?php $status = $withdraw->status;
                                                        if($status == 'received'){
                                                            ?>
                                                            <p style="color:green;margin: 0px !important;">{{ 'received' }}</p>
                                                            <?php
                                                        }else{
                                                           ?>
                                                            <p style="color:red;margin: 0px !important;">{{ 'pending' }}</p>
                                                            <?php 
                                                        }
                                                     ?>
                                                </td>
                    				<td>
                                                    {{ $withdraw->date }}
                                                </td>

                                          
                                                
                                                <th>

                                                    <?php $status = $withdraw->status;
                                                        if($status == 'received'){
                                                        $withdraw->approved_by
                                                            ?>
                                                            <?php
                                                        }else{
                                                           ?>
                                                            <button class="btn btn-info pull-left" style="padding:0px 10px !important;" type="button" onClick="location.href='{{ action('WithdrawController@show', array($withdraw->member_id)) }}'">{{ 'Approve' }}</button>
                                                            <?php 
                                                        }
                                                     ?>
                                                    
                                                </th>
                                                
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