@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
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
                     @include('flash::message')
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Buttons</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                <?php 
                                //echo "<pre>";
                                //print_r($approves);
                                //echo "</pre>";
                                ?>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>NRC No</th>
                                                <th>Status</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>NRC No</th>
                                                <th>Status</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($approves as $approve)
                                        <tr>
                                        	<td>{{$approve->id}}</td>
                                       		<td>{{$approve->username}}</td>
                                       		<td>{{$approve->father_name}}</td>
                                       		<td>{{$approve->nrc_no}}</td>
                                       		<td>{{$approve->status}}</td>
                                       		<td>{{$approve->phone}}</td>
                                       		<td>
                                       			<a href="{{ URL::to('approve-member/' . $approve->id) }}" class="btn btn-inline btn-primary btn-sm ladda-button" >View</a>
                                                    <a href="{{ URL::to('approve-member/' . $approve->id . '/edit') }}" class="btn btn-inline btn-info btn-sm ladda-button" >Edit</a>
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