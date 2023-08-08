@extends('frontend.layouts.main')
@push('css')

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
            <p><button type="submit" class="me-3 btn btn-primary">Login</button><a href="">Frogot password?</a></p>
            <p>Don't have an account yet? <a href="{{route('user.register')}}">Register Here</a></p>
          </form>
    </div>
@endsection