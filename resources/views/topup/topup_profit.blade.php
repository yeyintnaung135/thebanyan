@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title" style="float:left;">
            <h1>Topup Profit By Month
                <small>Search by month</small>

            </h1>
            {!! Form::open(['method'=>'GET','url'=>url('topup_balance')])  !!}

            <input type="month" name="month"/>


            <input type="submit" value="search"/>
            {!! Form::close() !!}
        </div>

    </div>
    @if(\Illuminate\Support\Facades\Session::has('A'))
        <div class="row">
            <div class="alert alert-info">

                Updated success!
            </div>
        </div>
    @endif
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>

                        <span class="caption-subject bold">Topup Profit By Month
                                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>

                            <th>MPT %</th>

                            <th>Ooredoo %</th>
                            <th>Telenor %</th>

                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>MPT %</th>

                            <th>Ooredoo %</th>
                            <th>Telenor %</th>

                            <th>Created At</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $count = 0;$mpt_total=0;$tel_total=0;$oo_total=0;$total=0;?>
                        @foreach ($data as $tb)
                            <?php $count++;$h=0;?>


                            <tr>

                                <td>
                                    <?php $has=DB::table('topup_profit')->where('date',$tb->date)->count();
                                   if($has >0){
                                    $h=1;
                                        }?>
                                    @if($h==1)
                                        <?php
                                           $pp= DB::table('topup_profit')->where('date',$tb->date)->first();
                                         ?>
                                       &nbsp;&nbsp;({{$pp->mptper}}%)
                                     @else
                                    <input type="number" id="mpt{{$count}}"/>
                                     @endif
                                </td>


                                <td>
                                    <?php $has=DB::table('topup_profit')->where('date',$tb->date)->count();
                                    if($has >0){
                                        $h=1;
                                    }?>
                                    @if($h==1)
                                        <?php
                                        $pp= DB::table('topup_profit')->where('date',$tb->date)->first();
                                        ?>
                                        &nbsp;({{$pp->ooper}}%)

                                        @else
                                            <input type="number" id="oo{{$count}}"/>
                                    @endif
                                </td>

                                <td>
                                    <?php $has=DB::table('topup_profit')->where('date',$tb->date)->count();
                                    if($has >0){
                                        $h=1;
                                    }?>
                                    @if($h==1)
                                        <?php
                                        $pp= DB::table('topup_profit')->where('date',$tb->date)->first();
                                        ?>
                                  &nbsp;&nbsp;({{$pp->telper}}%)

                                        @else
                                            <input type="number" id="tel{{$count}}"/>
                                    @endif
                                </td>
                                <td>
                                    {{$tb->date}}
                                    @if($h != 1)

                                    <form method="post" action="{{url('topup_cal')}}">

                                        <input type="hidden" name="date" value="{{$tb->date}}"/>



                                        <input type="hidden" name="mptper" id="uniqueIDmpt{{$count}}">
                                        <input type="hidden" name="ooper"  id="uniqueIDoo{{$count}}">
                                        <input type="hidden" name="telper" id="uniqueIDtel{{$count}}">

                                        <script>
                                            function cal(a) {
                                                var mpt = document.getElementById('mpt'+a).value;
                                                document.getElementById('uniqueIDmpt'+a).value = mpt;
                                                var oo = document.getElementById('oo'+a).value;
                                                document.getElementById('uniqueIDoo'+a).value = oo;
                                                var tel = document.getElementById('tel'+a).value;
                                                document.getElementById('uniqueIDtel'+a).value = tel;
                                            }
                                        </script>
                                        <input type="submit" value="Calculate" onClick="cal('{{$count}}')"/>

                                    </form>
                                        @else
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     <input type="submit" value="delete" onClick="window.location.href='{{url('delete_topup_balance/'.$tb->date)}}'"/>
                                    @endif


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    TOTAL:{{$total}} Mpt:{{$mpt_total}} Tel:{{$tel_total}} OOredoo:{{$oo_total}}
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>


    <!-- END CONTAINER -->
@endsection