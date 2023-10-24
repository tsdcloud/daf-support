<li class="nav-item {{ setMenuActive('home') }}">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/dashboard')}}" class="nav-link">Accueil</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="ml-auto navbar-nav">

          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="{{ route('users.profile', auth()->user()->id) }}" class="dropdown-item dropdown-footer">
                Mon profil
              </a>

              <a href="#" class="dropdown-item dropdown-footer" onclick="document.getElementById('btn_click').click();">
                se deconnecter
              </a>
              <form method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf

                <button id="btn_click" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
              </button>
              </form>
            </div>
          </li>
          {{-- <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="mr-2 fas fa-envelope"></i> 4 new messages
                <span class="float-right text-sm text-muted">3 mins</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="mr-2 fas fa-users"></i> 8 friend requests
                <span class="float-right text-sm text-muted">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="mr-2 fas fa-file"></i> 3 new reports
                <span class="float-right text-sm text-muted">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
        </ul>
      </nav>
