@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Admin Add New_Member
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
             <form method='post'>
				<table class="table">
					<tr>
						<td>Name</td>
						<td>
						<input type="hidden" name="memberId" value="{{$member->id}}" >
						<input type="text"  name="memberName" id="exampleInputEmail1" required="required" value="{{$member->username}}" >
						</td>
					</tr>
					<tr>
						<td>Payment</td>
						<td><select  name="payment">
  <option value="0">Cash Down</option>
  <option value="1">Indebts</option>
</select></td>
					</tr>
					<tr>
						<td>Balance</td>
						<td>
						<input type="text"  id="" name="balance" value="{{$member->main_balance}}" required="required" >
	                 <strong>+</strong>
                    <input type="text" id="" name="addBalance" required="required"></td>
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