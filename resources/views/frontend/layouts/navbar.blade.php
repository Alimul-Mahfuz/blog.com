<nav class="navbar sticky-top navbar-expand-lg shadow-sm frosted-nav">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">Blog.com</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Science</a></li>
                        <li><a class="dropdown-item" href="#">Astronomy</a></li>
                        <li><a class="dropdown-item" href="#">Movie</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Recent</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Featured</a>
                </li>
                <li class="nav-item">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </li>
                <li class="nav-item">
                    @if (Route::has('user.login'))
                        @if (auth()->check())
                            <div class="dropdown">
                                <a class="btn bg-lavender dropdown-toggle border border-1 rounded border-dark" style="font-size: 10pt;" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{Auth::user()->name}} 
                                    <img class="avater-icon rounded rounded-circle" src="{{ 'storage/'.$image = Auth::user()->profile_image ?? "https://img.icons8.com/fluency/48/user-male-circle.png"}}" alt="">
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('user.profile')}}">Profile</a></li>
                                    <li>
                                      <form action="{{route('user.logout')}}" method="post">
                                        @csrf
                                        <button class="dropdown-item border border-2 bg-red-light" type="submit">Logout</button>
                                      </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{route('user.login')}}" class="btn btn-outline-primary">Login</a>
                        @endif
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
