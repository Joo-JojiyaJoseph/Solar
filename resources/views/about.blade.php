@extends('layouts.app')
@section('content')


    <!-- Inner Banner Section -->
    <section class="inner-banner">
        <div class="image-layer" style="background-image: url({{ asset('/storage/images/background/banner-image-1.jpg') }});"></div>
        <div class="auto-container">
            <div class="inner">
                <div class="subtitle"><span>our story</span></div>
                <div class="pattern-image"><img src="{{ asset('/storage/images/icons/separator.svg') }}" alt="" title=""></div>
                <h1><span>About Us</span></h1>
            </div>
        </div>
    </section>
    <!--End Banner Section -->

     <!--About Section-->
     <section class="about-section">
        <div class="left-bg"><img src="{{ asset('/storage/images/background/bg-10.png') }}" alt="" title=""></div>
        <div class="right-bg"><img src="{{ asset('/storage/images/background/bg-11.png') }}" alt="" title=""></div>
        <div class="auto-container">
            <div class="title-box centered">
                <div class="subtitle"><span>who we are</span></div>
                <div class="pattern-image"><img src="{{ asset('/storage/images/icons/separator.svg') }}" alt="" title=""></div>
                <h3>A modern restaurant with a menu that will make your mouth water. Servicing delicious food <span class="theme_color">since 45 years</span>. Enjoy our seasonal menu and experience the beauty of naturalness</h3>
            </div>
        </div>
    </section>

    <!--Fluid Section-->
    <section class="fluid-section">
        <div class="outer-container">
            <div class="row clearfix">
                <!--Col-->
                <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="image-layer" style="background-image: url({{ asset('/storage/images/background/image-5.jpg') }});"></div>
                        <div class="image"><img src="{{ asset('/storage/images/background/image-5.jpg') }}" alt=""></div>
                    </div>
                </div>
                <!--Col-->
                <div class="content-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="right-bg"><img src="{{ asset('/storage/' . $abouts->image) }}" alt="" title=""></div>
                    <div class="inner clearfix wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="content-box">
                            <div class="title-box centered">
                                <div class="subtitle"><span>DELIGHTFUL EXPERIENCE</span></div>
                                <div class="pattern-image"><img src="{{ asset('/storage/images/icons/separator.svg') }}" alt="" title=""></div>
                                <h2>{{$abouts->title}}</h2>
                                <div class="text">{{$abouts->description}}</div>
                            </div>

                            <div class="link-box">
                                <a href="{{route('team')}}" class="theme-btn btn-style-two clearfix">
                                    <span class="btn-wrap">
                                        <span class="text-one">meet our team</span>
                                        <span class="text-two">meet our team</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.count')
    @include('components.strength')
    @include('components.testimonial')
    <div style="padding: 20px"></div>

@endsection
