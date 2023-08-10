@extends('frontend.layouts.authuser')
@section('user-content')
    <div class="col-12 mb-2 col-md-9">
        @if (session('success'))
            <x-alert type='success'>
                {{ session('success') }}
            </x-alert>
        @endif
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{asset('storage/'.$post->cover_image)}}" class="card-img-top rounded rounded-0" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text"> {!! Str::limit($post->description, 100) !!}</p>
                            <p><small><a href="{{route('post.show',['post'=>$post->id])}}">Read more</a></small>&nbsp;&nbsp;<small><a href="{{route('post.edit',['post'=>$post->id])}}">Edit</a></small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
