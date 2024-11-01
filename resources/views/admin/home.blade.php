@extends('admin.layouts.app')

@section('title', 'Website Management')

@section('content')

    <div class="main-container">

        <div class="row mb-3">
            <div class="col-md-1">
                <a href="{{ route('dashboard', '') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3 class="text-2xl">Total Orders ({{$count['total']}})</h3><p>Branch</p></div>
                    </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="info-stats2">
                    <div class="info-icon danger"><i class="icon-layers2"></i></div>
                    <div class="sale-num"><h3 class="text-2xl">New Orders</h3><p>Branch</p></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="info-stats2">
                    <div class="info-icon danger"><i class="icon-layers2"></i></div>
                    <div class="sale-num"><h3 class="text-2xl">Pending Orders</h3><p>Branch</p></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="info-stats2">
                    <div class="info-icon danger"><i class="icon-layers2"></i></div>
                    <div class="sale-num"><h3 class="text-2xl">working Orders</h3><p>Branch</p></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="info-stats2">
                    <div class="info-icon danger"><i class="icon-layers2"></i></div>
                    <div class="sale-num"><h3 class="text-2xl">Completed Orders</h3><p>Branch</p></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 d-flex justify-content-center align-items-center">
               <a href="{{route('lead.create')}}"> <button class="rounded-lg px-4 py-4 bg-gray-200 hover:bg-gray-300 duration-300 text-blue-500 text-2xl font-extrabold">
                    Enquiry Form
                </button></a>
            </div>
        </div>

        <div class="row p-5">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('branch.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3 class="text-xl">Branch</h3><p>Branch</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('technician.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3 class="text-xl">Technician</h3><p>Technician</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3 class="text-xl">Services</h3><p>services</p></div>
                    </div>
                </a>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3 class="text-xl">Sub Services</h3><p>Sub Services</p></div>
                    </div>
                </a>
            </div>

        </div>

    </div>

@endsection
