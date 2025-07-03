@extends('layouts.main')

@section('styles')

@endsection

@section('content')
<!--
    <div class="parallax-content baner-content" id="home">
        <div class="container">
            <div class="text-content">
                <h2><em>TINKER</em> <span>HTML5</span> Template</h2>
                <p>Tinker is a responsive CSS template provided by templatemo site. This design can be applied for any kind of website. Please mention our site to your colleagues. Thank you.</p>
                <div class="primary-white-button">
                    <a href="#" class="scroll-link" data-id="about">Let's Start</a>
                </div>
            </div>
        </div>
    </div> -->


    <section id="about" class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="service-item">
                        <div class="icon">
                            <img src="{{ asset('img/gp.png') }}" alt="" style="width:70%">
                        </div>
                        <h3>Gender Portal</h3>
                        <div class="line-dec"></div>
                        <p>This Gender Portal is envisioned as a computerized database of women related statistics/ information organized and programmed</p>
                        <div class="primary-blue-button">
                            <a href="{{ route('login')}}">Continue <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="service-item">
                        <div class="icon">
                            <img src="{{ asset('img/kh.png') }}" alt="" style="width:70%">
                        </div>
                        <h3>Knowledge Hub</h3>
                        <div class="line-dec"></div>
                        <p>A Knowledge Hub, which will hold national and international researches, publications and other resources on women’s empowerment and gender equality</p>
                        <div class="primary-blue-button">
                            <a href="{{ route('knowledgehub')}}" >Continue <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection


@section('scripts')

@endsection
