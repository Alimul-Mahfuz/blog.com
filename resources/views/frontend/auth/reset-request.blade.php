@extends('frontend.layouts.main')
@push('css')
    <style>
        .social-icon {
            width: 25px;
        }

        /* .social-btn .col-md-4 {
            width: 25.333333%;
            } */
    </style>
@endpush
@section('content')
    <div id="login-container" class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form class="rounded rounded-3 p-3 frosted-glass" id="password-reset-request-form" method="post">
            @csrf
            <h1>Reset Passwrod</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">If your email matched, we will send you a password reset link.</div>
            </div>
            <p><button type="submit" class="me-3 btn btn-primary">Send Reset Link</button><span id="notify"></span>
            <p>Don't have an account yet? <a href="{{ route('user.register') }}">Create an account</a></p>
        </form>
        <script src="{{ asset('assets/frontend/js/auth.js') }}"></script>
    </div>
@endsection
