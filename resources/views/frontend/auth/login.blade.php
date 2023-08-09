@extends('frontend.layouts.main')
@push('css')
  <style>
    .social-icon{
      width: 25px;
    }
    /* .social-btn .col-md-4 {
    width: 25.333333%;
    } */
  </style>
@endpush
@section('content')
    <div id="login-container" class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form class="w-75">
            <h1>Login</h1>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <div class="mb-3">
              <div class="social-btn row g-3 justify-content-center align-items-center">
                <div class="col-12 col-md-4 col-lg-3">
                  <a href="{{route('user.google_redirect')}}"><button type="button" class="btn btn-outline-secondary w-100"><img class="social-icon me-1" src="{{asset('assets/frontend/icons/social/google.png')}}" alt="">Singin with Google</button></a>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                  <a href="{{route('user.twitter_redirect')}}"><button type="button" class="btn btn-outline-secondary w-100"><img class="social-icon me-1" src="{{asset('assets/frontend/icons/social/twitters-sm.png')}}" alt="">Singin with twitter</button></a>
                </div>
              </div>
            </div>
            <p><button type="submit" class="me-3 btn btn-primary">Login</button><a href="">Frogot password?</a></p>
            <p>Don't have an account yet? <a href="{{route('user.register')}}">Create an account</a></p>
          </form>
    </div>
@endsection