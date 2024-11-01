<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <title>{{ config('app.name') }} - Admin</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/main.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('/storage/images/favicon.png') }}">
</head>

<body class="">
 <div class="">
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('/storage/img/admin_login.jpg') }} " alt=""
            class="w-full h-full object-cover filter blur-lg brightness-50">
    </div>
    @include('admin.layouts.alert')


    <!-- Login Form -->
    <div class="relative z-10 bg-white p-8 rounded-md shadow-lg justify-center w-25">
        <a href="{{ route('admin.login') }}" class="login-logo mb-1 justify-center flex mx-auto">
            <img src="{{ asset('/storage/uploads/logo/' . $logo->image) }}" style="width: 70px;" alt="{{ config('app.name') }}" />
        </a>
        <h1 class="text-xl font-bold mb-4 text-center">Login</h1>
        <form  action="{{ route('admin.login') }}" method="post">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="username">UserName</label>
                <input
                    class="appearance-none border rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                     type="text" name="username" value="{{ old('username') }}" required>
                     @error('username')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                <input
                    class="appearance-none border rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                    id="password" type="password" name="password" value="{{ old('password') }}" required>
                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="flex items-center justify-between gap-8">
                <button
                    class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</div>
</div>
</body>

</html>
