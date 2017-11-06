@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Active Members Lists
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
                        <span class="caption-subject bold uppercase">Active Members</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-responsive" id="sample_1">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>

                            <th>NRC</th>
                            <th>Child[Total]</th>
                            <th>Level</th>
                                                   
                                                                 <th>Phone</th>

                            <th>Main Balance</th>
                            <th>Bonus</th>
                            <th width="160px">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>

                            <th>NRC</th>
                            <th>Child</th>
                            <th>Level</th>
                                                      
                                                                                                                         <th>Phone</th>


                            <th>Main Balance</th>
                            <th>Bonus</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>TB{{$member->id}}</td>
                                <td>{{ $member->username }}</td>

                                <td>{{ $member->nrc_no }}</td>
                                <td>{{ $member->child_count }}
                                    [{{ $member->total_child}}<?php
                                    /* $id = $member->id;
                                     $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                     $var =$result[0]->total;
                                     if ($var >= 797163 ) {
                                         echo "797163";
                                     }else{
                                         echo $var;
                                     }
         */
                                    ?>]
                                </td>
                                <td>
                                    <?php
                                    $id = $member->id;
                                    $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                    $var =$result[0]->total;

                                    if ($var < 4) {
                                    echo "Beginner";
                                    }elseif ($var >= 4 && $var < 13 ) {
                                    echo "Level 1";
                                    }elseif ($var >= 13 && $var < 40) {
                                    echo "Level 2";
                                    }elseif($var >= 40 && $var < 121){
                                    echo "Level 3";
                                    }elseif($var >= 121 && $var < 364){
                                    echo "Level 4";
                                    }elseif($var >= 364 && $var < 1093){
                                    echo "Level 5";
                                    }elseif($var >= 1093 && $var < 3280){
                                    echo "Level 6";
                                    }elseif($var >= 3280 && $var < 9841){
                                    echo "Level 7";
                                    }elseif($var >= 9841 && $var < 29524){
                                    echo "Level 8";
                                    }elseif($var >= 29524 && $var < 88573){
                                    echo "Level 9";
                                    }elseif($var >= 88573 && $var < 265720){
                                    echo "King";
                                    }elseif($var >= 265720 && $var < 797163){
                                    echo "Ruby King";
                                    }else{
                                    echo "Director";
                                    }

                                    ?>
                                </td>
                              
                                <td class="text-success">
                                    {{ $member->phone}}
                                </td>
                                <td class="text-success">
                                    {{ ceil($member->main_balance)}}
                                </td>
                                <td class="text-success">
                                    {{ ceil($member->balance)}}
                                </td>
                                <td>
                                    <a href="{{ URL::to('member/' . $member->id) }}"
                                       class="btn btn-inline btn-primary btn-sm ladda-button">View</a>
                                    <a href="{{ URL::to('member/' . $member->id . '/edit') }}"
                                       class="btn btn-inline btn-info btn-sm ladda-button">Add Balance</a>


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