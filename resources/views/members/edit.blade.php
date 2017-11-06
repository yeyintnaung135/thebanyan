@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Edit Member Info
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
                                        <i class="fa fa-gift"></i> Edit Member </div>
                                    <div class="tools">
                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="" class="reload" data-original-title="" title=""> </a>
                                        <a href="" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                <?php
                                $result=DB::select(DB::raw("SELECT * from activemembers WHERE child_count<3 ORDER BY id ASC"));
                                $sponsor = $result[0]->id;
                                /*foreach($result as $count){
                                	$ccount = $count->child_count;
                                	$sponsor = $count->id;
                                	if($ccount < 3){
                                		echo "sponsor_id ".$sponsor." - ".$ccount;
                                		echo "<br>";
                                	}                     	
                                }
                                */
                                ?>
                                {{ Form::model($member, array('route' => array('deactivemember.update', $member->id), 'method' => 'PUT','class'=> 'form-horizontal', 'role'=>'form')) }}

                                @include('errors.error')
                                        <div class="form-body">
                                        @include('flash::message')
                                        
                                                    
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Sponsor ID:</label>
                                                <div class="col-md-9">
                                                    {{ Form::number('sponsor_id', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Main Sponsor ID:</label>
                                                <div class="col-md-9">
                                                    {{ Form::number('main_sponsor_id', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Agent ID:</label>
                                                <div class="col-md-9">
                                                    {{ Form::number('agent_id', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Child Count :</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('child_count', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username :</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('username', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Father Name :</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('father_name', null, ['class' => 'form-control']) }} 
                                                </div>
                                            </div>
                             
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Password :</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('password', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">NRC No. :</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('nrc_no', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Phone No. :</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('phone', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Balance :</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('balance', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                    
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Address :</label>
                                                <div class="col-md-9">
                                                    {{ Form::textarea('address', null, ['class' => 'form-control','rows' => '4']) }}
                                                </div>
                                            </div>
                                            <div class="form-actions right1">
                                                <a href="{{ URL::to('/member') }}" class="btn btn-sm btn-default">Cancle</a>
                                                <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
@stop