<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="ml-auto navbar-nav">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ asset('images/'. getEntityImg(session('fonction_id'))) }}" width="10"  height="10" alt="Entity image" class="mr-1 border img-size-50 img-circle">
                {{ limitString(getEntity(session('fonction_id'))) }}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @foreach (getFunctions(session('fonction_id')) as $fonction)
                    <a href="#" class="dropdown-item" onclick="document.getElementById({{ $fonction->id }}).click();">
                    <div class="media">
                        <img src="{{ asset('images/'. getEntityImg(session('fonction_id'))) }}" alt="Entity image" class="mr-3 img-size-50 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ auth()->user()->fname }}<br> {{ auth()->user()->lname }}
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <div class="my-2 dropdown-divider"></div>
                            <p class="text-sm">
                                {{ $fonction->fonction }}
                            </p>
                        </div>
                    </div>
                        <form action="{{ route('entity.change.post', $fonction->id) }}" method="post" class="d-none">
                            @csrf
                            <button type="submit" class="btn btn-primary" id="{{ $fonction->id }}">
                                {{ $fonction->fonction }}
                            </button>
                        </form>
                    </a>
                    <div class="dropdown-divider"></div>

                @endforeach
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ route('users.profile') }}" class="dropdown-item dropdown-footer">
                    <i class="mr-2 fa fa-user"></i>
                    Mon profil
                </a>

                @if(auth()->user()->user_entity->count() > 1)
                    @foreach (auth()->user()->user_entity as $key => $user_entity)

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('entity.change.get', $user_entity->id) }}" class="dropdown-item {{ auth()->user()->current_user_entity()->entity_id == $user_entity->entity_id ? 'bg-success':'' }}">
                            <i class="fa fa-home"></i>{{ $user_entity->entity->sigle }}
                        </a>

                    @endforeach
                @endif

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer" onclick="document.getElementById('btn_click').click();">
                    <i class="fa fa-sign-out"></i>
                    Se déconnecter
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
    </ul>
</nav>
<!-- /.navbar -->
