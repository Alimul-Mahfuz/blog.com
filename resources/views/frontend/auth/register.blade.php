@extends('frontend.layouts.main')
@push('css')
    <style>
        #login-container {
            background-image: url("{{ asset('assets/frontend/images/login-bg.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endpush
@section('content')
    <div id="login-container" class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form class="rounded rounded-3 frosted-glass p-5" method="post" action="">
            @csrf
            <h1>Register</h1>
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" id="fullname" aria-describedby="user's full name">
                @error('fullname')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                @error('password')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                @error('password_confirmation')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>
            <p><button type="submit" class="me-3 btn btn-primary">Register</button></p>
            <p>Already have an account? <a href="{{ route('user.login') }}">Login Here</a></p>
        </form>
    </div>
@endsection
