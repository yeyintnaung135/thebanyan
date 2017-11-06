@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    @include('flash::message')

    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->

      <!--  <div class="page-title" style="float:left;">
            <h1>Debit List
                <small>Search by month</small>

            </h1>
            {!! Form::open(['method'=>'GET','url'=>'debit_list/'])  !!}
            <input type="month" name="month"/>
            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>
        -->

        <div class="caption font-dark">





    </div>

    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>

                        <span class="caption-subject bold">Debit list
                                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>Member_id</th>
                            <th>Username</th>
                            <th>Amount</th>
                            <th>Approve Date</th>
                            <th>Signature</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Member_id</th>
                            <th>Username</th>
                            <th>Amount</th>
                            <th>Approve Date</th>
                            <th>Signature</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($debit_list as $dl)
                            <tr>
                                <td>
                                    TB{{ $dl->member_id }}
                                </td>
                                <td>
                                    <?php
                                    $username = \Illuminate\Support\Facades\DB::table('activemembers')->where('id', '=', $dl->member_id)->first();
                                    echo $username->username;
                                    ?>
                                </td>
                                <td>
                                {{$dl->sum_amount}}
                                </td>
                                <td>{{ $dl->created_at }}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="location.href='{{url('debit_list_by_id/'.$dl->member_id)}}';">  View  </button>

                                    <button class="btn btn-success" onclick="location.href='{{url('paying/'.$dl->member_id)}}';"> Pay  </button>
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