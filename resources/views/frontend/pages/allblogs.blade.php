@extends('frontend.layouts.authuser')
@section('user-content')
    <div class="col-12 mb-2 col-md-9">
        @if (session('success'))
            <x-alert type='success'>
                {{ session('success') }}
            </x-alert>
        @endif
        @if (session()->has('status'))
            <x-alert type='success'>
                {{ session('status') }}
            </x-alert>
        @endif
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3 rounded rounded-pill px-3" data-bs-toggle="modal"
            data-bs-target="#searchModal">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>

        <!-- Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content position-relative">
                    <div class="modal-body">
                        <input type="text" id="liveSearchByWithUserId" autocomplete="off" class="form-control w-100"
                            placeholder="Search Your Blogs">
                    </div>
                    <div class="card position-absolute w-100 rounded frosted d-block d-none" id="previewer"
                        style="top:80px;"></div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-3">
            @foreach ($posts as $post)
                <div class="col" class="height:500px;">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $post->cover_image) }}" class="card-img-top rounded rounded-0"
                            style="height:200px;width:100%;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{!! Str::limit($post->title, 20) !!}</h5>
                            <p class="card-text"> {!! Str::limit($post->description, 100) !!}</p>
                            <p><small><a href="{{ route('post.show', ['post' => $post->id]) }}">Read
                                        more</a></small>&nbsp;&nbsp;<small><a
                                        href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a></small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="float-end my-3">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        const localbaseurl = `user-post/search/`
        // LiveSearch("liveSearchByWithUserId","previewer", baseurl)
        LocalSearch("liveSearchByWithUserId","previewer", localbaseurl)
    </script>
@endpush
