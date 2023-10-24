@extends('layouts.master')

@section('title')
Voir une DMD
@endsection

@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">


   <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0')}}">

    @livewireStyles
@endsection

@section('header-section')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1 class="m-0">Voir une fiche de demande de mise à disposition</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Voir une DMD</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('body-section')
    <section class="content">
        <div class="container-fluid">
            <div class="mx-1 row">
                <div class="p-3 mb-3 invoice col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="text-left btn btn-primary w-100">
                                <div class="row">
                                    <div class="col-6"><b>DMD N° </b></div>
                                    <div class="col-6">N° {{ $availability_request_sheet->id }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Dossier </b></div>
                                    <div class="col-6">N° {{ $availability_request_sheet->num_dossier }}</div>
                                </div>
                            </button>
                        </div>

                        <div class="col-md-6">
                            <button class="text-left btn btn-primary w-100">
                                <div class="row">
                                    <div class="col-6"><b>Pays</b></div>
                                    <div class="col-6">{{ $availability_request_sheet->city_entity ? $availability_request_sheet->city_entity->city->country->label : ''}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Ville </b></div>
                                    <div class="col-6">{{ $availability_request_sheet->city_entity ? $availability_request_sheet->city_entity->city->label : '' }} {{ $availability_request_sheet->site_id ? $availability_request_sheet->site->label : '' }}</div>
                                </div>
                            </button>
                        </div>
                    </div>

                        {{--  corps du travail --}}
                        <div class="row invoice-info">
                            <div class="text-left col-sm-4 invoice-col">
                                <br/>
                                <strong>Initiateur </strong>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Nom</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->user->fname }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Prénom</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->user->lname }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Téléphone</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->user->phone }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Email</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->user->email }}</div>
                                </div>

                            </div>

                            <div class="col-sm-4 invoice-col">
                                <br/>
                                <strong>Infos sur la DMD</strong>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Service demandeur</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->service_demandeurs->title }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Produit </div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->produit }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Date de création</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->created_at }}</div>
                                </div>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <br/>
                                <strong>Ordonnateur</strong>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Nom</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->chef_departs->fname }} {{ $availability_request_sheet->chef_departs->lname }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Tel / email</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->chef_departs->phone }}/{{ $availability_request_sheet->chef_departs->email }}</div>
                                </div>
                                <strong>Contrôleur</strong>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Nom</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->controlleurs->fname }} {{ $availability_request_sheet->controlleurs->lname }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 text-bold">Tel / email</div>
                                    <div class="col-md-9 col-sm-6">: {{ $availability_request_sheet->controlleurs->phone }} / {{ $availability_request_sheet->controlleurs->email }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Corps de la DMD --}}
                        <div class="row invoice-info" >
                            <br/>
                            <strong>Description : </strong>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"> {{ $availability_request_sheet->user_observation }}</div>
                            </div>
                        </div>
                        <div>
                            <div class="mt-3 row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Désignation(s)</th>
                                                <th>Quantité</th>
                                                <th>Motif de la DMD</th>
                                                <th>Bénéficiaire(s)</th>
                                                <th>Début d'usage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $k = 1;
                                            @endphp

                                            @foreach ($availability_request_sheet->labels as $labels)
                                                <tr>
                                                    <td>#{{ $k++ }}</td>
                                                    <td>{{ $labels->designation }}</td>
                                                    <td>{{ $labels->quantite }}</td>
                                                    <td>{{ $labels->motif }}</td>
                                                    <td>{{ $labels->beneficiaires->fname }} {{ $labels->beneficiaires->lname }}/{{ $labels->beneficiaires->email }}</td>
                                                    <td>{{ $labels->date_debut_usage }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- décharge --}}
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th>Confirmation reception  </th> --}}
                                        <th>Visa reception comptable matière </th>
                                        <th>Visa Ordonnateur</th>
                                        <th>Visa du contrôleur</th>
                                        <th>Visa demandeur</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>

                                        <!-- validation reception -->
                                        {{-- <td>
                                            <form action="{{ route('availability_request_sheet.validation_dmd', auth()->user()->id) }}" method="post">
                                                @csrf
                                                <input type="number" name="availability_request_sheet_id" class="d-none" value="{{ $availability_request_sheet->id }}">
                                                @if($availability_request_sheet->statut == 'réçu')
                                                    OK
                                                    <span class="badge badge-danger">Observation</span><br>
                                                    <ul>
                                                            <li>{{ $availability_request_sheet->user_observation }}</li>

                                                    </ul>
                                                @else
                                                    @if (auth()->user()->id == $availability_request_sheet->user_id)
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user_observation{{ $availability_request_sheet->id }}"  @if($availability_request_sheet->statut  == 'en attente'||$availability_request_sheet->statut == 'validée par contrôler'||$availability_request_sheet->statut == 'validée par ordonnateur')disabled @endif>
                                                            Valider
                                                        </button>

                                                    @else
                                                        En attente de signature
                                                    @endif
                                                @endif
                                                        <!-- .modal-dialog -->
                                            </form>

                                            <div class="modal fade" id="user_observation{{ $availability_request_sheet->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Faites une observation</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="{{ route('availability_request_sheet.validation_dmd', $availability_request_sheet->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="text" name="fonction" class="d-none" value="initiateur">
                                                                <input type="text" class="form-control" name="user_observation" id="user_observation" placeholder="Observation ici!" >
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </td> --}}

                                        <!-- validation comptable matière -->
                                        <td>
                                            <form action="{{ route('availability_request_sheet.validation_dmd', $availability_request_sheet->id) }}" method="POST">
                                                @csrf
                                                <input type="number" name="availability_request_sheet_id" class="d-none" value="{{ $availability_request_sheet->id }}">
                                                @if($availability_request_sheet->statut == 'validée par comptable matière ' || $availability_request_sheet->statut == 'réçu')
                                                    <span class="badge badge-danger">OK :</span><br>
                                                    {{-- <ul> --}}
                                                            {{-- {{ $availability_request_sheet->comptable_matier->fname }} {{ $availability_request_sheet->comptable_matier->lname }}</li> --}}
                                                        {{-- <li> {{ $availability_request_sheet->comptable_matier ? $availability_request_sheet->comptable_matier->fname }} {{ $availability_request_sheet->comptable_matier ? $availability_request_sheet->comptable_matier->lname }} </li> --}}
                                                    {{-- </ul> --}}
                                                @else

                                                    @if (auth()->user()->isComptable_matiere())
                                                        <input type="text" name="fonction" class="d-none" value="beneficiaire">
                                                        <button type="submit" class="btn btn-primary" class="btn btn-primary" @if($availability_request_sheet->statut  == 'en attente'||$availability_request_sheet->statut == 'validée par contrôler')disabled @endif>
                                                            <input type="text" name="fonction" class="d-none" value="comptable_matier">
                                                            Valider
                                                        </button>

                                                    @else
                                                        En attente de signature
                                                    @endif
                                                @endif

                                            </form>

                                        </td>

                                        <!-- validation chef département -->
                                        <td>
                                            <form action="{{ route('availability_request_sheet.validation_dmd', auth()->user()->id) }}" method="post">
                                                @csrf
                                                <input type="number" name="availability_request_sheet_id" class="d-none" value="{{ $availability_request_sheet->id }}">
                                                @if($availability_request_sheet->statut == 'validée par ordonnateur' || $availability_request_sheet->statut == 'validée par comptable matière ' || $availability_request_sheet->statut == 'réçu')
                                                    OK
                                                    <span class="badge badge-danger">Observation</span><br>
                                                    <ul>
                                                            <li>{{ $availability_request_sheet->chef_depart_observation }}</li>
                                                            <li>Priorité : {{ $availability_request_sheet->dg_rejet }}</li>

                                                    </ul>
                                                @else
                                                    @if($availability_request_sheet->chef_depart_rejet)
                                                        <span class="badge badge-danger">Rejété</span>
                                                        <strong>Motif:</strong>
                                                        <ul>
                                                            @foreach (explode(",",$availability_request_sheet->chef_depart_rejet) as $chef_depart_rejet)
                                                                <li>{{ $chef_depart_rejet }}</li>
                                                            @endforeach

                                                        </ul>
                                                    @else
                                                        @if (auth()->user()->id == $availability_request_sheet->chef_depart)
                                                            <input type="text" name="fonction" class="d-none" value="chef_depart">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chef_depart_observation{{ $availability_request_sheet->id }}"  @if($availability_request_sheet->statut  == 'en attente')disabled @endif>
                                                                Valider
                                                            </button>
                                                            <button type="button" class="btn btn-warning" data-target="#chef_depart_rejet{{ $availability_request_sheet->id }}" data-toggle="modal" @if($availability_request_sheet->statut  == 'en attente') disabled @endif>
                                                                Rejeter
                                                            </button>

                                                        @else
                                                            En attente de signature
                                                        @endif
                                                    @endif
                                                @endif

                                            </form>
                                            {{-- modal chef de département --}}
                                            <div class="modal fade" id="chef_depart_observation{{ $availability_request_sheet->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Faites une observation</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="{{ route('availability_request_sheet.validation_dmd', $availability_request_sheet->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="text" name="fonction" class="d-none" value="chef_depart">
                                                                <input type="text" class="form-control" name="chef_depart_observation" id="chef_depart_observation" placeholder="Observation ici!" >
                                                                <br>
                                                                <select name="dg_rejet" id="dg_rejet"  class="@error('dg_rejet') is-invalid @enderror form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                                                                        <option value=" ">Précisez la priorité</option>
                                                                        <option value="faible">Faible</option>
                                                                        <option value="normale">Normale</option>
                                                                        <option value="haute">Haute</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="chef_depart_rejet{{ $availability_request_sheet->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Cause</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="{{ route('chef_depart_rejet.availability_request_sheet', $availability_request_sheet->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <select type="text" class="form-control select2" multiple="multiple" name="chef_depart_rejet[]">
                                                                    <option>Demande pas conforme</option>
                                                                    <option>Demande non justifiée</option>
                                                                    <option>Doublon de besoin</option>
                                                                    <option>Libellé incorrect</option>
                                                                    <option>Demande non validée</option>
                                                                </select>

                                                            <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- validation controleur -->
                                        <td>
                                            <form action="{{ route('availability_request_sheet.validation_dmd', auth()->user()->id) }}" method="post">
                                                @csrf
                                                <input type="number" name="availability_request_sheet_id" class="d-none" value="{{ $availability_request_sheet->id }}">
                                                @if($availability_request_sheet->statut == 'validée par contrôler' || $availability_request_sheet->statut == 'validée par ordonnateur' || $availability_request_sheet->statut == 'validée par comptable matière ' || $availability_request_sheet->statut == 'réçu')
                                                    OK
                                                    <span class="badge badge-danger">Observation</span><br>
                                                    <ul>
                                                            <li>{{ $availability_request_sheet->controleur_observation }}</li>

                                                    </ul>
                                                @else
                                                    @if($availability_request_sheet->controleur_rejet)
                                                        <span class="badge badge-danger">Rejété</span>
                                                        <strong>Motif:</strong>
                                                        <ul>
                                                            @foreach (explode(",",$availability_request_sheet->controleur_rejet) as $controleur_rejet)
                                                                <li>{{ $controleur_rejet }}</li>
                                                            @endforeach

                                                        </ul>
                                                    @else
                                                        @if (auth()->user()->id == $availability_request_sheet->controlleur)
                                                            <input type="text" name="fonction" class="d-none" value="controlleur">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#controleur_observation{{ $availability_request_sheet->id }}"  @if($availability_request_sheet->statut  == 'en attente') @endif>
                                                                Valider
                                                            </button>
                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#controleur_rejet{{ $availability_request_sheet->id }}" @if($availability_request_sheet->statut  == 'en attente') @endif >
                                                                Rejeter
                                                            </button>

                                                        @else
                                                            En attente de signature
                                                        @endif
                                                    @endif
                                                @endif

                                            </form>
                                            {{-- modal controlleur --}}
                                            <div class="modal fade" id="controleur_observation{{ $availability_request_sheet->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Faites une observation</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="{{ route('availability_request_sheet.validation_dmd', $availability_request_sheet->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="text" name="fonction" class="d-none" value="controlleur">

                                                                <input type="text" class="form-control" name="controleur_observation" id="controleur_observation" placeholder="Observation ici!" >
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="controleur_rejet{{ $availability_request_sheet->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Cause</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="{{ route('controleur_rejet.availability_request_sheet', $availability_request_sheet->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <select type="text" class="form-control select2" multiple="multiple" name="controleur_rejet[]">
                                                                    <option>Demande pas conforme</option>
                                                                    <option>Demande non justifiée</option>
                                                                    <option>Doublon de besoin</option>
                                                                    <option>Libellé incorrect</option>
                                                                    <option>Demande non validée</option>
                                                                </select>

                                                            <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- validation demandeur -->
                                        <td>
                                            OK
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @if((auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere()) && $availability_request_sheet->statut == 'réçu'&& $availability_request_sheet->president_rejet  == '')
                            <div class="row">
                                <!-- Create BSM -->
                                {{-- <div class="col-md-2 col-sm-2">
                                    <form action="{{ route('material_release_form.create') }}" method="post" title="Cliquer ici pour crée un BSM">
                                        @csrf
                                        <input type="hidden" class="form-control @error('dmd_id')
                                        is-invalid
                                        @enderror" id="dmd_id" name="dmd_id" value="{{$availability_request_sheet->id }}" placeholder="{{ $availability_request_sheet->id }}"/>
                                        @error('dmd_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <br/>
                                        <button type="submit" onclick="return confirm('Voulez vous créer un bon de sortie matériel ? si oui cliquez sur ok')"
                                            id="register" class="btn btn-success">
                                                Créer un bon de sortie
                                        </button>
                                    </form>
                                </div> --}}
                                <!-- Create DA -->
                                {{-- <div class="col-md-2 col-sm-2">
                                    <form action="#" method="post" title="Cliquer ici pour crée un BSM">
                                        @csrf
                                        <input type="hidden" class="form-control @error('dmd_id')
                                        is-invalid
                                        @enderror" id="dmd_id" name="dmd_id" value="{{$availability_request_sheet->id }}" placeholder="{{ $availability_request_sheet->id }}"/>
                                        @error('dmd_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <br/>
                                        <button type="submit" onclick="return confirm('Voulez vous créer une demande d\'achat ? si oui cliquez sur ok')"
                                            id="register" class="btn btn-warning">
                                                Créer demande achat
                                        </button>
                                    </form>
                                </div> --}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    // $.widget.bridge('uibutton', $.ui.button)

    window.addEventListener('load', (event) => {
        document.getElementById('destinataire').style.display = 'block';
        // console.log('La page est complètement chargée');
    });
    function change(param) {
        if (param == 'Espèces') {
            document.getElementById('destinataire').style.display = 'none';
            document.getElementById('numero_contribuable').style.display = 'none';
        }else{
            document.getElementById('destinataire').style.display = 'block';
            document.getElementById('numero_contribuable').style.display = 'block';
        }
    }
</script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script> --}}

<script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>
  @livewireScripts
@endsection
