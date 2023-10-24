

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
{{-- {{ getEntityImg(session('fonction_id')) }} --}}
    <!-- Brand Logo -->
    <a href="https://www.bfclimited.com/" class="brand-link">
      <img src="{{ asset('images/'. getEntityImg(session('fonction_id'))) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ getEntity(session('fonction_id')) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="pb-3 mt-3 mb-3 user-panel d-flex justify-content-center">
        <div class="info w-100">
          <a href="#" class="d-block">
          <span class="text-bold">Compte:</span> {{ auth()->user()->fname }}<br> {{ auth()->user()->lname }}
          </a>
        </div>
      </div>


      <!-- Menu de la side barre -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="mb-3 nav-item">
            <a href="#" class="border nav-link">
              <img src="{{ asset('images/'. getEntityImg(session('fonction_id'))) }}" alt="Entity image" srcset="" with="20" height="20" class="rounded-circle">
              <p>
                 {{ getEntity(session('fonction_id')) }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    @foreach (getFunctions(session('fonction_id')) as $fonction)
                        <a class="nav-link" href="#" data-language="fr" onclick="document.getElementById({{ $fonction->id }}).click();">
                            <i class="far fa-circle nav-icon"></i>
                            {{ $fonction->fonction }}
                            <form action="{{ route('entity.change.post', $fonction->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary d-none" id="{{ $fonction->id }}">
                                    {{ $fonction->fonction }}
                                </button>
                            </form>
                        </a>
                    @endforeach
                </li>
            </ul>
          </li>

          <!-- save user -->
          @if (auth()->user()->isAdmin())
            <li class="nav-item ">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Utilisateurs
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('users.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Liste des utilisateurs</p>
                  </a>
                  <!-- end save user -->
                </li>

              </ul>
            </li>
          @endif

                {{-- Expense --}}

          <li class="nav-item menu-open">
            {{-- menu-open --}}
            <a href="#" class="nav-link active">
              {{-- active --}}
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Fiches de dépenses
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('expense_sheet.create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Créer une FD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('expense_sheet.encours')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fiche en cours</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('expense_sheet.validated') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fiches validées</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('expense_sheet.rejected') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fiches rejetées</p>
                </a>
              </li>


            </ul>
          </li>

            {{-- Cash register supply --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Fiches approv. caisse
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('fac')}}" class="nav-link">
                {{-- <a href="#" class="nav-link"> --}}
                  <i class="far fa-circle nav-icon"></i>
                  <p>Créer une FAC</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                    <a href="{{ route('fac')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consulter liste de FAC</p>
                </a>
              </li>
            </ul>
          </li>

                      {{-- Return to cash --}}

          <li class="nav-item">
            <a href="#" class="nav-link">
                {{-- <a href="{{ url('/ListFAC')}}" class="nav-link"> --}}
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                FRC
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                {{-- <a href="#" class="nav-link"> --}}
                    <a href="{{ url('/FicheRetourCaisse')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Créer FRC</p>
                </a>
              </li>
              <li class="nav-item">
                {{-- <a href="#" class="nav-link"> --}}
                    <a href="{{ url('/ListFRC')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consulter liste de FRC</p>
                </a>
              </li>

            </ul>
          </li>

           {{-- Recipe --}}

           <li class="nav-item">
            <a href="#" class="nav-link">
                {{-- <a href="{{ url('/ListFAC')}}" class="nav-link"> --}}
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                F.RECETTE
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                {{-- <a href="#" class="nav-link"> --}}
                    <a href="{{ route('recipe_sheet.index')}}" class="nav-link {{ setMenuActive('recipe_sheet.index') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Créer FR</p>
                </a>
              </li>
              <li class="nav-item">
                {{-- <a href="#" class="nav-link"> --}}
                    <a href="{{ route('recipe_sheet.create')}}" class="nav-link{{ setMenuActive('recipe_sheet.create') }}"">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consulter liste de Recette</p>
                </a>
              </li>

            </ul>
          </li>
                        {{-- Recipe  --}}

        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
