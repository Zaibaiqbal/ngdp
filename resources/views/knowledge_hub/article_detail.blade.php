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
<!-- BREAD CRUMB -->
<div class="breadcome-area mg-t-40 mg-b-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
              <div class="">
                  <table>
                      
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- END BREAD CRUMB -->


 <!-- welcome Project, sale area start-->
    <div class="welcome-adminpro-area knowladge-hub">
        <div class="container">
            <!-- ROW 1 SEARCH  -->
            <div class="row">
                 <div class="col-lg-12">
                    <div class="sparkline8-list shadow-reset">
                        <div class="sparkline8-hd">
                            <div class="main-sparkline8-hd">
                                <h1>Article Information</h1>
                                <div class="sparkline8-outline-icon">
                                    <span class="sparkline8-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="sparkline8-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">
                              
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">
                                   
                                    <tbody>
                                            <tr>
                                <td style="width: 35%; font-weight: bold;">Themes</td>
                                <td>{{$article->knowledgeTheme->name}}</td>
                            </tr>
                             <tr>
                                <td style="width: 35%; font-weight: bold;">Title</td>
                                <td>{{$article->title}}</td>
                            </tr>
                           
                             <tr>
                                <td style="width: 35%; font-weight: bold;">Author(s)</td>
                                <td>
                                    {{$article->author}}
                                </td>
                            </tr>

                             <tr>
                                <td style="width: 35%; font-weight: bold;">Author Affiliation</td>
                                <td>
                                    {{$article->author_affilication}}
                                </td>
                            </tr>

                              <tr>
                                <td style="width: 35%; font-weight: bold;">Year(s)</td>
                                <td>
                                    {{$article->year}}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 35%; font-weight: bold;">Volume(s)</td>
                                <td>
                                    {{$article->volume}}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 35%; font-weight: bold;"> Issue(s)</td>
                                <td>
                                    {{$article->issues}}
                                </td>
                            </tr>

                                <tr>
                                <td style="width: 35%; font-weight: bold;"> Pages(s)</td>
                                <td>
                                    {{$article->pages}}
                                </td>
                            </tr>

                                <tr>
                                <td style="width: 35%; font-weight: bold;">ISSN / ISBN </td>
                                <td>
                                    {{$article->isbn}}
                                </td>
                            </tr>
                             <tr>
                                <td style="width: 35%; font-weight: bold;">Source</td>
                                <td>
                                    <a target="_blank" href="{{$article->url}}">Click Here</a>
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection