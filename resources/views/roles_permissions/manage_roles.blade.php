@extends('layouts.master')


@section('content')
<!-- BREAD CRUMB -->
<div class="breadcome-area mg-t-40 mg-b-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               <!--  <div class="breadcome-list shadow-reset">
                    <div class="breadcome-heading">
                        <h1><strong style="color: #4385C7;">Role and Permission</strong></h1>

                    </div>
                    <ul class="breadcome-menu">
                        <li><a href="{{url('/')}}">Home</a> <span class="bread-slash">/</span>
                        </li>



                        <li><span class="bread-blod">Roles and Permissions</span>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- END BREAD CRUMB -->


 <!-- welcome Project, sale area start-->
    <div class="welcome-adminpro-area knowladge-hub">
        <div class="container">
            <!-- ROW 1 SEARCH  -->
            <div class="row">
                 <div class="col-lg-12">
                    <div class="sparkline8-list shadow-reset">
                        <div class="sparkline8-hd">
                            <div class="main-sparkline8-hd">
                                <h2>Manage Roles And Permissions</h2>
                               
                            </div>
                        </div>
                        <div class="sparkline8-graph" style="background:white; padding:10px; border-radius:10px;">
                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <div id="toolbar">
                                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add Roles']))
                                    <a  class="btn btn-success" style="background:#a24187;border-color:#a24187; margin: 0;float:right;" href="#" data-toggle="modal" data-target="#md_add_role"><i class="fa fa-pencil"></i> Add New Roles</a>

                                         @endif
                                </div>
                                <table class="table" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="false" data-key-events="true" data-show-toggle="false" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th >Sr #</th>
                                            <th data-field="name"  >Roles</th>
                                            <th data-field="email"  >Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       @isset($role_list)

                                        @foreach($role_list as $rows)
                                        <tr>
                                        <td >{{$loop->iteration}}</td>

                                        <td>{{$rows->name}}</td>

                                        <td>{{ Carbon\Carbon::parse($rows->created_at)->diffForHumans()}}</td>

                                       <td >

                                            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add Roles']))
                                            <a  href="{{url('assignpermission',['id' => Crypt::encrypt($rows->id)])}}" data-toggle="tooltip" data-placement="left" title="Assign Permission" class="js-tooltip-enabled" data-original-title="Edit">
                                                    <i class="fa fa-lock"></i>
                                                </a>&nbsp;
                                            @endif

                                            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Update Roles']))
                                            @php($route = route('update.role',['id' => Crypt::encrypt($rows->id)]))
                                            <a onclick="onFetchFormModal(event,'{{$route}}','#md_update_role','#bind_md_update_role');" href="#" data-toggle="tooltip" data-placement="left" title="Edit User" class="js-tooltip-enabled" data-original-title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>&nbsp;
                                            @endif

                                             @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All']))

                                            <a content="delete role" href="{{url('removerole',['id' => Crypt::encrypt($rows->id)])}}"  data-toggle="tooltip" data-placement="left" title="Remove Role" class="js-tooltip-enabled cls_delete" data-original-title="Edit">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>


                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="bind_md_update_role"></div>
@include('roles_permissions.modals.add_role')

    @endsection


