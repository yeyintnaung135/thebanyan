@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Admin Create Monthly Bonus Percent
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
                            <span class="active">Create Monthly Bonus Percent</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->


                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="portlet box purple ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i> Create Monthly Bonus Percent </div>
                                    <div class="tools">
                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="" class="reload" data-original-title="" title=""> </a>
                                        <a href="" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                {{ Form::open(array('url' => 'bonuspercent', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                @include('errors.error')
                                        <div class="form-body">
                                        @include('flash::message')
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Monthly Bonus Percent</label>
                                                <div class="col-md-6">
                                                    <input type="number" name="bonuspercent" class="form-control" placeholder="Enter Member-fee"> 
                                                </div>
                                            </div>
                                        <div class="form-group">
                                        <div class="col-md-4 pull-right">
                                            <button type="submit" class="btn green">Submit</button>
                                        </div>
                                           
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
@stop