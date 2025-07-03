<!doctype html>
<html class="no-js" lang="en">


<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>UN WOMEN</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <!-- adminpro icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminpro-custon-icon.css') }}">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.min.css') }}">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/form/all-type-forms.css') }}">
    <!-- switcher CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/switcher/color-switcher.css') }}">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/Lobibox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/notifications.css') }}">

    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-one.css') }}" title="color-one" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-two.css') }}" title="color-two" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-three.css') }}" title="color-three" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-four.css') }}" title="color-four" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-five.css') }}" title="color-five" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-six.css') }}" title="color-six" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-seven.css') }}" title="color-seven" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-eight.css') }}" title="color-eight" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-nine.css') }}" title="color-nine" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/switcher/color-ten.css') }}" title="color-ten" media="screen" />
    <!-- select2 CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/select2/select2.min.css')}}">

    <style type="text/css">
        .cus-footer {
          /* position: fixed; */
          left: 0;
          bottom: 0;
          width: 100%;
          margin-top: 50px;

        }
body,html{
  background-image: url("{{ asset('assets/sam20.jpg')}}");
}

    </style>

    @yield('styles')
</head>


<body>

@include('includes.header')
@if(Auth::user())
@endif
@yield('content')
@include('includes.footer')
@if(true)

@endif
<!-- jquery
============================================ -->
<script src="{{ asset('assets/js/vendor/jquery-1.11.3.min.js') }}"></script>
<!-- bootstrap JS
============================================ -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- meanmenu JS
============================================ -->
<script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
<!-- mCustomScrollbar JS
============================================ -->
<script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- sticky JS
============================================ -->
<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
<!-- scrollUp JS
============================================ -->
<script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>

<script src="{{ asset('assets/js/switcher/styleswitch.js') }}"></script>
<script src="{{ asset('assets/js/switcher/switch-active.js') }}"></script>
<!-- main JS
============================================ -->
<script src="{{ asset('assets/js/main.js') }}"></script>



<script>

// Basic notifications active class
          @if(Session::has('default'))
          Lobibox.notify('default', {
            msg: '{!! Session::get('default') !!}'
          });
          @endif
          @if(Session::has('info'))
          Lobibox.notify('info', {
            msg: '{!! Session::get('info') !!}'
          });
          @endif
          @if(Session::has('warning'))
          Lobibox.notify('warning', {
            msg: '{!! Session::get('warning') !!}'
          });
          @endif
          @if(Session::has('error'))
          Lobibox.notify('error', {
                msg: '{!! Session::get('error') !!}'
            });
          @endif
          @if(Session::has('success'))
          Lobibox.notify('success', {
              msg: '{!! Session::get('success') !!}'
          });
          @endif

</script>

@yield('scripts')
</body>
</html>
