@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- THEME -->
                        <form method="Post" action="{{route('theme.store')}}">
                            <legend>THEME</legend>
                            @csrf
                            <label>Name</label>
                            <input type="text" name="name"><br>
                            <button type="submit">Submit</button>
                        </form>
                        <!-- END THEME -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                         <!-- SUBTHEME -->
                        <form method="Post" action="{{route('subtheme.store')}}">
                            <legend>SUBTHEME</legend>
                            @csrf
                            <input type="hidden" name="theme" value="{{Crypt::encrypt(1)}}">
                            <label>Name</label>
                            <input type="text" name="name"><br>
                            <button type="submit">Submit</button>
                        </form>
                        <!-- END SUBTHEME -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                         <!-- QUALITIVE -->
                        <form method="Post" action="{{route('requirement.store')}}">
                            <legend>Qualitative</legend>
                            @csrf
                            <input type="hidden" name="sub_theme" value="{{Crypt::encrypt(1)}}">
                            <input type="hidden" name="type" value="Qualitative">
                            <label>data_requirement</label><br>
                            <input type="text" name="data_requirement"><br>

                            <label>constitutional_and_legal_provisions</label><br>
                            <input type="text" name="constitutional_and_legal_provisions"><br>

                            <label>policy_issues_and_institutional_arrangements</label><br>
                            <input type="text" name="policy_issues_and_institutional_arrangements"><br>

                            <label>programmer</label><br>
                            <input type="text" name="programmer"><br>

                            <label>remarks</label><br>
                            <input type="text" name="remarks"><br>
                            
                            <button type="submit">Submit</button>
                        </form>
                        <!-- END QUALITIVE -->
                    </div>

                    <div class="col-sm-6">
                         <!-- Quantitative -->
                        <form method="Post" action="{{route('requirement.store')}}">
                            <legend>Quantitative</legend>
                            @csrf
                            <input type="hidden" name="sub_theme" value="{{Crypt::encrypt(1)}}">
                            <input type="hidden" name="type" value="Quantitative">
                            <label>data_requirement</label><br>
                            <input type="text" name="data_requirement"><br>

                            <label>sdgs</label><br>
                            <input type="text" name="sdgs"><br>

                            <label>beijeing</label><br>
                            <input type="text" name="beijeing"><br>

                            <label>cedaw</label><br>
                            <input type="text" name="cedaw"><br>

                            <label>remarks</label><br>
                            <input type="text" name="remarks"><br>
                            
                            <button type="submit">Submit</button>
                        </form>
                        <!-- END QUANTITVE -->
                    </div>

                </div>
                
                <!-- USER  -->
                <div class="row">
                    <div class="col-sm-6">
                        <!-- STORE USER -->
                        <form method="Post" action="{{route('user.store')}}">
                            <legend> STORE USER</legend>
                            @csrf
                            <label>Name</label>
                            <input type="text" name="name"><br>

                            <label>Father Name</label>
                            <input type="text" name="fname"><br>
                            
                            <label>CNIC</label>
                            <input type="text" name="cnic"><br>
                            
                            <label>CONTACT</label>
                            <input type="text" name="contact"><br>
                            
                            <label>EMAIL</label>
                            <input type="email" name="email"><br>
                            
                            <label>PASSWORD</label>
                            <input type="password" name="password"><br>

                            <label>CONFIRM PASSWORD</label>
                            <input type="password" name="confirm_password"><br>
                         
                            <label>Status</label>
                            <input type="text" name="status"><br>
                         
                            <button type="submit">Submit</button>
                        </form>
                        <!-- END STORE USER -->
                </div>


                    <!-- UPDATE USER -->

                <!-- USER  -->
                    <div class="col-sm-6">
                        <!-- USER -->
                        <form method="Post" action="{{route('user.update')}}">
                            <legend>UPDATE USER</legend>
                            @csrf
                            <label>Name</label>
                            <input type="text" name="name" value=""><br>

                            <label>Father Name</label>
                            <input type="text" name="fname"><br>
                            
                            <label>CNIC</label>
                            <input type="text" name="cnic"><br>
                            
                            <label>CONTACT</label>
                            <input type="text" name="contact"><br>
                            
                            <label>EMAIL</label>
                            <input type="email" name="email"><br>
                            
                            <label>PASSWORD</label>
                            <input type="password" name="password"><br>

                            <label>CONFIRM PASSWORD</label>
                            <input type="password" name="confirm_password"><br>

                            <label>Status</label>
                            <input type="text" name="status"><br>

                            <input type="hidden" name="user" value="{{Crypt::encrypt(2)}}">
                            
                            <button type="submit">Submit</button>
                        </form>
                        <!-- END USER -->
                    </div>
                </div>

               <!-- END USER -->


                    <!-- END UPDATE USER -->
               <!-- END USER -->


			</div>
		</div>
	</div>
</div>
@endsection