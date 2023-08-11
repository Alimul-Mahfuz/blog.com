@extends('frontend.layouts.main')
@push('css')
    <style>
        .social-icon {
            width: 25px;
        }
    </style>
@endpush
@section('content')
    <div id="login-container" class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form class="rounded rounded-3 p-3 frosted-glass" method="post" action="{{route('user.update-password')}}">
            @csrf
            <h1>Reset Passwrod</h1>
            <input type="email" name="email" hidden value="{{$email}}">
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" id="password">
                @error('password')
                    {{$message}}
                @enderror
            </div>            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                @error('password_cofirmation')
                    {{$message}}
                @enderror
            </div>
            <p><button type="submit" class="me-3 btn btn-primary">Save</button><a href="">Frogot password?</a></p>
        </form>
    </div>
@endsection
