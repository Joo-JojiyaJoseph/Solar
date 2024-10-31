@extends('admin.layouts.app')

@section('title', 'Password Change')

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
                                    <img src="{{ asset('/storage/'.$admin->image) }}" alt="Logo">
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
                        <form action="{{ route('profile.update', $admin->id ) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('put')
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-3 text-primary">Password Change</h6>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="password" class="form-control" name="current_password" autocomplete="off">
                                        @error('current_password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="password" autocomplete="off">
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" autocomplete="off"> 
                                        @error('confirm_password')<span class="text-danger">{{ $message }}</span>@enderror
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