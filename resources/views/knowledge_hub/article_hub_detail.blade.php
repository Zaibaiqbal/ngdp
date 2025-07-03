@extends('layouts.master')

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
</style>
@endsection
@section('content')
 <!-- welcome Project, sale area start-->
<div class="welcome-adminpro-area">
    <!-- CONTAINER -->
    <div class="container "  style="background-color: #b6c0cc;opacity:0.9;border-radius: 17px;">
        <!-- ROW -->

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
                     <div class="row">

                         <!-- COL -->
                        <div class="col-sm-12 col-md-10 col-lg-10">
                           

                            <div class="col-sm-12" style="word-wrap: break-word;">
                                <div class="form-group">
                                  <h4>   <a href="{{ route('knowledgehub')}}" > <i class="fa fa-arrow-left"></i></a> {{$knowladge->title}} </h4>
                                </div>
                            </div>

                             <div class="col-sm-12" style="word-wrap: break-word;">
                                <div class="form-group">
                                        <p  style="text-align: justify;text-justify: inter-word;">
                                            {!! EF::textWrapping($knowladge->summary) !!}
                                        </p>
                                </div>


                            </div>


                            <div class="col-sm-12" style="word-wrap: break-word;">
                                <div class="form-group">
                                    <strong>Source</strong><br>
                                    <a target="_blank" href="{{$knowladge->url}}">{{$knowladge->url}}</a>

                                </div>


                            </div>



                        </div>
                        <!-- END COL -->
                        <!-- COL -->
                        <div class="col-sm-12 col-md-2 col-lg-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group" style="margin-top:3%">

                                        @if($knowladge->thumbnail != null)
                                            <img onerror="this.src='{{asset("/graphics/na-image.png")}}'" width="150px" height="150px" class="img-responsive" src="{{asset(EF::retriveFileLink($knowladge->thumbnail))}}">
                                        @else
                                            <img onerror="this.src='{{asset("/graphics/na-image.png")}}'" width="150px" height="150px" class="img-responsive" src="{{asset(EF::retriveFileLink($knowladge->image))}}">
                                        @endif
                                    </div>
                                        <hr>
                                    </div>

                                    @if(isset(Auth::user()->id)  && Auth::user()->hasAnyPermission(['All','Download Data']))

                                    @if(file_exists(public_path().EF::retriveFileLink($knowladge->pdf)))
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <b>Downloads</b>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">

                                                <img style="float:left;" class="img-responsive" src="{{asset('/graphics/pdf.png')}}">
                                                <a target="_blank" href="{{asset(EF::retriveFileLink($knowladge->pdf))}}" style="float:left;padding-top: 5px;" href="#">Report.pdf</a>

                                        </div>
                                    </div>
                                    @endif

                                    @endif

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <!-- <small>6.339MB 272,318 downloads</small> -->

                                        </div>
                                    </div>





                                </div>
                        </div>
                        <!-- END COL -->

												<div class="col-md-12">
												<table class="table table-striped">
													@if($knowladge['publication_date'] != null)
													<tr>
													<th>Publication Date</th>
													<td>{{$knowladge['publication_date']}}</td>
													</tr>
													@endif


													@if($knowladge['author'] != null)
													<tr>
													<th>Author(s)</th>
													<td>{{$knowladge['author']}}</td>
													</tr>
													@endif


													@if($knowladge['volume'] != null)
													<tr>
													<th>Volumes</th>
													<td>{{$knowladge['volume']}}</td>
													</tr>
													@endif


													@if($knowladge['issues'] != null)
													<tr>
													<th>Issues</th>
													<td>{{$knowladge['issues']}}</td>
													</tr>
													@endif


													@if($knowladge['pages'] != null)
													<tr>
													<th>Pages</th>
													<td>{{$knowladge['pages']}}</td>
													</tr>
													@endif


													@if($knowladge['isbn'] != null)
													<tr>
													<th>ISBN</th>
													<td>{{$knowladge['isbn']}}</td>
													</tr>
													@endif
												</table>
												</div>

                    </div>

                </div>
            </div>
        </div>

        <!-- END ROW -->


    </div>


    <!-- END CONTAINRE -->
</div>
<!-- END WELCOME -->
@endsection
