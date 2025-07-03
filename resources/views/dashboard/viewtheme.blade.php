@extends('layouts.main')

@section('styles')
<style>


.indicator,
.indicator-box {
	flex-wrap: wrap;
	align-items: center;
}

.indicator-box {
	flex: 3 1 30ch;
	overflow: hidden;

	img {
		max-width: 100%;
		min-height: 100%;
		width: auto;
		height: auto;
		object-fit: cover;
		object-position: 50% 50%;
	}
}
.indicator-content{

	padding-right: 22px;
	padding-left: 22px;
	flex: 4 1 40ch;
	/* margin-bottom:13%; */
	padding-top: 3%;
}
	
.indicator-title {
	margin: 0;
	font-size: clamp(1.4em, 2.1vw, 2.1em);
	font-family: "Roboto Slab", Helvetica, Arial, sans-serif;
	}

.indicator-desc:hover{

	color:steelblue;

}



/* Body Layout */
* {
	box-sizing: border-box;
}

.indicator-card {
	padding: 14px;
}

.offer-pg-cont{
    width: 100%;
    overflow-x: hidden;
    margin: 0px;
}
span.arrow-left,span.arrow-right{
    display: block;
    position: absolute;
    background-color: #5555;
    top: 8px;
    color:black;
    z-index: 2;
    cursor: pointer;
}
span.arrow-left{
    left: 0px;
	font-size: 18px;
	font-weight: bold;
	padding: 0.5%;
    background-color: #5eaef1;

}
span.arrow-right{
    right: 0px;
	font-size: 18px;
	font-weight: bold;
	padding: 0.5%;
    background-color: #5eaef1;

}
span.arrow-left:hover,.offer-pg span.arrow-right:hover{
    background-color: #d8a9af;
}
.offer-pg{
    width: 1500px;
}
.item-wrapper.offer-con{
    background-color: #aeb899 !important;
}
.offer-con .left-item h4 {
    color: #fff;
    font-weight: normal;
    margin: 0px;
}
.offer-con .right-item{
    float: right;
    padding: 10px;
}
.offer-con .right-item h5{
    color: #cb9944;
    margin: 0px;
    font-size: 14px;
}
.offer-pg > .portfolio-item{
    background-color:white;
    margin-left:10px;
    float:left;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	text-align: center;
	vertical-align: center;
	
}

.portfolio-item:hover {

background-color: #A24787;
color: white !important;
font-weight: bolder;
cursor: pointer;

}
.portfolio-item a{
	color: black !important;


}
.portfolio-item a:hover{
	color: cadetblue !important;

}

.active_class{

	background-color: #9A95D8 !important;
	color: white !important;

}

.card{
	background-color:white;
	padding-left: 1% ;
	padding-right: 1% ;
	border: 2px solid #F2F2F2;
	border-radius: 8px;
	box-shadow: 0 4px 4px 0 #d8c4ed, 0 6px 8px 0 #d8c4ed;
	height: 450px;
}

@media screen and (min-width: 1400px) {
	.indicator {
	background-color:white;
	padding-top: 0px;
	padding-bottom: 0px;
	height:536px !important;
	border: 2px solid #F2F2F2;
	border-radius: 8px;
	overflow: hidden;
}
.indicator-box img{
	height:320px;
	width:100%;
}
}

@media screen and (max-width: 1350px) {
	.indicator {
	background-color:white;
	padding-top: 0px;
	padding-bottom: 0px;
	height:536px !important;
	border: 2px solid #F2F2F2;
	border-radius: 8px;
	overflow: hidden;
}
.indicator-box img{
	height:320px;
	width:100%; 
}
}


@media screen and (max-width: 1300px) {
	.indicator {
	background-color:white;
	padding-top: 0px;
	padding-bottom: 0px;
	height:440px !important;
	border: 2px solid #F2F2F2;
	border-radius: 8px;
	overflow: hidden;
}

}

@media screen and (max-width: 992px) {
	.indicator {
	background-color:white;
	padding-top: 0px;
	padding-bottom: 0px;
	height:420px !important;
	border: 2px solid #F2F2F2;
	border-radius: 8px;
	overflow: hidden;
}

.indicator-box img{
	height:240px;
};
}

@media only screen and (max-width: 425px) {

.theme-section{
	margin-bottom:10px !important;
}
.main-section{
	margin-bottom:9%;
}

}

@media only screen and (max-width: 325px) {

.theme-section{
	margin-bottom:10px !important;
}
.main-section{
	margin-bottom:11%;
}

}

</style>
@endsection

@section('content')
<div class="container-fluid">

	<div class="row" style="border-bottom:3px solid #E1818E">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<span class='arrow-left'><</span>
		<span class='arrow-right'>></span>
		<div class='offer-pg-cont'>
			<ul class='offer-pg' style="display:inline-flex">
			@foreach($themes as $rows)

				<li class="portfolio-item @if($rows->id == $curr_theme->id)active_class  @endif" style="width:100% !important;list-style: none;background-color:#ccd6d6">
				<a href="{{route('viewtheme',['id' => encrypt($rows->id)])}}" ><h6 style="font-weight:bold;font-size:13px;">  {{$rows->name}}  </h6>	</a> 
				</li>
				@endforeach
			</ul>
		</div>

		</div>

	</div>
	<div class="row main-section" style="margin-top:1%;" > 
	@foreach($indicator_list as $rows)
		<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 theme-section" >
			<div class="card h-100" style="background-color: white;">
			
				<div class="card-body" style="height: 220px;">
				<input type="hidden" id="indicator_{{$loop->iteration}}" name="indicator" value="{{encrypt($rows->id)}}">
	
				<h1 class="card-title" style="font-size:44px;display:inline-flex" id="title_{{$loop->iteration}}"></h1> <small style="font-weight:bold;font-size:15px" id="unit_{{$loop->iteration}}"></small>

				
					<p class="card-text">
					<a href="{{route('indicators',['id' => encrypt($rows->id)])}}" style="margin-top:-20px !important;color:purple !important">
						<b style="font-size: 14px;">
						{{$rows->data_requirement}}
						</b>
					</a>

					</p>
					<h5 class="indicator-source-name" style="font-weight:bolder;font-size:13px;" id="indicator-source-name_{{$loop->iteration}}"> </h5>

					<a style="font-weight:bolder;margin-top:1%;font-size:13px;" target="_blank" href="{{route('indicators',['id' => encrypt($rows->id)])}}">More Details...</a>

				</div>
			
				<div  style="">
					@if($rows->indicator_id == 131)

					<canvas id="chart-line_{{$loop->iteration}}"  class="chartjs-render-monitor" style="display: block;margin-left:2%;"></canvas>

					@elseif($rows->data_depiction == "Pie Chart")

					<div id="chartContainer_{{$loop->iteration}}" style="height: 210px; width: 80%;"></div>
					@else
					<canvas id="chart-line_{{$loop->iteration}}"  class="chartjs-render-monitor" style="margin-left:2%;"></canvas>

					@endif

				</div>
				
			
			</div>
		</div>
		@endforeach
	@if(isset($map_indicator->id))

	<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12" >
			<div class="card" style="background-color: white;">
			
				<div class="card-body" style="height: 190px;">
				<input type="hidden" id="map_indicator" name="indicator" value="{{encrypt($map_indicator->id)}}">
					
				<h1 class="card-title map-indicator-title " id="map-indicator-title" style="font-size:44px;display:inline-flex" ></h1> <small style="font-weight:bold;font-size:15px" id="map-indicator-unit"></small>

					<p class="card-text">
					<a href="{{route('indicators',['id' => encrypt($map_indicator->id)])}}" style="margin-top:-20px !important;color:purple !important">
						<b style="font-size: 14px;">
						{{$map_indicator->data_requirement}}
						</b>
					</a>

					</p>
					<h5 class="indicator-source-name" style="font-weight:bolder;font-size:13px;" id="map-indicator-source-name"> </h5>
{{--
					<a style="font-weight:bolder;margin-top:1%;font-size:13px;" target="_blank" href="https://un-women.herokuapp.com/{{$curr_theme->id}}&{{$map_indicator->id}}&{{$map_indicator->current_year}}&{{$map_indicator->data_source_name}}">More Details...</a>
					--}}
				</div>
				<img src="{{asset('assets/maps/'.$map_indicator->id.'.png')}}" style="width:100%; height:54%;" alt="">
			
			<span style="color: red;font-weight:bold;font-size:13px;"> * <small> KP excluding NMDs</small> </span>
			</div>
		</div>

	@endif
	</div>
</div>
@endsection


@section('scripts')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script type="text/javascript">



$(document).ready(function(){
    $(".arrow-left").click(function(){
        $(".offer-pg-cont").animate({scrollLeft: "-="+100});
    });
    $(".arrow-right").click(function(){
        $(".offer-pg-cont").animate({scrollLeft: "+="+100});
    });        
});




$('document').ready(function(){

	var count = 1;
	for(count = 1; count<=3; count++)
	{
		getIndicatorGraphView(count);

	}
	getIndicatorMapView();


});


function getIndicatorMapView()
{
	var curr_indicator_id = $("#map_indicator").val();

	var route = "{{url('indicatormapview')}}";
    var data_set = {"_token":"{{ csrf_token() }}","curr_indicator_id":curr_indicator_id};
    // showLoader();

    $.post(route,data_set,function(data){

		if(data.unit == "Number"){

		$("#map-indicator-title").html(data.current_value);

		$("#map-indicator-unit").html('');
		}
		else{

		if(data.unit == "%"){
			var current_value = parseFloat(data.current_value);
			$("#map-indicator-title").html(current_value.toFixed(1));
			$("#map-indicator-unit").html(data.unit);

		}
		else{
			$("#map-indicator-title").html(data.current_value);
			$("#map-indicator-unit").html(data.unit);
		}

		}

		$("#map-indicator-source-name").html(data.data_source_name);
	
    });

}

function getIndicatorGraphView(count){

var curr_indicator_id = $("#indicator_"+count).val();

var route = "{{url('indicatorgraphview')}}";
var data_set = {"_token":"{{ csrf_token() }}","curr_indicator_id":curr_indicator_id};
    // showLoader();

    $.post(route,data_set,function(data){
			if(data.data_depiction == "Pie Chart"){
				getIndividualIndicatorPieChart(data,count);
			}
			else if(data.indicator_id == 131)
			{
				getAccesstoJusticeIndicatorGraph(count);
			}
			else{
				getIndividualIndicatorGraph(data,count);
			}
		if(data.national_info['unit'] == "Number"){
			
			$("#title_"+count).html(data.national_info['current_value']);

			$("#unit_"+count).html('');
		}
		else{

			if(data.national_info['unit'] == "%" || data.national_info['unit'] == "Ratio"){
				if(data.national_info['current_value'] == "4.03")
				{
					// alert("helo");
				var current_value = parseFloat(data.national_info['current_value']);

				$("#title_"+count).html(current_value.toFixed(2));

				}
				else{
				var current_value = parseFloat(data.national_info['current_value']);

					$("#title_"+count).html(current_value.toFixed(1));
				}
				
				$("#unit_"+count).html(data.national_info['unit']);

			}
			else{
				$("#title_"+count).html(data.national_info['current_value']);
				$("#unit_"+count).html(data.national_info['unit']);
			}
	
		}

		$("#indicator-source-name_"+count).html(data.national_info['data_source_name']);
    });

}



function getIndividualIndicatorGraph(data,count){
var graph_count = -1;

graph_obj = [];

	if(data.data1[0].current_value > 0)
    {
    	graph_obj[++graph_count] =  {
			data: [data.data1[0].current_value],
			label: "Total",
			borderColor: "#458af7",
			backgroundColor: '#458af7',
			fill: false
    };
	}
    if(parseFloat(data.data1[0].info1) > 0)
    {

        graph_obj[++graph_count] = {
            data: [data.data1[0].info1],
            label: [data.data1[0].label1],
            borderColor: "#8e5ea2",
            backgroundColor: '#8e5ea2',
            fill: false
        };
    }
    
    if(parseInt(data.data1[0].info2) > 0)
    {

        graph_obj[++graph_count] = { 
            data: [data.data1[0].info2],
            label: [data.data1[0].label2],
            borderColor: 'green',
            backgroundColor: 'green',
            fill: false
        };
    }
	if(parseInt(data.data1[0].info3) > 0)
    {

        graph_obj[++graph_count] = { 
            data: [data.data1[0].info3],
            label: [data.data1[0].label3],
            borderColor: 'orange',
            backgroundColor: 'orange',
            fill: false
        };
    }

	var ctx = $("#chart-line_"+count);

	var myLineChart = new Chart(ctx, {
	axisY:{
       interval: 100
     },
	type: 'bar',
	data: {
		labels: ['National','',''],
		datasets:  
			graph_obj
		
	},
	options: {
		
	scales: {
		yAxes: [{
			ticks: {
					beginAtZero: true,
					},
		scaleLabel: {
		display: true,
		labelString: data.national_info['unit']
		},
		

		}]
		}
	}
	});

}

function getIndividualIndicatorPieChart(data,count){

	var total = 100 -data.data1[0].current_value;
var chart = new CanvasJS.Chart("chartContainer_"+count, {
// exportEnabled: true,
animationEnabled: true,
title:{
	text: ""
},
legend:{
	cursor: "pointer",
	itemclick: explodePie
},
data: [{
	type: "pie",
	showInLegend: true,
	toolTipContent: "{name}: <strong>{y}%</strong>",
	indexLabel: " {y}%",
	indexLabelPlacement: "inside",
	indexLabelFontColor: "white",
	indexLabelFontWeight: "bold",
	indexLabelFontSize:   15,
	indexLabelTextAlign: "right",
	dataPoints: [
		{ y: total, name: 'Total', exploded: true ,color: "#468AF7"},
		{ y: data.data1[0].info1, name: data.data1[0].label1 ,color: "#8650A2"},
	
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

function getAccesstoJusticeIndicatorGraph(index_count){

var ctx = $("#chart-line_"+index_count);

var myLineChart = new Chart(ctx, {
type: 'bar',
data: {
		labels: [],
		datasets: [
		// 	{
		// 	data: [0],
		// 	label: "National",
		// 	borderColor: "#458af7",
		// 	backgroundColor: '#458af7',
		// 	fill: false
		// },  
		{
			data: [2],
			label: "Punjab",
			borderColor: "green",
			backgroundColor: 'green',
			fill: false
		},
		{
			data: [2],
			label: "Sindh",
			borderColor: "blue",
			backgroundColor: 'blue',
			fill: false
		},
		{
			data: [1],
			label: "KPK",
			borderColor: "orange",
			backgroundColor: 'orange',
			fill: false
		},   
	  ],
		
	},
options: {
    
  scales: {
    yAxes: [{
        ticks: {
                 beginAtZero: true,
                },
    scaleLabel: {
    display: true,
    labelString: "%"
    }
    }]
    }
}
});

}

</script>

@endsection