@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Balance transfer Lists for TB {{$member_id}}

            </h1>
        </div>
    </div>
    {!! Form::open(['method'=>'GET','url'=>'all_tran_transaction']) !!}

    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-3">
            <input type="number" name="member_id" class="form-control" placeholder="id">
        </div>
        <div class="col-md-3">
            <input type="date" name="date" class="form-control" value="" placeholder="DATE">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn green">Search</button>
        </div>
    </div>
    {{ Form::close() }}

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
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>To Id</th>
                            <th>Date</th>
                            <th>Amount</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>To Id</th>
                            <th>Date</th>
                            <th>Amount</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($data as $d)
                            <tr>

                                <td>
                                 TB {{$d->transfer_id}}
                                </td>


                                <td>
                                    {{$d->created_at}}

                                </td>
                                <td>
                                    {{$d->amount}}

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