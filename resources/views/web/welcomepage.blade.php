@extends('layouts.welcome_master')

@section('styles')
<style>

.navbar-brand {
    float: left;
    height: 40px;
    padding: 0px 0px !important;
    font-size: 18px;
    line-height: 20px;
}

</style>
@endsection

@section('content')
	
<div class="container" style="padding:0%;margin:0%;">

<nav class="navbar" style="border:0px;background: transparent;position:fixed;top:0%;
  ">
        <div class="container">
         
          <div class="row"  style="width: 100%;" >
           <div class="col-md-6">
              <div style="float: left;" >

            
              <a href="{{ route('index')}}"><img src="{{ asset('img/logos/ncswlogo.png') }}" alt=""  style="width: 76%;"/>
              </a>
            </div>

           </div>
           <div class="col-md-6">
       
            <div style="float: right;" >

            <a href="{{ route('index')}}"><img src="{{ asset('img/logos/unwomen.png') }}" alt="" style="width: 76%;margin-top:3%;"/>
            </a>
            </div>
           </div>
          </div><!--/.nav-collapse -->
        
        </div>

</nav>
    <div class="row" style="color:#341531;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
        <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12">

        <h1 style="text-align: center;">Launching of <b style="color: #7a3479;"> National Gender Data Portal (NGDP)</b></h1>

        </div>
        <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12">
        <h1 style="text-align: center;">by</h1>

        </div>
        <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12">

        <h1 style="text-align: center;">His Excellency, President, Islamic Republic of Pakistan</h1>
        </div>
        <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12">

        <h1 style="text-align: center;color: #7a3479;font-size:64px;"><b>Dr. Arif Alvi</b> </h1>
        </div>
        <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12" style="text-align: center;">
            <a href="{{route('launch')}}" class="btn btn-lg bg-info" style="width:20%;font-size:35px;padding-top:2%;padding-bottom:2%;margin-top: 6%;background-image: linear-gradient(to right, #8858AA , #D77EDB);color:white;"> <b>Launch</b>  </a>
        </div>

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
