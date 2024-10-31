@extends('layouts.app')
@section('content')
    <!-- Banner Section -->
    <section class="banner-section">
        <div class="banner-container">
            <div class="banner-slider">
                <div class="swiper-wrapper">
                    <!--Slide Item-->
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide slide-item">
                            <div class="image-layer"
                                style="background-image: url({{ asset('/storage/uploads/slider/' . $slider->image) }});">
                            </div>
                            <div class="auto-container">
                                <div class="content-box">
                                    <div class="content">
                                        <div class="clearfix">
                                            <div class="inner">
                                                <div class="subtitle"><span>{{ $slider->toptitle }}</span></div>
                                                <div class="pattern-image"><img src="images/icons/separator.svg"
                                                        alt="" title=""></div>
                                                <h1><span class="">{!! $slider->title !!}</span></h1>
                                                <div class="text">{{ $slider->subtitle }}</div>
                                                <div class="links-box wow fadeInUp" data-wow-delay="0ms"
                                                    data-wow-duration="1500ms">
                                                    <div class="link">
                                                        <a href="{{ route('menu') }}"
                                                            class="theme-btn btn-style-two clearfix">
                                                            <span class="btn-wrap">
                                                                <span class="text-one">view our menu</span>
                                                                <span class="text-two">view our menu</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="swiper-button-prev"><span class="fal fa-angle-left"></span></div>
                <div class="swiper-button-next"><span class="fal fa-angle-right"></span></div>
            </div>
        </div>
        <div class="book-btn"><a href="" class="theme-btn"><span class="icon"><img
                        src="{{ asset('storage/images/resource/book-icon-1.png') }}" alt=""
                        title=""></span><span class="txt">book a table</span></a></div>
    </section>
    <!--End Banner Section -->

        <!--Special Offer Section-->
        <section class="special-offer-two">
            <div class="left-bg"><img src="{{ asset('/storage/images/background/bg-20.png') }}" alt="" title=""></div>
            <div class="right-bg"><img src="{{ asset('/storage/images/background/bg-19.png') }}" alt="" title=""></div>
            <div class="auto-container">
                <div class="title-box centered">
                    <div class="subtitle"><span>special offer</span></div>
                    <div class="pattern-image"><img src="{{ asset('/storage/images/icons/separator.svg') }}"  alt="" title=""></div>
                    <h2>Best Special Menu</h2>
                </div>
                <div class="row clearfix">
                    @foreach ($cats as $cat)
                        <!--Item-->
                        <div class="offer-block-three col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                                <div class="image"><a href="{{route('dish',$cat->id)}}"><img style="height: 300px" src="{{ asset('/storage/uploads/cats/' . $cat->image) }}"
                                            alt=""></a></div>
                                <h4><a href="{{route('dish',$cat->id)}}">{{$cat->title}}</a></h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


    @include('components.ourstory')
    @include('components.specialDish')

    <!--Special Offer Section-->
    <section class="special-offer">
        <div class="outer-container">
            <div class="auto-container">
                <div class="title-box centered">
                    <div class="subtitle"><span>specials</span></div>
                    <div class="pattern-image"><img src="{{ asset('/storage/images/icons/separator.svg') }}" alt=""
                            title=""></div>
                    <h2>Best Specialties</h2>
                </div>
                <div class="dish-gallery-slider owl-theme owl-carousel">
                    @foreach ($foods as $food)
                        <!--Slide Item-->
                        <div class="offer-block-two">
                            <div class="inner-box">
                                <div class="image h-32"><a ><img  src="{{ asset('/storage/uploads/food/' . $food->image) }}"
                                            alt=""></a></div>
                                <h4><a href="">{{ $food->fdtitle }}</a></h4>
                                {{-- <div class="text desc">Avocados with crab meat, red onion, crab salad red bell pepper...
                                </div> --}}
                                <div class="price">${{ $food->amount }}</div>
                                <livewire:addtocart :food="$food"/>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="lower-link-box text-center">
                    <a href="{{ route('menu') }}" class="theme-btn btn-style-two clearfix">
                        <span class="btn-wrap">
                            <span class="text-one">view all menu</span>
                            <span class="text-two">view all menu</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('components.strength')
    @include('components.count')
    @include('components.chef')
    @include('components.testimonial')
    @include('components.tablebooking')
        <!--Recnt Updates Section-->
        <section class="news-section">
            <div class="auto-container">
                <div class="title-box centered">
                    <div class="subtitle"><span>recent updates</span></div>
                    <div class="pattern-image"><img src="{{ asset('/storage/images/icons/separator.svg') }}" alt="" title=""></div>
                    <h2>Upcoming Event</h2>
                </div>
                <div class="row justify-content-center clearfix">
                    @foreach ($newss as $news)
                    <!--Block-->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                            <div class="image-box">
                                <div class="date"><span>{{ date('d M ', strtotime($news->date))}},{{  date('h:i A', strtotime($news->time)) }}</span></div>
                                <div class="image"><a href="#"><img src="{{ asset('/storage/' . $news->image) }}" style="height: 300px" alt=""></a></div>
                                <div class="over-content">
                                    <div class="cat">{{ $news->title }}</div>
                               </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="lower-link-box text-center">
                    <a href="{{route('contact')}}" class="theme-btn btn-style-two clearfix">
                        <span class="btn-wrap">
                            <span class="text-one">contact</span>
                            <span class="text-two">contact</span>
                        </span>
                    </a>
                </div>
            </div>
        </section>
@endsection
