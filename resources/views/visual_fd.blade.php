<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BFC_DAF_Support</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">


    {{--  --}}
    {{--  --}}

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="Logo-BFC.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('navbar')
        <!-- /.navbar -->
        @include('sidebar')


        <!-- Content Wrapper. Contains page content horizontal -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Fiche dépense numéro {{ $fiche_depense->id }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="{{ url('/dashboard') }}{{ url('/dashboard') }}"><a href="#">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">/Historique</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="invoice p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button class="btn btn-primary">
                                            <b>Fiche dépense N° {{ $fiche_depense->id }}</b><br>
                                        </button>
                                    </div>

                                    <div class="col-md-4">
                                        <button class="btn btn-primary">
                                            <b>N° de dossier: {{ $fiche_depense->num_dossier }}</b><br>
                                        </button>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="text-right">
                                            {{-- @dump(auth()->user()->isComptable()) --}}
                                            @if ($fiche_depense->num_comptable)
                                                <button type="button" class="btn btn-success">

                                                    <span class="text-bold"> Référence comptable :</span>
                                                    <span>{{ $fiche_depense->num_comptable }}</span>
                                                </button>
                                            @else
                                                @if (auth()->user()->isComptable() && $fiche_depense->statut == 'décaissé')
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modal-default{{ $fiche_depense->id }}">
                                                        Ajouter une référence comptable
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                        {{-- Modal pour comptable --}}
                                        <div class="modal fade" id="modal-default{{ $fiche_depense->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content text-center">
                                                    <div class="modal-header ">
                                                        <h4 class="modal-title">Imputation comptable</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    @csrf
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('add.num_comptable', $fiche_depense->id) }}"
                                                            method="POST">
                                                            <div class="form-body">
                                                                {{-- début élément comptable --}}

                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="num_comptable_general">N° Compte
                                                                                général :<span
                                                                                    class="text-danger"><sub>*</sub></span></label>
                                                                            <input type="text"
                                                                                name="num_comptable_general"
                                                                                id="num_comptable_general"
                                                                                value="{{ @old('num_comptable_general') }}"
                                                                                class="form-control  @error('num_comptable_general') is-invalid @enderror"
                                                                                placeholder="8 chiffre complet par 0"
                                                                                required>
                                                                            @error('num_comptable_general')
                                                                                <span class="invalid-feedback"
                                                                                    role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="code_tiers">Code tiers :<span
                                                                                    class="text-danger"><sub>*</sub></span></label>
                                                                            <input type="text" name="code_tiers"
                                                                                id="code_tiers"
                                                                                value="{{ @old('code_tiers') }}"
                                                                                class="form-control  @error('code_tiers') is-invalid @enderror"
                                                                                placeholder="4 chiffres et 10 lettres max"
                                                                                required>
                                                                            @error('code_tiers')
                                                                                <span class="invalid-feedback"
                                                                                    role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="section_analytique">Section
                                                                            analytique :<span
                                                                                class="text-danger"><sub>*</sub></span></label>
                                                                        <input type="text" name="section_analytique"
                                                                            id="section_analytique"
                                                                            value="{{ @old('section_analytique') }}"
                                                                            class="form-control  @error('section_analytique') is-invalid @enderror"
                                                                            placeholder="12 Digits max" required>
                                                                        @error('section_analytique')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>


                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label for="num_chèque_virement">N°
                                                                            Chèque/Virement :<span
                                                                                class="text-danger"><sub>*</sub></span></label>
                                                                        <input type="text"
                                                                            name="num_chèque_virement"
                                                                            id="num_chèque_virement"
                                                                            value="{{ @old('num_chèque_virement') }}"
                                                                            class="form-control  @error('num_chèque_virement') is-invalid @enderror"
                                                                            placeholder="12 Digits max" required>
                                                                        @error('num_chèque_virement')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ref_comptable">Référence compte
                                                                            :</label>
                                                                        <select name="ref_comptable"
                                                                            id="ref_comptable"
                                                                            onChange="change(this.value);"
                                                                            class="@error('ref_comptable')
                                                                is-invalid
                                                                @enderror form-control select2"
                                                                            style="width: 100%;" required>
                                                                            <option value="Référence comptable 1"
                                                                                selected="selected">Référence comptable
                                                                                1</option>
                                                                            <option value="Référence comptable 2">
                                                                                Référence comptable 2</option>
                                                                            <option value="Référence comptable 3">
                                                                                Référence comptable 3</option>
                                                                            <option value="Référence comptable 4">
                                                                                Référence comptable 4</option>
                                                                            <option value="Référence comptable 5">
                                                                                Référence comptable 5</option>
                                                                        </select>
                                                                        @error('ref_comptable')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label for="fname">Montant dette :<span
                                                                                class="text-danger"><sub>*</sub></span></label>
                                                                        <input type="text" name="fname"
                                                                            id="fname"
                                                                            value="{{ @old('fname') }}"
                                                                            class="form-control  @error('fname') is-invalid @enderror"
                                                                            placeholder="saisir montant dette"
                                                                            required>
                                                                        @error('fname')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fname">Retenue à la source
                                                                            :<span
                                                                                class="text-danger"><sub>*</sub></span></label>
                                                                        <input type="text" name="fname"
                                                                            id="fname"
                                                                            value="{{ @old('fname') }}"
                                                                            class="form-control  @error('fname') is-invalid @enderror"
                                                                            placeholder="saisir Retenue à la source"
                                                                            required>
                                                                        @error('fname')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fname">N° Attestation :<span
                                                                                class="text-danger"><sub>*</sub></span></label>
                                                                        <input type="text" name="fname"
                                                                            id="fname"
                                                                            value="{{ @old('fname') }}"
                                                                            class="form-control  @error('fname') is-invalid @enderror"
                                                                            placeholder=" visible Si retenue à la source remplie"
                                                                            required>
                                                                        @error('fname')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fname">Montant à payer :<span
                                                                                class="text-danger"><sub>*</sub></span></label>
                                                                        <input type="text" name="fname"
                                                                            id="fname"
                                                                            value="{{ @old('fname') }}"
                                                                            class="form-control  @error('fname') is-invalid @enderror"
                                                                            placeholder="dette - retenue à la source"
                                                                            required>
                                                                        @error('fname')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fname">N° de Facture :<span
                                                                                class="text-danger"><sub>*</sub></span></label>
                                                                        <input type="text" name="fname"
                                                                            id="fname"
                                                                            value="{{ @old('fname') }}"
                                                                            class="form-control  @error('fname') is-invalid @enderror"
                                                                            placeholder="12 Digits max" required>
                                                                        @error('fname')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                {{-- fin élément comptable --}}

                                                                <div class="modal-body">
                                                                    <input type="text" class="form-control"
                                                                        name="num_comptable" id="num_comptable"
                                                                        placeholder="saisir ici!" required>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Fermer</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Enregistrer</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row invoice-info mt-3">
                                    <div class="col-sm-4 invoice-col">

                                        <strong>Demandeur</strong>
                                        <hr>
                                        {{-- @dump(session('fonction_id')) --}}
                                        <address>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Nom </strong>
                                                </div>
                                                <div class="col-md-9">
                                                    <strong>:</strong> {{ $fiche_depense->user->fname }}
                                                    {{ $fiche_depense->user->lname }}<br>
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

                                            {{-- <div class="row">
                                            <div class="col-md-3">
                                                <strong>Grade </strong>
                                            </div>
                                            <div class="col-md-9">
                                                <strong>:</strong>   <br>
                                            </div>
                                        </div> --}}

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Téléphone </strong>
                                                </div>
                                                <div class="col-md-9">
                                                    <strong>:</strong> {{ $fiche_depense->user->phone }}<br>
                                                </div>
                                            </div>
                                            {{-- <strong>Grade : </strong><br>
                                        <strong>Téléphone: </strong>{{ $fiche_depense->user->phone }}<br>
                                        <strong>Email: </strong>{{ $fiche_depense->user->email }} --}}
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        <strong>Bénéficiaire</strong>
                                        <hr>
                                        <address>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Nom </strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>:</strong> {{ $fiche_depense->beneficiaires->fname }}
                                                    {{ $fiche_depense->beneficiaires->lname }}<br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Matricule </strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>:</strong> {{ $fiche_depense->numero_contribuable }}<br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Numéro contribuable </strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>:</strong> {{ $fiche_depense->numero_contribuable }}<br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Mode de paiement </strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>:</strong> {{ $fiche_depense->mode_paiment }}<br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Destinataire </strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>:</strong> {{ $fiche_depense->destinataire }}<br>
                                                </div>
                                            </div>
                                            {{-- <strong>Email :</strong> {{ $fiche_depense->beneficiaires->email }}<br>
                                        <strong>Numéro contribuable:</strong> {{ $fiche_depense->numero_contribuable }}<br>
                                        <strong>Mode de paiement :</strong> {{ $fiche_depense->mode_paiment }}<br>
                                        <strong>Destinataire :</strong> {{ $fiche_depense->destinataire }}<br> --}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">

                                        <div class="row mt-5">
                                            <hr>
                                            <hr>
                                            <div class="col-md-5">
                                                <strong>Ordonnée par </strong>
                                            </div>
                                            <div class="col-md-7">
                                                <strong>:</strong> {{ $fiche_depense->ordonateurs->fname }}<br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <strong>Contrôlée par </strong>
                                            </div>
                                            <div class="col-md-7">
                                                <strong>:</strong>{{ $fiche_depense->controlleurs->fname }} <br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <strong>Montant </strong>
                                            </div>
                                            <div class="col-md-7">
                                                <strong>:</strong>{{ number_format($fiche_depense->montant, 0, ',', '.') }}
                                                Fcfa <br>
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
                                        {{-- <b>Ordonné par:</b> {{$fiche_depense->ordonateurs->fname}} <br>
                                    <b>Contrôlé par: </b> {{$fiche_depense->controlleurs->fname}} <br>
                                    <b>Montant:</b> {{ $fiche_depense->montant }} F <br>
                                    <b>Date de demande:</b> {{ $fiche_depense->created_at }} --}}
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-secondary p-1 rounded">
                                            <strong>Description :</strong> {{ $fiche_depense->description }}
                                        </button>
                                    </div>
                                </div>
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
                                                        <form
                                                            action="{{ route('fiche_depense.validation_fd', auth()->user()->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="number" name="fiche_depense_id"
                                                                class="d-none" value="{{ $fiche_depense->id }}">
                                                            @if ($fiche_depense->statut == 'décaissé' || $fiche_depense->statut == 'validée')
                                                                OK
                                                            @else
                                                                @if ($fiche_depense->ordonateur_rejet)
                                                                    <span class="badge badge-danger">Rejété</span><br>
                                                                    <strong>Motif:</strong>
                                                                    {{ $fiche_depense->ordonateur_rejet }}
                                                                    <ul>
                                                                        @foreach (explode(',', $fiche_depense->ordonateur_rejet) as $ordonateur_rejet)
                                                                            <li>{{ $ordonateur_rejet }}</li>
                                                                        @endforeach

                                                                    </ul>
                                                                @else
                                                                    @if (auth()->user()->id == $fiche_depense->ordonateur)
                                                                        <input type="text" name="fonction"
                                                                            class="d-none" value="ordonateur">
                                                                        <button type="submit" class="btn btn-primary"
                                                                            @if ($fiche_depense->statut == 'en attente' || $fiche_depense->statut == 'en cours_conf') disabled @endif>
                                                                            Valider
                                                                        </button>
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#ordonateur{{ $fiche_depense->id }}"
                                                                            class="btn btn-warning"
                                                                            @if ($fiche_depense->statut == 'en attente' || $fiche_depense->statut == 'en cours_conf') disabled @endif>
                                                                            Rejeter
                                                                        </button>
                                                                    @else
                                                                        En attente de signature
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </form>
                                                        {{-- modal --}}
                                                        <div class="modal fade"
                                                            id="ordonateur{{ $fiche_depense->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Cause</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <form
                                                                        action="{{ route('rejet_ordonateur.fiche_depense', $fiche_depense->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <select type="text"
                                                                                class="form-control select2"
                                                                                multiple="multiple"
                                                                                name="ordonateur_rejet[]">
                                                                                <option>Facture pas conforme</option>
                                                                                <option>Pas de facture</option>
                                                                                <option>Numéro de contribuable absent
                                                                                </option>
                                                                                <option>Numéro de contribuable incorrect
                                                                                </option>
                                                                                <option>Numéro de contribuable
                                                                                    inexistant</option>
                                                                                <option>Numéro de dossier incorrect
                                                                                </option>
                                                                                <option>Doublon de besoin</option>
                                                                            </select>
                                                                            <input type="text"
                                                                                class="form-control d-none"
                                                                                name="num_comptable"
                                                                                id="num_comptable"
                                                                                placeholder="saisire ici!">
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-between">
                                                                            <button type="button"
                                                                                class="btn btn-default"
                                                                                data-dismiss="modal">Fermer</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Enregistrer</button>
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
                                                        <form
                                                            action="{{ route('fiche_depense.validation_fd', auth()->user()->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="number" name="fiche_depense_id"
                                                                class="d-none" value="{{ $fiche_depense->id }}">
                                                            @if ($fiche_depense->statut == 'en cours' ||
                                                                $fiche_depense->statut == 'validée' ||
                                                                $fiche_depense->statut == 'décaissé')
                                                                OK
                                                            @else
                                                                @if ($fiche_depense->controleur_rejet)
                                                                    <span class="badge badge-danger">Rejété</span><br>
                                                                    <strong>Motif:</strong>
                                                                    {{-- {{ $fiche_depense->controleur_rejet }}- --}}
                                                                    <ul>
                                                                        @foreach (explode(',', $fiche_depense->controleur_rejet) as $controleur_rejet)
                                                                            <li>{{ $controleur_rejet }}</li>
                                                                        @endforeach

                                                                    </ul>
                                                                @else
                                                                    @if (auth()->user()->id == $fiche_depense->controlleur)
                                                                        <input type="text" name="fonction"
                                                                            class="d-none" value="controlleur">
                                                                        <button type="submit" class="btn btn-primary"
                                                                            @if ($fiche_depense->statut == 'en attente') disabled @endif>
                                                                            Valider
                                                                        </button>
                                                                        <button type="button" class="btn btn-warning"
                                                                            @if ($fiche_depense->statut == 'en attente') disabled @endif
                                                                            data-toggle="modal"
                                                                            data-target="#controlleur{{ $fiche_depense->id }}">
                                                                            Rejeter
                                                                        </button>
                                                                    @else
                                                                        En attente de signature
                                                                    @endif
                                                                @endif
                                                            @endif

                                                        </form>
                                                        {{-- modal --}}
                                                        <div class="modal fade"
                                                            id="controlleur{{ $fiche_depense->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Cause</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <form
                                                                        action="{{ route('rejet_budj.fiche_depense', $fiche_depense->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <select type="text"
                                                                                class="form-control select2"
                                                                                multiple="multiple"
                                                                                name="controleur_rejet[]">
                                                                                <option>Facture pas conforme</option>
                                                                                <option>Pas de facture</option>
                                                                                <option>Numéro de contribuable absent
                                                                                </option>
                                                                                <option>Numéro de contribuable incorrect
                                                                                </option>
                                                                                <option>Numéro de contribuable
                                                                                    inexistant</option>
                                                                                <option>Numéro de dossier incorrect
                                                                                </option>
                                                                                <option>Doublon de besoin</option>
                                                                            </select>
                                                                            <input type="text"
                                                                                class="form-control d-none"
                                                                                name="num_comptable"
                                                                                id="num_comptable"
                                                                                placeholder="saisire ici!">
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-between">
                                                                            <button type="button"
                                                                                class="btn btn-default"
                                                                                data-dismiss="modal">Fermer</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Enregistrer</button>
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
                                                        <form
                                                            action="{{ route('fiche_depense.validation_fd', auth()->user()->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="number" name="fiche_depense_id"
                                                                class="d-none" value="{{ $fiche_depense->id }}">
                                                            @if ($fiche_depense->statut == 'en cours_conf' ||
                                                                $fiche_depense->statut == 'en cours' ||
                                                                $fiche_depense->statut == 'validée' ||
                                                                $fiche_depense->statut == 'décaissé')
                                                                OK
                                                            @else
                                                                @if ($fiche_depense->controleur_conf_rejet)
                                                                    <span class="badge badge-danger">Rejété</span><br>
                                                                    <strong>Motif:</strong>
                                                                    <ul>
                                                                        @foreach (explode(',', $fiche_depense->controleur_conf_rejet) as $controleur_conf_rejet)
                                                                            <li>{{ $controleur_conf_rejet }}</li>
                                                                        @endforeach

                                                                    </ul>
                                                                    {{-- @dump(explode(",",$fiche_depense->controleur_conf_rejet)) --}}
                                                                @else
                                                                    @php
                                                                        $isControllerConf = false;
                                                                        foreach (auth()->user()->privileges as $privilege) {
                                                                            if ($privilege->role_id == 4) {
                                                                                $isControllerConf = true;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if ($isControllerConf)
                                                                        <input type="text" name="fonction"
                                                                            class="d-none" value="controlleur_conf">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">
                                                                            Valider
                                                                        </button>
                                                                        <button type="button" class="btn btn-warning"
                                                                            data-toggle="modal"
                                                                            data-target="#controlleur_conf{{ $fiche_depense->id }}">
                                                                            Rejeter
                                                                        </button>
                                                                    @else
                                                                        En attente de signature
                                                                    @endif
                                                                @endif
                                                            @endif

                                                        </form>
                                                        {{-- modal --}}
                                                        <div class="modal fade"
                                                            id="controlleur_conf{{ $fiche_depense->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Cause</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <form
                                                                        action="{{ route('rejet_conf.fiche_depense', $fiche_depense->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <select type="text"
                                                                                name="controleur_conf_rejet[]"
                                                                                class="form-control select2"
                                                                                multiple="multiple">
                                                                                <option>Absence dossier fiscal à jour
                                                                                </option>
                                                                                <option>Facture non enrégistrée en
                                                                                    comptabilité</option>
                                                                                <option>Facture non échue</option>
                                                                                <option>Doublon de besoin</option>
                                                                            </select>
                                                                            <input type="text"
                                                                                class="form-control d-none"
                                                                                name="num_comptable"
                                                                                id="num_comptable"
                                                                                placeholder="saisire ici!">
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-between">
                                                                            <button type="button"
                                                                                class="btn btn-default"
                                                                                data-dismiss="modal">Fermer</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Enregistrer
                                                                            </button>
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
                                                        <form
                                                            action="{{ route('fiche_depense.validation_fd', auth()->user()->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="number" name="fiche_depense_id"
                                                                class="d-none" value="{{ $fiche_depense->id }}">
                                                            @if ($fiche_depense->statut == 'décaissé')
                                                                OK
                                                            @else
                                                                @if (auth()->user()->id == $fiche_depense->beneficiaires->id)
                                                                    <input type="text" name="fonction"
                                                                        class="d-none" value="beneficiaire">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        @if ($fiche_depense->statut == 'en attente' ||
                                                                            $fiche_depense->statut == 'en cours_conf' ||
                                                                            $fiche_depense->statut == 'en cours') disabled @endif>
                                                                        Signez en cliquant ici
                                                                    </button>
                                                                @else
                                                                    En attente de signature
                                                                @endif
                                                            @endif
                                                        </form>
                                                    </td>

                                                    {{-- demandeur --}}
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
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Allez sur le site officiel <a href="https://www.bfclimited.com/">BFC.com</a>.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b></b>
            </div>
        </footer>

        <!-- Control Sidebar (controleur de l'affichage) -->
        {{-- <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside> --}}
        <!-- /.control-sidebar -->
        {{-- </div> --}}
        <!-- ./wrapper -->

        {{-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}


        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        {{-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

        <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>


        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()
            });
        </script>
        {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
</body>

</html>
