@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')

        <!-- BEGIN PAGE HEAD-->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>All Staff Datatable
        </h1>
    </div>
</div>
<!-- END PAGE BREADCRUMB -->
@include('flash::message')
        <!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">All Staff</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>TB</th>
                        <th>Set By</th>
                        <th>Added Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>TB</th>
                        <th>Set By</th>
                        <th>Added Date</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($agents as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->tb }}</td>
                            <td>{{ $user->set_by }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>

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


<!-- END CONTAINER -->
@endsection