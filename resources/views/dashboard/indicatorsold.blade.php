@extends('layouts.master')

@section('styles')
<style>

  #map {
    width: 600px;
    height: 400px;
  }

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

@endsection

@section('content')<!-- Breadcome start-->
<div class="breadcome-area mg-b-30"  >
    <div class="container">
        <div class="row" >
            <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top: 30px;
                    border-radius: 10px !important;">
                    <div class="breadcome-heading">
                        <h2> <a href="{{ route('home')}}" class="btn-xs btn-primary" style="border-radius:150px;"><i class="fa fa-arrow-left"></i> </a> &nbsp;&nbsp;  {{$indicator->subTheme->name}}</h2>

                        <table class="table">
                          @if($indicator->beijing)
                          <tr>

                            <td>{{$indicator->beijing->target_number}}.
                            {{$indicator->beijing->indicator_name}}</td>
                          </tr>
                          @endif
                          @if($indicator->getgoals($indicator->target_id)->count() > 0)
                          <tr>
                            <td>{{$indicator->getgoals($indicator->target_id)->goal_number}}.
                            {{$indicator->getgoals($indicator->target_id)->goal_name}}</td>
                          </tr>
                          @endif
                          @if($indicator->gettargets($indicator->target_id)->count() > 0)
                          <tr>
                            <td>{{$indicator->gettargets($indicator->target_id)->target_number}}.
                            {{$indicator->gettargets($indicator->target_id)->target_name}}</td>
                          </tr>
                          @endif
                          <tr>
                            <td>
                            <b>{{$indicator->newindicator->indicator_number}}. {{$indicator->data_requirement}}</b>
                            </td>
                          </tr>
                          <!-- <tr>
                            <th>SDG</th>
                            <td>{{$indicator->sdg->name}}</td>
                            <th>CEDAW Link</th>
                            <td>{{$indicator->qualitative->links}}</td>
                          </tr> -->

                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcome End-->
<div class="adminpro-accordion-area">
    <div class="container">

        <div class="row">
          <div class="col-lg-3">
              <div class="admintab-wrap mg-b-40">
                  <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1">
                      <li class="active" style="width:50%"><a data-toggle="tab" href="#TabProject" style="padding: 8px;"><span class="adminpro-icon adminpro-analytics tab-custon-ic"></span>Filters</a>
                      </li>
                      <!-- <li style="width:33%;"><a data-toggle="tab" href="#TabDetails" style="padding: 8px;"><span class="adminpro-icon adminpro-analytics-arrow tab-custon-ic"></span>Share</a>
                      </li> -->
                      <li style="width:50%;"> <a data-toggle="tab" href="#TabPlan" style="padding: 8px;"><span class="adminpro-icon adminpro-analytics-bridge tab-custon-ic"></span>Options</a>
                      </li>
                  </ul>
                  <div class="tab-content" style="background: white;
    padding: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                      <div id="TabProject" class="tab-pane in active animated flipInX custon-tab-style1">
                        <p>Filter Records</p>
                        <div class="row">



                              <div class="col-md-12">
                                <label>Data Source / Department</label>
                                <select class="form-control" name="data_source" id="data_source">
                                  <option value="all">All</option>
                                  @foreach($info2 as $data)
                                  <option value="{{$data->data_source_name}}">{{$data->data_source_name}}</option>
                                  @endforeach
                                </select>
                              </div>


                          <div class="col-md-12">
                            <label>Year</label>
                            <input value="{{Crypt::encrypt($indicator->id)}}" type="hidden" name="indicator_id" id="indicator_id"/>

                            <select class="form-control" name="year" id="year">
                              <option value="all">All</option>
                              <option value="2020">2020</option>
                              <option value="2019">2019</option>
                              <option value="2018">2018</option>
                              <option value="2017">2017</option>
                              <option value="2016">2016</option>
                              <option value="2015">2015</option>
                              <option value="2014">2014</option>
                              <option value="2013">2013</option>
                              <option value="2012">2012</option>
                              <option value="2011">2011</option>
                              <option value="2010">2010</option>
                            </select>
                          </div>


                          <div class="col-md-12">
                            <label>Type</label>
                            <select class="form-control" name="type" id="type">
                              <option value="all">All</option>
                              <option value="national">National/Pakistan</option>
                              @foreach($provinces as $prop)
                              <option value="{{$prop->id}}">{{$prop->title}}</option>
                              @endforeach


                            </select>
                          </div>




                          <div class="col-md-12" style="margin-top:10px;">
                            <button onclick="filterindicator()" class="btn btn-success">Search</button>
                          </div>

                        <!-- </form> -->
                        </div>
                          </div>
                      <!-- <div id="TabDetails" class="tab-pane animated flipInX custon-tab-style1">
                        <div class="button-style-four social-btn-icon-cl btn-mg-b-10">
                            <button type="button" class="btn btn-custon-four btn-default"><span class="adminpro-icon adminpro-facebook"></span>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><span class="adminpro-icon adminpro-twitter"></span>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><span class="adminpro-icon adminpro-google-plus"></span>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><span class="adminpro-icon adminpro-pinterest"></span>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><span class="adminpro-icon adminpro-linkedin"></span>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><i class="fa fa-youtube" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><i class="fa fa-dropbox" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><i class="fa fa-digg" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><i class="fa fa-dribbble" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><i class="fa fa-edge" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-custon-four btn-default"><i class="fa fa-skype" aria-hidden="true"></i>
                            </button>
                        </div>
                          </div> -->
                      <div id="TabPlan" class="tab-pane animated flipInX custon-tab-style1">
                        <div class="view-mail-action view-mail-ov-d-n" style="position: relative;">
                            <!-- <a href="#"><i class="fa fa-reply"></i> Reply</a> -->
                             @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
                            <a class="compose-info-bt" href="#" data-toggle="modal" data-target="#addindicatorInfo"><i class="fa fa-plus"></i> Add info</a>
                        </br></br>    <a class="compose-info-bt" href="#" data-toggle="modal" data-target="#addindicatorInfochild"><i class="fa fa-plus"></i> Add info Child</a>
<!--
                            <a class="compose-draft-bt" href="#" data-toggle="modal" data-target="#editPolicy"><i class="fa fa-pencil"></i> Edit</a>
  </br></br>
                            <a class="compose-discard-bt" href="#" data-toggle="modal" data-target="#deleteIndi"><i class="fa fa-trash-o"></i> Delete</a> -->
                            @endif
                          </br></br>
                        </div>
                        </div>
                  </div>
              </div>
          </div>
            <div class="col-lg-9">
                <div class="admintab-wrap">
                    <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1 tab-menu-right">
                        <li class="active pull-right"><a data-toggle="tab" href="#TabProject2"><span class="adminpro-icon adminpro-analytics tab-custon-ic"></span>Data</a>
                        </li>
                        <!-- <li class="pull-right"><a data-toggle="tab" href="#TabDetails2"><span class="adminpro-icon adminpro-analytics-arrow tab-custon-ic"></span>Graphs</a>
                        </li>
                        <li class="pull-right"><a data-toggle="tab" href="#TabPlan2"><span class="adminpro-icon adminpro-analytics-bridge tab-custon-ic"></span>MetaData</a>
                        </li> -->
                        <li class="pull-right"><a data-toggle="tab" href="#TabPlan3"><span class="adminpro-icon adminpro-analytics-bridge tab-custon-ic"></span>Qualitative</a>
                        </li>
                        <!-- <li class="pull-right"><a data-toggle="tab" href="#TabPlan3"><span class="adminpro-icon adminpro-analytics-bridge tab-custon-ic"></span>Map</a>
                        </li> -->
                    </ul>
                    <div class="tab-content" style="background:white; padding:15px; border-top-left-radius:10px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;margin-right: 2px;">
                        <div id="TabProject2" class="tab-pane in active animated flipInY custon-tab-style1">
                          <!-- <div class="sparkline13-graph">
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
                                              <th data-field="state" data-checkbox="true"></th>
                                              <th data-field="id">Sr No</th>
                                              <th data-field="name" data-editable="true">Data Source</th>
                                              <th data-field="email" data-editable="true">Source Link</th>
                                              <th data-field="phone" data-editable="true">Data Last Updated</th>
                                              <th data-field="action">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td></td>
                                              <td>1</td>
                                              <td>SDG-3 Target 3.7</td>
                                              <td>Age, Location</td>
                                              <td>Age, Location</td>
                                              <td class="datatable-ct"><i class="fa fa-gear"></i>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div> -->

                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="admin-pro-accordion-wrap mg-b-40 shadow-reset" style="padding:10px;">
                                      <!-- <div class="alert-title">
                                          <h2>Animate bounce Accordion</h2>
                                          <p>These are the Custom bootstrap Animate bounce Accordion style 1</p>
                                      </div> -->
                                      <div class="panel-group adminpro-custon-design" id="accordion">
                                        @if($info2->count() == 0)
                                        <h4>No Information Added</h4>
                                        <br>
                                         @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
                                        <a class="compose-info-bt" href="#" data-toggle="modal" data-target="#addindicatorInfo"><i class="fa fa-plus"></i> Add Headline info</a>
                                        <!-- <a class="compose-info-bt" href="#" data-toggle="modal" data-target="#addindicatorInfo"><i class="fa fa-plus"></i> Add Chlid info</a> -->
                                        @endif
                                        @endif
                                        <div id="myindicatordata">
                                      @include('dashboard.indicatorsData')
                                        </div>
                                      </div>
                                  </div>
                              </div>

                          </div>
                        </div>
                        <!-- <div id="TabDetails2" class="tab-pane animated flipInY custon-tab-style1">


                                  <div id="chartContainer" style="height: 420px; width: 100%;"></div>
                              </div> -->
                        <!-- <div id="TabPlan2" class="tab-pane animated flipInY custon-tab-style1">
                          <h4>Data Source</h4>
                          <ul>
                            @foreach($data_source as $ff)
                            <li> {{$loop->iteration}} ) <a>{{$ff->data_source_name}}</a></li>
                            @endforeach
                          </ul>
                            </div> -->
                        <div id="TabPlan3" class="tab-pane animated flipInY custon-tab-style1">
                           @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
<a class="pull-right" href="#" data-toggle="modal" data-target="#qualitativeAdd"><i class="fa fa-plus"></i> Add Qualitative Indicator</a>
@endif
                          <h4>Constitutional & Legal Provisions</h4>
                          <ul>
                            @foreach($qualitative as $q)
                            @if($q->legal_name != "" || $q->legal_name != null)
                            <li> <i class="fa fa-dot-circle-o"></i>

                               <a>{{$q->legal_name}}</a>
                               @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
                               <a href="{{ route('legaldelete' , $q->id)}}"><i class="fa fa-trash pull-right"></i></a>
                               @endif
                             </li>
                            @else
                            <!-- <li></li> -->
                            @endif
                            @endforeach
                          </ul>
                          <hr>
                            <h4>Policy & Institutional Arrangements</h4>
                            <ul>
                              @foreach($qualitative as $q)
                              @if($q->policy_name != "" || $q->policy_name != null)
                              <li> <i class="fa fa-dot-circle-o"></i> <a>{{$q->policy_name}}</a>
                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
                                <a href="{{ route('policydelete' , $q->id)}}"><i class="fa fa-trash pull-right"></i></a>
                                @endif
                              </li>
                              @else
                              <!-- <li>N/A</li> -->
                              @endif
                              @endforeach
                            </ul>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.modals.add_indicator_info')
@include('dashboard.modals.add_indicator_info_child')
@include('dashboard.modals.edit_indicator_info')
@include('dashboard.modals.delete_indicator')
@include('dashboard.modals.edit_policy')
@include('indicators.modals.create_qualitative')
@endsection


@section('scripts')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!-- Charts JS
============================================ -->
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Data & Stats"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}</strong>",
		indexLabel: "{name} - {y}",
		dataPoints: [
      @foreach($yearsum as $ys)
			{ y: '{{$ys->total}}', name: "{{$ys->last_updated}}", exploded: true },
      @endforeach

		]
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>
<script>
function sdgchange()
{
  var id = $("#sdg_id").val();

  $('#sdg_id option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('gettargets')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $('#targets').html(data);
      }
      else{
        alert('something went wrong');
      }
      }
      });
}
</script>
<script>
function checkheadline()
{
  var id = $("#headline_id").val();

  $('#headline_id option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('getdivisions')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
        document.getElementById("mydis").style.display = "block";
        document.getElementById("mydiv").style.display = "block";
      $('#division_id').html(data);
      $('#district_id').html("");
      }
      else{
        document.getElementById("mydis").style.display = "none";
        document.getElementById("mydiv").style.display = "none";
      }
      }
      });
}
</script>
<script>
function getdistricts()
{
  var id = $("#division_id").val();
  $('#division_id option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('getdistricts')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $('#district_id').html(data);
      }
      else{
        alert('something went wrong');
      }
      }
      });
}
</script>
<script>
@if(Session::has('success1'))
Lobibox.notify('success', {
    msg: '{!! Session::get('success1') !!}'
});
@endif
</script>

<script>
function setsource()
{

  if($("#data_source_name").val() == "Other")
  {
    document.getElementById("ddid").style.display = "block";
  }
  else{
    document.getElementById("ddid").style.display = "none";
  }
}
</script>
<script>
function setpro()
{

  if($("#survey_level").val() == "Provincial")
  {
    document.getElementById("prov").style.display = "block";
  }
  else{
    document.getElementById("prov").style.display = "none";
  }
}
</script>
<script>
function setsource()
{

  if($("#data_source_name1").val() == "Other")
  {
    document.getElementById("ddid1").style.display = "block";
  }
  else{
    document.getElementById("ddid1").style.display = "none";
  }
}
</script>
<script>
function editinfo(id,sourcename,last_updated,source_link)
{
  $("#data_source_name1").val(sourcename);
  $("#info_id").val(id);
  $("#source_link").val(source_link);
  // $("#lastyear").val(last_updated);
  // $("#editindicatorInfo").show();

}
</script>
<script>
function mydup()
{
  var $button = $('#setdup');
  $('#dup').clone().appendTo($button);
}
</script>

<script>
function filterindicator()
{
  var indicator_id = $("#indicator_id").val();
  var type = $("#type").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicators')}}",
      data:{"indicator_id":indicator_id,"type":type,"data_source":data_source,"year":year,"_token": "{{ csrf_token() }}"},
      success:function(data){
      $('#myindicatordata').html(data);
      }
      });
}
</script>
@endsection
