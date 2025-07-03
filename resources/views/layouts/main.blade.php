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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-V2PC604RQE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-V2PC604RQE');
</script>

</head>

@yield('styles')
<style>

* { margin: 0; padding: 0; }
		
		body { 
			background: url("{{ asset('assets/sam201.png')}}") no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
      background-color: #EEEEEE;

		}

    .navbar-default .navbar-nav>li>a {
    color: black;
}

a.active {
    background-color: white;
    border-radius: 6px;
}


.nav>li>a {
    position: relative;
    display: block;
    padding: 10px 15px;
}

.navbar-brand {
    float: left;
    height: 40px;
    padding: 0px 0px !important;
    font-size: 18px;
    line-height: 20px;
}


.cus-footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  color: white;
  text-align: center;
  padding-top: 0.5%;
  
  background-image: linear-gradient(to right, #5071d0, #b4a1da);


        }
@media only screen and (max-width: 425px) {

.nav-img{

  width: 45% !important;

}

}

@media only screen and (min-width: 450px) {
  .nav-img{

width: 26% !important;

}

}
/* @media only screen and (min-width: 922) {
.background{

  background-image: url('assets/Resized_922px.png');
    width: 100%;
		height: 100%;
		position: fixed;
		background-size: cover;
		background-repeat: no-repeat;

}

} */

</style>
<body class="background" >

  <div id="cls-loader" style="display:none;position: absolute;width:100%;background-color:white;height:3000px;z-index:1;opacity:0.5">
    <img src="{{asset('/loader.gif')}}" style="margin:25%;margin-left:50%;">

  </div>
<nav class="navbar navbar-default" style="border:0px;background: transparent;
  ">
        <div class="container">
         
          <div class="navbar-header" >
          <div class="navbar-brand">

          
          <a href="{{ route('welcome')}}"><img src="{{ asset('img/logos/ncsw.png') }}" alt="" class="nav-img"/>
                    </a>
           

          </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="#">Project name</a> -->
          </div>
          <div id="navbar" class="navbar-collapse collapse">

           
            <ul class="nav navbar-nav navbar-right" style="color:black;font-weight:bold">

            <li class="" style="width: 140px;"><a class="{{ Request::segment(1) === 'genderStatistics' ? 'active' : null }} {{ Request::segment(1) === 'genderStatistics' ? 'active' : null }} { Request::segment(1) === 'indicators' ? 'active' : null }}" style="font-size:13px" href="{{ route('genderStatistics')}}">Gender Statistics </a></li>

            
            @if(Request::segment(1) != "knowledgehub")
            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data','View Data']))
              <li class="" style="width: 140px;"><a class="{{ Request::segment(1) === 'knowledgehubHome' ? 'active' : null }}" style="font-size:13px" href="{{url('knowledgehubHome')}}">Knowledge Hub </a></li>
              @else
            @if(!isset(Auth::user()->id) )
            <li class="" style="width: 140px;"><a class="{{ Request::segment(1) === 'knowledgehubHome' ? 'active' : null }}" style="font-size:13px" href="{{url('knowledgehubHome')}}">Knowledge Hub </a></li>
            @endif
        @endif
            @elseif(Request::segment(1) == "knowledgehub")

            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data','View Data']))
              <li style="width: 140px;"><a style="font-size:13px" class="{{ Request::segment(1) === 'knowledgehubHome' ? 'active' : null }}"  href="{{url('knowledgehubHome')}}">Knowledge Hub</a></li>

              @else
            @if(!isset(Auth::user()->id) )
            <li style="width: 140px;"><a style="font-size:13px" class="{{ Request::segment(1) === 'knowledgehubHome' ? 'active' : null }}"  href="{{url('knowledgehubHome')}}">Knowledge Hub</a></li>


            @endif
             @endif
        @endif
              <li><a style="font-size:13px;width:100%" href="{{asset('map/index.html')}}" target="_blank">Reporting</a></li>
                {{--
              @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','View Logs']))

              <li><a style="font-size:13px;width:100%;" class="{{ Request::segment(1) === 'logs' ? 'active' : null }}"  href="{{ route('logs')}}" >Logs</a></li>

                  
                    @endif
                    --}}
            @if(Auth::guest())
            <li><a style="font-size:13px" class="{{ Request::segment(1) === 'login' ? 'active' : null }}" href="{{ route('login')}}" >Login</a></li>

            
            @endif
            @if(Auth::guest())
            <li><a style="font-size:13px" class="{{ Request::segment(1) === 'register' ? 'active' : null }}" href="{{ route('register')}}" >Register</a></li>

            
            @endif

            @if(isset(Auth::user()->id))

            @if(Request::segment(1) == "home")
            <li><a style="font-size:13px" onclick="showsearch()" href="#" ><i class="fa fa-search"></i> Search</a></li>

            @endif
            @if(Request::segment(1) == "knowledgehub")
            <li><a style="font-size:13px" onclick="showsearch2()" href="#" ><i class="fa fa-search"></i></a></li>

            @endif

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 13px;"> {{ Auth::user()->name}} <span class="caret"></span></a>

                <ul class="dropdown-menu" style="background-color: #d8d0d0;">

                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add Roles','Update Roles']))
                <li><a class="{{ Request::segment(1) === 'roles' ? 'active' : null }}" style="font-size:13px;font-weight:bold" href="{{ route('roles')}}">Roles & Permissions</a></li>

                @endif

                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Approve / Reject Users']))
                <li><a class="{{ Request::segment(1) === 'registerlist' ? 'active' : null }}" style="font-size:13px;font-weight:bold" href="{{ route('registerlist')}}">Approve / Reject Users</a></li>
                    
                @endif
                

                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Registered Users']))
                <li><a class="{{ Request::segment(1) === 'userlist' ? 'active' : null }}" style="font-size:13px;font-weight:bold" href="{{ route('userlist')}}">Registered Users</a></li>
                   
                @endif

                @if(isset(Auth::user()->id))
                <li><a class="{{ Request::segment(1) === 'userlist' ? 'active' : null }}" style="font-size:13px;font-weight:bold" href="" onclick="onFetchFormModal(event,'{{route('change.password')}}','#modal_change_password','#bind_modal')">Change Password</a></li>
                   
                @endif
                <!--   <li><a href="#"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Settings</a>
                </li> -->
                <li><a class="" style="font-size:13px;font-weight:bold" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="#">Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
     

                </ul>
            </li>

              @endif
  
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->


</nav>
        <div class="container-fluid" style="position:relative;">

    
        @yield('content')
        <div id="bind_modal"></div>
      @include('includes.footer')
        </div>
        <!-- <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->

 <script src="{{ asset('assets/js/bootstrap3.min.js') }}"></script>
 <script src="{{ asset('js/sweetalert.min.js') }}" ></script>

 <script src="{{ asset('webassets/js/vendor/bootstrap.min.js') }}"></script>

 <script src="{{ asset('assets/js/jquery3.5.min.js') }}"></script>
 <script src="{{ asset('assets/js/bootstrap3.4.min.js') }}"></script>


  <script type="text/javascript" src="{{asset('/js/custom_js/validation/custom_validation.js')}}"></script>

<script type="text/javascript" src="{{asset('/js/custom_js/validation/bind_validation.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/custom_js/validation/js_validation.js')}}"></script>

    
  <!-- <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>



    <script src="{{ asset('webassets/js/plugins.js') }}"></script>
    <script src="{{ asset('webassets/js/main.js') }}"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // navigation click actions
        $('.scroll-link').on('click', function(event){
            event.preventDefault();
            var sectionID = $(this).attr("data-id");
            scrollToID('#' + sectionID, 750);
        });
        // scroll to top action
        $('.scroll-top').on('click', function(event) {
            event.preventDefault();
            $('html, body').animate({scrollTop:0}, 'slow');
        });
        // mobile nav toggle
        $('#nav-toggle').on('click', function (event) {
            event.preventDefault();
            $('#main-nav').toggleClass("open");
        });
    });
    // scroll function
    function scrollToID(id, speed){
        var offSet = 50;
        var targetOffset = $(id).offset().top - offSet;
        var mainNav = $('#main-nav');
        $('html,body').animate({scrollTop:targetOffset}, speed);
        if (mainNav.hasClass("open")) {
            mainNav.css("height", "1px").removeClass("in").addClass("collapse");
            mainNav.removeClass("open");
        }
    }
    if (typeof console === "undefined") {
        console = {
            log: function() { }
        };
    } -->
    </script>
@yield('scripts')


<script>
  function onFetchFormModal(event,route,target_model,bind_model)
    {
        event.preventDefault();
        // One.layout('header_loader_on');
        $.get(route, function(data) {
            // One.layout('header_loader_off');

            $(bind_model).html(data);
            $(target_model).modal('show');
        });
    }
</script>

</body>

</html>
