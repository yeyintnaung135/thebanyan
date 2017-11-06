@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
Memebers Api            </h1>
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
                <i class="fa fa-gift"></i> Check Parent
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="" class="reload" data-original-title="" title=""> </a>
                <a href="" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form method='post' action="{{url('api/v1/check-parent')}}">
                <table class="table">
                    <tr>
                        <td>Enter Child Id</td>
                        <td>
                            <input type="hidden" name="memberId" value="" >
                            <input type="number"  name="child_id" id="exampleInputEmail1" required="required" value="">
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
                <i class="fa fa-gift"></i> Check Child
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="" class="reload" data-original-title="" title=""> </a>
                <a href="" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form method='post' action="{{url('api/v1/check-child')}}">
                <table class="table" >
                    <tr>
                        <td>Enter Parent ID</td>
                        <td>
                            <input type="number"  name="parent_id" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> See Balance
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('api/v1/reload-balance')}}">
                    <table class="table">
                        <tr>
                            <td>Enter Member ID</td>
                            <td>
                                <input type="number"  name="id" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check Top up Code
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="http://topup.thebanyanmm.com/public/check-code">
                    <table class="table">
                        <tr>
                            <td>Enter Code:</td>
                            <td>
                                <input type="number"  name="code" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check Nmsi
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='get' action="{{url('check_main')}}">
                    <table class="table">
                        <tr>
                            <td>Enter ID</td>
                            <td>
                                <input type="number"  name="id" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check NMSI by member
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('search_by_user')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check 2nd NMSI by member
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('search_2by_user')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check 3rd NMSI by member
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('search_3by_user')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check Use Amount For This Month
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url("check-use")}}">
                    <table class="table">
                        <tr>
                            <td>Enter ID</td>
                            <td>
                                <input type="number"  name="id" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check Active members by month
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('check_date')}}">
                    <table class="table">
                        <tr>
                            <td>Enter Month</td>
                            <td>

                                <input type="number"  name="month" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check Active Child
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('check-active')}}">
                    <table class="table">
                        <tr>
                            <td>Enter Parent ID: </td>
                            <td>

                                <input type="number"  name="parent_id" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>Enter Point: </td>
                            <td>

                                <input type="number"  name="point" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check NMSI
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('search_id_date')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="date"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="date"  name="to" id="exampleInputEmail1" required="required" >
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
                    <i class="fa fa-gift"></i> Check Member by date and id
                </div>

            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('search_mem_date')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="date"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="date"  name="to" id="exampleInputEmail1" required="required" >
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
                    <i class="fa fa-gift"></i> Check 2nd Nmsi
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('2nd_nmsi')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="date"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="date"  name="to" id="exampleInputEmail1" required="required" >
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
                    <i class="fa fa-gift"></i> Check 3rd Nmsi
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('3rd_nmsi')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="date"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="date"  name="to" id="exampleInputEmail1" required="required" >
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
                    <i class="fa fa-gift"></i> Check card by date
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('buy_topup')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="date"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="date"  name="to" id="exampleInputEmail1" required="required" >
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
                    <i class="fa fa-gift"></i> Get Transfer
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('get_tran')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="date"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="date"  name="to" id="exampleInputEmail1" required="required" >
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
                    <i class="fa fa-gift"></i>  Transfer To
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('tran_to')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="date"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="date"  name="to" id="exampleInputEmail1" required="required" >
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
                    <i class="fa fa-gift"></i>  Approve Members
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('approved')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>From Date:  </td>
                            <td>

                                <input type="date"  name="from" id="exampleInputEmail1" required="required" >
                            </td>
                        </tr>
                        <tr>
                            <td>To Date:  </td>
                            <td>

                                <input type="date"  name="to" id="exampleInputEmail1" required="required" >
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
                    <i class="fa fa-gift"></i>  All Check
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('huge_check_by_id')}}">
                    <table class="table">
                        <tr>
                            <td>TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>

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
                    <i class="fa fa-gift"></i> Check Agent by agent id
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="http://thebanyanmm.org/the-banyan/public/check-agent">
                    <table class="table">
                        <tr>
                            <td>Enter Agent Id:</td>
                            <td>
                                <input type="number"  name="id" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i> Check Agent by Member id
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="http://thebanyanmm.org/the-banyan/public/check-agent-by-mem">
                    <table class="table">
                        <tr>
                            <td>Enter Member Id:</td>
                            <td>
                                <input type="number"  name="id" id="exampleInputEmail1" required="required" value="">
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
                    <i class="fa fa-gift"></i>  All Check
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method='post' action="{{url('all_cc')}}">
                    <table class="table">
                         <tr>
                            <td>From TB </td>
                            <td>

                                <input type="number"  name="from_id" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>To TB </td>
                            <td>

                                <input type="number"  name="tb" id="exampleInputEmail1" required="required" value="">
                            </td>
                        </tr>
                       
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