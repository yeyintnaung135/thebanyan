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
            {!! Form::open(['method'=>'GET','url'=>url('topup_by_phone')])  !!}

            <input type="date" name="date"/>


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

                        <span class="caption-subject bold">Topup Transfer
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

                            <th>Phone No</th>
                            <th>Topup Code</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Approve id</th>
                            <th>Phone No</th>
                            <th>Topup Code</th>
                            <th>Created At</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $count=0;?>
                        @foreach ($tbp as $bs)
                            <?php
                            $count_mem_s=\Illuminate\Support\Facades\DB::table('activemembers')->where('id',$bs->member_id)->count();?>
                            @if($count_mem_s ==1)
                                <?php $count++;?>


                                <tr><td>{{$count}}</td>
                                    <td>
                                        <?php    $name_mem_s=\Illuminate\Support\Facades\DB::table('activemembers')->where('id',$bs->member_id)->first();?>

                                        TB{{$bs->member_id}}  ({{$name_mem_s->username}})
                                    </td>

                                    <td>{{ $bs->phone_no }}</td>
                                    <td>{{ $bs->topup_code }}</td>

                                    <td>{{ $bs->created_at}}</td>

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