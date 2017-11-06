@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title" style="float:left;">
            <h1>Approve members by staff
                <small>Search by month</small>

            </h1>
            {!! Form::open(['method'=>'GET','url'=>url('approve_bystaff')])  !!}

            <input type="month" name="date"/>


            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>
        <div style="float:right;margin-right:23%;">
            <a href="{{url('approve_member')}}" class="btn btn-lg purple" style="">  << By members <i class="fa fa-search"></i> </a>
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

                        <span class="caption-subject bold">Approve members list by staff
                                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>

                            <th>ID</th>
                            <th>Approve id</th>

                            <th>Approve By</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Approve id</th>
                            <th>Approve By</th>
                            <th>Created At</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $count=0;?>
                        @foreach ($by_staff as $bs)
                            <?php
                            $count_mem_s=\Illuminate\Support\Facades\DB::table('activemembers')->where('id',$bs->member_id)->count();?>
                            @if($count_mem_s ==1)
                                <?php $count++;?>


                                <tr><td>{{$count}}</td>
                                    <td>
                                        <?php    $name_mem_s=\Illuminate\Support\Facades\DB::table('activemembers')->where('id',$bs->member_id)->first();?>

                                        TB{{$bs->member_id}}  ({{$name_mem_s->username}})
                                    </td>

                                    <td>{{ $bs->approved_by }}</td>

                                    <td>{{ $bs->approved_date}}</td>

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