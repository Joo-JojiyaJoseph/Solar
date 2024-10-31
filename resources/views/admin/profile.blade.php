@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')

    <div class="main-container">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Account Settings</li>
            </ol>
        </div>

        <div class="row gutters">
            <div class="col-md-12 mb-2">
                @include('admin.layouts.alert')
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="{{ asset('/storage/' . $admin->image) }}" alt="Logo">
                                </div>
                                <h5 class="user-name text-capitalize">{{ $admin->name }}</h5>
                                <h6 class="user-email">{{ $admin->username }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-3 text-primary">Personal Details</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $admin->name) }}">
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ old('username', $admin->username) }}">
                                        @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" class="form-control" name="image">
                                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
