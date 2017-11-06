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

    <!-- END PAGE BREADCRUMB -->


    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
        @include('flash::message')
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Buttons</span>
                    </div>
                    <div class="caption font-dark">
                        <a onClick="location.href='{{ URL::to('message/create') }}'">
                            <button class="btn btn-oval btn-success" type="button"
                                    style="margin-left: 30px;margin-top: -8px;">Create New Message for All
                            </button>
                        </a>
                    </div>
                    <div class="caption font-dark">
                        <a onClick="location.href='{{ URL::to('member_message') }}'">
                            <button class="btn btn-oval btn-success" type="button"
                                    style="margin-left: 30px;margin-top: -8px;">Create Personal Message
                            </button>
                        </a>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>TB</th>
                            <th>Created_at</th>
                            <th width="180px">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>TB</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach( $messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->description }}</td>
                                <td>@if(empty($message->tb_id))
                                        {{ 'All' }}
                                    @else
                                        {{$message->tb_id}}
                                @endif</td>
                                <td>{{ $message->created_at }}</td>
                                <td>
                                    <a href="{{ URL::to('message/' . $message->id) }}" class="btn btn-info pull-left">View</a>
                                    {{ Form::open(['url' => 'message/' . $message->id, 'method' => 'DELETE']) }}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@stop