@php($uniqid = uniqid())
<!-- REPORTS MODALS  -->
 <div id="md_add_report" class="modal modal-adminpro-general default-popup-PrimaryModal fadeIn" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="form_add_report"  enctype="multipart/form-data" method="Post" action="{{route('store.knowladge')}}">
          @csrf
            <div class="modal-header header-color-modal" style="background-color: #BCA0D8;">
                <h4 class="modal-title" style="display: inline-flex;">Upload Report</h4>
               
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
                        <select  class="form-control form-control-sm cls_selection theme_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
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
                        <select  class="form-control cls_selection form-control-sm sub_theme_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
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

                    @php($name  = 'publication_date')
                    @php($label = 'Publication Date')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                         <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                          <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="date" class="form-control cls_date form-control-sm publish_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'author')
                    @php($label = 'Author(s)')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                         <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                                  <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm cls_required author_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'organization')
                    @php($label = 'Organization / Institution')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                         <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                                  <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm cls_required author_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'summary')
                    @php($label = 'Abstract / Summary')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                         <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                                  <small class="text-danger form-errors  " value="">{{ $errors->first($name,":message") }}</small>
                        <textarea  id="summernote1" type="text" class="form-control form-control-sm summary_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">{{old($name)}}</textarea>
                      </div>
                    </div>

                    @php($name  = 'source')
                    @php($label = 'Source')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                                  <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control cls_required form-control-sm title_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'thumbnail')
                    @php($label = 'Thumbnail')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                         <label for="example-text-input">{{$label}}  <i style = "color:red;"></i> <small style="color: red;">Maximum image size:2 MB</small>
                         </label>
                                  <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="file" class="form-control form-control-sm logo_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'pdf')
                    @php($label = 'File')

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                          <label for="example-text-input">{{$label}}  <i style = "color:red;"></i> <small style="color: red;">Maximum file size:100 MB</small></label>
                                  <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="file" class="form-control form-control-sm pdf_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="tagname" value="tab1"></input>
            <div class="modal-footer">
              <button class="btn btn-primary"  data-dismiss="modal">Close</button>
                <button onclick="storeReport(event,this);" class="btn btn-info">Submit</button>
            </div>
            </form>
        </div>
    </div>
  </div>

<!-- END REPORTS MODALS -->
