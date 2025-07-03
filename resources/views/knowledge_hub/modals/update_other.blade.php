@php($uniqid = uniqid())
<!-- REPORTS MODALS  -->
 <div id="md_update_other" class="modal modal-adminpro-general default-popup-PrimaryModal fadeIn" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="form_update_other" enctype="multipart/form-data" method="Post" action="{{route('update.otherknowledge')}}">
          @csrf
            <div class="modal-header header-color-modal" style="background-color: #BCA0D8;">
                <h4 class="modal-title" style="display: inline-flex;">Update Other</h4>
               
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
                            <option @if($other->knowledge_theme_id == $rows->id) selected @endif value="{{Crypt::encrypt($rows->id)}}">{{$rows->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
     @php($name  = 'type')
                    @php($label = 'Select Type')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <select class="form-control form-control-sm theme_{{$uniqid}} cls_selection"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                          <option value="{{Crypt::encrypt(0)}}">Select {{$label}}</option>
                          @foreach(EF::getOtherKnowladgeList() as $rows)
                            <option @if($rows == $other->type) selected @endif value="{{$rows}}">{{$rows}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    @php($name  = 'title')
                    @php($label = 'Title')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{($other->title)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                     @php($name  = 'source')
                    @php($label = 'Source')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{($other->url)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'institution')
                    @php($label = 'Organization/Institution')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}} </label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm year_{{$uniqid}}"  name="{{$name}}"  value="{{($other->institution)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'new_year')
                    @php($label = 'Year')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}} </label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm year_{{$uniqid}}"  name="{{$name}}"  value="{{($other->new_year)}}" placeholder="{{$label}}">
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
              <input type="hidden" name="other_knowledge" value="{{Crypt::encrypt($other->id)}}">
              <button class="btn btn-primary"  data-dismiss="modal">Close</button>
                <button class="btn btn-info" onclick="updateOtherKnowledge(event,this);">Update</button>
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
