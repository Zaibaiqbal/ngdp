<div id="modal_change_password" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Change Password   <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a></h4>
                <div class="modal-close-area modal-close-df">
                  
                </div>
            </div>

            <form method="POST" action="{{ route('change.password') }}">
            @csrf
            <div class="modal-body">

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <input type="hidden" value="{{encrypt($register->id)}}" name="user_id">
            <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
            <input type="submit" class="btn btn-success" value="Approve"></input>
            </div>
            </form>

            
        </div>
    </div>
</div>
