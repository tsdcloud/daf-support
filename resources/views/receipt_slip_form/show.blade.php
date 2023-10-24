@extends('layouts.master')

@section('title')
Voir une FRC
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
                    <h1 class="m-0">Voir une fiche de recette</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Voir une FR</li>
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
                        <div class="col-md-3">
                            <button class="text-left btn btn-primary w-100">
                                <div class="row">
                                    <div class="col-6"><b>Fiche recette </b></div>
                                    <div class="col-6">N° {{ $recipe_sheet->id }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Dossier </b></div>
                                    <div class="col-6">N° {{ $recipe_sheet->num_dossier }}</div>
                                </div>
                            </button>
                        </div>

                        <div class="col-md-3">
                            <button class="text-left btn btn-primary w-100">
                                <div class="row">
                                    <div class="col-6"><b>Pays</b></div>
                                    <div class="col-6">{{ $recipe_sheet->city_entity ? $recipe_sheet->city_entity->city->country->label : ''}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Ville </b></div>
                                    <div class="col-6">{{ $recipe_sheet->city_entity ? $recipe_sheet->city_entity->city->label : '' }} </div>
                                </div>
                            </button>
                        </div>

                        <div class="col-md-3">
                            <div class="text-left">
                                @if($recipe_sheet->num_rappot_de_shift)
                                    <button class="text-left btn btn-info w-100">
                                        <div class="row">
                                            <div class="col-6"><b>N°Rapport: </b></div>
                                            <div class="col-6">{{ $recipe_sheet->num_rappot_de_shift }}</div>
                                        </div>
                                    </button>
                                @else
                                    @if (auth()->user()->isControler_recipe() && $recipe_sheet->statut == 'validée par apporteur')
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_rapport_de_quart{{ $recipe_sheet->id }}">
                                            Faites un rapport de quart
                                        </button>
                                    @endif
                                @endif
                            </div>

                            {{-- Modal rapport de quart --}}
                            <div class="modal fade" id="modal_rapport_de_quart{{ $recipe_sheet->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Faites une observation</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{ route('recipe_sheet.validation_fr', $recipe_sheet->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="text" name="fonction" class="d-none" value="support_partenaire">

                                                <label for="num_rappot_de_shift">N° de rapport <span class="text-danger"><sup>*</sup></span></label>
                                                <input type="text" class="form-control" name="num_rappot_de_shift" id="num_rappot_de_shift" placeholder="Numéro de quart!" >

                                                <label for="observation_support_partenaire">Faites votre observation <span class="text-danger"><sup>*</sup></span></label>
                                                <input type="text" class="form-control" name="observation_support_partenaire" id="observation_support_partenaire" placeholder="Observation ici!" >
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal-dialog -->

                        </div>


                        <div class="col-md-3">
                            <div class="text-right">
                                {{-- @dump(auth()->user()->isComptable()) --}}
                                @if($recipe_sheet->num_comptable)
                                    <button type="button" class="btn btn-success">

                                        <span class="text-bold"> Référence comptable :</span>
                                        <span>{{ $recipe_sheet->num_comptable }}</span>
                                    </button>
                                @else
                                    @if (auth()->user()->isComptable() && $recipe_sheet->num_rappot_de_shift)
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default{{ $recipe_sheet->id }}">
                                            Ajouter une référence comptable
                                        </button>
                                    @endif
                                @endif
                            </div>
                            {{-- Modal pour comptable --}}
                            <div class="modal fade" id="modal-default{{ $recipe_sheet->id }}">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Imputation Comptable</h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <livewire:imputation-comptable-fr :recipe_sheet="$recipe_sheet" :comptes="$comptes">

                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-dialog -->

                        </div>
                    </div>

                    {{--  corps du travail --}}
                    <div class="row invoice-info">

                        <div class="text-left col-sm-4 invoice-col">
                            <strong>Initiateur</strong>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Nom</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->user->fname }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Prénom</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->user->lname }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Téléphone</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->user->phone }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Email</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->user->email }}</div>
                            </div>

                        </div>

                        <div class="col-sm-4 invoice-col">
                            <strong>Apporteur</strong>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Nom</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->apporteurs->fname }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Prénom</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->apporteurs->lname }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Téléphone</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->apporteurs->phone }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Email</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->apporteurs->email }}</div>
                            </div>

                        </div>

                        <div class="col-sm-4 invoice-col">
                            <strong>Coordonnateur</strong>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Nom</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->controlleur ? $recipe_sheet->controlleurs->fname : '' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Prénom</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->controlleur ? $recipe_sheet->controlleurs->lname : '' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Téléphone</div>
                                <div class="col-md-9 col-sm-6">:{{ $recipe_sheet->controlleur ? $recipe_sheet->controlleurs->phone : '' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 text-bold">Email</div>
                                <div class="col-md-9 col-sm-6">: {{ $recipe_sheet->controlleur ? $recipe_sheet->controlleurs->email : '' }}</div>
                            </div>
                        </div>

                    </div>


                        {{-- Corps de la recette --}}

                    <hr/>
                    <div class="row invoice-info">


                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Provenance </strong>
                                </div>
                                <div class="col-md-9">
                                    <b>:</b> {{ $recipe_sheet->provenance }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Mode paiment </strong>
                                </div>
                                <div class="col-md-9">
                                    <b>:</b> {{ $recipe_sheet->mode_paiment }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Tranche horaire</strong>
                                </div>
                                <div class="col-md-9">
                                    <b>:</b> {{ $recipe_sheet->shift }}<br>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Contact</strong>
                                </div>
                                <div class="col-md-9">
                                    <b>:</b> {{ $recipe_sheet->contact }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Raison sociale</strong>
                                </div>
                                <div class="col-md-9">
                                    <b>:</b> {{ $recipe_sheet->raison_sociale }}<br>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>N° contribuable</strong>
                                </div>
                                <div class="col-md-9">
                                    <b>:</b> {{ $recipe_sheet->numero_contribuable }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Date</strong>
                                </div>
                                <div class="col-md-9">
                                    <b>:</b>{{ $recipe_sheet->created_at }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <hr/> --}}

                    <div class="mt-3 row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Libellé</th>
                                        <th>Prix unitaire </th>
                                        <th>Quantité</th>
                                        <th>Prix total </th>
                                        <th>Dossier d'affectation</th>
                                        <th>Site de production</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $k = 1;
                                        // $total=0;
                                    @endphp
                                    @foreach ($recipe_sheet->labels as $labels)
                                        <tr>
                                            <td>#{{ $k++ }}</td>
                                            <td>{{ $labels->libelle }}</td>
                                            <td>{{\App\Helpers\MoneyHelper::price($labels->prix_unitaire)}}</td>
                                            <td>{{ $labels->quantite }}</td>
                                            <td>{{\App\Helpers\MoneyHelper::price($labels->prix_total)}}</td>
                                            <td>{{ $labels->dossier }}</td>
                                            <td>{{ $labels->site_prod ? $recipe_sheet->site->label : ''  }}</td>
                                        </tr>
                                        {{-- @php
                                        $total += $labels->prix_total;
                                        @endphp --}}
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><strong>Total </strong></th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th>{{\App\Helpers\MoneyHelper::price($recipe_sheet->montant)}}</th>
                                        <th> </th>
                                        <th> </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>


                    {{-- affichage du rapport support client --}}

                    @if($recipe_sheet->observation_support_partenaire )
                        <div class="col-12">
                            <button type="button" class="btn btn-info btn-block">
                                <strong>Description :</strong> {{ $recipe_sheet->observation_support_partenaire }}
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="row">
                                    <strong>Nom du support partenaire </strong>
                                </div>
                                <div class="row">
                                    {{ $recipe_sheet->support_partenaire ? $recipe_sheet->support_partenaires->fname : '' }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <strong>Prénom du support partenaire </strong>
                                </div>
                                <div class="row">
                                    {{ $recipe_sheet->support_partenaire ? $recipe_sheet->support_partenaires->lname : '' }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <strong>Email </strong>
                                </div>
                                <div class="row">
                                    {{ $recipe_sheet->support_partenaire ? $recipe_sheet->support_partenaires->email : '' }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <strong>Téléphone </strong>
                                </div>
                                <div class="row">
                                    {{ $recipe_sheet->support_partenaire ? $recipe_sheet->support_partenaires->phone : '' }}

                                </div>
                            </div>

                        </div>

                    @endif

                    {{-- afficher les infos comptable --}}
                    @if($recipe_sheet->num_comptable && auth()->user()->isAdmin()|| $recipe_sheet->num_comptable && auth()->user()->isComptable())
                        <br/>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>N° facture </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->num_facture }}<br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Montant dette </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b>{{\App\Helpers\MoneyHelper::price($recipe_sheet->montant_dette)}}<br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Retenue à la source </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b>{{\App\Helpers\MoneyHelper::price($recipe_sheet->retenu_source)}}<br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Numéro d'attestation </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->num_attestation }}<br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Montant recette </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b>{{\App\Helpers\MoneyHelper::price($recipe_sheet->montant_a_payer)}}<br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>N°compte général </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->num_compte_general }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Code tiers </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->code_tiers }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Section analytique </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->section_analytique }}
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <strong>N° chèque\virement </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->num_cheque_virement }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Référence compte </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->compte->banque }} {{ $recipe_sheet->compte->intitule }} {{ $recipe_sheet->compte->entity->sigle }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <strong>Nom du comptable </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->comptables ? $recipe_sheet->comptables->fname : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Prénom du comptable </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->comptables ? $recipe_sheet->comptables->lname : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Email </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->comptables ? $recipe_sheet->comptables->email : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Téléphone </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <b>:</b> {{ $recipe_sheet->comptables ? $recipe_sheet->comptables->phone : '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                 {{-- décharge --}}
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Apporteur</th>
                                <th>Caisse</th>
                                <th>Contrôleur</th>
                                <th>Initiation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- validation Apporteur -->
                                <td>
                                    @if($recipe_sheet->statut == 'validée par apporteur')
                                        OK<br>
                                        <span class="badge badge-danger">Observation</span><br>
                                        <ul>
                                                <li>{{ $recipe_sheet->observation_apporteur }}</li>
                                        </ul>
                                    @else
                                        @if (auth()->user()->id == $recipe_sheet->apporteur)

                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#observation_apporteur{{ $recipe_sheet->id }}" @if($recipe_sheet->statut  == 'en attente' ||$recipe_sheet->statut == 'validée par contrôleur' )  disabled @endif>
                                                Signez en cliquant ici
                                            </button>
                                        @else
                                            En attente de signature
                                        @endif
                                    @endif

                                        {{-- modal --}}

                                    <div class="modal fade" id="observation_apporteur{{ $recipe_sheet->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Faites une observation</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('recipe_sheet.validation_fr', $recipe_sheet->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="fonction" class="d-none" value="apporteur">
                                                        <input type="text" class="form-control" name="observation_apporteur" id="observation_apporteur" placeholder="saisire ici!" >
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    </div>
                                                </form>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <!-- validation Caisse -->
                                <td>
                                    @if($recipe_sheet->statut == 'encaissé'|| $recipe_sheet->statut == 'validée par apporteur')
                                        OK<br>
                                        <span class="badge badge-danger">Observation</span><br>
                                        <ul>
                                                <li>{{ $recipe_sheet->observation_caisse }}</li>

                                        </ul>
                                    @else

                                        @if ( auth()->user()->isCaissier())
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#observation_caisse{{ $recipe_sheet->id }}" @if($recipe_sheet->statut  == 'en attente' )  disabled @endif>
                                                Signez en cliquant ici
                                            </button>
                                        @else
                                            En attente de signature
                                        @endif
                                    @endif

                                    {{-- modal observation caisse --}}

                                    <div class="modal fade" id="observation_caisse{{ $recipe_sheet->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Faites une observation</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('recipe_sheet.validation_fr', $recipe_sheet->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="fonction" class="d-none" value="caisse">
                                                        <input type="text" class="form-control" name="observation_caisse" id="observation_caisse" placeholder="saisire ici!" >
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    </div>
                                                </form>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <!-- validation coordonnateur = contrôleur -->
                                <td>
                                        @if($recipe_sheet->statut == 'validée par contrôleur'|| $recipe_sheet->statut == 'encaissé'|| $recipe_sheet->statut == 'validée par apporteur')
                                            OK<br>
                                            <span class="badge badge-danger">Observation</span><br>
                                            <ul>
                                                    <li>{{ $recipe_sheet->observation_controlleurer }}</li>

                                            </ul>
                                        @else

                                            @if (auth()->user()->isCoordonnateur())

                                                {{-- <input type="text" name="fonction" class="d-none" value="controler_recipe"> --}}
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#observation_controlleurer{{ $recipe_sheet->id }}">
                                                    Signez en cliquant ici
                                                </button>
                                            @else
                                                En attente de signature
                                            @endif
                                        @endif

                                    {{-- modal observation coordonnateur NB le coordonnateur à remplace de le controlleur recette --}}

                                    <div class="modal fade" id="observation_controlleurer{{ $recipe_sheet->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Faites une observation</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('recipe_sheet.validation_fr', $recipe_sheet->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="fonction" class="d-none" value="controler_recipe">
                                                        <input type="text" class="form-control" name="observation_controlleurer" id="observation_controlleurer" placeholder="saisire ici!" >
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    </div>
                                                </form>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <!-- validation Création -->
                                <td>
                                    OK
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

    let recup =  document.getElementById("observation_controlleurer").value;
    console.log(recup)
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
