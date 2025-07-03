@extends('layouts.main')

@section('styles')
<style>
	
html, body {
	height: 100%;
	margin: 0;
	padding: 0;
	font-family: 'helvetica', sans-serif;
}



	.inner {
		position: relative;
		max-width: 960px;
		/* height: 100%; */
		margin: 0 auto;
		display: flex;
		flex-direction: column;
		flex-wrap: nowrap;
		justify-content: center;
		align-items: center;
		text-align: center;
		padding: 40px;
		box-sizing: padding-box;
		z-index: 4;
  }
		h2 {
			color: #b294ce;
			font-weight: 300;
			text-transform: uppercase;
			margin-bottom: 0;
			font-size: 40px;
			/* border-bottom: 2px rgba(163,32,109,0.6) dashed; */
		}
		p {
			color: #999999;
			margin-bottom: 0;
			font-size: 13px;
			line-height: 150%;
			/* max-width: 550px; */
			&.small {
				font-size: 12px;
			}
		}
		
		}
	}

	}
}

</style>

<style>

.mydiv{
	padding: 0px;
	background: #ffffffde;
	border-radius: 10px;
  transition: 0.3s;
 

}

.mydiv:hover{
	box-shadow: 0px 4px 3px 2px #cf9fce;
	transform: scale(1.1);
	background-color:#eddce9;
}

@media only screen and (max-width: 425px) {

.main-section{
  margin-bottom:10%;
}

.theme-main-section{
	margin-left:100px !important;
}
h2{
	font-size: 30px;
}
h4{
	font-size: 13px !important;
}

}

@media only screen and (max-width: 320px) {



.theme-main-section{
	margin-left:70px !important;
}


</style>

<style>

</style>
@endsection

@section('content')

	<div class="row" style="">
		<div class="col-md-12" style="text-align: center;">
		<h2><b style="color: #A24787;">knowledge hub</b></h2>


		</div>
	</div>

		<div class="row k_hub theme-main-section" style="text-align:center;margin-left:2%;">

			@foreach($theme_list as $rows)
			<div class="col-xl-2 col-md-2 col-lg-2 col-sm-6 mydiv " style="margin-top:20px;margin-left:1%;width: 156px;height: 140px;border: 2px solid #a24187;">
	
				<a href="{{route('knowledgehub',['id' => encrypt($rows->id)])}}" style=""> <img src="{{asset(EF::retriveFileLink($rows->image))}}" alt="" style="width:40%;margin-top:6%;">
				<h4 style="
				text-align: center;
				;font-weight:bold;color:#A24787;font-size:15px;">{{$rows->name}}</h4></a>
				
			</div>
			@endforeach
	</div>

	<div class="row main-section" style="margin-top: 1%;">
		<!-- <div class="col-md-2"></div> -->
		<div class="col-md-12" style="text-align:center;margin-bottom:5%;">
	<!-- <img src="{{ asset('img/kh.png') }}" alt="" style="width:30%">
	<h3>Knowledge Hub</h3> -->
	<a href="{{route('knowledgehub')}}" class="btn btn-primary" style="background: #c35fa7;
    border: 0px;">Click to Proceed &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
	</div>
	</div>

@endsection


@section('scripts')
<script>

let ww = $(window).width();
let wh = $(window).height();

// pure javascrip random function ============
function random(min, max) {
	return Math.random() * (max - min) + min;
}

</script>
@endsection
