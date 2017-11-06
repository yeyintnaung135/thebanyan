@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Tree Structure
            </h1>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->

    <!-- END PAGE BREADCRUMB -->


    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="portlet box purple ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> Tree Structure
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="" class="reload" data-original-title="" title=""> </a>
                <a href="" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form method='post'>
                <table class="table">
                    <tr>
                        <td>TB</td>
                        <td>
                            <input type="number"  name="id" id="exampleInputEmail1" required="required" >
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-primary">See</button></td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
@stop