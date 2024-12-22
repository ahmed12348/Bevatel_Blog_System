<header class="top-header">        
  <nav class="navbar navbar-expand gap-3">
    <!-- Mobile Toggle Icon -->
    <div class="mobile-toggle-icon fs-3">
      <i class="bi bi-list"></i>
    </div>

    <!-- Searchbar -->
    <form class="searchbar">
      <div class="position-absolute top-50 translate-middle-y search-icon ms-3">
        <i class="bi bi-search"></i>
      </div>
      <input class="form-control" type="text" placeholder="Type here to search">
      <div class="position-absolute top-50 translate-middle-y search-close-icon">
        <i class="bi bi-x-lg"></i>
      </div>
    </form>

    <!-- Navbar Right -->
    <div class="top-navbar-right ms-auto">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item search-toggle-icon">
          <a class="nav-link" href="#"><i class="bi bi-search"></i></a>
        </li>
        <!-- Add more nav items here -->
      </ul>
    </div>

    <!-- User Dropdown -->
    <div class="dropdown dropdown-user-setting">
      <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
        <div class="user-setting d-flex align-items-center gap-3">
          <img src="{{ asset('assets/images/avatars/user1.jpg') }}" class="user-img" alt="">
          <div class="d-none d-sm-block">
            <p class="user-name mb-0">{{ Auth::user()->name }}</p>
            <small class="mb-0 dropdown-user-designation">{{ Auth::user()->job_title }}</small>
          </div>
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <!-- <li><a class="dropdown-item" href="#"><i class="bi bi-person-fill"></i> Profile</a></li>
        <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill"></i> Setting</a></li> -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item"><i class="bi bi-lock-fill"></i> Logout</button>
          </form>
      </ul>
    </div>
  </nav>
</header>
