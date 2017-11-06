@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Admin Add New_Member 
                            </h1>
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Dashboard</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Add Member</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->


                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="portlet box purple ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i> Add New Member </div>
                                    <div class="tools">
                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="" class="reload" data-original-title="" title=""> </a>
                                        <a href="" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                {{ Form::model($approve, array('route' => array('approve-member.update', $approve->id), 'method' => 'PUT','class'=> 'form-horizontal', 'role'=>'form')) }}

                                @include('errors.error')
                                        <div class="form-body">
                                        @include('flash::message')
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Sponsor_id</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('sponsor_id', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Child_Count</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('child_count', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('username', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Father_Name</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('father_name', null, ['class' => 'form-control']) }} 
                                                </div>
                                            </div>
                    
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Password</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('password', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">NRC_NO</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('nrc_no', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Phone_No</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('phone', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Balance</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('balance', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Status</label>
                                                <div class="col-md-9">
                                                <?php 
                                                   $num = $approve->id;

                                                    $pickstatus = DB::table('approvemembers')->where('id','=',$num)->pluck('status');
                                                 ?>
                                                    <select class="form-control" name="status">
                                                        <option value="{{ implode(', ', $pickstatus) }}">
                                                            {{ implode(', ', $pickstatus) }}
                                                        </option>                                  
                                                        <option value="active" >{{ 'active' }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Address</label>
                                                <div class="col-md-9">
                                                    {{ Form::textarea('address', null, ['class' => 'form-control','rows' => '4']) }}
                                                </div>
                                            </div>
                                            <div class="form-actions right1">
                                                <a href="{{ URL::to('/approve-member') }}" class="btn btn-sm btn-default">Cancle</a>
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                <input type="hidden" name="mid" value="{{$approve->member_id}}">
                                                <input type="hidden" name="temp_id" value="{{$approve->id}}">
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
@stop