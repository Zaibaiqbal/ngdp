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
    
  body {
  font-family: sans-serif;
  display: grid;
  height: 100vh;
  place-items: center;
  background-color: #f4b7f3;
}

.base-timer {
  position: relative;
  width: 300px;
  height: 300px;
}

.base-timer__svg {
  transform: scaleX(-1);
}

.base-timer__circle {
  fill: none;
  stroke: none;
}

.base-timer__path-elapsed {
  stroke-width: 7px;
  stroke: grey;
}

.base-timer__path-remaining {
  stroke-width: 7px;
  stroke-linecap: round;
  transform: rotate(90deg);
  transform-origin: center;
  transition: 1s linear all;
  fill-rule: nonzero;
  stroke: currentColor;
}

.base-timer__path-remaining.green {
  color: rgb(65, 184, 131);
}

.base-timer__path-remaining.orange {
  color: orange;
}

.base-timer__path-remaining.blue {
  color: blue;
}

.base-timer__label {
  position: absolute;
  width: 300px;
  height: 300px;
  top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 48px;
}




</style>
<body >

<div id="app" ></div>

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
<script>

// Credit: Mateusz Rybczonec

const FULL_DASH_ARRAY = 283;
const WARNING_THRESHOLD = 10;
const ALERT_THRESHOLD = 5;

const COLOR_CODES = {
  info: {
    color: "#824181"
  },
  warning: {
    color: "orange",
    threshold: WARNING_THRESHOLD
  },
  alert: {
    color: "blue",
    threshold: ALERT_THRESHOLD
  }
};

const TIME_LIMIT = 5;
let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;

document.getElementById("app").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label" class="base-timer__label">${formatTime(
    timeLeft
  )}</span>
</div>
`;

startTimer();

function onTimesUp() {

  clearInterval(timerInterval);
}

function startTimer() {
  timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label").innerHTML = formatTime(
      timeLeft
    );
    setCircleDasharray();
    setRemainingPathColor(timeLeft);

    if (timeLeft == 0) {

      window.location.href = "{{route('welcome')}}";
      onTimesUp();

    }
  }, 1000);
}

function formatTime(time) {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${seconds}`;
}

function setRemainingPathColor(timeLeft) {
  const { alert, warning, info } = COLOR_CODES;
  if (timeLeft <= alert.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(warning.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(info.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(warning.color);
  }
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
  const circleDasharray = `${(
    calculateTimeFraction() * FULL_DASH_ARRAY
  ).toFixed(0)} 283`;
  document
    .getElementById("base-timer-path-remaining")
    .setAttribute("stroke-dasharray", circleDasharray);
}

</script>
@yield('scripts')
</body>

</html>
