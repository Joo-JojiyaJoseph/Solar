
    <!--Testimonials Section-->
    <section class="testimonials-section">
        <div class="image-layer" style="background-image: url({{ asset('/storage/images/background/image-2.jpg') }});"></div>
        <div class="auto-container">
            <div class="carousel-box">
                <div class="testi-top owl-theme owl-carousel">
                    @foreach ($testimonials as $testimonial)
                    <div class="slide-item">
                        <div class="slide-content">
                            <div class="text quote-text">”{{ $testimonial->quote }}”</div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="separator"><span></span><span></span><span></span></div>
                <div class="thumbs-carousel-box">
                    <div class="testi-thumbs owl-theme owl-carousel">
                        @foreach ($testimonials as $testimonial)
                        <div class="slide-item">
                            <div class="image"><img src="{{ asset('/storage/' . $testimonial->image) }}"  alt=""></div>
                            <div class="auth-title">{{ $testimonial->name }}</div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
