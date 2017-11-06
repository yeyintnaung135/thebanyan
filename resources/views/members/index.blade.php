@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Pending Members List
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
                                        <i class="icon-users font-dark"></i>
                                        <span class="caption-subject bold uppercase">Pending Members</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>NRC</th>
                                                <th>Child Count</th>
                                                <th>Father Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>NRC</th>
                                                <th>Child Count</th>
                                                <th>Father Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>TB{{ $member->id }}</td>
                                                <td>{{ $member->username }}</td>
                                                <td>{{ $member->nrc_no }}</td>
                                                <td>
                                                    {{ $member->child_count }}
                                                </td>
                                                <td>
                                                    {{ $member->father_name }}
                                                </td>
                                                <td class="text-danger">
                                                    {{ $member->status }}
                                                </td>
                                                <td>
                                                    <a href="{{ URL::to('deactivemember/' . $member->id) }}" class="btn btn-inline btn-primary btn-sm ladda-button" >View</a>
                                                    <a href="{{ URL::to('deactivemember/' . $member->id . '/edit') }}" class="btn btn-inline btn-info btn-sm ladda-button" >Approve</a>
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