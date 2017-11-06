@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
<!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Monthly Member Status
                                <small>buttons extension demos</small>
                            </h1>
                        </div>
                    </div>
                <div class="row widget-row">
                @include('flash::message')
                        <div class="col-md-3">
                        <a onClick="location.href='{{ URL::to('new-member') }}'">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">New Members</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-green icon-users"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Total</span>
                                        <?php
                                            use App\Activemember;
                                            date_default_timezone_set("Asia/Rangoon");
                                            $year = date('Y-m-d h:i:s');
                                            $date = date('m/Y');
                                            $newmember = Activemember::where('date','=',$date)->count();
                                        ?>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $newmember; ?>">    
                                            {{ $newmember }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                            </a>
                        </div>
                        <div class="col-md-3">
                        <a onClick="location.href='{{ URL::to('old-member') }}'">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Old Members</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-red icon-users"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Total</span>
                                        <?php
                                            $oldmember = Activemember::where('date','!=',$date)->count();
                                        ?>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $oldmember; ?>">
                                            {{ $oldmember }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                            </a>
                        </div>
                        <div class="col-md-3">
                        <a onClick="location.href='{{ URL::to('active-member') }}'">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Active Members</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-purple icon-users"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Total</span>
                                        <?php 

                                           $count=DB::table('activemembers')->where('control',1)->count();

                                        if($count != '0'){
                                        ?>

                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $count }}">{{ $count }}</span>
                                        <?php
                                        }else{
                                            ?>
                                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="none"></span>
                                            <?php
                                            } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                            </a>
                        </div>
                        <div class="col-md-3">
                        <a onClick="location.href='{{ URL::to('inactive-member') }}'">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Inactive Members</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-blue icon-users"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Total</span>

                                        <?php 

                                           /* date_default_timezone_set("Asia/Rangoon");
                                            $year = date('Y-m-d h:i:s');
                                            $date = date('m/Y');

                                            $activepoint = DB::table('activepoints')->where('monthly','=',$date)->pluck('activepoint');
                                            if(!empty($activepoint)){
                                            $pickactivepoint = $activepoint['0'];

                                            $members = Activemember::all();
                                            $counts = 0;

                                            foreach ($members as $key => $value) {
                                                $member_id = $value{'id'};

                                                $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where member_id=$member_id"); 
                                                $useamount = $totalamount[0]->amount;
                                                if ($pickactivepoint > $useamount) {
                                                    $counts ++;
                                                }
                                            }*/
                                           $counts=DB::table('activemembers')->where('control',0)->count();
                                           if($counts != 0){
                                        ?>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $counts }}">{{ $counts }}</span>
                                        <?php
                                        }else{
                                            ?>
                                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="none"></span>
                                            <?php
                                            } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                            </a>
                        </div>
                    </div><!-- BEGIN PAGE HEAD-->

                   
        <!-- END CONTAINER -->
@endsection