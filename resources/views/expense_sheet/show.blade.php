@extends('layouts.master')

@section('title')
Consulter une FD
@endsection

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
@livewireStyles()
@endsection

@section('header-section')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Fiche dépense N° {{ $fiche_depense->id }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Accueil</a></li>
                <li class="breadcrumb-item active">Consulter une FD</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('body-section')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="p-3 mb-3 invoice">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="text-left btn btn-primary w-100">
                                    <div class="row">
                                        <div class="col-6"><b>Fiche dépense </b></div>
                                        <div class="col-6">N° {{ $fiche_depense->id }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6"><b>Dossier </b></div>
                                        <div class="col-6">N° {{ $fiche_depense->num_dossier }}</div>
                                    </div>
                                </button>
                            </div>

                            <div class="col-md-4">
                                <button class="text-left btn btn-primary w-100">
                                    <div class="row">
                                        <div class="col-6"><b>Pays</b></div>
                                        <div class="col-6">{{ $fiche_depense->city_entity ? $fiche_depense->city_entity->city->country->label : ''}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6"><b>Ville </b></div>
                                        <div class="col-6">{{ $fiche_depense->city_entity ? $fiche_depense->city_entity->city->label : '' }} {{ $fiche_depense->site_id ? $fiche_depense->site->label : '' }}</div>
                                    </div>
                                </button>
                            </div>

                            <div class="col-md-4">
                                <div class="text-right">
                                    {{-- @dump(auth()->user()->isComptable()) --}}
                                    @if($fiche_depense->num_comptable)
                                        <button type="button" class="btn btn-success w-100">

                                            <span class="text-bold"> Référence comptable :</span>
                                            <span>{{ $fiche_depense->num_comptable }}</span>
                                        </button>
                                    @else
                                        @if (auth()->user()->isComptable() && $fiche_depense->statut == 'décaissé')
                                            <button type="button" class="btn btn-warning w-100" data-toggle="modal" data-target="#modal-default{{ $fiche_depense->id }}">
                                                Ajouter une référence comptable
                                            </button>
                                        @endif
                                    @endif
                                </div>
                                {{-- Modal pour comptable --}}
                                <div class="modal fade" id="modal-default{{ $fiche_depense->id }}">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Imputation Comptable</h4>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <livewire:imputation-comptable :fiche_depense="$fiche_depense" :comptes="$comptes">

                                        </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- <div class="modal fade" id="modal-default{{ $fiche_depense->id }}">
                                    <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Imputation Comptable</h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{ route('add.num_comptable', $fiche_depense->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="num_comptable">N° Compte général <span class="text-danger"><sub>*</sub></span></label>
                                                                <input type="text" name="num_comptable" id="num_comptable" value="{{ @old('num_comptable') }}" class="form-control  @error('num_comptable') is-invalid @enderror" placeholder="8 chiffre complet par 0" required>
                                                                @error('num_comptable')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="code_tiers">Code tiers <span class="text-danger"><sub>*</sub></span></label>
                                                                <input type="text" name="code_tiers" id="code_tiers" value="{{ @old('code_tiers') }}" class="form-control  @error('code_tiers') is-invalid @enderror" placeholder="4 chiffres et 10 lettres max" required>
                                                                @error('code_tiers')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="section_analytique">Section analytique <span class="text-danger"><sub>*</sub></span></label>
                                                                <input type="text" name="section_analytique" id="section_analytique" value="{{ @old('section_analytique') }}" class="form-control  @error('section_analytique') is-invalid @enderror" placeholder="12 Digits max" required>
                                                                @error('section_analytique')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-6 ">
                                                                <label for="num_cheque_virement">N° Chèque/Virement </label>
                                                                <input type="text" name="num_cheque_virement" id="num_cheque_virement" value="{{ @old('num_cheque_virement') }}" class="form-control  @error('num_cheque_virement') is-invalid @enderror" placeholder="12 Digits max">
                                                                @error('num_cheque_virement')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group col-6">
                                                                <label for="ref_compte">Référence compte <span class="text-danger"><sub>*</sub></span></label>
                                                                <input type="text" name="ref_compte" id="ref_compte" value="{{ @old('ref_compte') }}" class="form-control  @error('ref_compte') is-invalid @enderror" placeholder="Zonne de liste" required>
                                                                @error('ref_compte')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-3 ">
                                                                <label for="montant_dette">Montant dette</label>
                                                                <input type="number" name="montant_dette" id="montant_dette" value="{{ @old('montant_dette') }}" class="form-control  @error('montant_dette') is-invalid @enderror" placeholder="saisir montant dette">
                                                                @error('montant_dette')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-2 ">
                                                                <label for="retenu_source">Retenue à la source</label>
                                                                <input type="number" name="retenu_source" id="retenu_source" value="{{ @old('retenu_source') }}" class="form-control  @error('retenu_source') is-invalid @enderror" placeholder="saisir Retenue à la source">
                                                                @error('retenu_source')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-2 ">
                                                                <label for="num_attestation">N° Attestation</label>
                                                                <input type="text" name="num_attestation" id="num_attestation" value="{{ @old('num_attestation') }}" class="form-control  @error('num_attestation') is-invalid @enderror" placeholder=" visible Si retenue à la source remplie">
                                                                @error('num_attestation')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-2 ">
                                                                <label for="montant_a_payer">Montant à payer</label>
                                                                <input type="number" name="montant_a_payer" id="montant_a_payer" value="{{ @old('montant_a_payer') }}" class="form-control  @error('montant_a_payer') is-invalid @enderror" placeholder="dette - retenue à la source">
                                                                @error('montant_a_payer')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-3 ">
                                                                <label for="num_facture">N° de Facture</label>
                                                                <input type="text" name="num_facture" id="num_facture" value="{{ @old('num_facture') }}" class="form-control  @error('num_facture') is-invalid @enderror" placeholder="12 Digits max">
                                                                @error('num_facture')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div> --}}
                                {{-- fin modal comptable --}}
                            </div>
                        </div>

                        <div class="mt-3 row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <strong>Bénéficiaire</strong>
                                <hr>
                                <address>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Nom </strong>
                                        </div>
                                        <div class="col-md-9">
                                            <strong>:</strong> {{ $fiche_depense->beneficiaires->fname }} {{ $fiche_depense->beneficiaires->lname }}<br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Matricule </strong>
                                        </div>
                                        <div class="col-md-9">
                                            <strong>:</strong> {{ $fiche_depense->numero_contribuable }}<br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Numéro contribuable </strong>
                                        </div>
                                        <div class="col-md-9">
                                            <strong>:</strong> {{ $fiche_depense->numero_contribuable }}<br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Mode de paiement </strong>
                                        </div>
                                        <div class="col-md-9">
                                            <strong>:</strong> {{ $fiche_depense->mode_paiment }}<br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Destinataire </strong>
                                        </div>
                                        <div class="col-md-9">
                                            <strong>:</strong> {{ $fiche_depense->destinataire }}<br>
                                        </div>
                                    </div>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">

                                <strong>Demandeur</strong>
                                <hr>
                                <address>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Nom </strong>
                                        </div>
                                        <div class="col-md-9">
                                            <strong>:</strong> {{ $fiche_depense->user->fname }} {{ $fiche_depense->user->lname }}<br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Email </strong>
                                        </div>
                                        <div class="col-md-9">
                                            <strong>:</strong> {{ $fiche_depense->user->email }}<br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Téléphone </strong>
                                        </div>
                                        <div class="col-md-9">
                                            <strong>:</strong> {{ $fiche_depense->user->phone }}<br>
                                        </div>
                                    </div>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">

                                <div class="mt-5 row">
                                    <hr>
                                    <hr>
                                    <div class="col-md-5">
                                        <strong>Ordonnée par </strong>
                                    </div>
                                    <div class="col-md-7">
                                        <strong>:</strong> {{$fiche_depense->ordonateurs->fname}}<br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <strong>Contrôlée par </strong>
                                    </div>
                                    <div class="col-md-7">
                                        <strong>:</strong>{{$fiche_depense->controlleurs->fname}} <br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <strong>Montant </strong>
                                    </div>
                                    <div class="col-md-7">
                                        <strong>:</strong>
                                        {{\App\Helpers\MoneyHelper::price($fiche_depense->montant)}}
                                        {{-- {{ number_format($fiche_depense->montant, 2, '.', ' ') }}  --}}
                                        Fcfa
                                        <br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <strong>Date de demande </strong>
                                    </div>
                                    <div class="col-md-7">
                                        <strong>:</strong>{{ $fiche_depense->created_at }} <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="p-1 rounded btn btn-secondary">
                                    <strong>Description :</strong> {{ $fiche_depense->description }}
                                </button>
                            </div>
                            <div class="col-12">
                                <strong>Pièces jointes :</strong> <br>
                                <div class="row">
                                    @forelse ($fiche_depense->attachments as $attachment)
                                        <div class="col-md-3">
                                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                <a href="{{ asset('storage/' .$attachment->filename) }}" orderdata-toggle="lightbox" data-title="sample 1 - white">
                                                    <img src="{{ asset('storage/' .$attachment->filename) }}" class="mb-2" width="100" height="100" alt="white sample" />
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-3 my-2 text-bold">
                                            Aucune pièces justificatives associées
                                        </div>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                        {{-- afficher les infos comptable --}}
                        @if($fiche_depense->num_comptable && auth()->user()->isAdmin() || $fiche_depense->num_comptable && auth()->user()->isComptable())
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>N° facture </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->num_facture }}<br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Montant dette </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->montant_dette }}<br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Retenue à la source </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->retenu_source }}<br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Numéro d'attestation </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->num_attestation }}<br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Montant à payer </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->montant_a_payer }}<br>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>N°compte général </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->num_compte_general }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Code tiers </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->code_tiers }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Section analytique </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->section_analytique }}
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <strong>N° chèque\virement </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->num_cheque_virement }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Référence compte </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->compte->banque }} {{ $fiche_depense->compte->intitule }} {{ $fiche_depense->compte->entity->sigle }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <strong>Nom du comptable </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->comptables ? $fiche_depense->comptables->fname : '' }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Prénom du comptable </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->comptables ? $fiche_depense->comptables->lname : '' }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Email </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->comptables ? $fiche_depense->comptables->email : '' }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Téléphone </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <b>:</b> {{ $fiche_depense->comptables ? $fiche_depense->comptables->phone : '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- fin afficher les infos comptable --}}


                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ordonnateur</th>
                                            <th>Controleur budgétaire</th>
                                            <th>Controleur conformité</th>
                                            <th>Bénéficiaire</th>
                                            <th>Demandeur</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <!-- validation ordonateur -->
                                            <td>
                                                <form action="{{ route('fiche_depense.validation_fd', auth()->user()->id) }}" method="post">
                                                    @csrf
                                                    <input type="number" name="fiche_depense_id" class="d-none" value="{{ $fiche_depense->id }}">
                                                    @if($fiche_depense->statut == 'décaissé' || $fiche_depense->statut == 'validée')
                                                      OK

                                                    @else
                                                        @if($fiche_depense->ordonateur_rejet)
                                                            <span class="badge badge-danger">Rejété</span><br>
                                                            <strong>Motif:</strong>
                                                            {{ $fiche_depense->ordonateur_rejet }}
                                                            <ul>
                                                                @foreach (explode(",",$fiche_depense->ordonateur_rejet) as $ordonateur_rejet)
                                                                    <li>{{ $ordonateur_rejet }}</li>
                                                                @endforeach

                                                            </ul>
                                                        @else
                                                            @if (auth()->user()->id == $fiche_depense->ordonateur)
                                                                <input type="text" name="fonction" class="d-none" value="ordonateur">
                                                                <button type="submit" class="btn btn-primary" @if($fiche_depense->statut  == 'en attente' || $fiche_depense->statut  == 'en cours_conf')  disabled @endif>
                                                                    Valider
                                                                </button>
                                                                <button type="button" data-toggle="modal" data-target="#ordonateur{{ $fiche_depense->id }}" class="btn btn-warning" @if($fiche_depense->statut  == 'en attente' || $fiche_depense->statut  == 'en cours_conf')  disabled @endif>
                                                                    Rejeter
                                                                </button>
                                                            @else
                                                                En attente de signature
                                                            @endif
                                                        @endif
                                                    @endif
                                                </form>
                                                {{-- modal --}}
                                                <div class="modal fade" id="ordonateur{{ $fiche_depense->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Cause</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('rejet_ordonateur.fiche_depense', $fiche_depense->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <select type="text" class="form-control select2" multiple="multiple" name="ordonateur_rejet[]">
                                                                        <option>Facture pas conforme</option>
                                                                        <option>Pas de facture</option>
                                                                        <option>Numéro de contribuable absent</option>
                                                                        <option>Numéro de contribuable incorrect</option>
                                                                        <option>Numéro de contribuable inexistant</option>
                                                                        <option>Numéro de dossier incorrect</option>
                                                                        <option>Doublon de besoin</option>
                                                                        <option>Libellé incorrect</option>
                                                                        <option>Dépense non validée</option>
                                                                    </select>
                                                                <input type="text" class="form-control d-none" name="num_comptable" id="num_comptable" placeholder="saisire ici!" >
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

                                            <!-- validation controleur -->
                                            <td>
                                                <form action="{{ route('fiche_depense.validation_fd', auth()->user()->id) }}" method="post">
                                                    @csrf
                                                    <input type="number" name="fiche_depense_id" class="d-none" value="{{ $fiche_depense->id }}">
                                                    @if($fiche_depense->statut == 'en cours' || $fiche_depense->statut == 'validée' || $fiche_depense->statut == 'décaissé')
                                                        OK

                                                    @else
                                                        @if($fiche_depense->controleur_rejet)
                                                            <span class="badge badge-danger">Rejété</span><br>
                                                            <strong>Motif:</strong>
                                                            {{-- {{ $fiche_depense->controleur_rejet }}- --}}
                                                            <ul>
                                                                @foreach (explode(",",$fiche_depense->controleur_rejet) as $controleur_rejet)
                                                                    <li>{{ $controleur_rejet }}</li>
                                                                @endforeach

                                                            </ul>
                                                        @else
                                                            @if (auth()->user()->id == $fiche_depense->controlleur)
                                                                <input type="text" name="fonction" class="d-none" value="controlleur">
                                                                <button type="submit" class="btn btn-primary"  @if($fiche_depense->statut  == 'en attente')  disabled @endif>
                                                                    Valider
                                                                </button>
                                                                <button type="button" class="btn btn-warning" @if($fiche_depense->statut  == 'en attente')  disabled @endif data-toggle="modal" data-target="#controlleur{{ $fiche_depense->id }}">
                                                                    Rejeter
                                                                </button>

                                                            @else
                                                                En attente de signature
                                                            @endif
                                                        @endif
                                                    @endif

                                                </form>
                                                {{-- modal --}}
                                                <div class="modal fade" id="controlleur{{ $fiche_depense->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Cause</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('rejet_budj.fiche_depense', $fiche_depense->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <select type="text" class="form-control select2" multiple="multiple" name="controleur_rejet[]">
                                                                        <option>Facture pas conforme</option>
                                                                        <option>Pas de facture</option>
                                                                        <option>Numéro de contribuable absent</option>
                                                                        <option>Numéro de contribuable incorrect</option>
                                                                        <option>Numéro de contribuable inexistant</option>
                                                                        <option>Numéro de dossier incorrect</option>
                                                                        <option>Doublon de besoin</option>
                                                                        <option>Libellé incorrect</option>
                                                                        <option>Dépense non validée</option>
                                                                    </select>
                                                                <input type="text" class="form-control d-none" name="num_comptable" id="num_comptable" placeholder="saisire ici!" >
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

                                            <!-- validation controleur_conf -->
                                            <td>
                                                <form action="{{ route('fiche_depense.validation_fd', auth()->user()->id) }}" method="post">
                                                    @csrf
                                                    <input type="number" name="fiche_depense_id" class="d-none" value="{{ $fiche_depense->id }}">
                                                    @if($fiche_depense->statut == 'en cours_conf' || $fiche_depense->statut == 'en cours' || $fiche_depense->statut == 'validée' || $fiche_depense->statut == 'décaissé')
                                                        OK
                                                    @else
                                                        @if($fiche_depense->controleur_conf_rejet)
                                                            <span class="badge badge-danger">Rejété</span><br>
                                                            <strong>Motif:</strong>
                                                            <ul>
                                                                @foreach (explode(",",$fiche_depense->controleur_conf_rejet) as $controleur_conf_rejet)
                                                                    <li>{{ $controleur_conf_rejet }}</li>
                                                                @endforeach

                                                            </ul>
                                                            {{-- @dump(explode(",",$fiche_depense->controleur_conf_rejet)) --}}
                                                        @else
                                                            @php
                                                                $isControllerConf = false;
                                                                foreach (auth()->user()->privileges as $privilege){
                                                                    if($privilege->role_id == 4){
                                                                        $isControllerConf = true;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if ($isControllerConf)
                                                                <input type="text" name="fonction" class="d-none" value="controlleur_conf">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Valider
                                                                </button>
                                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#controlleur_conf{{ $fiche_depense->id }}">
                                                                    Rejeter
                                                                </button>
                                                            @else
                                                                En attente de signature
                                                            @endif
                                                        @endif
                                                    @endif

                                                </form>
                                                {{-- modal --}}
                                                <div class="modal fade" id="controlleur_conf{{ $fiche_depense->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Cause</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('rejet_conf.fiche_depense', $fiche_depense->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <select type="text" name="controleur_conf_rejet[]" class="form-control select2" multiple="multiple">
                                                                        <option>Absence dossier fiscal à jour</option>
                                                                        <option>Facture non enrégistrée en comptabilité</option>
                                                                        <option>Facture non échue</option>
                                                                        <option>Doublon de besoin</option>
                                                                        <option>Libellé incorrect</option>
                                                                        <option>Dépense non validée</option>
                                                                    </select>
                                                                <input type="text" class="form-control d-none" name="num_comptable" id="num_comptable" placeholder="saisire ici!">
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer </button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </td>

                                            <!-- validation bénéficiaire -->
                                            <td>
                                                <form action="{{ route('fiche_depense.validation_fd', auth()->user()->id) }}" method="post">
                                                    @csrf
                                                    <input type="number" name="fiche_depense_id" class="d-none" value="{{ $fiche_depense->id }}">
                                                    @if($fiche_depense->statut == 'décaissé')
                                                        OK
                                                    @else
                                                        @if (auth()->user()->id == $fiche_depense->beneficiaires->id)
                                                            <input type="text" name="fonction" class="d-none" value="beneficiaire">
                                                            <button type="submit" class="btn btn-primary" @if($fiche_depense->statut  == 'en attente' || $fiche_depense->statut  == 'en cours_conf' || $fiche_depense->statut  == 'en cours' )  disabled @endif>
                                                                Signez en cliquant ici
                                                            </button>
                                                        @else
                                                            En attente de signature
                                                        @endif
                                                    @endif
                                                </form>
                                            </td>
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
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //désactiver le bouton du formulaire
        $('#fd_form').on('submit', function () {
            $('#register').attr('disabled', 'true');
        });
    })
  </script>

  @livewireScripts()
@endsection
