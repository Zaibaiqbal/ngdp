@extends('layouts.main')

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
			font-size: 50px;
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
			a {
				display: inline-block;
				font-size: 22px;
				color: rgba(163,32,109,0.4);
				margin: 0 10px;
				transform: rotateY(0deg);
				transition: transform 0.2s ease-in-out, color 0.2s linear;
				&:hover {
					color: rgba(163,32,109,0.8);
					transform: rotateY(360deg);
					transition: transform 0.6s ease-in-out, color 0.4s linear;
				}
			}
		}
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
		background-image: url("{{ asset('assets/sam20.jpg')}}");
		z-index: 1;
  }
		#hero-canvas {
			width: 100%;
			height: 100%;
			position: fixed;
		}
	}
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
.nav ul {
  list-style: none;
  background-color: #f5f5f5cf;
  /* text-align: center; */
  padding: 0;
  margin: 0;
}
.nav li {
  font-family: 'Oswald', sans-serif;
  font-size: 1.2em;
  line-height: 40px;
  height: 40px;
  border-bottom: 1px solid #888;
}

.nav a {
  text-decoration: none;
  color: #fff;
  display: block;
  transition: .3s background-color;
}

/* .nav a:hover {
  background-color: #005f5f;
}

.nav a.active {
  background-color: #fff;
  color: #444;
  cursor: default;
} */

@media screen and (min-width: 600px) {
  .nav li {
    width: 120px;
    border-bottom: none;
    height: 50px;
    line-height: 50px;
    font-size: 1.4em;
  }

  /* Option 1 - Display Inline */
  .nav li {
    display: inline-block;
    margin-right: -4px;
  }

  /* Options 2 - Float
  .nav li {
    float: left;
  }
  .nav ul {
    overflow: auto;
    width: 600px;
    margin: 0 auto;
  }
  .nav {
    background-color: #444;
  }
  */
}
@media screen and (max-width: 420px) {

 h1{
	font-size:23px !important;
}

}

</style>
@endsection

@section('content')
<header style="z-index: 4;
	position: relative;
	width: 100%;">
		<div class="nav" >
			<ul style="padding-left:10px;padding-right:10px;padding-top:10px">
				<li class="home"><a href="#"><img src="{{ asset('img/logos/4.png')}}"></img></a></li>

					<li class="home" style="float:right;"><a href="#"><img src="{{ asset('img/unw.png')}}"></img></a></li>
				<!-- <li class="tutorials"><a href="#">Tutorials</a></li> -->
			</ul>
		</div>
	</header>
<div class="container hero">

	<div class="inner">

		<h1><b>National Gender Da54t45ta Portal</b></h1>
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
			<p style="color: white;
				margin-top: 45px;
				background: #a24187b5;
				padding: 20px;
				border-radius: 10px;text-align: justify;">The National Gender Data Portal is a centralized and interactive information portal hosted by NCSW. The portal aims to share gender disaggregated statistics, statistics on women and gender analysis. Indicators, statistics and knowledge products are available here in a form relevant for decision-makers and data users for their analysis, advocacy, policy and planning needs. Such sex-disaggregated data will support evidence based planning to bridge gender gap in public and private life as well as gender monitoring and policy alignment.</p>
						
			</div>
		
		</div>
		
		<div class="row" style="margin:0px;">
			<div class="col-lg-5 col-md-5 col-sm-6 mydiv " style="margin-top:40px;">
		  <img src="{{ asset('img/gp.png') }}" alt="" style="width:30%">
			<h3>Gender Statistics</h3>
			<a href="{{ route('login')}}" class="btn btn-primary" style="margin-top:10px;background: #c35fa7;
    border: 0px;">Continue <i class="fa fa-arrow-right"></i></a>
		</div>
		<div class="col-lg-2 col-md-2 "></div>
		<div class="col-md-5 col-sm-6 mydiv" style="margin-top:40px;">
	<img src="{{ asset('img/kh.png') }}" alt="" style="width:30%">
	<h3>Knowledge Hub</h3>
	<a href="{{route('knowledgehub')}}" class="btn btn-primary" style="margin-top:10px;background: #c35fa7;
    border: 0px;">Continue <i class="fa fa-arrow-right"></i></a>
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
	</div>
	<div class="overlay"></div>
	<div class="background">
		<canvas id="hero-canvas" width="1920" height="1080" ></canvas>
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

window.requestAnimFrame = (function() {
	return window.requestAnimationFrame ||
		function(callback, element) {
			window.setTimeout(callback, 1000 / 60);
		};
})();

function init() {} //end init

function animate() {
	requestAnimFrame(animate);
	draw();
}

function draw() {

	//setup canvas enviroment
	let time = new Date().getTime() * 0.002;
	//console.log(time);
	const color1 = "rgba(163,32,109,0.3)";
	const color2 = "rgba(154,25,172,0.4)";
	let canvas = document.getElementById("hero-canvas");
	let ctx = document.getElementById("hero-canvas").getContext("2d");
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	ctx.save();

	// random float to be used in the sin & cos
	let randomX = random(.2, .9);
	let randomY = random(.1, .2);

	// sin & cos for the movement of the triangles in the canvas
	let rectX = Math.cos(time * 1) * 1.5 + randomX;
	let rectY = Math.sin(time * 1) * 1.5 + randomY;
	let rectX2 = Math.cos(time * .7) * 3 + randomX;
	let rectY2 = Math.sin(time * .7) * 3 + randomY;
	let rectX3 = Math.cos(time * 1.4) * 4 + randomX;
	let rectY3 = Math.sin(time * 1.4) * 4 + randomY;

	//console.log(rectX + '-' + rectY + '-' + rectX2 + '-' + rectY2 + '-' + rectX3 + '-' + rectY3);

	//triangle gradiente ==========================================
	var triangle_gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
	triangle_gradient.addColorStop(0, color1);
	triangle_gradient.addColorStop(1, color2);

	//triangle group 1 ===========================================
	// triangle 1.1
	ctx.beginPath();
	ctx.moveTo(rectX2 + 120, rectY2 - 100);
	ctx.lineTo(rectX2 + 460, rectY2 + 80);
	ctx.lineTo(rectX2 + 26, rectY2 + 185);
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	//triangle 1.2
	ctx.beginPath();
	ctx.moveTo(rectX - 50, rectY - 25);
	ctx.lineTo(rectX + 270, rectY + 25);
	ctx.lineTo(rectX - 50, rectY + 195);
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	//triangle 1.3
	ctx.beginPath();
	ctx.moveTo(rectX3 - 140, rectY3 - 150);
	ctx.lineTo(rectX3 + 180, rectY3 + 210);
	ctx.lineTo(rectX3 - 225, rectY3 - 50);
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	//triangle group 2 ===========================================
	// triangle 2.1
	ctx.beginPath();
	ctx.moveTo(rectX + (canvas.width - 40), rectY - 30);
	ctx.lineTo(rectX + (canvas.width + 40), rectY + 190);
	ctx.lineTo(rectX + (canvas.width - 450), rectY + 120);
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	// triangle 2.2
	ctx.beginPath();
	ctx.moveTo(rectX3 + (canvas.width - 200), rectY3 - 240);
	ctx.lineTo(rectX3 + (canvas.width + 80), rectY3 - 240);
	ctx.lineTo(rectX3 + (canvas.width - 50), rectY3 + 460);
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	// triangle 2.3
	// ctx.beginPath();
	// ctx.moveTo(rectX2 + (canvas.width - 400), rectY2 + 140);
	// ctx.lineTo(rectX2 + (canvas.width + 20), rectY2 + 200);
	// ctx.lineTo(rectX2 + (canvas.width - 350), rectY2 + 370);
	// ctx.fillStyle = triangle_gradient;
	// ctx.fill();

	//triangle group 3 ===========================================
	// triangle 3.1
	ctx.beginPath();
	ctx.moveTo(rectX3 - 50, rectY3 + (canvas.height - 350));
	ctx.lineTo(rectX3 + 350, rectY3 + (canvas.height - 220));
	ctx.lineTo(rectX3 - 100, rectY3 + (canvas.height - 120));
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	// triangle 3.2
	ctx.beginPath();
	ctx.moveTo(rectX + 100, rectY + (canvas.height - 380));
	ctx.lineTo(rectX + 320, rectY + (canvas.height - 180));
	ctx.lineTo(rectX - 275, rectY + (canvas.height + 150));
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	// triangle 3.3
	ctx.beginPath();
	ctx.moveTo(rectX2 - 230, rectY2 + (canvas.height - 50));
	ctx.lineTo(rectX2 + 215, rectY2 + (canvas.height - 110));
	ctx.lineTo(rectX2 + 250, rectY2 + (canvas.height + 130));
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	//triangle group 4 ===========================================
	// triangle 4.1
	ctx.beginPath();
	ctx.moveTo(rectX3 + (canvas.width - 80), rectY3 + (canvas.height - 320));
	ctx.lineTo(rectX3 + (canvas.width + 250), rectY3 + (canvas.height + 220));
	ctx.lineTo(rectX3 + (canvas.width - 200), rectY3 + (canvas.height + 140));
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	// triangle 4.2
	ctx.beginPath();
	ctx.moveTo(rectX + (canvas.width - 100), rectY + (canvas.height - 160));
	ctx.lineTo(rectX + (canvas.width - 30), rectY + (canvas.height + 90));
	ctx.lineTo(rectX + (canvas.width - 420), rectY + (canvas.height + 60));
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	// triangle 4.3
	ctx.beginPath();
	ctx.moveTo(rectX2 + (canvas.width - 320), rectY2 + (canvas.height - 200));
	ctx.lineTo(rectX2 + (canvas.width - 50), rectY2 + (canvas.height - 20));
	ctx.lineTo(rectX2 + (canvas.width - 420), rectY2 + (canvas.height + 120));
	ctx.fillStyle = triangle_gradient;
	ctx.fill();

	ctx.restore();

} //end function draw

//call init
init();
animate();
</script>
@endsection
