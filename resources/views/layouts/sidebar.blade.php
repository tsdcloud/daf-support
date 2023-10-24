<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" --}}
           {{-- style="opacity: .8"> --}}
      <img src="{{ asset('images/'. getEntityImg(session('fonction_id'))) }}" width="50"  height="50" alt="Entity image" class="mr-1 border img-circle">
      <span class="brand-text font-weight-light">
        {{ getEntityAttribute(session('fonction_id'))->sigle }}
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ setMenuActive('dashboard') }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Tableau de bord
                        </p>
                    </a>
                </li>

                {{-- FD --}}
                <li class="nav-item {{ setMenuOpen('expense_sheet') }}">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ setMenuActive('expense_sheet') }}">
                        <i class="nav-icon fas fa-comments-dollar"></i>
                        <p>
                            Fiches de dépenses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('expense_sheet.create')}}" class="nav-link {{ setMenuActive('expense_sheet.create') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('expense_sheet.my.encours')}}" class="nav-link {{ setMenuActive('expense_sheet.my.encours') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>En cours</p>
                          </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('expense_sheet.encours')}}" class="nav-link {{ setMenuActive('expense_sheet.encours') }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Fiches en cours</p>
                            </a>
                        </li>
                        @if (auth()->user()->isAdmin() || auth()->user()->isOrdonnateur())
                        <li class="nav-item">
                            <a href="{{ route('expense_sheet.ordonnancable')}}" class="nav-link {{ setMenuActive('expense_sheet.ordonnancable') }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Attente Ordonnation</p>
                            </a>
                          </li>
                        @endif
                        @if (auth()->user()->isAdmin() || auth()->user()->isControleur())
                        <li class="nav-item">
                            <a href="{{ route('expense_sheet.controle_budgetaire')}}" class="nav-link {{ setMenuActive('expense_sheet.controle_budgetaire') }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Attente budgétaire</p>
                            </a>
                          </li>
                        @endif

                        @if (auth()->user()->isAdmin() || auth()->user()->isControleur_conf())
                        <li class="nav-item">
                            <a href="{{ route('expense_sheet.controle_conformite')}}" class="nav-link {{ setMenuActive('expense_sheet.controle_conformite') }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>En conformité</p>
                            </a>
                          </li>
                        @endif

                        @if (auth()->user()->isAdmin() ||auth()->user()->isComptable())
                        <li class="nav-item">
                            <a href="{{ route('expense_sheet.imputable')}}" class="nav-link {{ setMenuActive('expense_sheet.imputable') }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Imputables</p>
                            </a>
                          </li>
                        @endif
                        <li class="nav-item">
                          <a href="{{ route('expense_sheet.validated') }}" class="nav-link {{ setMenuActive('expense_sheet.validated') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Validées</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('expense_sheet.rejected') }}" class="nav-link {{ setMenuActive('expense_sheet.rejected') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Rejetées</p>
                          </a>
                        </li>
                    </ul>
                </li>

                {{-- FAC --}}
                @if (auth()->user()->isAdmin() || auth()->user()->isCaissier() || auth()->user()->isComptable() || auth()->user()->isControleur_conf() || auth()->user()->isOrdonnateur())
                <li class="nav-item {{ setMenuOpen('cash_register_supply_sheet') }}">
                    <a href="#" class="nav-link {{ setMenuActive('cash_register_supply_sheet') }}">
                        <i class="nav-icon fas fa-comments-dollar"></i>
                        <p>
                            Fiche approv. caisse
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cash_register_supply_sheet.create')}}" class="nav-link {{ setMenuActive('cash_register_supply_sheet.create') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cash_register_supply_sheet.index')}}" class="nav-link {{ setMenuActive('cash_register_supply_sheet.index') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liste des FAC</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                {{-- FRC --}}
                @if (auth()->user()->isAdmin() || auth()->user()->isCaissier() || auth()->user()->isComptable() || auth()->user()->isControleur_conf() || auth()->user()->isOrdonnateur())
                <li class="nav-item {{ setMenuOpen('return_to_cash_sheet') }}">
                    <a href="#" class="nav-link {{ setMenuActive('return_to_cash_sheet') }}">
                        <i class="nav-icon fas fa-comments-dollar"></i>
                        <p>
                            Fiche retour en caisse
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('return_to_cash_sheet.create')}}" class="nav-link {{ setMenuActive('return_to_cash_sheet.create') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('return_to_cash_sheet.index')}}" class="nav-link {{ setMenuActive('return_to_cash_sheet.index') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liste des FRC</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                {{-- RECIPE SHEET / FICHE DE RECETTE --}}
                <li class="nav-item {{ setMenuOpen('recipe_sheet') }}">
                    <a href="#" class="nav-link {{ setMenuActive('recipe_sheet') }}">
                        <i class="nav-icon fas fa-comments-dollar"></i>
                        <p>
                            Fiche de recette
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('recipe_sheet.create')}}" class="nav-link {{ setMenuActive('recipe_sheet.create') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('recipe_sheet.index')}}" class="nav-link {{ setMenuActive('recipe_sheet.index') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liste des FR</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('recipe_sheet.by_day')}}" class="nav-link {{ setMenuActive('recipe_sheet.by_day') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recette du jour</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- AVAILABILITY REQUEST SHEET / FICHE DE DMD --}}
                <li class="nav-item {{ setMenuOpen('availability_request_sheet') }}">
                    <a href="#" class="nav-link {{ setMenuActive('availability_request_sheet') }}">
                        <i class="nav-icon fas fa-comments-dollar"></i>
                        <p>
                            DMD
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('availability_request_sheet.create')}}" class="nav-link {{ setMenuActive('availability_request_sheet.create') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Créer une DMD</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('availability_request_sheet.index')}}" class="nav-link {{ setMenuActive('availability_request_sheet.index') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liste des DMD</p>
                            </a>
                        </li>
                        @if (auth()->user()->isAdmin() ||auth()->user()->isCoordonnateur())
                            <li class="nav-item">
                                <a href="{{ route('availability_request_sheet.controllable')}}" class="nav-link {{ setMenuActive('availability_request_sheet.controllable') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Contrôlés</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->isAdmin() ||auth()->user()->isChef_depart())
                            <li class="nav-item">
                                <a href="{{ route('availability_request_sheet.ordonnable')}}" class="nav-link {{ setMenuActive('availability_request_sheet.ordonnable') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ordonnations</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere())
                            <li class="nav-item">
                                <a href="{{ route('availability_request_sheet.comptabilisable')}}" class="nav-link {{ setMenuActive('availability_request_sheet.comptabilisable') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Receptionnés</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere() ||auth()->user()->isChef_depart())
                            <li class="nav-item">
                                <a href="{{ route('availability_request_sheet.rejected')}}" class="nav-link {{ setMenuActive('availability_request_sheet.rejected') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rejetées</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere() ||auth()->user()->isChef_depart())
                            <li class="nav-item">
                                <a href="{{ route('availability_request_sheet.archived')}}" class="nav-link {{ setMenuActive('availability_request_sheet.archived') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Archivées</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                {{-- MATERIAL RELEASE FORM / BON DE SORTIE MATERIEL --}}
                    <li class="nav-item {{ setMenuOpen('material_release_form') }}">
                        <a href="#" class="nav-link {{ setMenuActive('material_release_form') }}">
                            <i class="nav-icon fas fa-comments-dollar"></i>

                            <p>
                                Bon Sortie Materiel
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere())
                                <li class="nav-item">
                                    <a href="{{ route('material_release_form.create')}}" class="nav-link {{ setMenuActive('material_release_form.create') }}">
                                        <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                        <p>
                                            <i class="far fa-circle nav-icon"></i>
                                            Créer
                                        </p>
                                    </a>
                                </li>
                            @endif



                            <li class="nav-item">
                                <a href="{{ route('material_release_form.index') }}" class="nav-link {{ setMenuActive('material_release_form.index') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        Encours
                                    </p>
                                </a>
                            </li>
                            @if (auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere())

                                <li class="nav-item">
                                    <a href="{{ route('material_release_form.archive') }}" class="nav-link {{ setMenuActive('material_release_form.archive') }}">
                                        <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                        <p>
                                            <i class="far fa-circle nav-icon"></i>
                                            Archivées
                                        </p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>

                {{-- SUPPLY REQUEST / Demande d'approvisionnement --}}
                {{-- @if (auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere())
                    <li class="nav-item {{ setMenuOpen('supply_request_form') }}">
                        <a href="#" class="nav-link {{ setMenuActive('supply_request_form') }}">
                            <i class="nav-icon fas fa-comments-dollar"></i>

                            <p>
                                DA
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('supply_request_form.create')}}" class="nav-link {{ setMenuActive('supply_request_form.create') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        Créer
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('supply_request_form.index') }}" class="nav-link {{ setMenuActive('supply_request_form.index') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        List DA
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif --}}

                <!-- Config comptable -->
                @if (auth()->user()->isAdmin() ||auth()->user()->isComptable())
                <li class="nav-item {{ setMenuOpen('book_keeper') }}">
                    <a href="#" class="nav-link {{ setMenuActive('book_keeper') }}">
                        <i class="nav-icon fas fa-comments-dollar"></i>

                        <p>
                            Config. comptable
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('book_keeper.create')}}" class="nav-link {{ setMenuActive('book_keeper.create') }}">
                                <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                <p>
                                    <i class="far fa-circle nav-icon"></i>
                                    Configuration comptable
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('book_keeper.index') }}" class="nav-link {{ setMenuActive('book_keeper.index') }}">
                                <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                <p>
                                    <i class="far fa-circle nav-icon"></i>
                                    Liste Confi. Comptable
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Config comptable matière -->
                @if (auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere())
                    <li class="nav-item {{ setMenuOpen('material_accountant') }}">
                        <a href="#" class="nav-link {{ setMenuActive('material_accountant') }}">
                            <i class="nav-icon fas fa-comments-dollar"></i>

                            <p>
                                Config. compta. mat.
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('material_accountant.create_af')}}" class="nav-link {{ setMenuActive('material_accountant.create_af') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        Créer famille articles
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('material_accountant.create_a') }}" class="nav-link {{ setMenuActive('material_accountant.create_a') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        Créer articles
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Config support client -->
                @if (auth()->user()->isAdmin() ||auth()->user()->isControler_recipe())
                    <li class="nav-item {{ setMenuOpen('config_site_recipe_sheet') }}">
                        <a href="#" class="nav-link {{ setMenuActive('config_site_recipe_sheet') }}">
                            <i class="nav-icon fas fa-comments-dollar"></i>

                            <p>
                                Config-sup_Client
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('config_site.create')}}" class="nav-link {{ setMenuActive('config_site_recipe_sheet.create') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        Créer site
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('config_site.index') }}" class="nav-link {{ setMenuActive('config_site_recipe_sheet.index') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        Liste des sites
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('produce_configuration.create')}}" class="nav-link {{ setMenuActive('produce_configuration.create') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        Créer un produit
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('produce_configuration.index') }}" class="nav-link {{ setMenuActive('produce_configuration.index') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        Liste des produits
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif



                <!-- Sething Admin -->
                @if (auth()->user()->isAdmin() )
                    <li class="nav-item {{ setMenuOpen('sething_admin') }}">
                        <a href="#" class="nav-link {{ setMenuActive('sething_admin') }}">
                            <i class="nav-icon fas fa-comments-dollar"></i>

                            <p>
                                Gestion des entités
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('entity.index')}}" class="nav-link {{ setMenuActive('entity.index') }}">
                                    <i class="fa-sharp fa-solid fa-folder-gear"></i>
                                    <p>
                                        <i class="far fa-circle nav-icon"></i>
                                        liste des entités
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ setMenuActive('users') }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Gestion utilisateurs
                            </p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
