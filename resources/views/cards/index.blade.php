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
                                        <span class="caption-subject bold uppercase">Card Page</span>
                                    </div>
                                    <div class="tools"> 
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Card</th>
                                                <th>Bonuspercent</th>
                                                <th>Monthly</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Card</th>
                                                <th>Bonuspercent</th>
                                                <th>Monthly</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach ($cards as $card)
                                            <tr>
                                                <td>{{ $card->id }}</td>
                                                <td>{{ $card->card }}</td>
                                                <td>{{ $card->bonuspercent }} %</td>
                                                <td>{{ $card->monthly }}</td>
                                                <td>
                                                    <a href="{{ URL::to('card/' . $card->id . '/edit') }}" style="padding:0px 10px !important;" class="btn btn-inline btn-info btn-sm ladda-button" >Edit</a>
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