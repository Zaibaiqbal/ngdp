@foreach($themes as $theme)
<div id="editTheme_{{$theme->id}}" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Update Theme</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <form method="Post" action="{{route('theme.update')}}" enctype="multipart/form-data">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                    <label class="pull-left">Name<span style="color:red">*</span></label>
                    <input class="form-control" type="text" name="name" value="{{$theme->name}}" required>
                    <input type="hidden" name="theme" value="{{Crypt::encrypt($theme->id)}}">
                   </div>

                   <div class="col-md-12">
                   <label class="pull-left">Icon<span style="color:red">*</span></label>
                   <input class="form-control" type="file" name="image">
                  </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-success" value="Update Theme"></input>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
