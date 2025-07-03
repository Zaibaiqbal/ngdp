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
  margin-bottom:19%;
}
h2{
	font-size: 30px;
}
h4{
	font-size: 13px !important;
}
.theme-main-section{
	margin-left:70px !important;
}
.img-class{

	width: 60% !important;
	margin-top: 20% !important;
}

}

@media only screen and (min-width: 450px) {
.main-section{
  margin-bottom:6%;
}
.theme-main-section{
	margin-left:30px !important;
}

}
</style>


@endsection

@section('content')

	<div class="row" style="margin-top: 1%;">
		<div class="col-md-12" style="text-align: center;">
		<h2><b style="color: #A24787;">Gender Statistics</b></h2>

		</div>
	</div>

		<div class="row theme-main-section" style="margin:0px;text-align:center;">

			@foreach($themes as $rows)
			<div class="col-xl-2 col-md-2 col-lg-2 col-sm-3 col-xs-6 mydiv " style="margin-top:20px;margin-left: 30px;height: 150px;border: 2px solid #a24187;">
			
				<a href="{{route('viewtheme',['id' => encrypt($rows->id)])}}"> <img src="{{asset(EF::retriveFileLink($rows->image))}}" class="img-class" alt="" style="width:40%;margin-top:5%;">
				<h4 style="
				text-align: center;
				;font-weight:bold;color:#A24787;font-size:15px;margin-top:16px;">{{$rows->name}}</h4></a>
				
			</div>
			@endforeach
	</div>

	<div class="row main-section">
		<!-- <div class="col-md-2"></div> -->
		<div class="col-md-12" style="margin-top:40px;text-align:center">
	<!-- <img src="{{ asset('img/kh.png') }}" alt="" style="width:30%">
	<h3>Knowledge Hub</h3> -->
	<a href="{{route('home')}}" class="btn btn-primary" style="margin-top:10px;background: #c35fa7;
    border: 0px;">Click to Proceed &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
	</div>
	</div>

	

		<!-- <p>
			<span><a href="https://dribbble.com/MDesignsuk"><i class="fa fa-dribbble" aria-hidden="true"></i></a></span>
			<span><a href="https://twitter.com/MDesignsuk" target="_blank"><i class="fa fa-twitter"></i></a></span>
			<span><a href="https://github.com/Mario-Duarte/" target="_blank"><i class="fa fa-github"></i></a></span>
			<span><a href="https://bitbucket.org/Mario_Duarte/" target="_blank"><i class="fa fa-bitbucket"></i></a></span>
			<span><a href="https://codepen.io/MarioDesigns/" target="_blank"><i class="fa fa-codepen"></i></a></span>
		</p>
		<p class="small">by: Mario Duarte</p> -->
	


@endsection


@section('scripts')
<script>

</script>
@endsection
