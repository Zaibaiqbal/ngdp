<div id="changerole" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Change Role  <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a></h4>
                <div class="modal-close-area modal-close-df">
                   
                </div>
            </div>

            <form method="Post" action="{{ route('changerole')}}">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                    <h4>Are you sure you want to change user role ?</h4>
                   </div>

                   <div class="col-md-12">
                     <label>Role<span style="color:red">*</span></label>
                     <select class="form-control" required name="role">
                       @foreach($roles as $role)
                       <option value="{{$role->name}}">{{$role->name}}</option>
                       @endforeach
                     </select>
                   </div>
                   <input  type="hidden" id="user_id" name="user_id"/>


                  </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-success" value="Change"></input>
            </div>
            </form>
        </div>
    </div>
</div>
