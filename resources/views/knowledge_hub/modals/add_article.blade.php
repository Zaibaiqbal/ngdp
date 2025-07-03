@php($uniqid = uniqid())
<!-- REPORTS MODALS  -->
 <div id="md_add_article" class="modal modal-adminpro-general default-popup-PrimaryModal fadeIn" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="form_add_article" enctype="multipart/form-data" method="Post" action="{{route('store.article')}}">
          @csrf
            <div class="modal-header header-color-modal" style="background-color: #BCA0D8;">
                <h4 class="modal-title" style="display: inline-flex;">Add Article</h4>
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body" style="margin: 30px; padding:0; text-align: left !important;">
                <div class="row">

                    @php($name  = 'knowledge_theme')
                    @php($label = 'Select Theme')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <select onchange="getSubTheme('{{$uniqid}}')" class="form-control form-control-sm theme_{{$uniqid}} cls_selection"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                          <option value="{{Crypt::encrypt(0)}}"> {{$label}}</option>
                          @foreach($theme_list as $rows)
                            <option value="{{Crypt::encrypt($rows->id)}}">{{$rows->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
{{--
                    @php($name  = 'sub_theme')
                    @php($label = 'Select Sub Theme')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <select  class="form-control form-control-sm cls_selection sub_theme_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                          <option value="{{Crypt::encrypt(0)}}">{{$label}}</option>
                          @foreach($theme_list as $rows)
                            <option value="{{Crypt::encrypt($rows->id)}}">{{$rows->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
--}}
                    @php($name  = 'title')
                    @php($label = 'Title')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>


                    @php($name  = 'source')
                    @php($label = 'Source')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'author')
                    @php($label = 'Author(s)')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  " value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'author_affilication')
                    @php($label = 'Author Affiliation')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  " value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'year')
                    @php($label = 'Publication Date')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>

                        <input type="date" class="form-control cls_required form-control-sm sub_theme_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">

                           <!-- <select  class="form-control form-control-sm cls_selection sub_theme_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                          <option value="0">{{$label}}</option>
                           @for($i = 1970; $i <= date('Y'); $i++ )
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select> -->
                      </div>
                    </div>


                    @php($name  = 'volume')
                    @php($label = 'Volume(s)')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'issue')
                    @php($label = 'Issue(s)')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                     @php($name  = 'page')
                    @php($label = 'Page(s)')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'isbn')
                    @php($label = 'ISSN / ISBN')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                          <label for="example-text-input">File  <i style = "color:red;"></i> <small style="color: red;">Maximum file size:100 MB</small></label>
                                  <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="file" class="form-control form-control-sm pdf_{{$uniqid}}"  name="pdf" value="{{old($name)}}" placeholder="File">
                      </div>
                    </div>


                </div>
            </div>
            <input type="hidden" name="tagname" value="tab2"></input>
            <div class="modal-footer">
              <button class="btn btn-primary"  data-dismiss="modal">Close</button>
                <button class="btn btn-info" onclick="storeArticle(event,this);">Submit</button>
            </div>
            </form>
        </div>
    </div>
  </div>

<!-- END REPORTS MODALS -->
