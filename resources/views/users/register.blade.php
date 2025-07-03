@extends('layouts.master')

@section('styles')
<style>

  #map {
    width: 600px;
    height: 400px;
  }

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

@endsection

@section('content')<!-- Breadcome start-->
<div class="breadcome-area mg-b-30"  >
    <div class="container">
        <div class="row" >
            <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset" style="margin-top: 30px;
                    border-radius: 10px !important;">
                    <div class="breadcome-heading">
                        <h2>Register User</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcome End-->
<div class="adminpro-accordion-area">
    <div class="container">

        <div class="row" style="background:white; padding:20px; border-radius:10px;">
          <form method="post" action="{{ route('reguser')}}">
          <div class="col-md-12">
            <label>Name<span style="color:red">*</span></label>
            <input type="text" required name="name" class="form-control"></input>
          </div>

          <!-- <div class="col-md-12">
            <label>Father's Name</label>
            <input type="text" required name="name" class="form-control"></input>
          </div> -->

          <!-- <div class="col-md-12">
            <label>Username</label>
            <input type="text" required name="usernname" class="form-control"></input>
          </div> -->

          <div class="col-md-12">
            <label>Email<span style="color:red">*</span></label>
            <input type="email" required name="email" class="form-control"></input>
          </div>

          {{ csrf_field()}}

          <div class="col-md-12">
            <label>Gender<span style="color:red">*</span></label>
            <select class="form-control" required name="gender">
              <option>Male</option>
              <option>Female</option>
              <option>Others</option>
            </select>
          </div>

          <div class="col-md-12">
            <label>Role<span style="color:red">*</span></label>
            <select class="form-control" required name="role">
              @foreach($roles as $role)
              <option value="{{$role->name}}">{{$role->name}}</option>
              @endforeach
            </select>
          </div>

          <!-- <div class="col-md-12">
            <label>CNIC<span style="color:red">*</span></label>
            <input type="text" required name="cnic" required class="form-control"></input>
          </div> -->

          <div class="col-md-12">
            <label>Address</label>
            <textarea type="text" name="address" class="form-control"></textarea>
          </div>


          <div class="col-md-12" style="margin-top:20px;">
            <input type="submit"  class="btn btn-success" value="Create New User" />
          </div>
        </form>
        </div>
    </div>
</div>

@endsection


@section('scripts')
@endsection
