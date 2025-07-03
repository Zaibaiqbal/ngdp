@extends('layouts.master')

@section('styles')
<style>

  #map {
    width: 600px;
    height: 400px;
  }
  .clickable{
    cursor: pointer;
}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<link href="{{ asset('assets/mycss.css') }}" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container breadcome-area mg-b-30">
    <div class="row breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top: 30px;
            border-radius: 10px !important;" >


        <div class="col-md-12">
            <h4 style="display:inline;"> <a href="{{ route('home')}}" class="btn-xs btn-primary" style="border-radius:150px;"><i class="fa fa-arrow-left"></i> </a> &nbsp;&nbsp;  {{$indicator->subTheme->name}}

            </h4>
            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
                <!-- <div class="col-md-12">
                <h4 style="padding-left: 25px;"><u>Main Indicator</u></h4>
                </div> -->
                <!-- <a class="btn btn-xs btn-primary pull-right" style="margin-left: 5px;" href="#" data-toggle="modal" data-target="#addindicatorInfochild"><i class="fa fa-plus"></i> Sub Indicator</a> -->
                <a class="btn btn-xs btn-primary pull-right" href="#" data-toggle="modal" data-target="#addindicatorInfo"><i class="fa fa-plus"></i> Indicator</a>
                @endif
        </div>
        <div class="col-md-12">
            <div class="panel-group adminpro-custon-design" style="width:100%;margin-top:3%" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading accordion-head">
                        <h4 class="panel-title" >
                            <a data-toggle="collapse"  data-parent="#accordion" href="#subthemecollaspe" onclick="setico()">
                            <i id="myico" class="fa fa-plus"></i> {{$indicator->data_requirement}} 
                        <!-- <p style="margin-top:5px;padding-left: 15px;
                            color: #a24187;" class="" data-toggle="collapse" data-parent="#accordion" href="#subthemecollaspe"><u>For more information / See more</u></p> -->
                            </a> 
                    

                        @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
                            <a class="compose-discard-bt pull-right"  href="#" data-toggle="modal" data-target="#deleteIndi"><i class="fa fa-trash-o"></i> </a>
                        @endif
                        </h4>
                    </div>


                    <div id="subthemecollaspe" class="panel-collapse panel-ic collapse">
                        <div class="panel-body admin-panel-content animated bounce">

                            <table class="table">
                            @if(isset($indicator->beijing->id))
                            <tr>
                                <td>Beijing +25</td>
                                <td>{{$indicator->beijing->target_number}}
                                {{$indicator->beijing->indicator_name}}</td>
                            </tr>
                            @endif

                            @if($indicator->getregsdg($indicator->id)->count() > 0)
                            @foreach($indicator->getregsdg($indicator->id) as $rows)
                            @if($rows->getgoals($rows->target_id)->count() > 0)
                            <tr>
                                <th>SDG Goal</th>
                                <td>{{$rows->getgoals($rows->target_id)->goal_number}}.
                                {{$rows->getgoals($rows->target_id)->goal_name}}</td>
                            </tr>
                            @endif
                            @if($rows->gettargets($rows->target_id)->count() > 0)
                            <tr>
                                <th>SDG Target</th>
                                <td>{{$rows->gettargets($rows->target_id)->target_number}}.
                                {{$rows->gettargets($rows->target_id)->target_name}}</td>
                            </tr>
                            @endif
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
            </div>
        
        </div>
      

</div>

    <!-- FILTERS START-->
    <div class="col-md-4" style="margin-top:15px;" >

        <div class="row">
            <div class="col-md-12">

            <div class="panel panel-success">
            <div class="panel-heading">
            <h3 class="panel-title">Select Source/Year</h3>
            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
            </div>
            <div class="panel-body" style="padding: 0px;">
            <div class="row" style="padding:15px;margin-top: 0px;border-radius: 10px;">
            <div class="col-md-12">
                <label>Select source </label>
                <select class="form-control form-control-sm" name="data_source" id="data_source" onchange="getsurveyyear()">
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


            <div class="col-md-12" style="display:none;" id="filterdiv">

            </div>

            </div>
            </div>
            </div>




            </div>
        </div>
    
    </div>

    <!-- YEAR FILLTER END -->
    



    </div>


</div>


@endsection

@section('scripts')

@include('indicators.script')

@endsection