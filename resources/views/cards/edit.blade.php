@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Admin Add Card
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
                                        <i class="fa fa-gift"></i> Edit Card </div>
                                    <div class="tools">
                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="" class="reload" data-original-title="" title=""> </a>
                                        <a href="" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                {{ Form::model($card, array('route' => array('card.update', $card->id), 'method' => 'PUT','class'=> 'form-horizontal', 'role'=>'form')) }}
                                @include('errors.error')
                                        <div class="form-body">
                                        @include('flash::message')
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Card_Name</label>
                                                <div class="col-md-6">
                                                    {{ Form::text('card', null, ['class' => 'form-control']) }}
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Bonus</label>
                                                <div class="col-md-6">
                                                    {{ Form::text('bonuspercent', null, ['class' => 'form-control']) }} 
                                                </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-md-4 pull-right">
                                            <a href="{{ URL::to('/card') }}" class="btn btn-sm btn-default">Cancle</a>
                                            <button type="submit" class="btn green">Submit</button>
                                        </div>
                                           
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
@stop