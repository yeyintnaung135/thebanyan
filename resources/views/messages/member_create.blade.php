@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Admin Create Messages
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
            <span class="active">Create Messages</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->


    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="portlet box purple ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> Create Messages </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="" class="reload" data-original-title="" title=""> </a>
                <a href="" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
            {{ Form::open(array('url' => 'member_message', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
            @include('errors.error')
            <div class="form-body">
                @include('flash::message')
                <div class="form-group">
                    <label class="col-md-2 control-label">TB ID</label>
                    <div class="col-md-6">
                        <input type="number" name="id" class="form-control" placeholder="Example:1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Subject</label>
                    <div class="col-md-6">
                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Description</label>
                    <div class="col-md-6">
                        <textarea placeholder="Write something here..." name="description" class="form-control" data-autogrow rows="3" cols="80"></textarea>
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