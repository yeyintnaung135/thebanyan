@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')

    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Paying debit for TB {{$member->id}}
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
                <i class="fa fa-gift"></i> Remaining Balance {{$balance}}
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
                        <td>Name</td>
                        <td>
                            <input type="hidden" name="member_id" value="{{$member->id}}">
                            <input type="text" name="memberName" id="exampleInputEmail1" required="required"
                                   value="{{$member->username}}" disabled>
                        </td>
                    </tr>

                    <tr>
                        <td>Amount</td>
                        <td>

                            <input type="number" id="" name="amount" required="required">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">Pay</button>
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
@stop