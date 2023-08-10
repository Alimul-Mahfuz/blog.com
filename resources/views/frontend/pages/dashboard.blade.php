@section('title')
    Profile
@endsection
@extends('frontend.layouts.authuser')
@section('user-content')
    <div class="col-12 mb-2  col-md-9">
        <div class="card">
            <div class="card-header">
                User's Profile
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4 col-md-2">
                        <img src="{{Auth::user()->profile_image}}" class="mb-1 rounded float-start avater-image" alt="...">
                    </div>
                    <div class="col-8 col-md-10">
                        <h4>{{Auth::user()->name}}</h4>
                        <p>{{Auth::user()->email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
