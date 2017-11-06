@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> Add Approve Balance
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
                <i class="fa fa-gift"></i> Edit Active Member Balance
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="" class="reload" data-original-title="" title=""> </a>
                <a href="" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form method='post' action="{{url('approve_amount')}}">
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="hidden" name="id" value="{{$data->id}}" >
                            <input type="text"  name="memberName" id="exampleInputEmail1" required="required" value="{{$data->username}}" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Payment</td>
                        <td><select  name="payment">
                                <option value="3">Cash Down</option>
                                <option value="4">Indebts</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Balance</td>
                        <td>
                            <input type="text"  id="" value="{{$data->amount_for_approve}}" disabled>
                            <strong>+</strong>
                            <input type="text" id="" name="amount" required="required"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-primary">Edit</button></td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
@stop