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
    @include('flash::message')


    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Show Member Details</div>

                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">ID</label>
                        <div class="col-sm-9">
                            : <span class="text-danger">TB{{$member->id}}</span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Username</label>
                        <div class="col-sm-9">
                            : {{ $member->username }}
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Child [Total Count]</label>
                        <div class="col-sm-9">
                            :{{ $member->child_count }}
                            [<?php
                            $id = $member->id;
                            $result = DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                            $var = $result[0]->total;
                            if ($var >= 797163) {
                                echo "797163";
                            } else {
                                echo $var;
                            }

                            ?>]
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Father_Name</label>
                        <div class="col-sm-9">
                            : {{ $member->father_name }}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">NRC No</label>
                        <div class="col-sm-9">
                            : {{ $member->nrc_no }}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Phone</label>
                        <div class="col-sm-9">
                            : {{ $member->phone }}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Address</label>
                        <div class="col-sm-9">
                            : {{ $member->address }}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Status</label>
                        <div class="col-sm-9">
                            : {{ $member->status }}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Approve Amount</label>
                        <div class="col-sm-9">
                            : {{ $member->amount_for_approve }}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Main sponsor id</label>
                        <div class="col-sm-9">
                            : {{ $member->main_sponsor_id }}
                        </div>
                    </div>
                </div>
                   <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Agent id</label>
                        <div class="col-sm-9">
                            : {{ $member->agent_id}}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Balance</label>
                        <div class="col-sm-9">
                            : {{ $member->balance }}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-info">Date</label>
                        <div class="col-sm-9">
                            : {{ $member->created_at }}
                        </div>
                    </div>
                </div>
                @if(Auth::user()->role == 'Admin' or Auth::user()->role == 'SuperAdmin')
                <div class="panel-body">
                <button type="button" onclick="location.href='{{url('check_psw_for_psw/'.$member->id)}}'" class="btn btn-warning">See Password >></button>
                </div>
                @endif
                <div class="panel-body">
                    <button type="button" onclick="location.href='{{url('approve_amount/'.$member->id)}}'" class="btn btn-danger">Add Approve balance >></button>
                    <button type="button" onclick="location.href='{{url('bonus_this_mem/'.$member->id)}}'" class="btn btn-success">Bonus trans >></button>
                    <button type="button" onclick="location.href='{{url('bonus_get_by_this/'.$member->id)}}'" class="btn btn-success">Bonus get by this TB >></button>


                </div>

            </div>
        </div>
    </div>
@endsection