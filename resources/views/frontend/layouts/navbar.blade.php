<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">Blog.com</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <a class="nav-link">Talk of the town</a>
          </li>
          <li class="nav-item">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
          </li>
          <li>
            <a href="{{route('user.login')}}"><button class="btn btn-outline-primary" type="submit">Login</button></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>