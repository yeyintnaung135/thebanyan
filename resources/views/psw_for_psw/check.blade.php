@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> Member Password
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
                <i class="fa fa-gift"></i>  Member Password</div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="" class="reload" data-original-title="" title=""> </a>
                <a href="" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
            {{ Form::open(array('url' => 'check_psw_for_psw', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form')) }}
            @include('errors.error')
            <div class="form-body">
                @include('flash::message')
                <div class="form-group">
                    <label class="col-md-2 control-label">Password:</label>
                    <div class="col-md-9">
                        {{ Form::text('password', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <br>
                <input type="hidden" name="id" value="{{$mem_id}}"/>
                <div class="form-actions" style="margin-left:80%;">
                    <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
@stop