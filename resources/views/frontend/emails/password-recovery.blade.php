@extends('frontend.emails.layouts.main')
@section('email-title')
    Password Recovery Link
@endsection
@section('content')
    <p class="card-text">Dear sir, we have received an password reset request. Please click the button to reset your passowrd
    </p>
    <a href="{{route("user.reset-password",['email'=>$email,'token'=>$token])}}" class="btn btn-primary">Reset Password</a>
@endsection
