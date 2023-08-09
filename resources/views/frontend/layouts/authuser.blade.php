@section('title')
    @yield('page-title')
@endsection
@extends('frontend.layouts.main')
@section('content')
<div>
    <div class="row">
        <div class="col-12 mb-2  col-md-3">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{route('post.create')}}" class="link-unstyled">Create a new</a></li>
                    <li class="list-group-item"><a href="{{route('post.index')}}" class="link-unstyled">My Blogs</a></li>
                    <li class="list-group-item"><a href="{{}}" class="link-unstyled">Inactive Blogs</a></li>
                </ul>
            </div>
        </div>
        @yield('user-content')
    </div>
</div
@endsection
