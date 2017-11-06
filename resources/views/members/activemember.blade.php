@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Active Members Lists
                            </h1>
                        </div>
                    </div>


                    <!-- END PAGE BREADCRUMB -->
                     @include('flash::message')
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Buttons</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>NRC</th>
                                                <th>Child</th>
                                                <th>Total Count</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>NRC</th>
                                                <th>Child</th>
                                                <th>Total Count</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                            use App\Activemember;
                                            date_default_timezone_set("Asia/Rangoon");
                                            $year = date('Y-m-d h:i:s');
                                            $date = date('m/Y');

                                            $activepoint = DB::table('activepoints')->where('monthly','=',$date)->pluck('activepoint');
                                            if(!empty($activepoint)){
                                            $pickactivepoint = $activepoint['0'];

                                            $members = Activemember::all();

                                            foreach ($members as $key => $value) {
                                                $member_id = $value{'id'};

                                                $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where member_id=$member_id");
                                                $useamount = $totalamount[0]->amount;
                                                if ($pickactivepoint <= $useamount) {
                                                        ?>
                                                        <tr>
                                                            <td> TB{{$member_id}} </td>
                                                            <td>
                                                            <?php
                                                                $username = DB::table('activemembers')->where('id','=',$member_id)->pluck('username');
                                                                $pickname = $username['0'];
                                                            ?>
                                                            {{ $pickname }}
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $nrc = DB::table('activemembers')->where('id','=',$member_id)->pluck('nrc_no');
                                                                $picknrc = $nrc['0'];
                                                                ?>
                                                                {{ $picknrc }}
                                                            </td>
                                                            <td> {{ $value{'child_count'} }} </td>
                                                            <td>
                                                                <?php
                                                                    $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$member_id "));
                                                                    $var =$result[0]->total;
                                                                    if ($var >= 797163 ) {
                                                                        echo "797163";
                                                                    }else{
                                                                        echo $var;
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$member_id "));
                                                                    $var =$result[0]->total;

                                                                    if ($var < 4) {
                                                                        echo "Beginner";
                                                                    }elseif ($var >= 4 && $var < 13 ) {
                                                                        echo "Level 1";
                                                                    }elseif ($var >= 13 && $var < 40) {
                                                                        echo "Level 2";
                                                                    }elseif($var >= 40 && $var < 121){
                                                                        echo "Level 3";
                                                                    }elseif($var >= 121 && $var < 364){
                                                                        echo "Level 4";
                                                                    }elseif($var >= 364 && $var < 1093){
                                                                        echo "Level 5";
                                                                    }elseif($var >= 1093 && $var < 3280){
                                                                        echo "Level 6";
                                                                    }elseif($var >= 3280 && $var < 9841){
                                                                        echo "Level 7";
                                                                    }elseif($var >= 9841 && $var < 29524){
                                                                        echo "Level 8";
                                                                    }elseif($var >= 29524 && $var < 88573){
                                                                        echo "Level 9";
                                                                    }elseif($var >= 88573 && $var < 265720){
                                                                        echo "King";
                                                                    }elseif($var >= 265720 && $var < 797163){
                                                                        echo "Ruby King";
                                                                    }else{
                                                                        echo "Director";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="text-success">
                                                                <?php
                                                                    $status = DB::table('activemembers')->where('id','=',$member_id)->pluck('status');
                                                                    $pickstatus = $status['0'];
                                                                ?>
                                                                    {{ $pickstatus }}
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $balance = DB::table('activemembers')->where('id','=',$member_id)->pluck('balance');
                                                                    $pickbalance = $balance['0'];
                                                                ?>
                                                                    {{ $pickbalance }}
                                                            </td>
                                                            <td>
                                                                <a onClick="location.href='{{ action('MembersController@addbonus' , array($member_id)) }}'" class="btn btn-inline btn-primary btn-sm ladda-button" >Add Bonus</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }

                                            }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>


        <!-- END CONTAINER -->
@endsection