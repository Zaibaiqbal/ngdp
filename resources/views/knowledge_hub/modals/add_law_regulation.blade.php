@php($uniqid = uniqid())
<!-- REPORTS MODALS  -->
 <div id="md_add_law_regulation" class="modal modal-adminpro-general default-popup-PrimaryModal fadeIn" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="form_add_law_regulation" enctype="multipart/form-data" method="Post" action="{{route('store.law_regulation')}}">
          @csrf
            <div class="modal-header header-color-modal" style="background-color: #BCA0D8;">
                <h4 class="modal-title" style="display: inline-flex;">Add Law And Regulation</h4>
               
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

                    @php($name  = 'summary')
                    @php($label = 'Abstract / Summary')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}}  <i style = "color:red;"></i></label>
                        <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <textarea type="text" class="form-control  form-control-sm short_description_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">{{old($name)}}</textarea>
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

                    @php($name  = 'institution')
                    @php($label = 'Organization/Institution')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}} </label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm institution_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    @php($name  = 'new_year')
                    @php($label = 'Year')

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="example-text-input">{{$label}} </label>
                        <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input type="text" class="form-control form-control-sm year_{{$uniqid}}"  name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                          <label for="example-text-input">File  <i style = "color:red;"></i> <small style="color: red;">Maximum file size:100 MB</small></label>
                                  <small class="text-danger form-errors  req" value="">{{ $errors->first($name,":message") }}</small>
                        <input type="file" class="form-control form-control-sm pdf_{{$uniqid}}"  name="pdf" value="{{old($name)}}" placeholder="File">
                      </div>
                    </div>

                   <input type="hidden" name="tagname" value="tab6"></input>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary"  data-dismiss="modal">Close</button>
                <button class="btn btn-info" onclick="storeLawRegulation(event,this);">Submit</button>
            </div>
            </form>
        </div>
    </div>
  </div>

<!-- END REPORTS MODALS -->
