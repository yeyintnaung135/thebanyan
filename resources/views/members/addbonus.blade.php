@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Phone Bill
                                <small>buttons extension demos</small>
                            </h1>
                        </div>
                    </div>
                    <!-- END PAGE BREADCRUMB -->

                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Bonus From Phone Bill</span>

                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                    
                                    <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>bonus</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>bonus</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>                                          
                                        <?php 
                                            $id = $memberbonus->member_id;
                                            date_default_timezone_set("Asia/Rangoon");
                                            $year = date('Y-m-d h:i:s');
                                            $date = date('m/Y');
                                            $totalphoneamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and member_id ='$id' and card = '101' "); 
                                            $card1 = $totalphoneamount[0]->amount;
                                            if (!empty($card1)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                $username = DB::table('activemembers')->where('id','=',$id)->pluck('username');
                                                                $pickusername = $username['0']; 
                                                            ?>
                                                            {{ $pickusername }}
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $card_id = '1';
                                                                $card = DB::table('cards')->where('id','=',$card_id)->pluck('card');
                                                                $pickcard = $card['0']; 
                                                            ?>
                                                            {{ $pickcard }}
                                                        </td>
                                                        <td>{{ $date }}</td>
                                                        <td>{{ $card1 }}</td>
                                                        <td>
                                                            <?php
                                                                $card_id = '1';
                                                                $bonuspercent = DB::table('cards')->where('id','=',$card_id)->pluck('bonuspercent');
                                                                $pickbonuspercent = $bonuspercent['0'];

                                                                $totalamount1 = $card1 * ($pickbonuspercent/100);
                                                            ?>
                                                            {{ $totalamount1 }}
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                            
                                            $totalphoneamount1 = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and member_id ='$id' and card = '111' "); 
                                            $card2 = $totalphoneamount1[0]->amount;

                                            if (!empty($card2)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                $username = DB::table('activemembers')->where('id','=',$id)->pluck('username');
                                                                $pickusername = $username['0']; 
                                                            ?>
                                                            {{ $pickusername }}
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $card_id = '2';
                                                                $card = DB::table('cards')->where('id','=',$card_id)->pluck('card');
                                                                $pickcard = $card['0']; 
                                                            ?>
                                                            {{ $pickcard }}
                                                        </td>
                                                        <td>{{ $date }}</td>
                                                        <td>{{ $card2 }}</td>
                                                        <td>
                                                        <?php
                                                                $card_id = '2';
                                                                $bonuspercent = DB::table('cards')->where('id','=',$card_id)->pluck('bonuspercent');
                                                                $pickbonuspercent = $bonuspercent['0'];

                                                                $totalamount2 = $card2 * ($pickbonuspercent/100);
                                                            ?>
                                                            {{ $totalamount2 }}
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                            
                                            $totalphoneamount2 = DB::select("SELECT SUM(amount) AS amount FROM incomes where monthly='$date' and member_id ='$id' and card = '121' "); 
                                            $card3 = $totalphoneamount2[0]->amount;
                                            if (!empty($card3)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                $username = DB::table('activemembers')->where('id','=',$id)->pluck('username');
                                                                $pickusername = $username['0']; 
                                                            ?>
                                                            {{ $pickusername }}
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $card_id = '3';
                                                                $card = DB::table('cards')->where('id','=',$card_id)->pluck('card');
                                                                $pickcard = $card['0']; 
                                                            ?>
                                                            {{ $pickcard }}
                                                        </td>
                                                        <td>{{ $date }}</td>
                                                        <td>{{ $card3 }}</td>
                                                        <td>
                                                           <?php
                                                                $card_id = '3';
                                                                $bonuspercent = DB::table('cards')->where('id','=',$card_id)->pluck('bonuspercent');
                                                                $pickbonuspercent = $bonuspercent['0'];

                                                                $totalamount3 = $card3 * ($pickbonuspercent/100);
                                                            ?>
                                                            {{ $totalamount3 }} 
                                                        </td>
                                                    </tr>
                                                <?php
                                            }

                                        if(empty($card1) && empty($card2) && !empty($card3))
                                        {
                                            $totalamount = $totalamount3;

                                            $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                            $var =$result[0]->total;

                                            $bonuspercent = DB::table('bonuspercents')->where('monthly','=',$date)->pluck('bonuspercent');
                                            $pickbonuspercent = $bonuspercent['0'];

                                            $activebonus = $var * $pickbonuspercent;

                                            $alltotalbonus = $totalamount + $activebonus;

                                            $pickdate = DB::table('monthlybonus')->where('monthly','=',$date)->where('member_id','=',$id)->pluck('monthly');

                                            if(empty($pickdate)){

                                                DB::insert("INSERT INTO monthlybonus (member_id, totalbonus,monthly,status)
                                                    VALUES ('$id', '$alltotalbonus', '$date','pending')");
                                            }

                                        }elseif (empty($card1) && !empty($card2) && empty($card3)) {

                                            $totalamount = $totalamount2;

                                            $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                            $var =$result[0]->total;

                                            $bonuspercent = DB::table('bonuspercents')->where('monthly','=',$date)->pluck('bonuspercent');
                                            $pickbonuspercent = $bonuspercent['0'];

                                            $activebonus = $var * $pickbonuspercent;

                                            $alltotalbonus = $totalamount + $activebonus;

                                            $pickdate = DB::table('monthlybonus')->where('monthly','=',$date)->where('member_id','=',$id)->pluck('monthly');
                                            
                                            if(empty($pickdate)){

                                                DB::insert("INSERT INTO monthlybonus (member_id, totalbonus,monthly,status)
                                                    VALUES ('$id', '$alltotalbonus', '$date','pending')");
                                            }

                                        }elseif (empty($card1) && !empty($card2) && !empty($card3)) {

                                            $totalamount = $totalamount2 + $totalamount3;

                                            $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                            $var =$result[0]->total;

                                            $bonuspercent = DB::table('bonuspercents')->where('monthly','=',$date)->pluck('bonuspercent');
                                            $pickbonuspercent = $bonuspercent['0'];

                                            $activebonus = $var * $pickbonuspercent;

                                            $alltotalbonus = $totalamount + $activebonus;

                                            $pickdate = DB::table('monthlybonus')->where('monthly','=',$date)->where('member_id','=',$id)->pluck('monthly');

                                            if(empty($pickdate)){

                                                DB::insert("INSERT INTO monthlybonus (member_id, totalbonus,monthly,status)
                                                    VALUES ('$id', '$alltotalbonus', '$date','pending')");
                                            }
                                        }elseif (!empty($card1) && empty($card2) && empty($card3)) {

                                            $totalamount = $totalamount1;

                                            $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                            $var =$result[0]->total;

                                            $bonuspercent = DB::table('bonuspercents')->where('monthly','=',$date)->pluck('bonuspercent');
                                            $pickbonuspercent = $bonuspercent['0'];

                                            $activebonus = $var * $pickbonuspercent;

                                            $alltotalbonus = $totalamount + $activebonus;

                                            $pickdate = DB::table('monthlybonus')->where('monthly','=',$date)->where('member_id','=',$id)->pluck('monthly');

                                            if(empty($pickdate)){

                                                DB::insert("INSERT INTO monthlybonus (member_id, totalbonus,monthly,status)
                                                    VALUES ('$id', '$alltotalbonus', '$date','pending')");
                                            }

                                            
                                        }elseif (!empty($card1) && empty($card2) && !empty($card3)) {

                                            $totalamount = $totalamount1 + $totalamount3;

                                            $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                            $var =$result[0]->total;

                                            $bonuspercent = DB::table('bonuspercents')->where('monthly','=',$date)->pluck('bonuspercent');
                                            $pickbonuspercent = $bonuspercent['0'];

                                            $activebonus = $var * $pickbonuspercent;

                                            $alltotalbonus = $totalamount + $activebonus;

                                            $pickdate = DB::table('monthlybonus')->where('monthly','=',$date)->where('member_id','=',$id)->pluck('monthly');

                                            if(empty($pickdate)){

                                                DB::insert("INSERT INTO monthlybonus (member_id, totalbonus,monthly,status)
                                                    VALUES ('$id', '$alltotalbonus', '$date','pending')");
                                            }

                                        }elseif (!empty($card1) && !empty($card2) && empty($card3)) {
                                           
                                           $totalamount = $totalamount1 + $totalamount2;

                                            $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                            $var =$result[0]->total;

                                            $bonuspercent = DB::table('bonuspercents')->where('monthly','=',$date)->pluck('bonuspercent');
                                            $pickbonuspercent = $bonuspercent['0'];

                                            $activebonus = $var * $pickbonuspercent;

                                            $alltotalbonus = $totalamount + $activebonus;

                                           $pickdate = DB::table('monthlybonus')->where('monthly','=',$date)->where('member_id','=',$id)->pluck('monthly');

                                            if(empty($pickdate)){

                                                DB::insert("INSERT INTO monthlybonus (member_id, totalbonus,monthly,status)
                                                    VALUES ('$id', '$alltotalbonus', '$date','pending')");
                                            }

                                        }elseif (!empty($card1) && !empty($card2) && !empty($card3)) {

                                            $totalamount = $totalamount1 + $totalamount2 + $totalamount3;

                                            $result=DB::select(DB::raw("SELECT count(*) as total from relateds where pid=$id "));
                                            $var =$result[0]->total;

                                            $bonuspercent = DB::table('bonuspercents')->where('monthly','=',$date)->pluck('bonuspercent');
                                            $pickbonuspercent = $bonuspercent['0'];

                                            $activebonus = $var * $pickbonuspercent;

                                            $alltotalbonus = $totalamount + $activebonus;

                                            $pickdate = DB::table('monthlybonus')->where('monthly','=',$date)->where('member_id','=',$id)->pluck('monthly');

                                            if(empty($pickdate)){

                                                DB::insert("INSERT INTO monthlybonus (member_id, totalbonus,monthly,status)
                                                    VALUES ('$id', '$alltotalbonus', '$date','pending')");
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