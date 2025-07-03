<div id="deletesubTheme" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Delete Sub Theme</h4>
            </div>

            <form method="Post" action="{{route('subthemetrash')}}">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                      <h4>Are you sure you want to delete this sub theme?</h4>
                      <p>NOTE: All related data will also be removed.</p>
                    <input type="hidden" name="subtheme" id="deletesubthemeid">
                   </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Delete SubTheme"></input>
            </div>
            </form>
        </div>
    </div>
</div>
