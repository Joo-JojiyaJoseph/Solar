@extends('admin.layouts.app')

@section('title', 'Website Management')

@section('content')

    <div class="main-container">

        <div class="row mb-3">
            <div class="col-md-1">
                <a href="{{ route('dashboard', 'web') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="row p-5">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('slider.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Slider</h3><p>Website Slider</p></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
