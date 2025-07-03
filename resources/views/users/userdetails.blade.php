@extends('layouts.master')

@section('styles')

@endsection

@section('content')<!-- Breadcome start-->
<div class="breadcome-area mg-b-30"  >
    <div class="container">
        <div class="row" >
            <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top: 30px;
                    border-radius: 10px !important;">
                    <div class="breadcome-heading my-3" >
                        <h2 style="display:inline;"> User Detail</h2>
                        @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All']) && Auth::user()->hasRole('Super Admin'))

                        <a href="" data-toggle="modal" data-target="#modal_change_password" class="btn btn-primary mb-3" style="float: right;margin-bottom: 10px"><i class="fa fa-lock"></i>&nbsp;Change Password</a>

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcome End-->
<div class="adminpro-accordion-area">
    <div class="container">

        <div class="row" style="background:white; padding:20px; border-radius:10px;">
          <div class="col-md-12">
            <div class="sparkline13-graph">
                <div class="datatable-dashv1-list custom-datatable-overright">

                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{$register->name}}</td>
                              </tr>
                              <tr>
                                <th>Contact</th>
                                <td>{{$register->contact}}</td>
                            </tr>

                            <tr>
                              <th>Gender</th>
                              <td>{{$register->gender}}</td>
                            </tr>
                            <tr>
                              <th>Organization</th>
                              <td>{{$register->organization}}</td>


                            </tr>


                            <tr>
                              <th>Designation</th>
                              <td>{{$register->designation}}</td>
                            </tr>
                            <tr>
                              <th>Profession</th>
                              <td>{{$register->profession}}</td>


                            </tr>

                            <tr>
                              <th>Enrolled Program</th>
                              <td>{{$register->degree}}</td>
                            </tr>
                            <tr>
                              <th>Level</th>
                              <td>{{$register->level}}</td>


                            </tr>


                            <tr>
                              <th>Address</th>
                              <td>{{$register->address}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$register->email}}</td>
                            </tr>


                        </tbody>

                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('modals')

@include('users.modals.change_password')

@endsection


@section('scripts')

@endsection
