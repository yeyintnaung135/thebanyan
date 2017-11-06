@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Locked Members List
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
                        <i class="icon-users font-dark"></i>
                        <span class="caption-subject bold uppercase">Locked Members</span>
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
                             <th>Phone</th>
                            <th>Child Count</th>
                            <th>Father Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>NRC</th>
                             <th>Phone</th>
                            <th>Child Count</th>
                            <th>Father Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($data as $d)
                           @php
                               $check_three=DB::table('password_wrong')->where([['username','=',$d->username],['status','=','new']])->count();
                               @endphp
                           @if($check_three >=3)
                            @php
                            $member=DB::table('activemembers')->where('id',$d->username)->first();
                            @endphp

                            <tr>
                                <td>TB{{ $member->id }}</td>
                                <td>{{ $member->username }}</td>
                                <td>{{ $member->nrc_no }}</td>
                                   <td>{{ $member->phone }}</td>
                                <td>
                                    {{ $member->child_count }}
                                </td>
                                <td>
                                    {{ $member->father_name }}
                                </td>
                                <td class="text-danger">
                                   LOCKED
                                </td>
                                <td>
                                
                                    <a href="#"  onclick="falert({{$member->id}})" class="btn btn-inline btn-primary btn-sm ladda-button" >Active</a>
                                 
                                    <script>
                                        function falert(id){
                                            $data=confirm('Are u sure want to active this user?');
                                            if($data){
                                                window.location.assign('reactive/'+ id);
                                            }

                                        }
                                    </script>

                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>


    <!-- END CONTAINER -->
@endsection