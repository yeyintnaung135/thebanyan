@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Create New Member 
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
                                        <i class="fa fa-gift"></i> Create New Member </div>
                                    <div class="tools">
                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="" class="reload" data-original-title="" title=""> </a>
                                        <a href="" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                {{ Form::open(array('url' => 'member', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                @include('errors.error')
                                        <div class="form-body">

                                        @include('flash::message')

                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Member Fee :</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="memberfee" value="20000" class="form-control" placeholder="Username" disabled> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Main Sponsor ID :</label>
                                                <div class="col-md-9">
                                                    <input type="number" name="main_sponsor_id" class="form-control" placeholder="Enter Main Sponsor ID"> </div>
                                            </div>
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Sponsor ID :</label>
                                                <div class="col-md-9">
                                                    <input type="number" name="sponsor_id" class="form-control" placeholder="Enter Sponsor ID"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username :</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="username" class="form-control" placeholder="Enter Username"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Father Name :</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="father_name" class="form-control" placeholder="Enter Father Name"> </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Password :</label>
                                                <div class="col-md-9">
                                                    <input type="password" name="password" class="form-control" placeholder="Enter Password"> </div>
                                            </div>
                                            <!--
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Bank Branch :</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="bank_branch" class="form-control" placeholder="Enter Back Branch">
                                                </div>
                                            </div>
                                            -->
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">NRC No. :</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="nrc_no" class="form-control" placeholder="Enter NRC NO">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Agent Id :</label>
                                                <div class="col-md-9">
                                                    <input type="number" name="agent_id" class="form-control" placeholder="Enter Agent ID">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Phone No. :</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="phone_no" class="form-control" placeholder="Enter Phone No"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Address :</label>
                                                <div class="col-md-9">
                                                    <textarea rows="4" class="form-control" placeholder="Address here" id="address" name="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions right1">
                                            <button type="reset" class="btn default">Cancel</button>
                                            <button type="submit" class="btn green">Create</button>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
@stop