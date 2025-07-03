@extends('layouts.main')

@section('styles')
<style type="text/css">
  .tab-custon-menu-bg:before {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    background: #fff;
    content: "";
    z-index: -1 !important;
    height: 100%;

}
.cls-active{
background-color: #5171D0;
}
.nav-tabs>li.active>a{
  background: none !important;
  border-color: transparent !important;
}
.nav-tabs li a:hover{
    background-color: white ;
    font-weight: bold;
    color: purple !important;

}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: purple !important;
  }
.cus-btn {
    /*color: -webkit-link;*/
    cursor: pointer !important;
    /*text-decoration: underline;*/
}
h4{
  color: black !important;
}
.mypad{
  /* padding: 10px !important; */
}
.border-right{
  border-right: 1px solid;
}
.description-text{
  font-size: 18px;
}
.bbstyle{
  box-shadow: 0px 5px 3px rgba(0,0,0,.3);
      padding: 10px;
      color: #a24187;
      background: white;
      /* border-radius: 10px; */
}
.mycolorblack{
  background: #eeeeee !important;
}

.nav-tabs li a{

  color: white !important;
  font-weight: bold;
}

.theme_list>a {
    position: relative;
    display: block;
    padding: 5px 0px !important;
}

</style>
<link href="{{ asset('assets/mycss.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- BREAD CRUMB -->
<div class="breadcome-area mg-t-40 mg-b-30" style="margin-bottom: 10px;">
    <div class="container">
        <div class="row" id="ksreach" style="display:none">

             <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top: 30px;
                    border-radius: 10px !important;">
                    <div class="breadcome-heading">
                        <div class="row">
                          <div class="col-sm-6">
                           <select style="width:100%" id="themelist" onchange="searchKnowladgeHub();"  class="form-control form-control-sm theme1 search_value cls_selection" >

                          <option value="0">Enter here to search theme</option>
                          @foreach($theme_list as $rows)
                            <option value="{{($rows->id)}}">{{$rows->name}}</option>
                          @endforeach
                        </select>
                          <!-- <span onclick="resetKnowladgeHub();" class="cus-btn input-group-addon btn-sm btn-primary"><i class="glyphicon glyphicon-refresh"></i></span> -->

                      <!-- </div> -->
                    </div>

                    <div class="col-sm-6">
                          <div class="input-group">
                              <input id="searchindi" onkeyup="searchKnowladgeHub()" style="background-color: #efeded;" type="text" class="form-control" placeholder="Enter Keyword here">
                            <ul id="ulshow" class="list-group" style="z-index: 2;
                                padding: 5px;
                                position: absolute;
                                background: white;
                                width: 100%; display:none;"></ul>
                                <span onclick="resetKnowladgeHub();" class="cus-btn input-group-addon btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i></span>

                          </div>
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
    <div class="welcome-adminpro-area knowladge-hub" >
        <div class="container">
          <!-- ROW 1 SEARCH  -->
<div class="row" style="margin-bottom:200px;">

 
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 2%;">
          <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-dark mb-0">Reports & Books</h5>
                  <span class="h2 font-weight-bold mb-0 text-dark">{{$knowladge_list_count}}</span>
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


      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-dark mb-0">Laws & Regulation</h5>
                  <span class="h2 font-weight-bold mb-0 text-dark">{{$law_regulation_list_count}}</span>
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



      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-dark mb-0">Articles & Perspectives</h5>
                  <span class="h2 font-weight-bold mb-0 text-dark">{{$article_list_count}}</span>
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


      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-dark mb-0">Data Sets</h5>
                  <span class="h2 font-weight-bold mb-0 text-dark">{{$data_set_list_count}}</span>
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


                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
                          <div class="card-body">
                            <div class="row">
                              <div class="col">
                                <h5 class="card-title text-uppercase text-dark mb-0">Infographic</h5>
                                <span class="h2 font-weight-bold mb-0 text-dark">{{$info_graphics_list_count}}</span>
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

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
                            <div class="card-body">
                              <div class="row">
                                <div class="col">
                                  <h5 class="card-title text-uppercase text-dark mb-0">Trainings</h5>
                                  <span class="h2 font-weight-bold mb-0 text-dark">{{$other_knowledge_list_count_train}}</span>
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


                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col">
                                    <h5 class="card-title text-uppercase text-dark mb-0">Booklets</h5>
                                    <span class="h2 font-weight-bold mb-0 text-dark">{{$other_knowledge_list_count_book}}</span>
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


                          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                              <div class="card card-stats mb-4 mb-xl-0" style="background-image: linear-gradient(to right, #c39de0 , #9898CC);">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col">
                                      <h5 class="card-title text-uppercase text-dark mb-0">Pamphlets/Posters</h5>
                                      <span class="h2 font-weight-bold mb-0 text-dark">{{$other_knowledge_list_count_pamp + $other_knowledge_list_count_post}}</span>
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
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-right:3%; margin-top:10px;height:1250px;background-image: linear-gradient(to right, #c39de0 , #9898CC);border-radius:2%">
        
            <h4 style="text-align: center;color:black"><u style="color:black">Select theme</u> 
            <button  class="btn btn-primary font-weight-bolder theme_button" type="submit" onclick="showMultipleThemesData(event,this);" style="display: none;float:right"><i class="fa fa-save"></i> Submit</button> </h4>
            <ul class="nav nav-tabs" style="margin-top: 20px;display:inline-grid">
                <li style="background: #a24187; padding: 10px;">
                    <h4 class="Inbox-category-ad" style="text-align: center;"> Themes</h4>
                </li>
                
                <li class="all_data" onclick="searchKnowladgeHub2(0);" ><a data-toggle="tab" href="#"><span class="inbox-icon"></span> All </a>
                </li>
                  @foreach($theme_list as $theme)
                  @php($uniqId = uniqId())    

                <li class="theme_list theme_list_active" value="{{encrypt($theme->id)}}" onclick="showMultipleThemeData(event,this)" >

                  <a style="font-size: 13px;" data-toggle="tab">
   
                    <img src="{{asset(EF::retriveFileLink($theme->image))}}" alt="" style="width:15%" ></img>
                  
                 &nbsp;   {{$theme->name}}
          
                  </a>
          
                </li>
                @endforeach

            </ul>
       
      </div>
     

      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style=" margin-top:10px;background-image: linear-gradient(to right, #c39de0 , #9898CC);padding: 20px;border-radius: 15px;">
          <div class="row show-results" >

                {!! $view !!}

          </div>
      </div>

      </div>
  
    </div>
    </div>
    @include('knowledge_hub.modals.add_report')
    @include('knowledge_hub.modals.add_article')
    @include('knowledge_hub.modals.add_data_set')
    @include('knowledge_hub.modals.add_info_graphic')
    @include('knowledge_hub.modals.add_other')
    @include('knowledge_hub.modals.add_law_regulation')

    <div id="modal_update_report">
    <div id="modal_update_article">
    <div id="modal_update_data_set">
    <div id="modal_update_other">
    <div id="modal_update_infographic">
    <div id="modal_update_law_regulation">

    @include('knowledge_hub.script')
    
    <script type="text/javascript">
function onFetchFormModal(event,route,target_model,bind_model)
	{
  		showLoader();

		event.preventDefault();

		$.get(route,function(data)
		{

			$(bind_model).html(data);

			$(target_model).modal('show');

  			removeLoader();

	

		});
	}
 
    </script>
      <script>


      @if(Session::get('tagname') != null)

      var my = "{{Session::get('tagname')}}";
      var lastChar = my[my.length -1];
      var neid = "act"+lastChar;
      var element = document.getElementById(my);
      var element2 = document.getElementById("tab1");
      var element3 = document.getElementById(neid);
      var element4 = document.getElementById("act1");
        element4.classList.remove("active");
        element2.classList.remove("in");
        element2.classList.remove("active");
        element.classList.add("in");
        element.classList.add("active");
        element3.classList.add("active");
      @endif
      </script>
      <script>

      function showsearch2()
      {
        var x = document.getElementById("ksreach");
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
      }

 
      </script>

@endsection