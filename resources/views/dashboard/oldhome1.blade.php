@extends('layouts.master')

@section('styles')
<style>
.bst{
  color: #31aaf4 !important;
}
</style>
<link href="{{ asset('assets/mycss.css') }}" rel="stylesheet">
@endsection

@section('content')<!-- Breadcome start-->
<div class="breadcome-area mg-b-30" >
    <div class="container">
        <div class="row" id="searchdiv" style="display:none;">
            <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top: 30px;
                    border-radius: 10px !important;">
                    <div class="breadcome-heading">
                        <div class="row">
                          <div class="col-md-12">
                            <input id="searchindi" onkeyup="search_indicator()" style="background-color: #efeded;" type="text" class="form-control" placeholder="Enter here to search INDICATORS"></input>
                            <ul id="ulshow" class="list-group" style="z-index: 2;
    padding: 5px;
    position: absolute;
    background: white;
    width: 100%; display:none;"></ul>
                          </div>

                        </div>
                    </div>
                    <!-- <ul class="breadcome-menu">
                        <li><a href="#">Themes</a> <span class="bread-slash">/</span>
                        </li>
                        <li><span class="bread-blod">Subth</span>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="income-order-visit-user-area mg-t-40">
    <div class="container">
        <div class="row">


          <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Themes</h5>
                      <span class="h2 font-weight-bold mb-0">{{$themecount}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <img style="width: 30%;
  float: right;" src="{{ asset('img/theme.png')}}"></img>
                      </div>
                    </div>
                  </div>
                  <!-- <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p> -->
                </div>
              </div>
            </div>


            
            <div class="col-lg-3">
                <div class="income-dashone-total shadow-reset nt-mg-b-30">
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Sub Themes</h2>
                            <div class="main-income-phara order-cl">
                                <!-- <p>Annual</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter" id="subtcount">{{$subthemecount}}</span></h3>
                            </div>
                            <div class="price-graph">
                                <!-- <span id="sparkline6"></span> -->
                                <img style="width: 20%;
    float: right;" src="{{ asset('img/sub.png')}}"></img>
                            </div>
                        </div>
                        <!-- <div class="income-range order-cl">
                            <p>New Orders</p>
                            <span class="income-percentange">66% <i class="fa fa-level-up"></i></span>
                        </div> -->
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="income-dashone-total shadow-reset nt-mg-b-30">
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Qualitative Indicators</h2>
                            <div class="main-income-phara visitor-cl">
                                <!-- <p>Today</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter" id="qualcount">{{$qualitativecount}}</span></h3>
                            </div>
                            <div class="price-graph">
                                <!-- <span id="sparkline2"></span> -->
                                <img style="width: 20%;
    float: right;" src="{{ asset('img/survey.png')}}"></img>
                            </div>
                        </div>
                        <!-- <div class="income-range visitor-cl">
                            <p>New Visitor</p>
                            <span class="income-percentange">55% <i class="fa fa-level-up"></i></span>
                        </div> -->
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="income-dashone-total shadow-reset nt-mg-b-30">
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Quantitative Indicators</h2>
                            <div class="main-income-phara low-value-cl">
                                <!-- <p>Low Value</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter" id="quantcount">{{$quantitativecount}}</span></h3>
                            </div>
                            <div class="price-graph">
                                <!-- <span id="sparkline5"></span> -->
                                <img style="width: 20%;
    float: right;" src="{{ asset('img/quantitative.png')}}"></img>
                            </div>
                        </div>
                        <!-- <div class="income-range low-value-cl">
                            <p>In first month</p>
                            <span class="income-percentange">33% <i class="fa fa-level-down"></i></span>
                        </div> -->
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcome End-->
<div class="inbox-mailbox-area mg-b-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="inbox-email-menu-list compose-b-mg-30 shadow-reset" style="border-radius: 10px;">
                           @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
                            <div class="compose-email">
                              <a  class="btn btn-success" style="background:#a24187;border-color:#a24187" href="#" data-toggle="modal" data-target="#addTheme"><i class="fa fa-pencil"></i> Create New Theme</a>
                            </div>
                            @endif
                            <ul class="nav nav-tabs">
                                <li>
                                    <h4 class="Inbox-category-ad"><i class="fa fa-folder-o" aria-hidden="true"></i> Themes</h4>
                                </li>
                                @foreach($themes as $theme)
                                <li class="@if($loop->index == 0)active @endif" id="mytheme_{{$theme->id}}"><a data-toggle="tab" href="#themebox_{{$theme->id}}" onclick="getdashboardcounts({{$theme->id}})"><span class="inbox-icon"><img src="{{asset(EF::retriveFileLink($theme->image))}}" alt="" style="width:25%"></img></span> {{$theme->name}} </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','View Portal','Edit Portal']))

                        <div class="tab-content">
                          @foreach($themes as $theme)
                            <div id="themebox_{{$theme->id}}" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset @if($loop->index == 0) active @endif" style="border-radius: 10px;">
                                <div class="mail-title inbox-bt-mg">
                                        <h2>{{$theme->name}}</h2>
                                        @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))

                                        <div class="view-mail-action view-mail-ov-d-n">
                                            <!-- <a href="#"><i class="fa fa-reply"></i> Reply</a> -->

                                            <a class="compose-draft-bt" style="background:#a24187;border-color:#a24187; border-radius:5px" data-toggle="modal" href="#subThemeAdd" id="{{Crypt::encrypt($theme->id)}}" onclick="setthemeid(this.id)"><i class="fa fa-plus"></i> Add new Sub Theme</a>
                                            <a class="compose-draft-bt" style="border-radius:5px" data-toggle="modal" href="#editTheme_{{$theme->id}}"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="compose-discard-bt" style="border-radius:5px" data-toggle="modal" href="#deleteTheme" onclick="deletethemeclick('{{Crypt::encrypt($theme->id)}}')"><i class="fa fa-trash-o"></i> Delete</a>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="panel-group adminpro-custon-design" id="accordion">
                                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','View Portal','Edit Portal']))

                                      @foreach($theme->subTheme as $subtheme)

                                      <div class="panel panel-default">
                                          <div class="panel-heading accordion-head">
                                              <h4 class="panel-title">
                                           <a data-toggle="collapse" data-parent="#accordion" href="#subthemecollaspe_{{$subtheme->id}}">
                                           {{$subtheme->name}} </a>

                                            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))

                                           <a class="compose-discard-bt pull-right" href="#deletesubTheme" onclick="setsubthemeiddelete('{{Crypt::encrypt($subtheme->id)}}')" data-toggle="modal" style="margin-right:15px"><i class="fa fa-trash-o"></i></a>
                                           <a class="compose-draft-bt pull-right" data-toggle="modal" href="#subThemeupdate"  style="margin-right:15px" data-id="" data-name="" onclick="setsubthemeidtoedit('{{Crypt::encrypt($subtheme->id)}}', '{{$subtheme->name}}','{{Crypt::encrypt($subtheme->theme_id)}}')"><i class="fa fa-pencil" ></i></a>


                                           @endif
                                        </h4>
                                          </div>
                                          <div id="subthemecollaspe_{{$subtheme->id}}" class="panel-collapse panel-ic collapse @if($loop->index == 0) in @endif">
                                              <div class="panel-body admin-panel-content animated bounce">

                                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))

                                                <a class="compose-draft-bt pull-right" data-toggle="modal" href="#indicatorAdd" id="{{Crypt::encrypt($subtheme->id)}}" style="margin-right:15px" onclick="setsubthemeid(this.id,{{$subtheme->id}})"><i class="fa fa-plus"></i> Add Indicator</a>
                                                @endif
                                                <div class="">
                                                    <div class="adminpro-content res-tree-ov">
                                                        <div id="jstree1_{{$subtheme->id}}">
                                                            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','View Portal','Edit Portal']))
                                                            <ul>
                                                                <li class="jstree-open tf-class">Quantitative Indicators
                                                                    <ul>
                                                                      @foreach($subtheme->quantitative as $quant)
                                                                        <li onclick="call('{{Crypt::encrypt($quant->id)}}')" class="setcolor"><a style="color: #31aaf4 !important;" >{{Illuminate\Support\Str::limit($quant->data_requirement,70)}}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                          </div>
                                      </div>

                                      @endforeach
                                    </div>
                                    @endif
                            </div>
                            @endforeach

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="setidroute"/>
@include('theme.modals.add_theme')
@include('subtheme.modals.add_subtheme')
@include('subtheme.modals.update_subtheme')
@include('indicators.modals.create_indicator')
@include('theme.modals.update_theme')
@include('theme.modals.delete_theme')
@include('subtheme.modals.delete_subtheme')
@include('includes.login')
@endsection


@section('scripts')

<script>

function setthemeid(id)
{
  $("#themesubtheme").val(id);
}
function setsubthemeid(id,key)
{

  $("#indicatorsubtheme").val(id);
  $("#indicatorsubthemekey").val(key);
}
function setsubthemeidtoedit(id,name,theme_id)
{
  $("#subthemeid").val(id);
  $("#subthemenme").val(name);
  $("#subthemenme_themeid").val(theme_id);
}
function deletethemeclick(id)
{
  $("#deletethemeid").val(id);
}
function setsubthemeiddelete(id)
{
  $("#deletesubthemeid").val(id);
}
function call(id)
{
  @if(Auth::user())
  var url = "{{ route('indicators',':id')}}";
    url = url.replace(':id', id);
      window.location.href = url;
  @else
  $("#setidroute").val(id);
   $("#ajaxlogin").modal('show');
  @endif
}


$(function() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('form.login:first').on('submit', function(e){
    e.preventDefault();

    var $this = $(this);

    $.ajax({
        type: $this.attr('method'),
        url: $this.attr('action'),
        data: $this.serializeArray(),
        dataType: $this.data('type'),
        success: function (response) {
           if(response.success) {
             // location.reload();
             var url = "{{ route('indicators',':id')}}";
             var myid= $("#setidroute").val();
               url = url.replace(':id', myid);
                 window.location.href = url;
           }
           else{
             Lobibox.notify('error', {
                   msg: 'Authrization Failed'
               });
           }
        },
        error: function (jqXHR) {
          var response = $.parseJSON(jqXHR.responseText);
          if(response.message) {
            Lobibox.notify('error', {
                  msg: response.message
              });
          }
        }
    });
  });

});

</script>

<script>
function sdgchange()
{
  var id = $("#sdg_id").val();

  $('#sdg_id option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('gettargetsnew')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $('#targets').html(data);
      }
      else{
        alert('something went wrong or no data found');
      }
      }
      });
}
</script>
<script>
function targetchange()
{
  var id = $("#targets").val();

  $('#targets option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('getindicatorsnew')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $('#indicators').html(data);
      }
      else{
        alert('something went wrong or no data found');
      }
      }
      });
}
</script>
<script>
$("#droptypechange").change(function () {
        var end = this.value;
        if(end == "qualitative")
        {
          $("#typequalitativechange").css("display","block");
        }
        else{
            $("#typequalitativechange").css("display","none");
        }
    });
</script>


<!-- Tree Viewer JS
============================================ -->
<script src="{{ asset('assets/js/tree-line/jstree.min.js') }}"></script>
<script src="{{ asset('assets/js/tree-line/jstree.active.js') }}"></script>

<script>
@foreach($themes as $theme)
@foreach($theme->subTheme as $subtheme)
  (function ($) {
   "use strict";
   $('#jstree1_{{$subtheme->id}}').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-link'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });
        })(jQuery);
@endforeach
@endforeach
</script>
<script>
function search_indicator()
{
  var value = $("#searchindi").val();
  if(value == null || value == '')
  {

    $('#ulshow').html('');
    document.getElementById('ulshow').style.display = 'none';
  }
  else{
  $.ajax({
      type : 'post',
      url : "{{ route('search_indicator')}}",
      data:{"search":value,"_token": "{{ csrf_token() }}"},
      success:function(data){
      document.getElementById('ulshow').style.display = 'block';
      $('#ulshow').html(data);
      }
      });
    }
}
</script>
<script>
var elList = document.getElementsByClassName('tf-class');
$('.tf-class').addClass('fa-folder').removeClass('fa-link');
</script>

<script>
var globvalue = 0;
function mydup()
{

  if(globvalue == 0)
  {

  var mval = $("#targets").val();
  if(mval != 0)
  {
// var $button = $('#dup').clone();
//   $('#setdup').html($button);
var $button = $('#setdup');
  $('#dup').clone().appendTo($button);
  globvalue++;
}
else{
  alert('select SDG first');
}
}
else{
  var $button = $('#setdup');
    $('#dup').clone().appendTo($button);
}
}
</script>

<script>

document.getElementById("mybody").onclick = function() {

           $('#ulshow').html("");

       }
</script>
<script>
@if(Session::get('theme_key') != null)

var my = "themebox_"+{{Session::get('theme_key')}};
var element = document.getElementById(my);
var element2 = document.getElementById("themebox_1");
element2.classList.remove("active");
  element.classList.add("active");

var myt = "mytheme_"+{{Session::get('theme_key')}};
  var element3 = document.getElementById(myt);
  var element4 = document.getElementById("myt_1");
  element4.classList.remove("active");
    element3.classList.add("active");

    <?php Session::forget('theme_key'); ?>
@endif
</script>
<script>
@if(Session::get('sub_theme_key') != null)

var my = "subthemecollaspe_"+{{Session::get('sub_theme_key')}};
var element = document.getElementById(my);
var element2 = document.getElementById("subthemecollaspe_1");
element2.classList.remove("in");
  element.classList.add("in");

    <?php Session::forget('sub_theme_key'); ?>
@endif
</script>

<script>
function getdashboardcounts(id)
{
  var value = id;

  $.ajax({
      type : 'post',
      url : "{{ route('getdashboardcounts')}}",
      data:{"id":value,"_token": "{{ csrf_token() }}"},
      success:function(data){
      $("#subtcount").html(data.subthemecount);
      $("#qualcount").html(data.qualitativecount);
      $("#quantcount").html(data.quantitativecount);
      }
      });
}
</script>
<script>

function showsearch()
{
  var x = document.getElementById("searchdiv");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
@endsection
