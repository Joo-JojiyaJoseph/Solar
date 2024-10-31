    <!--Team Section-->
    <section class="team-section" style="background-color: rgba(255, 0, 0, 0.478)">
        <div class="left-bg"><img src="images/background/bg-21.png" alt="" title=""></div>
        <div class="right-bg"><img src="images/background/bg-9.png" alt="" title=""></div>
        <div class="auto-container">
            <div class="title-box centered">
                <div class="subtitle"><span>experienced team</span></div>
                <div class="pattern-image"><img src="images/icons/separator.svg" alt="" title=""></div>
                <h2>Meet Our Chef</h2>
            </div>
            <div class="row justify-content-center clearfix">
                <!--Block-->
                @foreach ($teams as $team )
                <div class="team-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="image">
                            <img src="{{ asset('/storage/' . $team->image) }}" alt="">
                            <div class="overlay-box">
                                {{-- <div class="overlay-inner">
                                    <!-- Social Box -->
                                    <ul class="social-box">
                                        <li><a href="https://www.facebook.com/" class="fab fa-facebook-f"></a></li>
                                        <li><a href="https://www.twitter.com/" class="fab fa-twitter"></a></li>
                                        <li><a href="https://dribbble.com/" class="fab fa-dribbble"></a></li>
                                        <li><a href="https://www.linkedin.com/" class="fab fa-linkedin"></a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        <h3><a>{{ $team->name}}</a></h3>
                        <div class="designation">{{ $team->designation }}</div>
                        {{-- <div class="text desc">Lorem Ipsum is simply dummy printing and typeset industry lorem Ipsum has been the industrys.</div> --}}
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
