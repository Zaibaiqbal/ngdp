@extends('layouts.master')

@section('title')
    Assign Permission
@endsection


@section('content')
<!-- BREAD CRUMB -->
<div class="breadcome-area mg-t-40 mg-b-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               <!--  <div class="breadcome-list shadow-reset">
                    <div class="breadcome-heading">
                        <h1><strong style="color: #4385C7;">Assign Permission</strong></h1>
                        
                    </div>
                    <ul class="breadcome-menu">
                        <li><a href="{{url('/')}}">Home</a> <span class="bread-slash">/</span>
                        </li>

                        <li><a href="{{route('roles')}}">{{$role->name}}</a> <span class="bread-slash">/</span>
                        </li>
                  
                        <li><span class="bread-blod">Assign Permission</span>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- END BREAD CRUMB -->

      <!-- Page Content -->
                <div class="content">
                    <div class="container">
                    <div class="row">
                    @foreach($module_list as $rows)
                    <div class="col-md-4">

                        <div class="sparkline7-list shadow-reset mg-t-30">
                            <div class="sparkline8-hd">
                                <div class="main-spark7-hd">
                                    <h2>{{$rows->module}} </h2>
                                    <div class="sparkline8-outline-icon">
                                        <!-- <span class="sparkline7-collapse-link"><i class="fa fa-chevron-down"></i></span> -->
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline7-graph project-details-price-hd"  style="background-color: #cecaca;">
                                <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0  table-vcenter text-center table-sm">
                                         <thead class="table-vcenter">
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th class="text-center">Permisson</th>
                                        <th class="d-none d-sm-table-cell text-center" >Action</th>


                                        
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($permission->getPermissionByModule($rows->module) as $permission_rows)
                                    @php($uniqid = uniqid())
                                    <tr>
                                        <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                                        
                                        <td class="font-w600 font-size-sm">{{$permission_rows->name}}</td>
                                        
                                        
                                       <td class="text-center">
                                            <div class="custom-control custom-switch mb-1">
                                                <input @if($role->hasPermissionTo($permission_rows)) checked @endif  onchange="verifyPermission(event,this,'{{Crypt::encrypt($permission_rows->id)}}','{{Crypt::encrypt($role->id)}}')" type="checkbox" class="custom-control-input" id="example-switch-custom{{$uniqid}}" name="example-switch-custom{{$uniqid}}" >
                                                <label class="custom-control-label" for="example-switch-custom{{$uniqid}}"></label>
                                            </div>
                                        </td>

                                        
                                       
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                                    </table>
                            </div>
                        </div>
                            
                    </div>
                    @endforeach
                    </div>
                  
            
</div>
                </div>
                <!-- END Page Content -->

  <!-- Page JS Plugins -->
  <script type="text/javascript">
    function verifyPermission(event,option,permission,role)
    {
        showLoader();
        var token  =  "{{Session::token()}}";
                

        var formdata = {'role':role,'permission':permission,'_token':token};



        $.post("{{route('verifypermission.role')}}", formdata, function(result)
        {
            

            if(result == "1")
            {
                
                Lobibox.notify('success', {
                    msg: 'Permission has been granted successfully.'
                  });
            }
            else if(result == "2")
            {
                Lobibox.notify('info', {
                    msg: 'Permission has been revoked successfully.'
                  });
            }
            else
            {
                 Lobibox.notify('warning', {
                    msg: 'Try again something wrong.'
                  });
            }

            removeLoader();


        });
    }
  </script>
      
@endsection

