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
                    <div class="breadcome-heading">
                        <h2>Approve / Reject Users</h2>
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
                    {{--
                    <div id="toolbar">
                        <select class="form-control">
                            <option value="">Export Basic</option>
                            <option value="all">Export All</option>
                            <option value="selected">Export Selected</option>
                        </select>
                    </div>
                    --}}
    <div class="table-responsive">
                    <table class="table " id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                        <thead>
                            <tr>

                                <th data-field="id">Sr No</th>
                                <th data-field="name" >Name</th>
                                <th data-field="company" >Gender</th>
                                <th data-field="phone" >Contact</th>
                                <th data-field="Organization" >Organization</th>
                                <th data-field="Designation" >Designation</th>
                                <th data-field="Level" >Level</th>
                                <th data-field="Degree" >Enrolled Program</th>
                                <th data-field="Profession" >Professional Designation</th>
                                <th data-field="email" >Email</th>
                                <th data-field="task" >Address</th>
                                <th data-field="date" >Question 1</th>
                                <th data-field="2" >Question 2</th>
                                <th data-field="action">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                              @foreach($users as $user)
                              <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td >{{$user->gender}}
                                </td>
                                <td>{{$user->contact}}</td>
                                <td>{{$user->organization}}</td>
                                <td>{{$user->designation}}</td>
                                <td>{{$user->level}}</td>
                                <td>{{$user->degree}}</td>
                                <td>{{$user->profession}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->option1}}</td>
                                <td>{{$user->option2}}</td>
                                <td>
                                  <a class="btn btn-sm" href="#" data-toggle="modal" data-target="#approveuser"  onclick="approveuserid('{{Crypt::encrypt($user->id)}}')"><i class="fa fa-check"></i>
                                  Approve</a>
                                  <a class="btn btn-sm" href="#" data-toggle="modal" data-target="#rejectuser"  onclick="rejectuserid('{{Crypt::encrypt($user->id)}}')"><i class="fa fa-trash"></i>
                                  Reject</a></td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@include('users.modals.approveuser')
@include('users.modals.rejectuser')
@endsection


@section('scripts')
<script>
function approveuserid(id)
{
  $("#user_id").val(id);
}
function rejectuserid(id)
{
  $("#user_idr").val(id);
}
</script>
@endsection
