@extends('layouts.plane')

@section('body')

<div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <h3 style="color:#337AB7;">THE BANYAN</h3>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->
                
                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                               <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user dropdown-dark">
                                <?php
                                $vars = Auth::user();
                                $id = $vars->id;
                                ?>
                                <a href="{{ URL::to('editprofile/' . $id . '/edit') }}" class="dropdown-toggle">
                                    <i class="fa fa-user"></i>
                                </a>

                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="{{url('logout')}}" class="dropdown-toggle" >
                                    <i class="icon-logout"></i>
                                </a>

                            </li>
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="{{''}}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-calendar"></i>
                                    <span id='count' class="badge badge-danger" style="color:white;font-weight:bold;font-size:14px !important;" onclick="window.location.assign('{{'show_unread_requests'}}');"></span>
                                </a>
                            </li>
                            <script>
                                $('body').click(function() {
                                    $.get("{{'get_unread_requests'}}",function(data,status){
                                        $('#count').html(data.success);
                                    });
                                });
                                $(window).load(function() {
                                    $.get("{{'get_unread_requests'}}",function(data,status){
                                        $('#count').html(data.success);
                                    });
                                });
                            </script>
                           <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>

                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->

        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                   
                    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start">
                            <a onClick="location.href='{{ URL::to('member-status') }}'" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Features</h3>
                        </li>

                        <?php 
                            $author = Auth::user();
                            $role = $author->role;
                            if($role == 'SuperAdmin' || $role == 'Admin'){
                        ?>
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-users"></i>
                                        <span class="title">Staff Panel</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item  ">
                                            <a onClick="location.href='{{ URL::to('staff/create') }}'" class="nav-link ">
                                                <span class="title">Add Staff</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a onClick="location.href='{{ URL::to('staff') }}'" class="nav-link ">
                                                <span class="title">All Staffs</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                        <?php
                            }
                         ?>


                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-users"></i>
                                <span class="title">Member Panel</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('member/create') }}'" class="nav-link ">
                                        <span class="title">Create Member</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('member') }}'" class="nav-link ">
                                        <span class="title">Activate Members</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('deactivemember') }}'" class="nav-link ">
                                        <span class="title">Pending Members</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('locked_members') }}'" class="nav-link ">
                                        <span class="title">Locked Members</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-users"></i>
                                <span class="title">Agents</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('set_agents') }}'" class="nav-link ">
                                        <span class="title">Set an agent</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('all_agents') }}'" class="nav-link ">
                                        <span class="title">All Agents</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-users"></i>
                                <span class="title">Approve members Panel</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('approve_member') }}'" class="nav-link ">
                                        <span class="title">By Members</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('approve_bystaff') }}'" class="nav-link ">
                                        <span class="title">By Staffs</span>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <?php 
                            $author = Auth::user();
                            $role = $author->role;
                            if($role == 'SuperAdmin' || $role == 'Admin'){
                        ?>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-calendar"></i>
                                <span class="title">Monthly Status</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                <a onClick="location.href='{{ URL::to('monthly/calculate-bonus') }}'" class="nav-link ">
                                        <span class="title">Calculate Bonus</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{URL::to('daily_debit')}}' " class="nav-link ">
                                        <span class="title">Daily Income</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                <a onClick="location.href='{{ URL::to('totalincome') }}'" class="nav-link ">
                                        <span class="title">Total Income</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                <a onClick="location.href='{{URL::to('monthly/monthly-report')}}' " class="nav-link ">
                                        <span class="title">Monthly Report</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                <a onClick="location.href='{{URL::to('dailyreport/now')}}' " class="nav-link ">
                                        <span class="title">Daily Report</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                <a onClick="location.href='{{URL::to('daily_by_staff')}}' " class="nav-link ">
                                        <span class="title">Daily Report By Staff</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{URL::to('daily_debit')}}' " class="nav-link ">
                                        <span class="title">Daily Debit</span>
                                    </a>
                                </li>

                                <li class="nav-item  ">
                                    <a onClick="location.href='{{URL::to('debit_list')}}' " class="nav-link ">
                                        <span class="title">Debit list</span>
                                    </a>
                                </li>

                              
                                <li class="nav-item  ">
                                <a onClick="location.href='{{URL::to('dailyrequest')}}' " class="nav-link ">
                                        <span class="title">Daily Requests Report</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-money"></i>
                                <span class="title">Topup </span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                 <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('topup_balance') }}'" class="nav-link ">
                                        <span class="title">Topup Profit</span>
                                    </a>
                                </li>
                               

                            </ul>
                        </li>


                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-money"></i>
                                <span class="title">Income</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('income/member-fee') }}'" class="nav-link ">
                                        <span class="title">Member Fee Income</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('income/phone-bill') }}'" class="nav-link ">
                                        <span class="title">Phone billing Income</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item start">
                            <a onClick="location.href='{{ URL::to('bonuspercent') }}'" class="nav-link nav-toggle">
                                <i class="fa fa-money"></i>
                                <span class="title">Bonus Settings</span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                        
                        <li class="nav-item start">
                                <a onClick="location.href='{{ URL::to('withdraw') }}'" class="nav-link nav-toggle">
                                    <i class="fa fa-money"></i>
                                    <span class="title">Withdraw Approve</span>
                                </a>
                        </li>
                                
                        <?php 
                            $author = Auth::user();
                            $role = $author->role;
                            if($role == 'SuperAdmin' || $role == 'Admin'){
                        ?>
                        <li class="nav-item start">
                            <a onClick="location.href='{{ URL::to('card') }}'" class="nav-link nav-toggle">
                                <i class="fa fa-money"></i>
                                <span class="title">Card</span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                        <li class="nav-item start">
                            <a onClick="location.href='{{ URL::to('show_mpu_requests') }}'" class="nav-link nav-toggle">
                                <i class="fa fa-money"></i>
                                <span class="title">Mpu Request</span>
                            </a>
                        </li>
                        @if(Auth::user()->role=='SuperAdmin')
                        <li class="nav-item  ">
                            <a onClick="location.href='{{ URL::to('create_psw_for_psw') }}'" class="nav-link nav-toggle">
                                <i class="fa fa-lock"></i>
                                <span class="title">Password For Password</span>
                            </a>
                        </li>

                        @endif
                          <li class="nav-item  ">
                            <a onClick="location.href='{{ url('login_timer') }}'" class="nav-link nav-toggle">
                                <i class="fa fa-lock"></i>
                                <span class="title">Login Timer</span>
                            </a>
                        </li>


                        <li class="nav-item  ">
                            <a onClick="location.href='{{ URL::to('message') }}'" class="nav-link nav-toggle">
                                <i class="fa fa-envelope"></i>
                                <span class="title">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a onClick="location.href='{{ URL::to('member_message') }}'" class="nav-link nav-toggle">
                                <i class="fa fa-envelope"></i>
                                <span class="title">Messages For Member</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a onClick="location.href='{{ URL::to('tree_staff') }}'" class="nav-link nav-toggle">
                                <i class="fa fa-envelope"></i>
                                <span class="title">Tree Structure</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-money"></i>
                                <span class="title">Transaction</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('all_transaction') }}'" class="nav-link ">
                                        <span class="title">Topup Transaction</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{URL::to('bonus_transfer/now')}}' " class="nav-link ">
                                        <span class="title">Bonus transfer Report</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('all_tran_transaction') }}'" class="nav-link ">
                                        <span class="title">Transfer Balance Records</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-money"></i>
                                <span class="title">Api</span>

                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('member_api') }}'" class="nav-link ">
                                        <span class="title">Member Api</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a onClick="location.href='{{ URL::to('topup_api') }}'" class="nav-link ">
                                        <span class="title">Topup Api</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a onClick="location.href='{{ URL::to('account_api') }}'" class="nav-link ">
                                        <span class="title">Account Api</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->


        <!-- BEGIN CONTAINER -->
        <div class="page-content-wrapper">
            <div class="page-content">


                @yield('content')



                <div class="page-footer">
                <div class="page-footer-inner"> 2016 &copy; THE BANYAN, All rights reserved with
                <a target="_blank" href="http://thebanyanmm.org">Mastery Company Limited</a> &nbsp;|&nbsp;
                
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        </div>
        </div>






        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        
        <!-- END FOOTER -->
        <!-- BEGIN QUICK NAV -->
        
        <div class="quick-nav-overlay"></div>
</div>
@stop

