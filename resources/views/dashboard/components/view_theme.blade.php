@foreach($indicator_list as $rows)
		<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 indicator-card" id="indicator_card" >

			<input type="hidden" id="indicator_{{$loop->iteration}}" name="indicator" value="{{encrypt($rows->id)}}">

			<article class="indicator">
				
				<div class="indicator-content" >
				
					<h1 class="indicator-title" id="indicator-title_{{$loop->iteration}}" style="font-size:44px;display:inline-flex"><a href="#"></a></h1>&nbsp;<span><small style="font-weight:bold;font-size:15px" id="indicator-unit_{{$loop->iteration}}"></small></span>
					<br>
					<br>

					<a href="{{route('indicators',['id' => encrypt($rows->id)])}}" style="color:purple !important"><h5 class="indicator-desc"><b> {{$rows->data_requirement}} </b></h5>	</a>

					<h5 class="indicator-source-name" style="font-weight:bold" id="indicator-source-name_{{$loop->iteration}}"> </h5>

					<a style="margin-top:1%" href="{{route('indicators',['id' => encrypt($rows->id)])}}">More Details...</a>

					
				</div>
				<div class="indicator-box">
						
					<div style="width:430px !important">
				
						<canvas id="chart-line_{{$loop->iteration}}" width="299" height="160" class="chartjs-render-monitor" style="display: block; width: 371px !important; height: 200px;"></canvas>
				
					</div>
				


				</div>
			</article>
		</div>
		@endforeach

	@if(isset($map_indicator->id))
		<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 indicator-card" id="indicator_card">

		<input type="hidden" id="map_indicator" name="indicator" value="{{encrypt($map_indicator->id)}}">


		<article class="indicator">
			
			<div class="indicator-content">
				
				<h1 class="map-indicator-title indicator-title" id="indicator-title" style="font-size:44px;display:inline-flex"><a href="#"></a></h1>&nbsp;<span><small style="font-weight:bold;font-size:15px" id="map-indicator-unit"></small></span>
			
				<br>
				<br>
				<a href="{{route('indicators',['id' => encrypt($map_indicator->id)])}}" style="color:purple !important">
				<h5 class="indicator-desc"><b> {{$map_indicator->data_requirement}} </b></h5>	
				</a>

				<h5 class="indicator-source-name" style="font-weight:bold;" id="map-indicator-source-name"> </h5>


				<a style="margin-top:1%" href="{{route('indicators',['id' => encrypt($map_indicator->id)])}}">More Details...</a>

			</div>
		
			<div class="indicator-box">
				<div style="width:350px !important">
			
					<img src="{{asset('assets/maps/'.$map_indicator->id.'.png')}}" style="width:100% !important;margin-left:5%" alt="">
			
				</div>
				

			</div>

		</article>
		</div>

	@endif