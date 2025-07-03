@extends('layouts.main')

@section('styles')
<style>

  #map {
    width: 600px;
    height: 400px;
  }
  #md_add_datasource_dropdown {
    margin-top: 5%;
    z-index: 1500;
  }
  .clickable{
    cursor: pointer;
}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}

@media only screen and (min-width: 600px) {

.main-section{

  margin-bottom: 5% !important;

}

} 
@media only screen and (max-width: 500px) {

.main-section{

  margin-bottom: 17% !important;

}
#chart-line{
  width: 280px !important;
  height: 200px !important;
}

} 

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<link href="{{ asset('assets/mycss.css') }}" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Breadcome start-->
<div class="breadcome-area mg-b-30"  >
    <div class="container main-section" style="background-color: #b6c0cc;opacity:0.9;border-radius: 17px;">
        <div class="row breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top: 10px;
            border-radius: 10px !important;" >
            <div class="col-md-12">
            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
            <!-- <div class="col-md-12">
              <h4 style="padding-left: 25px;"><u>Main Indicator</u></h4>
            </div> -->
            <!-- <a class="btn btn-xs btn-primary pull-right" style="margin-left: 5px;" href="#" data-toggle="modal" data-target="#addindicatorInfochild"><i class="fa fa-plus"></i> Sub Indicator</a> -->
            <a class="btn btn-xs btn-primary pull-right" style="" href="#" data-toggle="modal" data-target="#addindicatorInfo"><i class="fa fa-plus"></i> Indicator</a>

            @endif
  </div>
<div class="col-md-12">
  <h3> <a href="{{ route('home')}}" class="btn-xs btn-primary" style="border-radius:150px;"><i class="fa fa-arrow-left"></i> </a> &nbsp;&nbsp;  {{$indicator->subTheme->name}}

  </h3>

  <div class="tab-content" style="margin-top:10px;">
    <div class="panel-group adminpro-custon-design" id="accordion">
      <div class="panel panel-default">
  <div class="panel-heading accordion-head" style="padding-bottom: 1.5%;">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#subthemecollaspe" onclick="setico()">
        <i id="myico" class="fa fa-plus"></i> {{$indicator->data_requirement}} <br>
        </a>
      
      @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
        <a class="compose-discard-bt pull-right" href="#" data-toggle="modal" data-target="#deleteIndi"><i class="fa fa-trash-o"></i> </a>
      @endif
      </h4>
   </div>

   <div id="subthemecollaspe" class="panel-collapse panel-ic collapse">
       <div class="panel-body admin-panel-content animated bounce">

         <table class="table">
           <!-- <tr>
             <th>Indicator Name</th>
             <td>{{$indicator->data_requirement}}</td>
           </tr> -->
           @if($indicator->beijing)
           @if(isset($indicator->beijing->id))
           <tr>
             <th>Beijing +25</th>
             <td>{{$indicator->beijing->target_number}}.
             {{$indicator->beijing->indicator_name}}</td>
           </tr>
           @endif
           @endif

           @if($indicator->getregsdg($indicator->id)->count() > 0)
           @foreach($indicator->getregsdg($indicator->id) as $myindi)
           @if($myindi->getgoals($myindi->target_id)->count() > 0)
           <tr>
             <th>SDG Goal</th>
             <td>{{$myindi->getgoals($myindi->target_id)->goal_number}}.
             {{$myindi->getgoals($myindi->target_id)->goal_name}}</td>
           </tr>
           @endif
           @if($myindi->gettargets($myindi->target_id)->count() > 0)
           <tr>
             <th>SDG Target</th>
             <td>{{$myindi->gettargets($myindi->target_id)->target_number}}.
             {{$myindi->gettargets($myindi->target_id)->target_name}}</td>
           </tr>
           @endif
           <tr>
             <th>SDG Indicator</th>
             <td>
             <b>{{$myindi->newindicator->indicator_number}}. {{$myindi->newindicator->indicator_name}}</b>
             </td>
           </tr>
           @endforeach
           @endif
           @if($indicator->qualitativemany($indicator->id))

           <tr>
             <th>Qualitative Indicator</th>
             <td>{{$indicator->qualitative->legal_name}}...<a class="pull-right" href="#" data-toggle="modal" data-target="#qualitativemodal"><b>See details</b></a>
             </td>
           </tr>

           @endif

         </table>

         </div>
   </div>
 </div></div></div>
</div>



<div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:15px;" id="fildiv">

      <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Select Source/Year</h3>
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
      </div>
      <div class="panel-body" style="padding: 0px;">
      <div class="row" style="padding:15px;margin-top: 0px;border-radius: 10px;">
        <div class="col-md-12">
          <label>Select source </label>
          <select class="form-control" name="data_source" id="data_source" onchange="getsurveyyear()">
            @foreach($info2 as $data)
            <option value="{{$data}}">{{$data}}</option>
            @endforeach
            <!-- <option value="all">All</option> -->
          </select>
        </div>
        <input value="{{Crypt::encrypt($indicator->id)}}" type="hidden" name="indicator_id" id="indicator_id"/>
        <div class="col-md-12">
          <label>Select year</label>
          <select class="form-control" name="year" id="year" onchange="getmyfiltercheck()">
            <!-- <option value="all">All</option> -->
            @foreach($years as $yy)
            <option value="{{$yy->current_year}}">{{$yy->current_year}}</option>
            @endforeach

          </select>
        </div>
        <div class="col-md-12" style="margin-top:5px;" id="mygraphviewthird">

        </div>


        <div class="col-md-12" style="display:none;background-color:cadetblue" id="filterdiv">

        </div>

      </div>
</div>
</div>

</div>

<div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:15px;" id="mygraphviewfirst">

</div>
<div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:15px;" id="mygraphviewsecond">

</div>


<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;margin-bottom:7%">
  <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item active">
        <a class="nav-link active" data-toggle="tab" href="#mygraphview">Graph</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#homem">Table</a>
      </li>
    </ul>


    <div class="tab-content">
      <div id="mygraphview" class=" tab-pane active"><br>
        <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px !important; height: 200px;"></canvas>
      </div>
      <div id="homem" class=" tab-pane fade"><br>

      </div>
    </div>


</div>

                    </div>

                  </div>
                </div>

<div id="qualitativemodal" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Qualitative Indicators</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>


            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->

                    <div class="row">
                    <div class="col-md-6">
                      <table class="table table-bordered" style="border-color: black;">
                        <tr style="border-color: black;">
                          <th style="border-color: black;">Constitutional & Legal Provisions</th>
                        </tr>
                      @if($indicator->qualitativemany($indicator->id))
                      @foreach($indicator->qualitativemany($indicator->id) as $dfd)
                      @if($dfd->policy_name == "Constitutional and Legal Provisions")
                      <tr style="border-color: black;">
                        <td style="border-color: black;">{{$dfd->legal_name}}</td>
                     </tr>
                      @endif
                       @endforeach
                      @endif
  </table>
                   </div>
                   <div class="col-md-6">
                     <table class="table table-bordered" style="border-color: black;">
                       <tr style="border-color: black;">
                         <th style="border-color: black;">Policy & Institutional Arrangements</th>
                       </tr>
                     @if($indicator->qualitativemany($indicator->id))
                     @foreach($indicator->qualitativemany($indicator->id) as $dfd)
                     @if($dfd->policy_name != "Constitutional and Legal Provisions")
                     <tr style="border-color: black;">
                       <td style="border-color: black;">{{$dfd->legal_name}}</td>
                     </tr>
                     @endif
                      @endforeach
                     @endif
 </table>
                  </div>

                  </div>
            </div>

        </div>
    </div>
</div>



@include('indicators.modals.add_data_source')
@include('indicators.modals.add_indicator_info')
@include('dashboard.modals.edit_indicator_info_parent')
@include('dashboard.modals.edit_indicator_child_parent')
@include('dashboard.modals.delete_indicator')
@include('dashboard.modals.delete_information')
@include('dashboard.modals.delete_information_child')
@include('dashboard.modals.edit_policy')
@include('indicators.modals.create_qualitative')
@endsection



@section('scripts')



<script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>



@include('indicators.script')
<!-- @include('indicators.indicator_script') -->

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>

<!-- Charts JS
============================================ -->

@endsection
