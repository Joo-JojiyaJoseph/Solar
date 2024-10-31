   <!--Special Dish Section-->
   @if($specialDish!=null)
   <section class="special-dish">
    <div class="bottom-image"><img src="{{ asset('/storage/images/resource/image-3.png') }}" alt="" title=""></div>
    <div class="outer-container">
        <div class="row clearfix">
            <!--Col-->
            <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="image-layer" style="background-image: url({{ asset('/storage/images/background/image-1.jpg') }});"></div>
                    <div class="image"><img src="{{ asset('/storage/images/background/image-1.jpg') }}" alt=""></div>
                </div>
            </div>
            <!--Col-->
            <div class="content-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="right-bg"><img src="{{ asset('/storage/images/background/bg-4.png') }}" alt="" title=""></div>
                <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="title-box">
                        <span class="badge-icon"><img src="{{ asset('/storage/images/resource/badge-2.png') }}" alt="" title=""></span>
                        <div class="subtitle"><span>Special dish</span></div>
                        <div class="pattern-image"><img src="{{ asset('/storage/images/icons/separator.svg') }}" alt="" title=""></div>
                        <h2>{{ $specialDish->fdtitle}}</h2>
                        {{-- <div class="text">{{ $specialDish->amount }}</div> --}}
                    </div>
                    <div class="price">
                        {{-- <span class="old">$40.00</span> --}}
                        <span class="new">${{ $specialDish->amount }}</span>
                    </div>
                    <div class="link-box">
                        <a href="{{route('menu')}}" class="theme-btn btn-style-two clearfix">
                            <span class="btn-wrap">
                                <span class="text-one">view all menu</span>
                                <span class="text-two">view all menu</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif

