<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--
Tinker CSS Template
https://templatemo.com/tm-506-tinker
-->
    <title>Gender Data Portal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('webassets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('webassets/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('webassets/css/fontAwesome.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.3.5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-theme.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/tree-viewer/tree-viewer.css') }}">
<!--
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="{{ asset('webassets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('webassets/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('webassets/css/fontAwesome.css') }}">
    <link rel="stylesheet" href="{{ asset('webassets/css/hero-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('webassets/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('webassets/css/templatemo-style.css') }}">
    <link rel="stylesheet" href="{{ asset('webassets/css/lightbox.css') }}">

    <script src="{{ asset('webassets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script> -->

</head>

@yield('styles')
<style>
  * { margin: 0; padding: 0; }
    
    body, body > div {
  align-items: center;
  display: flex;
  justify-content: center;
}

body {
  margin: 0;
  height: 100vh;
}

[class*=curtain] {
  position: relative;
  height: 100%;
  width: 100%;
  margin: 5vh;
  padding: 5vw;
}

[class*=curtain]::after,
[class*=curtain]::before {
  content: '';
  background-color: #dd9de0;
  background-image:  url('assets/curtain.png');
  position: absolute;
  transition-duration: 2.5s;
  box-shadow:0px 0px 10px 0px #610B0B;
}

[class*=curtain]:hover:after,
[class*=curtain]:hover:before {
  opacity: 0;
}

.curtain-0::after,
.curtain-0::before {
  height: 100%;
  width: 100%;
}

.curtain-1::after,
.curtain-1::before {
  height: 50%;
  width: 100%;
}

.curtain-0::after {
  right: 0;
  transform-origin: right;
}

.curtain-0::before {
  left: 0;
  transform-origin: left;
}

.curtain-0:hover:after,
.curtain-0:hover:before {
  transform: scaleX(0);
}

.curtain-1::after {
  bottom: 0;
  transform-origin: bottom;
}

.curtain-1::before {
  top: 0;
  transform-origin: top;
}

.curtain-1:hover:after,
.curtain-1:hover:before {
  transform: scaleY(0);
}

</style>
<body >

 
  <div id="cls-loader" style="display:none;position: absolute;width:100%;background-color:white;height:100%;z-index:1;opacity:0.5">
    <img src="{{asset('/loader.gif')}}" style="margin:25%;margin-left:50%;">

  </div>

    @yield('content')
  
        <!-- <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->

 <script src="{{ asset('assets/js/bootstrap3.min.js') }}"></script>

 <script src="{{ asset('webassets/js/vendor/bootstrap.min.js') }}"></script>

 <script src="{{ asset('assets/js/jquery3.5.min.js') }}"></script>
 <script src="{{ asset('assets/js/bootstrap3.4.min.js') }}"></script>


  <script type="text/javascript" src="{{asset('/js/custom_js/validation/custom_validation.js')}}"></script>

<script type="text/javascript" src="{{asset('/js/custom_js/validation/bind_validation.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/custom_js/validation/js_validation.js')}}"></script>

@yield('scripts')
</body>

</html>
