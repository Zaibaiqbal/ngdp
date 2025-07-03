<div id="subThemeupdate" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Update Sub Theme</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <form method="Post" action="{{route('subtheme.update')}}">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                    <label class="pull-left">Name<span style="color:red">*</span></label>
                    <input class="form-control" type="text" name="name" id="subthemenme" required>
                    <input type="hidden" name="subtheme" id="subthemeid" required>
                    <input type="hidden" name="theme" id="subthemenme_themeid" required>
                   </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-success" value="Update Sub Theme"></input>
            </div>
            </form>
        </div>
    </div>
</div>
