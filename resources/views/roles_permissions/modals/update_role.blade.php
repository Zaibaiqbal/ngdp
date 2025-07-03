
        @php($uniqid = uniqid())
<!-- REPORTS MODALS  -->
 <div id="md_update_role" class="modal modal-adminpro-general default-popup-PrimaryModal fadeIn" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            {{ Form::open(['route' => 'update.role', 'enctype' => 'multipart/form-data', 'class' => 'cls_form']) }}
          
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Update Role   <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a></h4>
                <div class="modal-close-area modal-close-df">
                  
                </div>
            </div>
            <div class="modal-body" style="margin: 30px; padding:0; text-align: left !important;">
                <div class="row">
                       @php($name  = 'name')
                        @php($label = 'Name')

                        <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                                            <small class="text-danger form-errors  req" value="*">{{ $errors->first($name,":message") }}</small>
                                            <input required="true" type="text" class="form-control form-control-sm cls_required" id="example-text-input" name="{{$name}}" value="{{($role->name)}}" placeholder="{{$label}}">
                                        </div>
                                    </div>

                  
                   
                </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="role" value="{{Crypt::encrypt($role->id)}}">

              <button class="btn btn-primary"  data-dismiss="modal">Close</button>
                <button class="btn btn-info cls_submit" content="update role">Update</button>
            </div>
            {{ Form::close() }}
            
        </div>
    </div>
  </div>

<!-- END REPORTS MODALS -->