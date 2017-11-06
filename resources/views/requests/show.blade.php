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
                    
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="#">Tables</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Datatables</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->

                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                            <div class="panel-heading">Show Member Details</div>

                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    {{ $member->username }}
                                </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Father_Name</label>
                                <div class="col-sm-10">
                                    {{ $member->father_name }}
                                </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-2 control-label">NRC No</label>
                                <div class="col-sm-10">
                                    {{ $member->nrc_no }}
                                </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    {{ $member->phone }}
                                </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    {{ $member->address }}
                                </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    {{ $member->status }}
                                </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Balance</label>
                                <div class="col-sm-10">
                                    {{ $member->balance }}
                                </div>
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>
@endsection