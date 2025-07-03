@extends('layouts.main')

@section('styles')
<style>
  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: purple !important;
  }
.bst{
  color: #31aaf4 !important;
}
li.active{
  background: #80808042;
}
.nav-tabs a{
  color: white !important;
}
.tab-content a{

  color: black !important;

}


.theme_list>a {
    position: relative;
    display: block;
    padding: 5px 0px !important;
}

 @media only screen and (min-width: 600px) {

  .detail-section{

    width: 72% !important;

}

} 

.list-group-item:hover {
  background-color: #BDB6D0;
}

.tooltip-inner {
    max-width: 400px; /* Adjust this value to your preference */
    white-space: pre-wrap; /* Allows text to wrap to a new line */
}
</style>
<link href="{{ asset('assets/mycss.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- BREAD CRUMB -->
<div class="breadcome-area mg-t-40 mg-b-30" style="margin-bottom: 10px;">
    <div class="container">
        <div class="row" id="searchdiv" style="display:none">
          <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top: 30px;
                    border-radius: 10px !important;">
                    <div class="breadcome-heading">
                        <div class="row" style="margin-bottom: 2%;">
                          <div class="col-md-12">
                            <input id="searchindi" onkeyup="search_indicator()" style="border:1px solid purple;background-color: #bdb6d0;" type="text" class="form-control" placeholder="Enter here to search INDICATORS"></input>
                            <ul id="ulshow" class="list-group" style="z-index: 2;
                               padding: 5px;
                               position: absolute;
                               background: white;
                              width: 97.5%; display:none;"></ul>
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
<!-- END BREAD CRUMB -->

 <!-- welcome Project, sale area start-->
<div class="welcome-adminpro-area" >
  <div class="container">
        <!-- ROW 1 SEARCH  -->
    <div class="row" style="margin-bottom:200px;">

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 2%;">
          <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-dark mb-0">Themes</h5>
                  <span class="h2 font-weight-bold mb-0 text-dark">{{$themecount}}</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape text-dark rounded-circle shadow">
                    <img style="width: 100%;
                          float: right;" src="{{ asset('img/theme.png')}}"></img>
                  </div>
                </div>
              </div>
                    <!-- <p class="mt-3 mb-0 text-dark text-sm">
                      <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                      <span class="text-nowrap">Since last month</span>
                    </p> -->
            </div>
            </div>
      </div>


      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-dark mb-0">Sub Themes</h5>
                  <span class="h2 font-weight-bold mb-0 text-dark">{{$subthemecount}}</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape text-dark rounded-circle shadow">
                    <img style="width: 100%;float: right;" src="{{ asset('img/theme.png')}}"></img>
                  </div>
                </div>
              </div>
              <!-- <p class="mt-3 mb-0 text-dark text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span class="text-nowrap">Since last month</span>
              </p> -->
            </div>
          </div>
      </div>



      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-dark mb-0">Quantitative Indicators</h5>
                  <span class="h2 font-weight-bold mb-0 text-dark">{{$quantitativecount}}</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape text-dark rounded-circle shadow">
                    <img style="width: 100%;
                      float: right;" src="{{ asset('img/theme.png')}}"></img>
                  </div>
                </div>
              </div>
              <!-- <p class="mt-3 mb-0 text-dark text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span class="text-nowrap">Since last month</span>
              </p> -->
            </div>
          </div>
      </div>

  
      <!-- END ROW 1 SEARCH  -->
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-bottom:5%;height:100%;background-image: linear-gradient(to right, #706FE8 , #D77EDB);border-radius:2%">
        <div class="inbox-email-menu-list compose-b-mg-30 shadow-reset" style="border-radius: 10px;">
            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
            <div class="compose-email">
              <h4 style="text-align: center;"><u>Select theme</u></h4>
            <h4 style="color: white;
                    text-align: center;
            background: #a24187;
            padding: 10px;">Themes 
            <i class="fa fa-plus pull-right" style="color:white" data-toggle="modal" data-target="#addTheme"> </i>  </h4>
              </div>
              @endif
            <ul class="nav nav-tabs">
                @foreach($themes as $theme)
                <li class="theme_list theme_list_active @if($id == null && $loop->index == 0) active @endif @if($id == $theme->id) active @endif" id="mytheme_{{$theme->id}}" style="width: 100%;">
                
                      <a style="font-size: 13px;" data-toggle="tab" href="#themebox_{{$theme->id}}" >
                      <img src="{{asset(EF::retriveFileLink($theme->image))}}" alt="" style="width:20%;padding:0px"></img>
                    {{$theme->name}}
                      </a>
                    
                </li>
                @endforeach
            </ul>
        </div>
      </div>
    

      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 detail-section" style="margin-bottom:5%;margin-left:3%;color:white;background-image: linear-gradient(to right, #706FE8 , #D77EDB);opacity:0.9;border-radius:2%">

              <div class="tab-content">
                @foreach($themes as $theme)
                  <div id="themebox_{{$theme->id}}" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset @if($loop->index == 0 && $id == null) active @endif @if($id == $theme->id) active @endif" style="border-radius: 10px;">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 style="text-align: center;margin-bottom:3%"><u>Select sub-theme and indicator to view data</u></h4>
                      </div>

                    </div>
                    <div class="row">
                     
                      <div class="col-lg-5 col-md-2 col-sm-12">
                        <h4 style="color:black; font-size: 14px;"> <b> {{strtoupper($theme->name)}} </b></h4>

                        </div>
                      @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
                      <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12" style="text-align: right;">

                            <a class="compose-draft-bt" style="background:#E6E3E7;border-color:#E6E3E7; border-radius:5px;padding:2%;color:white" data-toggle="modal" href="#subThemeAdd" id="{{Crypt::encrypt($theme->id)}}" onclick="setthemeid(this.id)"><i class="fa fa-plus"></i> Add new Sub Theme</a>
                      
                          <a class="compose-draft-bt" style="background:#E6E3E7;border-color:#E6E3E7; border-radius:5px;padding:2%;color:white;margin-top:1%" data-toggle="modal" href="#deleteTheme" onclick="deletethemeclick('{{Crypt::encrypt($theme->id)}}')"><i class="fa fa-trash-o"></i> Delete</a>
                  

                            <a class="compose-draft-bt" style="background:#E6E3E7;border-color:#E6E3E7; border-radius:5px;padding:2%;color:white;" data-toggle="modal" href="#editTheme_{{$theme->id}}" ><i class="fa fa-pencil"></i> Edit</a>
                      </div>
                        @endif
                               
                    </div>
                          <div class="panel-group adminpro-custon-design" id="accordion">

                            @foreach($theme->subTheme as $subtheme)

                            <div class="panel panel-default">
                                <div class="panel-heading accordion-head" >
                                    <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#subthemecollaspe_{{$subtheme->id}}">
                                  {{$subtheme->name}} ({{$subtheme->quantitative->count()}} Indicators)</a>

                                  @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))

                                  <a class="compose-discard-bt pull-right" href="#deletesubTheme" onclick="setsubthemeiddelete('{{Crypt::encrypt($subtheme->id)}}')" data-toggle="modal" style="margin-right:15px"><i class="fa fa-trash-o"></i></a>
                                  <a class="compose-draft-bt pull-right" data-toggle="modal" href="#subThemeupdate"  style="margin-right:15px" data-id="" data-name="" onclick="setsubthemeidtoedit('{{Crypt::encrypt($subtheme->id)}}', '{{$subtheme->name}}','{{Crypt::encrypt($subtheme->theme_id)}}')"><i class="fa fa-pencil" ></i></a>


                                  @endif
                              </h4>
                                </div>
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <div id="subthemecollaspe_{{$subtheme->id}}" class="panel-collapse panel-ic collapse in"  style="overflow: hidden;">
                                    <div class="panel-body admin-panel-content animated bounce">

                                      @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))

                                      <a class="compose-draft-bt pull-right" data-toggle="modal" href="#indicatorAdd" id="{{Crypt::encrypt($subtheme->id)}}" style="margin-right:15px;" onclick="setsubthemeid(this.id,{{$subtheme->id}})"><i class="fa fa-plus"></i> Add Indicator</a>
                                      @endif
                                   <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <div class="adminpro-content res-tree-ov">
                                                  <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 py-4" >
                                              <div id="jstree1_{{$subtheme->id}}">

                                                  <ul>
                                                      <li class="jstree-open tf-class">Quantitative Indicators
                                                          <ul>
                                                            @foreach($subtheme->quantitative as $quant)
                                                              <li onclick="call('{{Crypt::encrypt($quant->id)}}')" class="setcolor">
                                                                <a  data-toggle="tooltip" data-placement="top" title="{{ $quant->data_requirement }}" style="color: #31aaf4 !important;" >{{Illuminate\Support\Str::limit($quant->data_requirement,100)}}</a></li>
                                                              @endforeach
                                                          </ul>
                                                       
                                                      </li>
                                                      <!-- <li class="">Quantitative Indicators
                                                          <ul>
                                                            @foreach($subtheme->quantitative as $quant)
                                                              <li onclick="call('{{Crypt::encrypt($quant->id)}}')" class="setcolor"><a style="color: #31aaf4 !important;" >{{Illuminate\Support\Str::limit($quant->data_requirement,70)}}</a></li>
                                                              @endforeach
                                                          </ul>
                                                      </li> -->
                                                  </ul>
                                                    </div>
                                                  </div>
                                       
                                              </div>
                                      </div>
                                    
                                    </div>
                                   
                                   </div>
                                        
                                       
                                      </div>
                                  </div>
                                </div>
                                        
                              </div>
                            </div>

                            @endforeach
                          </div>

                  </div>
                  @endforeach

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

$('a[data-toggle="tab"]').on('shown.bs.tab', function(event) {
  let activeTab = $(event.target), // activated tab
      id = activeTab.attr('href'); // active tab href
     // set id in html5 localstorage for later usage      
     localStorage.setItem('activeTab', id);

});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

window.onload = function() {

  let tabID = localStorage.getItem('activeTab');
  $('.nav-tabs a[href="' + tabID + '"]').tab('show');
  localStorage.clear();
};
</script>

@include('gender_statistics.script')
@endsection