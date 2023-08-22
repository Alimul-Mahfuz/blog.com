<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/frontend/js/livesearch.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    @stack('css')
</head>

<body>
    {{-- Nabar --}}
    @include('frontend.layouts.navbar')
    <main class="container mt-3 min-vh-100">
        <div class="row">
            <div class="col-12 mb-2 col-md-3">
                <div class="card frosted-sidebar rounded rounded-3 border-0">
                    <ul class="list-group rounded rounded-0 list-group-flush">
                        <li class="list-group-item {{ request()->routeIs('post.index') ? 'bg-alice-blue' : '' }}"><a
                                href="{{ route('post.index') }}"
                                class="link-unstyled {{ request()->routeIs('post.index') ? 'text-dark fw-bold' : '' }}">My
                                Blogs</a></li>
                        <li class="list-group-item {{ request()->routeIs('post.create') ? 'bg-alice-blue' : '' }}"><a
                                href="{{ route('post.create') }}"
                                class="link-unstyled {{ request()->routeIs('post.create') ? 'text-dark fw-bold' : '' }}">Create
                                a new</a></li>
                        <li class="list-group-item {{ request()->routeIs('user.profile') ? 'bg-alice-blue' : '' }}"><a
                                href="{{ route('user.profile') }}"
                                class="link-unstyled {{ request()->routeIs('user.profile') ? 'text-dark fw-bold' : '' }}">My
                                Profile</a></li>
                        {{-- <li class="list-group-item {{request()->routeIs('post.get-inactive') ? 'bg-secondary':''}}"><a href="{{route('post.get-inactive')}}" class="link-unstyled {{request()->routeIs('post.create') ? 'text-white':''}}">Inactive Blogs</a></li> --}}
                    </ul>
                </div>
            </div>
            @yield('user-content')
        </div>
    </main>

    @include('frontend.layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        const baseurl = `post-search/`
        GlobalSearch('global_search_input', 'search-result-global', baseurl)
    </script>
    @stack('js')
</body>

</html>
