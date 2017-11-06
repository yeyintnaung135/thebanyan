@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Edit Message
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
                                        <i class="fa fa-gift"></i>Edit Message </div>
                                    <div class="tools">
                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="" class="reload" data-original-title="" title=""> </a>
                                        <a href="" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                {{ Form::model($message, array('route' => array('message.update', $message->id), 'method' => 'PUT','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                        <div class="form-body">                                            
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Subject</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('subject', null, ['class' => 'form-control']) }} </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Description</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('description', null, ['class' => 'form-control']) }} </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right1">
                                            <a href="{{ URL::to('/message') }}" class="btn btn-sm btn-default">Cancle</a>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
@endsection