@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
<div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Buttons Datatable
                                <small>buttons extension demos</small>
                            </h1>
                        </div>
                    </div>
                    
                    <!-- END PAGE BREADCRUMB -->

                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                            <div class="panel-heading">Show Message Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-3 control-label text-info">Subject</label>
                                <div class="col-sm-9">
                                   : {{ $message->subject }}
                                </div>
                                </div>
                            </div>
                            
                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-3 control-label text-info">Description</label>
                                <div class="col-sm-9">
                                   : {{ $message->description }}
                                </div>
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>
@endsection