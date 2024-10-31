<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    @livewireStyles

</head>

<body>
    <div class="page-wrapper">
        <!-- Preloader -->
        {{-- <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">x</div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="W" class="letters-loading">
                                W
                            </span>
                            <span data-text-preloader="E" class="letters-loading">
                                E
                            </span>
                            <span data-text-preloader="L" class="letters-loading">
                                L
                            </span>
                            <span data-text-preloader="C" class="letters-loading">
                                C
                            </span>
                            <span data-text-preloader="O" class="letters-loading">
                                O
                            </span>
                            <span data-text-preloader="M" class="letters-loading">
                                M
                            </span>
                            <span data-text-preloader="E" class="letters-loading">
                                E
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Preloader End -->

        <!-- Main Header-->
        <header class="main-header header-down">
            <div class="header-top">
                <div class="auto-container">
                    <div class="inner clearfix">
                        <div class="top-left clearfix">
                            <ul class="top-info clearfix">
                                <li><i class="icon far fa-map-marker-alt"></i> Restaurant </li>
                                <li><i class="icon far fa-clock"></i> Daily : 8.00 am to 10.00 pm</li>
                            </ul>
                        </div>
                        <div class="top-right clearfix">
                            <ul class="top-info clearfix">
                                <li><a href="tel:+11234567890"><i class="icon far fa-phone"></i> +1 123 456 7890</a>
                                </li>
                                <li><a href="mailto:booking@restaurant.com"><i class="icon far fa-envelope"></i>
                                        booking@restaurant.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Upper -->
            <div class="header-upper">
                <div class="auto-container">
                    <!-- Main Box -->
                    <div class="main-box clearfix">
                        <!--Logo-->
                        <div class="logo-box">
                            <div class="logo"><a href="{{ route('index') }}" title="">
                                    <img src="{{ asset('/storage/uploads/logo/' . $logo->image) }}" alt=""
                                        title="">

                                </a></div>
                        </div>

                        <div class="nav-box clearfix">
                            <!--Nav Outer-->
                            <div class="nav-outer clearfix">
                                <nav class="main-menu">
                                    <ul class="navigation clearfix">
                                        <li class="current"><a href="{{ route('index') }}">Home</a>
                                        </li>
                                        <li class="dropdown"><a href="{{ route('menu') }}">Menus</a>
                                            <ul>
                                                @foreach ($cats as $cat)
                                                    <li><a href="{{ route('dish', $cat->id) }}">{{ $cat->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('team') }}">Our chefs</a></li>
                                        <li><a href="{{ route('contact') }}">Contact</a></li>
                                        @guest
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        @endguest
                                        @auth
                                        <li><a href="{{ route('myaccount') }}">My Account</a></li>
                                        {{-- <div class="mt-3 space-y-1">
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-responsive-nav-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-responsive-nav-link>
                                            </form>
                                        </div> --}}
                                        @endauth
                                    </ul>
                                </nav>
                                <!-- Main Menu End-->
                            </div>
                            <!--Nav Outer End-->

                            <div class="links-box clearfix">
                                <livewire:cartbutton />
                                <div class="link link-btn">
                                    <a href="{{ route('table') }}" class="theme-btn btn-style-one clearfix">
                                        <span class="btn-wrap">
                                            <span class="text-one">find a table</span>
                                            <span class="text-two">find a table</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="link info-toggler">
                                    <button class="info-btn">
                                        <span class="hamburger">
                                            <span class="top-bun"></span>
                                            <span class="meat"></span>
                                            <span class="bottom-bun"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden Nav Toggler -->
                            <div class="nav-toggler">
                                <button class="hidden-bar-opener">
                                    <span class="hamburger">
                                        <span class="top-bun"></span>
                                        <span class="meat"></span>
                                        <span class="bottom-bun"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--End Main Header -->

        <!--Menu Backdrop-->
        <div class="menu-backdrop"></div>

        <!-- Hidden Navigation Bar -->
        <section class="hidden-bar">
            <!-- Hidden Bar Wrapper -->
            <div class="inner-box">
                <div class="cross-icon hidden-bar-closer"><span class="far fa-close"></span></div>
                <div class="logo-box"><a href="{{ route('index') }}" title="Delici - Restaurants HTML Template"><img
                            src="images/resource/sidebar-logo.png" alt=""
                            title="Delici - Restaurants HTML Template"></a></div>

                <!-- .Side-menu -->
                <div class="side-menu">
                    <ul class="navigation clearfix">
                        <li class="current"><a href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="dropdown"><a href="{{ route('menu') }}">Menus</a>
                            <ul>
                                @foreach ($cats as $cat)
                                    <li><a href="{{ route('dish', $cat->id) }}">{{ $cat->title }}</a></li>
                                @endforeach

                            </ul>
                        </li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('team') }}">Our chefs</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div><!-- /.Side-menu -->

                <h2>Visit Us</h2>
                <ul class="info">
                    <li>Restaurant</li>
                    <li>Open: 9.30 am - 2.30pm</li>
                    <li><a href="mailto:booking@domainame.com">booking@domainame.com</a></li>
                </ul>
                <div class="separator"><span></span></div>
                <div class="booking-info">
                    <div class="bk-title">Booking request</div>
                    <div class="bk-no"><a href="tel:+88-123-123456">+88-123-123456</a></div>
                </div>

            </div><!-- / Hidden Bar Wrapper -->
        </section>
        <!-- / Hidden Bar -->

        <!--Info Back Drop-->
        <div class="info-back-drop"></div>

        <!-- Hidden Bar -->
        <section class="info-bar">
            <div class="inner-box">
                <div class="cross-icon"><span class="far fa-close"></span></div>
                <div class="logo-box"><a href="{{ route('index') }}" title="Delici - Restaurants HTML Template"><img
                            src="images/resource/sidebar-logo.png" alt=""
                            title="Delici - Restaurants HTML Template"></a></div>
                <div class="image-box"><img src="images/resource/sidebar-image.jpg" alt="" title="">
                </div>

                <h2>Visit Us</h2>
                <ul class="info">
                    <li>Restaurant </li>
                    <li>Open: 9.30 am - 2.30pm</li>
                    <li><a href="mailto:booking@domainame.com">booking@domainame.com</a></li>
                </ul>
                <div class="separator"><span></span></div>
                <div class="booking-info">
                    <div class="bk-title">Booking request</div>
                    <div class="bk-no"><a href="tel:+88-123-123456">+88-123-123456</a></div>
                </div>
            </div>
        </section>
        <!--End Hidden Bar -->



        @include('layouts.alert')
        @yield('content')
        <style>
            .main-footer .info-col .inner:after {
                background: url({{ asset('/storage/images/background/pattern-9.svg') }}) center repeat;
            }

            .main-footer .info-col .inner:before {
                background: url({{ asset('/storage/images/background/pattern-9.svg') }}) center repeat;
            }

            .special-offer .outer-container:before {
                background: url({{ asset('/storage/images/background/pattern-9.svg') }}) center repeat;
            }

            .special-offer .outer-container:after {
                background: url({{ asset('storage/images/background/pattern-9.svg') }}) center repeat;
            }
        </style>

        <!--Main Footer-->
        <footer class="main-footer">
            <div class="image-layer"
                style="background-image: url({{ asset('/storage/images/background/image-4.jpg') }});"></div>
            <div class="upper-section">
                <div class="auto-container">
                    <div class="row clearfix">
                        <!--Footer Col-->
                        <div class="footer-col info-col col-lg-6 col-md-12 col-sm-12">
                            <div class="inner wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms"
                                style="background-image: url({{ asset('/storage/images/background/pattern-4.svg') }});">
                                <div class="content">
                                    <div class="logo"><a href="{{ route('index') }}" title=""><img
                                                src="{{ asset('/storage/uploads/logo/' . $logo->image) }}"
                                                alt="" title=""></a></div>
                                    <div class="info">
                                        <ul>
                                            <li>Restaurant </li>
                                            <li><a href="mailto:booking@domainname.com">booking@domainname.com</a></li>
                                            <li><a href="tel:+88-123-123456">Booking Request : +88-123-123456</a></li>
                                            <li>Open : 09:00 am - 01:00 pm</li>
                                        </ul>
                                    </div>
                                    <div class="separator"><span></span><span></span><span></span></div>
                                </div>
                            </div>
                        </div>
                        <!--Footer Col-->
                        <div class="footer-col links-col col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <ul class="links">
                                    <li><a href="{{ route('index') }}">Home</a></li>
                                    <li><a href="{{ route('menu') }}">Menus</a></li>
                                    <li><a href="{{ route('about') }}">About us</a></li>
                                    <li><a href="{{ route('team') }}">Our chefs</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--Footer Col-->
                        <div class="footer-col links-col last col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <ul class="links">
                                    <li><a href="#">facebook</a></li>
                                    <li><a href="#">instagram</a></li>
                                    <li><a href="#">Twitter</a></li>
                                    <li><a href="#">Youtube</a></li>
                                    <li><a href="#">Google map</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="copyright">&copy; 2023 demo. All Rights Reserved | Crafted by </div>
                </div>
            </div>
        </footer>

    </div>
    <!--End pagewrapper-->

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-up"></span></div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/owl.js') }}"></script>
    <script src="{{ asset('assets/js/appear.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-script.js') }}"></script>
    @livewireScripts
</body>

</html>
