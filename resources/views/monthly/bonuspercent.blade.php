@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Bonus Page
                            </h1>
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    
                    <!-- END PAGE BREADCRUMB -->


                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Bonus Page</span>
                                    </div>
                                    <div class="caption font-dark">
                                    <!--
                                        <a onClick="location.href='{{ URL::to('bonuspercent/create') }}'">
                                            <button class="btn btn-oval btn-success" type="button" style="margin-left: 30px;margin-top: -8px;">Create Monthly Bonuspercent</button>
                                        </a>-->
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                      @include('flash::message')
                                @include('errors.error')
                                
                                <div class="form-header text-success"><h3>Monthly Member Fee</h3></div>
                                        <div class="form-body">
                                      {{ Form::open(array('class'=> 'form-horizontal', 'role'=>'form')) }}
                                        <div class="form-group">
                                                <label class="col-md-3 control-label">Member Fee</label>
                                                <div class="col-md-6">
                                                       	<input type="text" name="memberfee" class="form-control" value="20000"> 
                                                </div>
                                                <div class="col-md-3"> 
                                                	
                                                </div>
                                        </div>
                                        {{ Form::close() }}
                                       <hr>
                                       
                                <div class="form-header text-success"><h3>Member Active Point</h3></div>
                                        <div class="form-body">
                                       
                                       {{ Form::open(array('url' => 'activepoint', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                        <div class="form-group">
                                                <label class="col-md-3 control-label">Active Point</label>
                                                <div class="col-md-6">
                                                <?php
                                                		date_default_timezone_set("Asia/Rangoon");
                                           	 		$year = date('Y-m-d h:i:s');
                                            			$date = date('m/Y');
                                            		$activepoint = DB::table('activepoints')->where('monthly','=',$date)->pluck('activepoint');
                                            		if(empty($activepoint))
                                            		{ ?>
                                            			<input type="number" name="activepoint" class="form-control" >
                                            		<?php 
                                            		}else{
                                            			$pickactivepoint = $activepoint['0'];
                                            			?>
                                            			<input type="number" name="activepoint" class="form-control" value="{{$pickactivepoint}}"> 
                                            			<?php
                                            		}
                                            		
                                                ?>
                                                </div>
                                                <div class="col-md-3">
                                            <button type="submit" class="btn green">Update</button>
                                            
                                        </div>
                                            </div>
                                       {{ Form::close() }}     
                                       <hr>

                                
                                	<div class="form-header text-success"><h3>Membering Bonus</h3></div>
                                        <div class="form-body">
                                       
                                        {{ Form::open(array('url' => 'membering-bonus', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                        <div class="form-group">
                                                <label class="col-md-3 control-label">Membering Bonus</label>
                                                <div class="col-md-6">
                                                <?php
                                                $result=DB::select(DB::raw("SELECT bonus from bonus where id='1' "));
                                             	$var =$result[0]->bonus;
                                                ?>
                                                    <input type="number" name="bonus" class="form-control" value="{{$var}}"> 
                                                </div>
                                                <div class="col-md-3">
                                            <button type="submit" class="btn green">Update</button>
                                            
                                        </div>
                                            </div>
                                       {{ Form::close() }}     
                                       <hr>
                                       {{ Form::open(array('url' => 'billing-bonus', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                       <div class="form-header text-success"><h3>Billing Bonus</h3></div>
                                       <?php
                                                $result1=DB::select(DB::raw("SELECT * from billingbonus where id='1' "));
                                             	$bonus =$result1[0]->billbonus ;
                                             	$extra=$result1[0]->extra;
                                                ?>
                                        <div class="form-group">
                                        	<label class="col-md-3 control-label">Billing Bonus</label>
                                                <div class="col-md-6">
                                                    <input type="number" name="bonus" class="form-control" value="{{$bonus}}"> 
                                                </div>
                                                <div class="col-md-3">
                                        </div>
                                        
                                           
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-md-3 control-label">Extra Bonus</label>
                                                <div class="col-md-6">
                                                    <input type="number" name="extra" class="form-control" value="{{$extra}}"> 
                                                </div>
                                                <div class="col-md-3">
                                            <button type="submit" class="btn green">Update</button>
                                        </div>
                                        
                                           
                                        </div>
                                        {{ Form::close()}}
                                            <hr>
                                            {{ Form::open(array('url' => 'nmsi-bonus', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                            <div class="form-header text-success"><h3>NMSI Bonus</h3></div>
                                            <?php
                                            $result_nmsi=DB::select(DB::raw("SELECT * from nmsi_bonus where id='1' "));
                                            $first_nmsi =$result_nmsi[0]->first_nmsi ;
                                            $small_nmsi =$result_nmsi[0]->small_nmsi_bonus ;
                                            $nmsi =$result_nmsi[0]->nmsi_bonus ;
                                            $second_nmsi =$result_nmsi[0]->second_nmsi ;
                                            $extra=$result1[0]->extra;
                                            ?>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> Nmsi Bonus</label>
                                                <div class="col-md-6">
                                                    <input type="number" name="nmsi_bonus" class="form-control" value="{{$nmsi}}">
                                                </div>
                                                <div class="col-md-3">
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Small Nmsi Bonus</label>
                                                <div class="col-md-6">
                                                    <input type="number" name="small_nmsi_bonus" class="form-control" value="{{$small_nmsi}}">
                                                </div>
                                                <div class="col-md-3">
                                                </div>


                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">first Nmsi Bonus</label>
                                                <div class="col-md-6">
                                                    <input type="number" name="first_nmsi" class="form-control" value="{{$first_nmsi}}">
                                                </div>
                                                <div class="col-md-3">
                                                </div>


                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Second Bonus</label>
                                                <div class="col-md-6">
                                                    <input type="number" name="second_nmsi" class="form-control" value="{{$second_nmsi}}">
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn green">Update</button>
                                                </div>


                                            </div>
                                            {{ Form::close()}}

                                        </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
@stop