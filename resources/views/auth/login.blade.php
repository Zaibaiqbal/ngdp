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
                <b> SIGN IN </b> 

            </div>
            <div class="col-lg-12" style="margin-top:1%">
                <div class="basic-login-inner" >
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group-inner">
                            <div class="row">
                                <!-- <div class="col-lg-4">

                                </div> -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="float:left" class="login2">Email</label>
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
                            <div class="row" style="margin-top: 3%;">
                                <!-- <div class="col-lg-4">

                                </div> -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="float:left" class="login2">Password</label>
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
                                    <div class="">
                                        <a href="{{route('password.request')}}" style="float:right;margin-top: 2%;"><i></i> Forget Password </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 6%;">
                                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                <div class="login-horizental">
                                    <button style="width:50%; background-image: linear-gradient(to right, #6C6FE8, #966FE4);color:white;"  class="btn btn-sm btn-primary" type="submit" id="loginbtn">LOG IN</button>
                                </div></div>
                                
                            </div>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
