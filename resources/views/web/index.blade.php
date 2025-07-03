@extends('layouts.master')

@section('styles')
<style>
html, body {
	height: 100%;
	margin: 0;
	padding: 0;
	font-family: 'helvetica', sans-serif;
}

.hero {
	background-color: #EEEEEE;
	width: 100%;
	height: 100%;
	max-height: calc(100% - 50px);
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
		h1 {
			color: rgb(162, 65, 135);
			font-weight: 300;
			text-transform: uppercase;
			margin-bottom: 0;
			font-size: 40px;
			/* border-bottom: 2px rgba(163,32,109,0.6) dashed; */
		}


	.overlay {
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: transparent;
		background: -moz-linear-gradient(top,  rgba(114,81,109,0.2) 0%, rgba(238,238,238,1) 100%);
		background: -webkit-linear-gradient(top,  rgba(114,81,109,0.2) 0%,rgba(238,238,238,1) 100%);
		background: linear-gradient(to bottom,  rgba(114,81,109,0.2) 0%,rgba(238,238,238,1) 100%);
		z-index: 3;
	}
	.background {
		width: 100%;
		height: 100%;
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background-color: #EEEEEE;
		background-size: cover;
		background-image: url("{{ asset('assets/sam20.png')}}");
		z-index: 1;
  }
		#hero-canvas {
			width: 100%;
			height: 100%;
			position: fixed;
		}

</style>

<style>

.mydiv{
	padding: 30px;
background: #ffffffde;
border-radius: 10px;
  transition: 0.3s;

}

.mydiv:hover{
	box-shadow: 0px 4px 3px 2px #cf9fce;
	transform: scale(1.1);
}
</style>

<style>

/* .nav a:hover {
  background-color: #005f5f;
}

.nav a.active {
  background-color: #fff;
  color: #444;
  cursor: default;
} */

@media screen and (max-width: 400px) {

.button{
	font-size:10px;
	width: 90%;

}
}


.main-content{
margin-top: 2%;

}

.button{
	background-image: linear-gradient(to right, #8858AA , #D77EDB);
	color: white;
	border-radius: 50px;
	border:0px;
	width: 80%;
	font-size: 15px;
	font-weight: bold;
	padding-top: 5%;
	padding-bottom: 5%;
}
@media screen and (max-width: 420px) {

h1{
   font-size:23px !important;
}
.button{

	font-size: 11px;
	width: 100%;
}
}

</style>
@endsection

@section('content')
	<div class="row main-content">
		<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12" style="margin-left:5%">

			<h1 style="color: black;">National <br> <b style="color: #b294ce;"> Gender </b> Data <br> Portal</h1>
				
			<ul style="font-size: 14px;text-align:justify;margin-top:2%;width:70%;color:black">
				<li>
				Dynamic and interactive information portal.</li>
				<li>Collates statistics and knowledge on indicators related to women.</li>
				<li>Allows evidence-based gender analysis for legislative, policy and programmatic recommendations.</li>
				<li>Supports the Government of Pakistan to report on international obligations on gender.</li>

			</ul>

		</div>
		<div class="col-md-6">
			
		</div>


		<!-- <p>
			<span><a href="https://dribbble.com/MDesignsuk"><i class="fa fa-dribbble" aria-hidden="true"></i></a></span>
			<span><a href="https://twitter.com/MDesignsuk" target="_blank"><i class="fa fa-twitter"></i></a></span>
			<span><a href="https://github.com/Mario-Duarte/" target="_blank"><i class="fa fa-github"></i></a></span>
			<span><a href="https://bitbucket.org/Mario_Duarte/" target="_blank"><i class="fa fa-bitbucket"></i></a></span>
			<span><a href="https://codepen.io/MarioDesigns/" target="_blank"><i class="fa fa-codepen"></i></a></span>
		</p>
		<p class="small">by: Mario Duarte</p> -->
	</div>
	<div class="row"  style="margin-top: 3%;margin-bottom: 3%;">
		<div class="col-md-3 col-lg-3 col-sm-5 col-xs-6" >
		 <a href="{{route('genderStatistics')}}" class="btn button" style="float: right;"> GENDER STATISTICS &nbsp;	</a>
		</div>
		<div class="col-md-3 col-lg-3 col-sm-5 col-xs-6">
		<a href="{{route('knowledgehubHome')}}" class="btn button"> KNOWLEDGE HUB &nbsp; 	</a>
		</div>
		<div class="col-md-6 col-lg-6 "></div>


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
