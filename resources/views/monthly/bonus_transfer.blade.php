@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title" style="float:left;">
            <h1>Daily Report
                <small>Search by date and id</small>

            </h1>
            {!! Form::open(['method'=>'GET','url'=>url('bonus_transfer')])  !!}

            <input type="date" name="date"/>


            <input type="number" name="id" placeholder="&nbsp;&nbsp;&nbsp;TB"/>
            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Session::has('A'))
        <div class="row">
            <div class="alert alert-info">

                Updated success!
            </div>
        </div>
    @endif
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>

                        <span class="caption-subject bold">Daily Report
                                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>Member_id</th>
                            <th>Amount</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Member_id</th>
                            <th>Amount</th>
                            <th>Created At</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($dailys as $daily)
                            <tr>
                                <td>
                                    TB  {{ $daily->member_id }}
                                </td>

                                <td>{{ $daily->amount }}</td>

                                <td>{{ $daily->created_at }}</td>

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