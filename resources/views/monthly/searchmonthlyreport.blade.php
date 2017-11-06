@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')


<script  type="text/javascript">
$(document).ready(function() {
    $('#extra').keyup(function(ev){
        var total = $('#income').val()  - $('#extra').val();
        $('#total').html((total).toFixed(2));
    });
});
</script>
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Monthly Report
                            </h1>
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    
                    <!-- END PAGE BREADCRUMB -->

					@include('flash::message')

					<div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                            <div class="panel-heading">Search Monthlyreport</div>
                            <div class="panel-body">
                            {{ Form::open(array('url' => 'searchmonthlyreport', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' name="monthly" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>    
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info">Search</button>
                                </div>
                                </div>
                                {{ Form::close() }}
                            </div>                            
                        </div> 
                        </div>
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->
                    {{ Form::open(array('url' => 'monthlybonus', 'method' => 'post'))  }}
                    <div class="row">
                        <div class="col-sm-6">
                        	<div class="panel panel-default">
				    <div class="panel-heading">Phone Billing</div>
					<div class="panel-body">
				        <div class="form-group">
				            <label class="col-sm-9 control-label text-info">Phone Billing Income </label>
				            <div class="col-sm-3">
				                <span class="text-danger">:{{ $monthlyreports->phone_income }}</span>
				            </div>
				        </div>
				        <br>
				        <div class="form-group">
				            <label class="col-sm-9 control-label text-info">Phone Billing Profits</label>
				            <div class="col-sm-3">
				                <span class="text-danger">:{{ $monthlyreports->phone_profit }} </span>
				            </div>
				        </div>
				        <br>
				        <div class="form-group">
				            <label class="col-sm-9 control-label text-info">Phone Billing Outcome</label>
				            <div class="col-sm-3">
				                <span class="text-danger">:</span>
				            </div>
				        </div>
				        <br>
				        <div class="form-group">
				            <label class="col-sm-9 control-label text-success">Total Income</label>
				            <div class="col-sm-3">
				                <span class="text-danger">:{{ $monthlyreports->total_income }}
				                </span> 
				            </div>
				        </div>
				    </div>
				</div>
                        </div>
                         <div class="col-sm-6">
                         	<div class="panel panel-default">
				    <div class="panel-heading">Membering </div>
					<div class="panel-body">
				        <div class="form-group">
				            <label class="col-sm-9 control-label text-info">Membering Fee Income</label>
				            <div class="col-sm-3">
				                <span class="text-danger">:{{ $monthlyreports->member_income }}</span>
				            </div>
				        </div>
				        <br>
				        <div class="form-group">
				            <label class="col-sm-9 control-label text-info">Membering Bonus Outcome</label>
				            <div class="col-sm-3">
				                <span class="text-danger">:{{ $monthlyreports->member_outcome }}</span>
				            </div>
				        </div>
				        <br>
				        <div class="form-group">
				            <label class="col-sm-9 control-label text-info">Balance Transfer fee</label>
				            <div class="col-sm-3">
				                <span class="text-danger">:{{ $monthlyreports->transfer_fee }}</span>
				            </div>
				        </div>
				        <br>
				        <div class="form-group">
				            <label class="col-sm-9 control-label text-success">Total Income</label>
				            <div class="col-sm-3">
				                <span class="text-danger">:{{ $monthlyreports->member_total_income }}</span>
				            </div>
				        </div>
				    </div>
				</div>
                         </div>                                           	
                     </div>


                     <!-- row -->    
                     <div class="row">
                        <div class="col-sm-12">
                        	<div class="panel panel-default">
				    <div class="panel-heading">Profits</div>
					<div class="panel-body">
				        <div class="form-group">
				            <label class="col-sm-6 control-label text-info">Total Income </label>
				            <div class="col-sm-6">
				                <span class="text-danger">:{{ $monthlyreports->profit_total_income }}</span>
				            </div>
				        </div>
				        <br>
				        <div class="form-group">
				            <label class="col-sm-6 control-label text-info">Extra Outcome</label>
				            <div class="col-sm-6">
				                <span class="text-danger">:{{ $monthlyreports->extra_outcome }}</span>
				            </div>
				        </div>
				        <br> 
				        
				        <div class="form-group">
				        <hr>
				            <label class="col-sm-6 control-label text-success">Total Profits</label>
				            <div class="col-sm-6">
				                <span class="text-danger" id="total">:
				                <?php 
				                	$income = $monthlyreports->profit_total_income;
				                	$outcome = $monthlyreports->extra_outcome;

				                	echo $profit = $income - $outcome;

				                ?>
				                </span>
				            </div>
				    </div>
				</div>
                        </div>
                                                          	
                     </div>

				{{ Form::close() }}
                     <!-- row -->
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
@stop
