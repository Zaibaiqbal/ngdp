<div id="deleteIndi" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Add Indicator Info</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <form method="Post" action="{{ route('deleteIndicator')}}">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                    <h4>Are you sure you want to Delete Indicator ?</h4>
                   </div>
                   <input value="{{Crypt::encrypt($indicator->id)}}" type="hidden" name="indicator_id"/>


                  </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-success" value="Delete Indicator"></input>
            </div>
            </form>
        </div>
    </div>
</div>
