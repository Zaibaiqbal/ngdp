<div id="ajaxlogin" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-user"></i>Login</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>


            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="basic-login-inner" style="text-align: center;">
                            <h3>Sign In</h3>
                            <p>You need to Signin to proceed further</p>
                            <form method="POST" class="login" action="{{ url('/loginAjax') }}" method="post" data-type="json">
                                @csrf
                                <div class="form-group-inner">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label class="login2">Email</label>
                                        </div>
                                        <div class="col-lg-8">
                                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group-inner">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label class="login2">Password</label>
                                        </div>
                                        <div class="col-lg-8">
                                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                          </div>
                                    </div>
                                </div>
                                <div class="login-btn-inner">
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <div class="i-checks">
                                                <label>
                                                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><i></i> Remember me </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <div class="login-horizental">
                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Sign In</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>

            </div>

        </div>
    </div>
</div>
