    <!--Story Section-->
    <section class="story-section" style="background-color: rgba(255, 0, 0, 0.478)">
        <div class="left-bg"><img src="{{ asset('/storage/images/background/bg-3.png') }}" alt="" title=""></div>
        <div class="auto-container">
            <div class="row clearfix">
                <!--Col-->
                <div class="text-col col-xl-5 col-lg-5 col-md-12 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="title-box centered">
                            <div class="subtitle"><span>Our story</span></div>
                            <div class="pattern-image"><img src="{{ asset('/storage/images/icons/separator.svg') }}" alt="" title=""></div>
                            <h2>{!! $story->title !!}</h2>
                            <div class="text">{!! $story->description !!}</div>
                        </div>
                        <div class="booking-info">
                            <div class="bk-title">Book Through Call</div>
                            <div class="bk-no"><a href="tel:+80-400-123456">+80 (400) 123 4567</a></div>

                            <div class="link-box">
                                <a href="{{route('about')}}" class="theme-btn btn-style-two clearfix">
                                    <span class="btn-wrap">
                                        <span class="text-one">Read More</span>
                                        <span class="text-two">Read More</span>
                                    </span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <!--Col-->
                <div class="image-col col-xl-7 col-lg-7 col-md-12 col-sm-12">
                    <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="round-stamp"><img src="{{ asset('/storage/images/resource/badge-1.png') }}" alt=""></div>
                        <div class="images parallax-scene-1">
                            <div class="image" data-depth="0.15"><img src="{{ asset('/storage/images/resource/image-1.jpg') }}" alt=""></div>
                            <div class="image" data-depth="0.30"><img src="{{ asset('/storage/' . $story->image) }}" alt=""></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

