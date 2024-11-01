@extends('admin.layouts.app')

@section('title', 'Website Management')

@section('content')

    <div class="main-container">

        {{-- <div class="row mb-3">
            <div class="col-md-1">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
            </div>
        </div> --}}

        <div class="row gutters p-5">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('logo.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Logo</h3><p>Website Logo</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('seo.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>SEO</h3><p>Website SEO</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('home.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Home</h3><p>Website Home</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{route('testimonial.index')}}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Testimonials</h3><p>Website Testimonials</p></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection


