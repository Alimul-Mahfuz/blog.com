@extends('frontend.layouts.authuser')
@section('user-content')
    <div class="col-12 mb-2 col-md-9">
        <div class="card">
            <div class="card-header">
                {{ $post->title }}
            </div>
            <div class="card-body">
                <div class="card border border-0 mb-3">
                    <img src="{{ asset('storage/' . $post->cover_image) }}" class="card-img-top img-fluid rounded rounded-0"
                        style="max-height: 300px;" alt="...">
                    <div class="card-body p-0">
                        <p class="card-text">{!! $post->description !!}</p>
                        <p class="card-text"><small class="text-body-secondary">Posted by:&nbsp;&nbsp; <span><img src="{{$post->user->profile_image}}" class="rounded rounded-circle" style="width: 20px" alt=""> {{$post->user->name}}</span></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
