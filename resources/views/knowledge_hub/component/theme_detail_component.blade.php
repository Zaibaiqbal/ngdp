
@if((isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','View Data','All','Add / Edit / Delete Data'])) || !isset(Auth::user()->id))
<div class="col-lg-12">

    <div class="tab-content">
    <div class="panel-group adminpro-custon-design" id="accordion">

    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab1" style="color:black;">Reports and Books ({{$knowladge_hub_list->count()}})</a>
                </h4>
            </div>
        </div>
    </div>

    <div id="tab1" class="panel-collapse panel-ic collapse  in ">
        <div class="panel-body admin-panel-content animated bounce">

            <div class="row" style="padding: 10px;">
                <!-- RESULT PART -->
                <div class="col-sm-12 col-md-12 col-lg-12" >
                <b>	Showing results {{@count($knowladge_hub_list)}} of {{@count($knowladge_hub_list)}}</b>

                        @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )
                        <button data-toggle="modal" data-target="#md_add_report" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                        @endif
                    <hr>
                </div>
                <!-- END RESULT PART -->

                @foreach($knowladge_hub_list as $rows)
                <!-- IMAGE PART -->
                <div class="col-sm-12 col-md-2 col-lg-2" >
                    <a  href="{{route('knowledgehubdetail',['id' => Crypt::encrypt($rows->id)])}}" target="_blank">
                        <img onerror="this.src='{{asset("/graphics/na-image.png")}}'" width="100px" height="150px" class="img-responsive" src="{{asset(EF::retriveFileLink($rows->thumbnail))}}">
                    </a>

                </div>
                <!-- END IMAGE PART -->

                <!-- TEXT PART -->
                <div class="col-sm-12 col-md-10 col-lg-10">
                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-12" style="word-wrap: break-word;">

                        <!-- <span>SERIAL</span><br> -->
                        <a  href="{{route('knowledgehubdetail',['id' => Crypt::encrypt($rows->id)])}}" target="_blank">
                        <h4 style="color:#3a3535 !important">	{{$rows->title}}</h4>

                            <p style="width: 90%; text-align: justify;text-justify: inter-word;">
                                {!! $rows->summary !!}
                            </p>
                        </a>


                    </div>
                    </div>

                        <div class="row">
                            <div class="col-sm-12">
                        @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                                    <a content="delete report" href="{{route('removeknowledgehub',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete">
                                        <span class="fa fa-trash"></span></a>

                                    @php($route = route('update.knowladge',['id' => Crypt::encrypt($rows->id)]))
                                    <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_report','#modal_update_report');" class="btn-sm btn-primary pull-right">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    @endif
                            </div>
                        </div>
                    <hr>
                </div>
                <!-- END TEXT PART -->


            @endforeach

            @if($knowladge_hub_list instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="col-sm-12">
                <div class="pull-right">
                {{$knowladge_hub_list->links()}}
                </div>
            </div>
            @endisset

            </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab6" style="color:black;">Laws and Regulations ({{$law_and_regulation_list->count()}})</a>
                </h4>
            </div>
        </div>
    </div>

    <div id="tab6" class="panel-collapse panel-ic collapse">
        <div class="panel-body admin-panel-content animated bounce">
        <div class="row" style="padding: 10px;">

            <div class="col-sm-12">
                <b> Showing results {{@count($law_and_regulation_list)}} of {{@count($law_and_regulation_list)}}</b>
                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                <button data-toggle="modal" data-target="#md_add_law_regulation" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                @endif
                <hr>
            </div>

            @foreach($law_and_regulation_list as $rows)
            <div class="col-sm-12" style="word-wrap: break-word;">
                <h4><a target="_blank" style="color:#3a3535;" href="{{url('lawdetail',['id' => Crypt::encrypt($rows->id)])}}" >{{$rows->title}}</a></h4>

            </div>

            <div class="col-sm-12" style="word-wrap: break-word;">
                <p style="text-align: justify;text-justify: inter-word;">
                    {!! EF::textWrapping($rows->short_description) !!}

                </p>
            </div>

            <div class="col-sm-12">

                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                <a content="delete law and regulation" href="{{route('removelawregulations',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete">
                    <span class="fa fa-trash"></span></a>

                @php($route = route('update.law_regulation',['id' => Crypt::encrypt($rows->id)]))
                <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_law_regulation','#modal_update_law_regulation');" class="btn-sm btn-primary pull-right">
                    <span class="fa fa-pencil"></span>
                </a>
                @endif
            </div>

            <div class="col-sm-12">
                <hr>
            </div>
            @endforeach

            @if($law_and_regulation_list instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="col-sm-12">
                <div class="pull-right">
                {{$law_and_regulation_list->links()}}
                </div>
            </div>
            @endisset



            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab2" style="color:black;">Articles and Perspectives ({{$article_list->count()}})</a>
                </h4>
            </div>
        </div>
    </div>

    <div id="tab2" class="panel-collapse panel-ic collapse">
        <div class="panel-body admin-panel-content animated bounce">
                <div class="row" style="padding: 10px;">

                <div class="col-sm-12">
                <b>  Showing results {{@count($article_list)}} of {{@count($article_list)}} </b>
                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                    <button data-toggle="modal" data-target="#md_add_article" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                    @endif

                    <hr>
                </div>

                @foreach($article_list as $rows)
                <div class="col-sm-12" style="word-wrap: break-word;">
                    <h4><a target="_blank" style="color:#3a3535;" href="{{url('articledetail',['id' => Crypt::encrypt($rows->id)])}}">{{ucwords($rows->title)}}</a></h4>

                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                        <a href="{{route('removearticle',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete" content="delete article">
                                    <span class="fa fa-trash"></span></a>

                                @php($route = route('update.article',['id' => Crypt::encrypt($rows->id)]))
                                <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_article','#modal_update_article');" class="btn-sm btn-primary pull-right">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                @endif

                                <!-- <a style="margin: 2px;"   class="btn-sm btn-primary pull-right">
                                    <span class="fa fa-eye"></span>
                                </a> -->
                </div>
                <div class="col-sm-12">
                    <hr>
                </div>
                @endforeach

                @if($article_list instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="col-sm-12">
                    <div class="pull-right">
                    {{$article_list->links()}}
                    </div>
                </div>
                @endisset





                </div>
            </div>
    </div>





    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab3" style="color:black;">Data Sets ({{$data_set_list->count()}})</a>
                </h4>
            </div>
        </div>
    </div>


    <div id="tab3" class="panel-collapse panel-ic collapse">
        <div class="panel-body admin-panel-content animated bounce">
            <div class="row" style="padding: 10px;">

                <div class="col-sm-12">
                <b> Showing results {{@count($data_set_list)}} of {{@count($data_set_list)}} </b>
                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                    <button data-toggle="modal" data-target="#md_add_data_set" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                    @endif
                    <hr>
                </div>

                @foreach($data_set_list as $rows)
                <div class="col-sm-12" style="word-wrap: break-word;">
                    <h4><a  target="_blank" style="color:#3a3535;" href="{{url('datadetail',['id' => Crypt::encrypt($rows->id)])}}"  >{{$rows->title}}</a></h4>

                </div>

                <div class="col-sm-12" style="word-wrap: break-word;">
                    <p style="text-align: justify;text-justify: inter-word;">
                        {!! EF::textWrapping($rows->short_description) !!}

                    </p>
                </div>

                <div class="col-sm-12">
                    {{--
                    <a  target="_blank" href="{{$rows->url}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right">
                                    <span class="fa fa-eye"></span></a>
                    --}}
                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                    <a content="delete data set" href="{{route('removedataset',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete">
                                    <span class="fa fa-trash"></span></a>

                                @php($route = route('update.data_set',['id' => Crypt::encrypt($rows->id)]))
                                <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_data_set','#modal_update_data_set');" class="btn-sm btn-primary pull-right">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                @endif
                </div>



                <div class="col-sm-12">
                    <hr>
                </div>
                @endforeach

                @if($data_set_list instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="col-sm-12">
                    <div class="pull-right">
                    {{$data_set_list->links()}}
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>



    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab4" style="color:black;">Infographics ({{$infographic_list->count()}})</a>
                </h4>
            </div>
        </div>
    </div>

    <div id="tab4" class="panel-collapse panel-ic collapse">
        <div class="panel-body admin-panel-content animated bounce">
    @php($image_list = ['info1.jpg','info2.jpg','info3.jpg','info4.png'])

            <div class="row" style="padding: 10px;">
                <div class="col-sm-12">
                <b> Showing results {{@count($infographic_list)}} of {{@count($infographic_list)}}</b>

                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                <button data-toggle="modal" data-target="#md_add_infographics" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                @endif

                <hr>
            </div>

            @foreach($infographic_list as $rows)
            {{--
            <div class="col-md-3">
                <div class="thumbnail">
                <a href="#" target="_blank">

                    <img onerror="this.src='{{asset("/graphics/na-image.png")}}'" src="{{asset(EF::retriveFileLink($rows->image))}}" alt="Lights" style="height: 300px; width: 100%;">

                </a>
                </div>
            </div>
            --}}


            <!-- IMAGE PART -->
        <div class="col-sm-12 col-md-2 col-lg-2">
            <a>
            <img onerror="this.src='{{asset("/graphics/na-image.png")}}'" width="100px" height="150px" class="img-responsive" src="{{asset(EF::retriveFileLink($rows->image))}}">
            </a>

        </div>
        <!-- END IMAGE PART -->

        <!-- TEXT PART -->
        <div class="col-sm-12 col-md-10 col-lg-10" style="word-wrap: break-word;">
            <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12" style="word-wrap: break-word;">

                <!-- <span>SERIAL</span><br> -->
                <a style="color:#3a3535;"  target="_blank" href="{{url('infodetail',['id' => Crypt::encrypt($rows->id)])}}"  >
                <h4 style="color:#3a3535 !important">{{$rows->title}}</h4>
                </a>
            </div>
            </div>

                <div class="row">
                    <div class="col-sm-12">
                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                            <a content="delete report" href="{{route('removeinfographic',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete">
                                <span class="fa fa-trash"></span></a>

                            @php($route = route('update.infographic',['id' => Crypt::encrypt($rows->id)]))
                            <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_infographic','#modal_update_infographic');" class="btn-sm btn-primary pull-right">
                                <span class="fa fa-pencil"></span>
                            </a>
                            @endif
                    </div>
                </div>
            <hr>
        </div>
        <!-- ENDdata TEXT PART -->
            @endforeach
            @if($infographic_list instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="col-sm-12">
                <div class="pull-right">
                {{$infographic_list->links()}}
                </div>
            </div>
            @endisset

            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab5" style="color:black;">Trainings ({{$training_knowledge_list->count()}})</a>
                </h4>
            </div>
        </div>
    </div>



    <div id="tab5" class="panel-collapse panel-ic collapse">
        <div class="panel-body admin-panel-content animated bounce">
            <div class="row" style="padding: 10px;">
                <div class="col-sm-12">
                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                    <button data-toggle="modal" data-target="#md_add_other" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                    @endif

                </div>
                <div class="col-sm-12"><hr></div>

                <div class="col-sm-12" style="word-wrap: break-word;">
                    <div class="tab-content custom-menu-content">

                        <div class="row" style="padding: 10px; border:1px sold #000;">

                            @foreach($training_knowledge_list as $rows)
                            <div class="col-sm-12" style="word-wrap: break-word;">

                                <h4><a style="color:#3a3535;"  target="_blank" href="{{url('otherdetail',['id' => Crypt::encrypt($rows->id)])}}" >{{ucwords($rows->title)}}</a></h4>

                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                                <a href="{{route('removeotherknowledge',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete" content="delete other">
                                            <span class="fa fa-trash"></span></a>

                                        @php($route = route('update.otherknowledge',['id' => Crypt::encrypt($rows->id)]))
                                        <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_other','#modal_update_other');" class="btn-sm btn-primary pull-right">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                    @endforeach
                        </div>
                    <!-- TAB TRACKING END MENUE -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab7" style="color:black;">Booklets ({{$booklets_knowledge_list->count()}})</a>

                </h4>
            </div>
        </div>
    </div>



    <div id="tab7" class="panel-collapse panel-ic collapse">
        <div class="panel-body admin-panel-content animated bounce">
                <div class="row" style="padding: 10px;">

                <div class="col-sm-12">
                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                    <button data-toggle="modal" data-target="#md_add_other" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                    @endif


                </div>
                <div class="col-sm-12"><hr></div>
                <div class="col-sm-12" style="word-wrap: break-word;">

                    <div class="tab-content custom-menu-content">

                        <div class="row" style="padding: 10px; border:1px sold #000;">

                            @foreach($booklets_knowledge_list as $rows)
                            <div class="col-sm-12" style="word-wrap: break-word;">

                            <h4>  <a style="color:#3a3535;"  target="_blank" href="{{url('otherdetail',['id' => Crypt::encrypt($rows->id)])}}" >{{ucwords($rows->title)}}</a></h4>

                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                                <a href="{{route('removeotherknowledge',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete" content="delete other">
                                            <span class="fa fa-trash"></span></a>

                                        @php($route = route('update.otherknowledge',['id' => Crypt::encrypt($rows->id)]))
                                        <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_other','#modal_update_other');" class="btn-sm btn-primary pull-right">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                    @endforeach
                        </div>
                        <!-- TAB TRACKING END MENUE -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab8" style="color:black;">Pamphlets ({{$pamphlets_knowledge_list->count()}})</a>

                </h4>
            </div>
        </div>
    </div>

    <div id="tab8" class="panel-collapse panel-ic collapse">
        <div class="panel-body admin-panel-content animated bounce">
                <div class="row" style="padding: 10px;">

                <div class="col-sm-12">
                    <!-- Showing results {{@count($other_knowledge_list)}} of {{@count($other_knowledge_list)}} -->
                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                    <button data-toggle="modal" data-target="#md_add_other" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                    @endif

                </div>
                <div class="col-sm-12"><hr></div>
                <div class="col-sm-12">


                    <div class="tab-content custom-menu-content">
                    <div class="row" style="padding: 10px; border:1px sold #000;">
                        @if($pamphlets_knowledge_list->count() > 0)
                            @foreach($pamphlets_knowledge_list as $rows)
                            <div class="col-sm-12" style="word-wrap: break-word;">

                            <h4>  <a style="color:#3a3535;" target="_blank" href="{{url('otherdetail',['id' => Crypt::encrypt($rows->id)])}}" >{{ucwords($rows->title)}}</a></h4>

                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                                <a href="{{route('removeotherknowledge',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete" content="delete other">
                                            <span class="fa fa-trash"></span></a>

                                        @php($route = route('update.otherknowledge',['id' => Crypt::encrypt($rows->id)]))
                                        <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_other','#modal_update_other');" class="btn-sm btn-primary pull-right">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                    @endforeach
                        @endif
                        </div>

                    <!-- TAB TRACKING END MENUE -->
                </div>

                </div>

                </div>
            </div>
    </div>




    <div class="panel panel-default">
        <div class="panel-heading accordion-head mycolorblack">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#tab9" style="color:black;">Posters ({{$posters_knowledge_list->count()}})</a>
                </h4>
            </div>
        </div>
    </div>

    <div id="tab9" class="panel-collapse panel-ic collapse">
        <div class="panel-body admin-panel-content animated bounce">
            <div class="row" style="padding: 10px;">

                <div class="col-sm-12">
                    <!-- Showing results {{@count($other_knowledge_list)}} of {{@count($other_knowledge_list)}} -->
                    @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                    <button data-toggle="modal" data-target="#md_add_other" type="button" class="btn btn-custon-four btn-primary pull-right"><span class="adminpro-icon adminpro-cloud-computing-down"></span> Upload</button>
                    @endif

                </div>
                <div class="col-sm-12"><hr></div>
                <div class="col-sm-12">

                    <div class="tab-content custom-menu-content">
                    <div class="row" style="padding: 10px; border:1px sold #000;">

                            @foreach($posters_knowledge_list as $rows)
                            <div class="col-sm-12">

                            <h4>  <a  style="color:dark;" target="_blank" href="{{url('otherdetail',['id' => Crypt::encrypt($rows->id)])}}" >{{ucwords($rows->title)}}</a></h4>

                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data']) )

                                <a href="{{route('removeotherknowledge',['id' => Crypt::encrypt($rows->id)])}}" style="margin: 2px;"  class="btn-sm btn-primary pull-right cls_delete" content="delete other">
                                            <span class="fa fa-trash"></span></a>

                                        @php($route = route('update.otherknowledge',['id' => Crypt::encrypt($rows->id)]))
                                        <a style="margin: 2px;"  onclick="onFetchFormModal(event,'{{$route}}','#md_update_other','#modal_update_other');" class="btn-sm btn-primary pull-right">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                        @endif
                                    </div>
                                    @endforeach

                        </div>
                    <!-- TAB TRACKING END MENUE -->
                </div>

                </div>

            </div>
        </div>
    </div>

    </div>
</div>
</div>
@endif
