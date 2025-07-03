@extends('layouts.master')
@section('styles')
<style>

  #map {
    width: 600px;
    height: 400px;
  }

  /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.header-card{
    background-image: linear-gradient(to right, #6C6FE8, #966FE4);
    padding:3%;
    color:white;
    text-align:left

}
.login{
    margin-top:50px;
    border:1px solid grey;
    margin-left:5%;
    text-align:center;
    box-shadow:cadetblue;
}
@media only screen and (max-width: 600px) {
.main-section{
  margin-bottom:19%;
}
}
@media only screen and (min-width: 765px) {
.main-section{
  margin-bottom:6%;
}
}
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

@endsection

@section('content')<!-- Breadcome start-->

<div class="row main-section" style="">
    <div class="col-lg-5 col-md-5 col-sm-10 col-xs-10 login" >
        <div class="row">
            <div class="col-md-12 header-card" style="">
                <b> REGISTER USER </b> 

            </div>
            <div class="col-lg-12" style="margin-top:1%">
                <div class="basic-login-inner" >
                    <form method="POST" action="{{ route('reguser') }}">
                        @csrf
                        <div class="form-group-inner" style="text-align: left;">
                            <div class="row">
                              <div class="col-md-12">
                              <label>Name<span style="color:red">*</span></label>
                              <input type="text" required name="name" onkeypress="return /[a-z]/i.test(event.key)" class="form-control"></input>
                              </div>

                              <div class="col-md-12">
                              <label>Gender<span style="color:red">*</span></label>
                              <select class="form-control" required name="gender">
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                              </select>
                            </div>

                            <div class="col-md-12">
                            <label>Contact</label>
                            <input type="number" min="0" maxlength="12" name="contact" class="form-control"></input>
                          </div>

                          <div class="col-md-12" id="">
                          <label>Organization</label>
                          <input type="text" name="organization" class="form-control"></input>
                        </div>

                        <div class="col-md-12">
                          <label>Designation<span style="color:red">*</span></label>
                          <select class="form-control" name="designation" required id="student" onchange="setpro()">
                              <option value="Professional">Professional</option>
                            <option value="Student">Student</option>

                          </select>
                        </div>

                        <div class="col-md-12" id="level" style="display:none">
                          <label>Level</label>
                          <input type="text" name="level" class="form-control"></input>
                        </div>
                        <div class="col-md-12" id="degree" style="display:none">
                          <label>Enrolled Program</label>
                          <input type="text" name="degree" class="form-control"></input>
                        </div>

                        <div class="col-md-12" id="prof" >
                          <label>Professional Designation</label>
                          <input type="text" name="prof" class="form-control"></input>
                        </div>


                        {{ csrf_field()}}
                        <div class="col-md-12">
                          <label>Email<span style="color:red">*</span></label>
                          <input type="email" required name="email" class="form-control"></input>
                        </div>

                        <div class="col-md-12">
                          <label>Address</label>
                          <textarea type="text" name="address" class="form-control"></textarea>
                        </div>


                        <div class="col-md-12">
                          <label>What areas of gender are you currently interested in? <span style="color:red">*</span></label>
                          <input type="text" required name="option1" maxlength="100"  class="form-control"></input>
                          </select>
                        </div>



                        <div class="col-md-12">
                          <label>What do you expect your future gender-related research/work to be?<span style="color:red">*</span></label>
                        <input type="text" required name="option2" maxlength="100" class="form-control"></input>
                        </div>
        
                            </div>
                        </div>

                     
                        <div class="login-btn-inner">
                         
                            <div class="row" >
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="login-horizental">
                                <div class="col-md-12" style="margin-top:20px;margin-bottom:20px;">
                                <input type="submit" style=" background-image: linear-gradient(to right, #6C6FE8, #966FE4);color:white"  class="btn btn-success" value="Create New User" />
                              </div>
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


@section('scripts')
<script>
function setpro()
{
  var va = $("#student").val();
  if(va == "Student")
  {
    document.getElementById("degree").style.display = "block";
    document.getElementById("level").style.display = "block";
    document.getElementById("prof").style.display = "none";
    // document.getElementById("org").style.display = "none";

  }
  else{

    document.getElementById("degree").style.display = "none";
    document.getElementById("level").style.display = "none";
    document.getElementById("prof").style.display = "block";
    // document.getElementById("org").style.display = "block";
  }
}
</script>
@endsection
