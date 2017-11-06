@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Admin Dashboard 
                            </h1>
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Dashboard</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->


                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="portlet box purple ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-user"></i>Edit Profile </div>
                                    <div class="tools">
                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="" class="reload" data-original-title="" title=""> </a>
                                        <a href="" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                {{ Form::model($user, array('route' => array('editprofile.update', $user->id), 'method' => 'PUT','class'=> 'form-horizontal', 'role'=>'form'))  }}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Select Role</label>
                                                <div class="col-md-9">
                                                <?php 
                                                    $num = $user->id;
                                                    $results = DB::select("select * from users where NOT role = 'SuperAdmin' and  NOT id = $num ");
                                                    $pickrole = DB::table('users')->where('id','=',$num)->pluck('role');
                                                 ?>
                                                    <select class="form-control" name="role">
                                                        <option value="{{ implode(', ', $pickrole) }}">
                                                            {{ implode(', ', $pickrole) }}
                                                        </option>
                                                        @foreach ($results as $result)
                                                        <option value="{{ $result->role }}" >{{ $result->role }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('username', null, ['class' => 'form-control']) }} </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Email</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('email', null, ['class' => 'form-control']) }} </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" name="password" class="form-control" placeholder="Password ေျပာင္းခ်င္ရင္ ထည့္ ... မေျပာင္းခ်င္ ဘာမထည့္ရ"> </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right1">
                                            <a href="{{ URL::to('/member-status') }}" class="btn btn-sm btn-default">Cancle</a>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
@endsection