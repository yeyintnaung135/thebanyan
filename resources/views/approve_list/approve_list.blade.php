@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title" style="float:left;">
            <h1>Approve members list by members
                <small>Search by month </small>

            </h1>
            {!! Form::open(['method'=>'GET','url'=>url('approve_member')])  !!}

            <input type="month" name="date"/>


            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>
        <div style="float:right;margin-right:23%;">
            <a href="{{url('approve_bystaff')}}" class="btn btn-lg purple" style=""><i class="fa fa-search"></i>   By staff >></a>
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

                        <span class="caption-subject bold">Approve members list by members
                                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>

                            <th>Approve id</th>
                            <th>Approve By</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>

                            <th>Approve id</th>
                            <th>Approve By</th>

                            <th>Created At</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($all_approve as $ap)
                        <?php    $count_mem=\Illuminate\Support\Facades\DB::table('activemembers')->where('username',$ap->username)->count();?>
                        @if($count_mem ==1)
                            <tr>
                                <td>
                                  <?php
                                    $get_mem=\Illuminate\Support\Facades\DB::table('activemembers')->where('username',$ap->username)->first();

                                    $tb=$get_mem->id;

                                    ?>
                                TB{{$tb}}
                                      ({{$ap->username}})</td>

                                <td>TB {{ $ap->member_id }}</td>

                                <td>{{ $ap->created_at}}</td>

                            </tr>
                            @endif
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