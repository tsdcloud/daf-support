<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="flex-row nav navbar-nav">
            <li class="mr-auto nav-item mobile-menu d-md-none">
                <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                    <i class="ft-menu font-large-1"></i>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="brand-logo" alt="modern admin logo" src="{{ asset('images/iup_logo.png') }}">
                    <h3 class="brand-text">
                        <span class="display-mobile">{{ IUP }}</span>
                        <span class="display-desktop">{{ IUP_SIGLE }}</span>
                    </h3>
                </a>
            </li> --}}
          <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="ft-more-vertical"></i></a></li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="float-left mr-auto nav navbar-nav">
            <li class="nav-item d-flex align-items-center">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="brand-logo img-fluid" alt="modern admin logo" src="{{ asset('images/'. getEntityImg(session('fonction_id'))) }}" width="60" height="60">
                </a>
            </li>
          </ul>
          <ul class="float-right nav navbar-nav">
            <li class="dropdown dropdown-language nav-item">
                <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <i class="flag-icon flag-icon-gb"></i> --}}
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/'. getEntityImg(session('fonction_id'))) }}" alt="Entity image" srcset="" with="30" height="30" class="rounded-circle">
                        <span class="selected-language" style="margin-left:5px">{{ getEntity(session('fonction_id')) }}</span>
                    </div>

                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                    @foreach (getFunctions(session('fonction_id')) as $fonction)
                        <a class="dropdown-item" href="#" data-language="fr" onclick="document.getElementById({{ $fonction->id }}).click();">
                            <img src="{{ asset('images/'. getEntityImg(session('fonction_id'))) }}" alt="Entity image" srcset="" with="20" height="20" class="rounded-circle">
                            {{ $fonction->fonction }}
                            <form action="{{ route('entity.change.post', $fonction->id) }}" method="post">
                                @csrf

                                <button type="submit" class="btn btn-primary d-none" id="{{ $fonction->id }}">
                                    {{ $fonction->fonction }}
                                </button>
                            </form>
                        </a>
                    @endforeach
                </div>
            </li>
            <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                    <span class="mr-1 user-name text-bold-700" style="margin-top:10px"> {{ auth()->user()->fname }}</span>
                    <span class="avatar avatar-online">
                        <img src="{{ asset('images/default_profil.jpg') }}" alt="avatar">
                        <i></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profil', auth()->user()->id) }}">
                        <i class="icon-user"></i> Mon profil
                    </a>

                    {{-- <div class="dropdown-divider"></div> --}}
                    @if(auth()->user()->user_entity->count() > 1)
                        {{-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('entity') }}">
                            <i class="ft-layout"></i> Changer l'entité
                        </a> --}}

                        {{--  --}}
                        @foreach (auth()->user()->user_entity as $key => $user_entity)

                            <div class="dropdown-divider"></div>
                            <a href="{{ route('entity.change.get', $user_entity->id) }}" class="dropdown-item {{ $user_entity->entity_id == auth()->user()->current_user_entity()->entity_id ? 'bg-green-color':'' }}">
                                <i class="ft-layout"></i> {{ $user_entity->entity->sigle }}
                            </a>
                            {{-- <a href="{{ route('entity.change.get', $user_entity->id) }}" class="dropdown-item {{ $key ? 'border-top':'' }} {{ $user_entity->entity_id == auth()->user()->current_user_entity()->entity_id ? 'bg-green-color':'' }}">
                                <i class="ft-layout"></i> {{ $user_entity->entity->sigle }}
                            </a> --}}

                        @endforeach
                        {{--  --}}
                    @endif

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="icon-login"></i> Se déconnecter
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
