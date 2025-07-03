@php($uniqid = uniqid())
<!-- REPORTS MODALS  -->
 <div id="md_update_report" class="modal modal-adminpro-general default-popup-PrimaryModal fadeIn" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="form_update_report" enctype="multipart/form-data" method="Post" action="{{route('update.knowladge')}}">
          @csrf
            <div class="modal-header header-color-modal" style="background-color: #BCA0D8;">
                <h4 class="modal-title" style="display: inline-flex;">Update Report</h4>
               
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
                        <select  class="form-control form-control-sm theme_{{$uniqid}} cls_selection"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                          <option value="{{Crypt::encrypt(0)}}">Select {{$label}}</option>
                          @foreach($theme_list as $rows)
                            <option @if($knowladge->knowledge_theme_id == $rows->id) selected @endif value="{{Crypt::encrypt($rows->id)}}">{{$rows->name}}</option>
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
                        <select  class="form-control cls_selection form-control-sm sub_theme_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                          <option value="{{Crypt::encrypt(0)}}">{{$label}}</option>
                           @foreach($knowladge->subTheme->theme->subTheme as $rows)
                            <option @if($knowladge->sub_theme_id == $rows->id) selected @endif value="{{Crypt::encrypt($rows->id)}}">{{$rows->name}}</option>
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
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{($knowladge->title)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'publication_date')
                    @php($label = 'Publication Date')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="date" class="form-control cls_date form-control-sm publish_{{$uniqid}}"  name="{{$name}}" value="{{$knowladge->publication_date}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'author')
                    @php($label = 'Author(s)')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm cls_required author_{{$uniqid}}"  name="{{$name}}" value="{{($knowladge->author)}}" placeholder="{{$label}}">
                      </div>
                    </div>
{{--
                    @php($name  = 'short_description')
                    @php($label = 'Short Description')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <textarea type="text" class="form-control cls_required form-control-sm short_description_{{$uniqid}}"  name="{{$name}}"  placeholder="{{$label}}">{{($knowladge->short_description)}}
                        </textarea>
                      </div>
                    </div>
--}}
                    @php($name  = 'organization')
                    @php($label = 'Organization / Institution')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                         <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                                  <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm cls_required author_{{$uniqid}}"  name="{{$name}}" value="{{($knowladge->organization)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'summary')
                    @php($label = 'Abstract / Summary')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  " value="">{{ $errors->first($name,":message") }}</small>
                        <textarea  id="summernote_rep" type="text" class="form-control form-control-sm summary_{{$uniqid}}"  name="{{$name}}" >{!! $knowladge->summary !!}</textarea>
                      </div>
                    </div>

                    @php($name  = 'source')
                    @php($label = 'Source')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{($knowladge->url)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'thumbnail')
                    @php($label = 'Thumbnail')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i>
                          <small style="color: red;">Maximum image size:2 MB</small>
                        </label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="file" class="form-control form-control-sm logo_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'pdf')
                    @php($label = 'File')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i>
                          <small style="color: red;">Maximum file size:100 MB</small>
                        </label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="file" class="form-control form-control-sm pdf_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="knowladge_hub" value="{{Crypt::encrypt($knowladge->id)}}">
              <button class="btn btn-primary"  data-dismiss="modal">Close</button>
                <button class="btn btn-info" onclick="updateReport(event,this);">Update</button>
            </div>
            </form>
        </div>
    </div>
  </div>

<script type="text/javascript">
  $('#summernote_rep').summernote({
    height: 200,
  });
</script>

<!-- END REPORTS MODALS -->
