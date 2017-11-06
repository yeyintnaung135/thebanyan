@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            Account Api

        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->

    <!-- END PAGE BREADCRUMB -->


    <!-- BEGIN PAGE BASE CONTENT -->


    <div class="col-sm-4">

        <div class="portlet box purple ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>See All Balance
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('show_add_balance')}}">
                    <table class="table">

                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="datetime-local"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="datetime-local"  name="to" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit" class="btn btn-primary">Search</button></td>
                        </tr>
                    </table>

                </form>
            </div>

        </div>
    </div>
    <div class="col-sm-4">

        <div class="portlet box purple ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>See All Balance
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('see_balance_withoutdate')}}">
                    <table class="table">


                        <tr>
                            <td></td>
                            <td><button type="submit" class="btn btn-primary">See</button></td>
                        </tr>
                    </table>

                </form>
            </div>

        </div>
    </div>
        <div class="col-sm-4">

        <div class="portlet box purple ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>See  Balance equal
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('see_equal_balance')}}">
                    <table class="table">
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="datetime-local"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>


                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="datetime-local"  name="to" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit" class="btn btn-primary">Search</button></td>
                        </tr>
                    </table>

                </form>
            </div>

        </div>
    </div>







@stop