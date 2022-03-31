  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html">VR<span class="color-b">CAFE</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link active" href="/">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">What We Are</a>
            <div class="dropdown-menu">
              <a class="dropdown-item " href="{{url('guest-about')}}">About Us</a>
              <a class="dropdown-item " href="blog-single.html">History</a>
              <a class="dropdown-item " href="agents-grid.html">Vision and Mission</a>
              <a class="dropdown-item " href="agent-single.html">Our Facilitator</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Our Service</a>
            <div class="dropdown-menu">
              <a class="dropdown-item " href="{{url('guest-ruang')}}">Studio</a>
              <a class="dropdown-item " href="{{url('guest-perangkat')}}">VR Wearables</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('guest-vr-room')}}">Try VR Room</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{url('guest-contact')}}">Contact</a>
          </li>
          @if(Auth::user())
          <div class="dropdown">
            <li class="nav-item d-flex align-items-center dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <a href="/logout" class="nav-link text-body font-weight-bold px-0" id="userDropdown" role="button">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">{{Auth::user()->name}}</span>
              </a>
            </li>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                <li><a class="dropdown-item" href="/logout">Sign Out</a></li>
              </ul>
          </div>
          @else
          <li class="nav-item">
            <a class="nav-link " href="/login">Sign In</a>
          </li>
          @endif
        </ul>
      </div>

      <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
        <i class="bi bi-search"></i>
      </button>

    </div>
  </nav><!-- End Header/Navbar -->