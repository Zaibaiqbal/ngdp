@php($uniqid = uniqid())
<!-- REPORTS MODALS  -->
 <div id="md_update_data_set" class="modal modal-adminpro-general default-popup-PrimaryModal fadeIn" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="form_update_data_set" enctype="multipart/form-data" method="Post" action="{{route('update.data_set')}}">
          @csrf
            <div class="modal-header header-color-modal" style="background-color: #BCA0D8;">
                <h4 class="modal-title" style="display: inline-flex;">Update Data Set</h4>
                
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
                          <option value="{{Crypt::encrypt(0)}}">Select {{$label}}</option>
                          @foreach($theme_list as $rows)
                            <option @if($data_set->knowledge_theme_id == $rows->id) selected @endif value="{{Crypt::encrypt($rows->id)}}">{{$rows->name}}</option>
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
                           @foreach($data_set->subTheme->theme->subTheme as $rows)
                            <option @if($data_set->sub_theme_id == $rows->id) selected @endif value="{{Crypt::encrypt($rows->id)}}">{{$rows->name}}</option>
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
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{($data_set->title)}}" placeholder="{{$label}}">
                      </div>
                    </div>


                     @php($name  = 'summary')
                    @php($label = 'Abstract / Summary')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <textarea type="text" class="form-control  form-control-sm short_description_{{$uniqid}}"  name="{{$name}}"  placeholder="{{$label}}">{{($data_set->summary)}}
                        </textarea>
                      </div>
                    </div>

                    @php($name  = 'institution')
                    @php($label = 'Organization/Institution')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}} </label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm year_{{$uniqid}}"  name="{{$name}}"  value="{{($data_set->institution)}}" placeholder="{{$label}}">
                      </div>
                    </div>
                    @php($name  = 'source')
                    @php($label = 'Source')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm cls_required title_{{$uniqid}}"  name="{{$name}}" value="{{($data_set->url)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'new_year')
                    @php($label = 'Year')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}} </label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm year_{{$uniqid}}"  name="{{$name}}"  value="{{($data_set->new_year)}}" placeholder="{{$label}}">
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
              <input type="hidden" name="data_set" value="{{Crypt::encrypt($data_set->id)}}">
              <button class="btn btn-primary"  data-dismiss="modal">Close</button>
                <button class="btn btn-info" onclick="updateDataset(event,this);">Update</button>
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
