@extends('layouts.master')

@section('styles')
<style>

.header-card{
    background-image: linear-gradient(to right, #6C6FE8, #966FE4);
    padding:3%;
    color:white;
    text-align:left

}
.login{
    margin-top:90px;
    border:1px solid grey;
    margin-left:5%;
    padding-bottom:2%;
    text-align:center;
    box-shadow:cadetblue;
}
</style>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-7 login" style="">
        <div class="row">
            <div class="col-md-12 header-card" style="">
                <b>{{ __('Reset Password') }} </b> 

            </div>
            <div class="col-lg-12" style="margin-top:1%">
                <div class="basic-login-inner" >
                <form method="POST" action="{{ route('forget.password.email') }}">
                        @csrf
                        <div class="form-group-inner">
                            <div class="row">
                                <!-- <div class="col-lg-4">

                                </div> -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="float:left" class="login2">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                   
                        <div class="login-btn-inner">
                            
                            <div class="row" style="margin-top: 6%;">
                                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                <div class="login-horizental">
                                <button type="submit" class="btn btn-primary" style="background-image: linear-gradient(to right, #6C6FE8, #966FE4);color:white;">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                                </div>
                            </div>
                                
                            </div>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



{{--


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
--}}
@endsection
