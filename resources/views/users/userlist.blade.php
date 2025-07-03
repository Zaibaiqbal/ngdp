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
                        <h2>Registered Users</h2>
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
                    <table class="table" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                        <thead>
                            <tr>
                                <th></th>
                                <th  >Email</th>
                                <th  >Name</th>
                                <th  >Contact</th>

                                <th >Gender</th>
                                <th  >Status</th>
                                  <th  >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->contact}}</td>
                                <td  >{{$user->gender}}
                                </td>
                                <td>

                                    @if($user->status == "0") Unapproved @else Approved @endif</td>
                                  <td>
                                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Change Roles']))
                                    <a class="btn btn-sm" href="#" data-toggle="modal" data-target="#changerole"  onclick="changeroleid('{{Crypt::encrypt($user->id)}}')"><i class="fa fa-pencil"></i>
                                    Change Role</a>
                                    <a class="btn btn-sm" href="{{ route('userdetails' , Crypt::encrypt($user->id))}}" ><i class="fa fa-eye"></i>
                                    Details</a>
                                    @endif
                                </td>
                                  </td>
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
@include('users.modals.changerole')
@endsection


@section('scripts')
<script>
function changeroleid(id)
{
  $("#user_id").val(id);
}
</script>
@endsection
