@extends('layouts.master')

@section('styles')
<style type="text/css">
	.tab-custon-menu-bg:before {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    background: #fff;
    content: "";
    z-index: -1 !important;
    height: 100%;
}
</style>
@endsection
@section('content')
<!-- BREAD CRUMB -->
<div class="breadcome-area mg-t-40 mg-b-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="breadcome-heading">
                        <h1><strong style="color: #4385C7;">Logs</strong></h1>
                    </div>
                    <ul class="breadcome-menu">
                        <li><a href="{{url('/')}}">Home</a> <span class="bread-slash">/</span>
                        </li>

                        <li><span class="bread-blod">Logs</span>
                        </li>
                    </ul>
                </div>
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
                                <h1>Logs Detail</h1>
                                <!-- <div class="sparkline8-outline-icon">
                                    <span class="sparkline8-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                    <span><i class="fa fa-wrench"></i></span>
                                    <span class="sparkline8-collapse-close"><i class="fa fa-times"></i></span>
                                </div> -->
                            </div>
                        </div>
                        <div class="sparkline8-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <div id="toolbar">
                                    <select class="form-control">
                                        <option value="">Export Basic</option>
                                        <option value="all">Export All</option>
                                        <option value="selected">Export Selected</option>
                                    </select>
                                </div>
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th >Sr #</th>
                                            <th data-field="name"  >User</th>
                                            <th data-field="email"  >Date</th>
                                            <th data-field="phone"  >Time</th>
                                            <th data-field="company"  >Log</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       @isset($logs_list)

                                        @foreach($logs_list as $rows)

                                            <tr>
                                                <td>{{(int)($loop->iteration)}}</td>

                                                <td>{{$rows->name}}</td>


                                                <td>{{EF::dateFormat($rows->log_date)}} </td>
                                          <td>{{$rows->log_time}}</td>

                                                <td>{{$rows->message}}</td>



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


@endsection
