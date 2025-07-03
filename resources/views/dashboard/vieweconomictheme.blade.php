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

.indicator {
	background-color:white;
	padding-top: 0px;
	padding-bottom: 0px;
	height:420px !important;
	border: 2px solid #F2F2F2;
	border-radius: 8px;
	overflow: hidden;

	
	&-tags {
		margin: 0 -8px;
	}

	&-tag {
		display: inline-block;
		margin: 8px;
		font-size: .875em;
		text-transform: uppercase;
		font-weight: 600;
		letter-spacing: .02em;
		color: var(--primary);
	}

	
	&-metadata {
		margin: 0;
	}
	
	&-rating {
		font-size: 1.2em;
		letter-spacing: 0.05em;
		color: var(--primary);
		
		span {
			color: var(--grey);
		}
	}
	
	&-votes {
		font-size: .825em;
		font-style: italic;
		color: var(--lightgrey);
	}
	
	&-save {
		display: flex;
		align-items: center;
		padding: 6px 14px 6px 12px;
		border-radius: 4px;
		border: 2px solid currentColor;
		color: var(--primary);
		background: none;
		cursor: pointer;
		font-weight: bold;
		
		svg {
			margin-right: 6px;
		}
	}
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
    background-color: #555;
    top: 16px;
    color:black;
    z-index: 2;
    cursor: pointer;
}
span.arrow-left{
    left: 0px;
	font-size: 18px;
	font-weight: bold;
	padding: 0.5%;
    background-color: #c9d5db;

}
span.arrow-right{
    right: 0px;
	font-size: 18px;
	font-weight: bold;
	padding: 0.5%;
    background-color: #c9d5db;

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
    width: 15%;
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

@media screen and (min-width: 1400px) {
	.indicator {
	background-color:white;
	padding-top: 0px;
	padding-bottom: 0px;
	height:520px !important;
	border: 2px solid #F2F2F2;
	border-radius: 8px;
	overflow: hidden;
}
.indicator-box img{
	height:320px;
	width:100%};
}

@media screen and (max-width: 1300px) {
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


</style>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row" style="border-bottom:3px solid #E1818E">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<span class='arrow-left'><</span>
		<span class='arrow-right'>></span>
		<div class=' offer-pg-cont'>
			<ul class='offer-pg' style="display:inline-flex">
			@foreach($themes as $rows)

				<li class="portfolio-item @if($rows->id == $curr_theme->id)active_class  @endif" style="width:29% !important;list-style: none;background-color:#ccd6d6">
				<a href="{{route('viewtheme',['id' => encrypt($rows->id)])}}" ><h6 style="font-weight:bold">  {{$rows->name}}  </h6>	</a> 
				</li>
				@endforeach
			</ul>
		</div>

		</div>
	</div>

	<div class="row" > 
	@foreach($sub_theme_indicator1 as $rows)
		<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 indicator-card" id="indicator_card">

			<input type="hidden" id="indicator1_{{$loop->iteration}}" name="indicator" value="{{encrypt($rows->id)}}">
			<article class="indicator" style="box-shadow: 0 4px 8px 0 #d8c4ed, 0 6px 20px 0 #d8c4ed;">
			
				<div class="indicator-content" style="height: 220px;">
				
					<h1 class="indicator-title" id="indicator-title1_{{$loop->iteration}}" style="font-size:44px;display:inline-flex"><a href="#"></a></h1>&nbsp;<span><small style="font-weight:bold;font-size:15px" id="indicator-unit1_{{$loop->iteration}}"></small></span>
					<br>
					<br>

					<a href="{{route('indicators',['id' => encrypt($rows->id)])}}" target="_blank" style="margin-top:-20px !important;color:purple !important"><h5 class="indicator-desc"><b> {{$rows->data_requirement}} </b></h5>	</a>

					<h5 class="indicator-source-name" style="font-weight:bolder;font-size:13px;" id="indicator-source-name1_{{$loop->iteration}}"> </h5>

					<a style="font-weight:bolder;margin-top:1%;font-size:13px;" target="_blank" href="{{route('indicators',['id' => encrypt($rows->id)])}}">More Details...</a>
					<br>
					<br>

					
				</div>
				
				<div class="indicator-box">
						
					<canvas id="chart-line1_{{$loop->iteration}}" class="chartjs-render-monitor" style="display: block;margin-left:2%;"></canvas>
									
				</div>
			</article>
		</div>
		@endforeach
	@if(isset($map_indicator1))
    @foreach($map_indicator1 as $rows)
	@php($indicator_info = $rows->getNationalLevelIndicator($rows->id))
		<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 indicator-card" id="indicator_card">

		<input type="hidden" id="map_indicator_{{$loop->iteration}}" name="indicator" value="{{encrypt($rows->id)}}">

		<article class="indicator" style="box-shadow: 0 4px 8px 0 #d8c4ed, 0 6px 20px 0 #d8c4ed;">

		<div class="indicator-content">
				
				<h1 class="map-indicator-title indicator-title" id="map-indicator-title_{{$loop->iteration}}" style="font-size:44px;display:inline-flex"><a href="#"></a></h1>&nbsp;<span><small style="font-weight:bold;font-size:15px" id="map-indicator-unit_{{$loop->iteration}}"></small></span>
			
				
				<a href="{{route('indicators',['id' => encrypt($rows->id)])}}" target="_blank" style="color:purple !important">
				<h5 class="indicator-desc"><b> {{$rows->data_requirement}} </b></h5>	
				</a>

				<h5 class="indicator-source-name" style="font-weight:bolder;font-size:13px;;" id="map-indicator-source-name_{{$loop->iteration}}"> </h5>

{{--
				<a style="font-weight:bolder;margin-top:1%;font-size:13px;" target="_blank" href="https://un-women.herokuapp.com/{{$curr_theme->id}}&{{$rows->id}}&{{$indicator_info->current_year}}&{{$indicator_info->data_source_name}}">More Details...</a>
				--}}
			</div>
			
	
			<div class="indicator-box">
		
			
					<img src="{{asset('assets/maps/'.$rows->id.'.png')}}" style="width:100% !important;" alt="">
			
			<span style="color: red;font-weight:bold;"> * <small> KP excluding NMDs</small> </span>
				
			
				

			</div>

		</article>
		</div>
@endforeach
	@endif
	</div>

	<div class="row"  style="margin-bottom: 5%;" > 
	@foreach($sub_theme_indicator2 as $rows)
		<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 indicator-card" id="indicator_card">

			<input type="hidden" id="indicator2_{{$loop->iteration}}" name="indicator" value="{{encrypt($rows->id)}}">
			<article class="indicator" style="box-shadow: 0 4px 8px 0 #d8c4ed, 0 6px 20px 0 #d8c4ed;">
			
				<div class="indicator-content" style="height: 220px;">
				
					<h1 class="indicator-title" id="indicator-title2_{{$loop->iteration}}" style="font-size:44px;display:inline-flex"><a href="#"></a></h1>&nbsp;<span><small style="font-weight:bold;font-size:15px" id="indicator-unit2_{{$loop->iteration}}"></small></span>

					<a href="{{route('indicators',['id' => encrypt($rows->id)])}}" target="_blank" style="margin-top:-20px !important;color:purple !important"><h5 class="indicator-desc"><b> {{$rows->data_requirement}} </b></h5>	</a>

					<h5 class="indicator-source-name" style="font-weight:bolder;font-size:13px;" id="indicator-source-name2_{{$loop->iteration}}"> </h5>

					<a style="font-weight:bolder;margin-top:1%;font-size:13px;" target="_blank" href="{{route('indicators',['id' => encrypt($rows->id)])}}">More Details...</a>
					<br>
					<br>
					
				</div>
				
				<div class="indicator-box">
						
					<canvas id="chart-line2_{{$loop->iteration}}" class="chartjs-render-monitor" style="display: block;margin-left:2%;"></canvas>
									
				</div>
			</article>
		</div>
		@endforeach

		@if(isset($map_indicator2->id))

<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 indicator-card" id="indicator_card">

<input type="hidden" id="map_indicator" name="indicator" value="{{encrypt($map_indicator2->id)}}">


<article class="indicator" style="box-shadow: 0 4px 8px 0 #d8c4ed, 0 6px 20px 0 #d8c4ed;">
	
	<div class="indicator-content">
		
		<h1 class="map-indicator-title indicator-title" id="indicator-title" style="font-size:44px;display:inline-flex"><a href="#"></a></h1>&nbsp;<span><small style="font-weight:bold;font-size:15px" id="map-indicator-unit"></small></span>
	
		<br>
		<br>
		<a href="{{route('indicators',['id' => encrypt($map_indicator2->id)])}}" style="color:purple !important">
		<h5 class="indicator-desc"><b> {{$map_indicator2->data_requirement}} </b></h5>	
		</a>

		<h5 class="indicator-source-name" style="font-weight:bold;" id="map-indicator-source-name"> </h5>

		<a style="font-weight:bolder;margin-top:1%;font-size:13px;" href="https://un-women.herokuapp.com/{{$curr_theme->id}}&{{$map_indicator2->id}}&{{$map_indicator2->current_year}}&{{$map_indicator2->data_source_name}}">More Details...</a>

	</div>

	<div class="indicator-box">
		<img src="{{asset('assets/maps/'.$map_indicator2->id.'.png')}}" style="width:100% !important;" alt="">

	</div>

</article>
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
	for(count = 1; count<=2; count++)
	{
		getIndicatorGraphView1(count);

	}
    var count = 1;
	for(count = 1; count<=2; count++)
	{
		getIndicatorGraphView2(count);

	}
	var count = 1;
	for(count = 1; count<=2; count++)
	{
		getIndicatorMapView(count);

	}

});


function getIndicatorMapView(count)
{
	var curr_indicator_id = $("#map_indicator_"+count).val();

	var route = "{{url('indicatormapview')}}";
    var data_set = {"_token":"{{ csrf_token() }}","curr_indicator_id":curr_indicator_id};
    // showLoader();

    $.post(route,data_set,function(data){

		// $(".map-indicator-title_"+count).html(data.current_value);

		if(data.unit == "Number"){

		$("#map-indicator-title_"+count).html(data.current_value);

		$("#map-indicator-unit_"+count).html('');
		}
		else{

			if(data.unit == "%"){
				var current_value = parseFloat(data.current_value);
				$("#map-indicator-title_"+count).html(current_value.toFixed(1));
				$("#map-indicator-unit_"+count).html(data.unit);

			}
			else{
				$("#map-indicator-title_"+count).html(data.current_value);
				$("#map-indicator-unit_"+count).html(data.unit);
			}

			}

		// $("#map-indicator-unit").html(data.unit);
		$("#map-indicator-source-name_"+count).html(data.data_source_name);
	
    });

}


function getIndicatorGraphView1(count){

var curr_indicator_id = $("#indicator1_"+count).val();

var route = "{{url('indicatorgraphview')}}";
    var data_set = {"_token":"{{ csrf_token() }}","curr_indicator_id":curr_indicator_id};
    // showLoader();

    $.post(route,data_set,function(data){

		getIndividualIndicatorGraph1(data,count);
		
		if(data.national_info['unit'] == "Number"){

		$("#indicator-title1"+count).html(data.national_info['current_value']);

		$("#indicator-unit1_"+count).html('');
		}
		else{

		if(data.national_info['unit'] == "%"){
			var current_value = parseFloat(data.national_info['current_value']);
			$("#indicator-title1_"+count).html(current_value.toFixed(1));
			$("#indicator-unit1_"+count).html(data.national_info['unit']);

		}
		else{
			$("#indicator-title1_"+count).html(data.national_info['current_value']);
			$("#indicator-unit1_"+count).html(data.national_info['unit']);
		}

		}

		// $("#indicator-title1_"+count).html(data.national_info['current_value']);
		// $("#indicator-unit1_"+count).html(data.national_info['unit']);

		$("#indicator-source-name1_"+count).html(data.national_info['data_source_name']);
    });

}
function getIndicatorGraphView2(count){

var curr_indicator_id = $("#indicator2_"+count).val();

var route = "{{url('indicatorgraphview')}}";
    var data_set = {"_token":"{{ csrf_token() }}","curr_indicator_id":curr_indicator_id};
    // showLoader();

    $.post(route,data_set,function(data){

		getIndividualIndicatorGraph2(data,count);

		if(data.national_info['unit'] == "Number"){

			$("#indicator-title2"+count).html(data.national_info['current_value']);

			$("#indicator-unit2_"+count).html('');
			}
			else{

			if(data.national_info['unit'] == "%"){
				var current_value = parseFloat(data.national_info['current_value']);
				$("#indicator-title2_"+count).html(current_value.toFixed(1));
				$("#indicator-unit2_"+count).html(data.national_info['unit']);

			}
			else{
				$("#indicator-title2_"+count).html(data.national_info['current_value']);
				$("#indicator-unit2_"+count).html(data.national_info['unit']);
			}

			}

		// $("#indicator-title2_"+count).html(data.national_info['current_value']);
		// $("#indicator-unit2_"+count).html(data.national_info['unit']);

		$("#indicator-source-name2_"+count).html(data.national_info['data_source_name']);
    });

}

function getIndividualIndicatorGraph1(data,count){

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
    if(parseInt(data.data1[0].info1) > 0)
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
            borderColor: "green",
            backgroundColor: 'green',
            fill: false
        };
    }

	var ctx = $("#chart-line1_"+count);

	var myLineChart = new Chart(ctx, {
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
		}
		}]
		}
	}
	});

}

function getIndividualIndicatorGraph2(data,count){

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
    if(parseInt(data.data1[0].info1) > 0)
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
            borderColor: "green",
            backgroundColor: 'green',
            fill: false
        };
    }

	var ctx = $("#chart-line2_"+count);

	var myLineChart = new Chart(ctx, {
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
		}
		}]
		}
	}
	});

}

</script>

@endsection
