@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Admin Dashboard 
                            </h1>
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <!-- END PAGE BREADCRUMB -->


                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="portlet box purple ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i> Add New Staff </div>
                                    <div class="tools">
                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="" class="reload" data-original-title="" title=""> </a>
                                        <a href="" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                {{ Form::open(array('url' => 'staff', 'method' => 'post','files' => true,'class'=> 'form-horizontal', 'role'=>'form'))  }}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Select Role</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="role">
                                                        <option value="Admin">Admin</option>
                                                        <option value="Staff">Staff</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="username" class="form-control" placeholder="Username"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Email</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="email" class="form-control" placeholder="Email"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" name="password" class="form-control" placeholder="Password"> </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right1">
                                            <button type="button" class="btn default">Cancel</button>
                                            <button type="submit" class="btn green">Submit</button>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
@endsection