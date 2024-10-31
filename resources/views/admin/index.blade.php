<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <title>{{ config('app.name') }} - Admin</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/main.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('/storage/images/favicon.png') }}">
</head>

<body class="authentication">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="login-screen">
                    <div class="login-box text-center">
                        @include('admin.layouts.alert')

                        <a href="{{ route('admin.login') }}" class="login-logo mb-1">
                            <img src="{{ asset('/storage/uploads/logo/' . $logo->image) }}" alt="{{ config('app.name') }}" />
                        </a>
                        <h5>Welcome back,<br />Please Login to Admin Account.</h5>
                        <form  action="{{ route('admin.login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required>
                                @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" required>
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            {{-- <div class="form-group mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember_pwd" name="remember">
                                    <label class="custom-control-label" for="remember_pwd">Remember me</label>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
