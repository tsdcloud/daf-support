@extends('layouts.master')

@section('title')
Voir une FAC
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
          <h1 class="m-0">Voir une FAC</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Voir une FAC</li>
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

                    <div class="col-md-4">
                        <button class="text-left btn btn-primary w-100">
                            <div class="row">
                                <div class="col-6"><b>Fiche dépense </b></div>
                                <div class="col-6">N° {{ $fiche_approv_caisse->id }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><b>Dossier </b></div>
                                <div class="col-6">N° {{ $fiche_approv_caisse->num_dossier }}</div>
                            </div>
                        </button>
                    </div>

                    <div class="col-md-4">
                        <button class="text-left btn btn-primary w-100">
                            <div class="row">
                                <div class="col-6"><b>Pays</b></div>
                                <div class="col-6">{{ $fiche_approv_caisse->city_entity ? $fiche_approv_caisse->city_entity->city->country->label : ''}}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><b>Ville </b></div>
                                <div class="col-6">{{ $fiche_approv_caisse->city_entity ? $fiche_approv_caisse->city_entity->city->label : '' }} {{ $fiche_approv_caisse->site_id ? $fiche_approv_caisse->site->label : '' }}</div>
                            </div>
                        </button>
                    </div>


                    <div class="col-md-4">
                        <div class="text-right">
                            {{-- @dump(auth()->user()->isComptable()) --}}
                            @if($fiche_approv_caisse->num_comptable)
                                <button type="button" class="btn btn-success">

                                    <span class="text-bold"> Référence comptable :</span>
                                    <span>{{ $fiche_approv_caisse->num_comptable }}</span>
                                </button>
                            @else
                                @if (auth()->user()->isComptable() && $fiche_approv_caisse->statut == 'encaissé')
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default{{ $fiche_approv_caisse->id }}">
                                        Ajouter une référence comptable
                                    </button>
                                @endif
                            @endif
                        </div>
                        {{-- Modal pour comptable --}}
                        <div class="modal fade" id="modal-default{{ $fiche_approv_caisse->id }}">
                            <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Imputation Comptable</h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <livewire:imputation-comptable-fac :fiche_approv_caisse="$fiche_approv_caisse" :comptes="$comptes">

                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>
                {{-- donnée sur la ficfe --}}

                <div class="row invoice-info">
                    <div class="text-left col-sm-4 invoice-col">
                        <strong>Initiateur</strong>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Nom</div>
                            <div class="col-md-9 col-sm-6">{{ $fiche_approv_caisse->user->fname }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Prénom</div>
                            <div class="col-md-9 col-sm-6">{{ $fiche_approv_caisse->user->lname }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Téléphone</div>
                            <div class="col-md-9 col-sm-6">{{ $fiche_approv_caisse->user->phone }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Email</div>
                            <div class="col-md-9 col-sm-6">{{ $fiche_approv_caisse->user->email }}</div>
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <strong>Approvisionneur</strong>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Nom</div>
                            <div class="col-md-9 col-sm-6">{{ $fiche_approv_caisse->approvisionneurs->fname }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Prénom</div>
                            <div class="col-md-9 col-sm-6">{{ $fiche_approv_caisse->approvisionneurs->lname }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Téléphone</div>
                            <div class="col-md-9 col-sm-6">{{ $fiche_approv_caisse->approvisionneurs->phone }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Email</div>
                            <div class="col-md-9 col-sm-6">{{ $fiche_approv_caisse->approvisionneurs->email }}</div>
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <strong>Infos sur l'approvisionnement</strong>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Montant </div>
                            <div class="col-md-9 col-sm-6">: {{\App\Helpers\MoneyHelper::price($fiche_approv_caisse->montant)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Provenance</div>
                            <div class="col-md-9 col-sm-6"> :{{ $fiche_approv_caisse->provenance }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Mode </div>
                            <div class="col-md-9 col-sm-6"> :{{ $fiche_approv_caisse->mode_approv }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-bold">Date </div>
                            <div class="col-md-9 col-sm-6">:{{ $fiche_approv_caisse->created_at }}</div>
                        </div>
                    </div>
                </div>
                {{--  libellé de la fac --}}
                <div class="col-12">
                    <button type="button" class="p-1 rounded btn btn-secondary">
                        <strong>Description :</strong> {{ $fiche_approv_caisse->libelle }}
                    </button>
                </div>

                {{-- Pièces jointe --}}
                <div class="col-12">
                    <strong>Pièces jointes :</strong> <br>
                    <div class="row">
                        @forelse ($fiche_approv_caisse->attachments as $attachment)
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
                {{-- Fin pièces jointe --}}

                {{-- afficher les infos comptable --}}
                @if($fiche_approv_caisse->num_comptable && auth()->user()->isAdmin() || $fiche_approv_caisse->num_comptable && auth()->user()->isComptable())
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>N° facture </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->num_facture }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Montant dette </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->montant_dette }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Retenue à la source </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->retenu_source }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Numéro d'attestation </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->num_attestation }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Montant approvisionnement </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->montant_a_payer }}<br>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>N°compte général </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->num_compte_general }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Code tiers </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->code_tiers }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Section analytique </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->section_analytique }}
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <strong>N° chèque\virement </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->num_cheque_virement }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Référence compte </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->compte->banque }} {{ $fiche_approv_caisse->compte->intitule }} {{ $fiche_approv_caisse->compte->entity->sigle }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row ">
                                <div class="col-md-6">
                                    <strong>Nom du comptable </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->comptables ? $fiche_approv_caisse->comptables->fname : '' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Prénom du comptable </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->comptables ? $fiche_approv_caisse->comptables->lname : '' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Email </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->comptables ? $fiche_approv_caisse->comptables->email : '' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Téléphone </strong>
                                </div>
                                <div class="col-md-6">
                                    <b>:</b> {{ $fiche_approv_caisse->comptables ? $fiche_approv_caisse->comptables->phone : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- fin afficher les infos comptable --}}
                <!-- processus de validation  -->
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Caisse</th>
                                <th>Approvisionneur</th>
                                <th>Initiation</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                                <!-- validation Caisse -->
                                <td>
                                    {{-- <form action="{{ route('cash_register_supply_sheet.validation_fac', auth()->user()->id) }}" method="post">
                                        @csrf
                                        <input type="number" name="fiche_approv_caisse_id" class="d-none" value="{{ $fiche_approv_caisse->id }}">
                                        @if($fiche_approv_caisse->statut == 'encaissé')
                                            OK
                                        @else
                                            @php
                                                $isCaissier = false;
                                                foreach (auth()->user()->privileges as $privilege){
                                                    if($privilege->role_id == 6){
                                                        $isCaissier = true;
                                                    }
                                                }
                                            @endphp

                                            @if ( $isCaissier)
                                                <input type="text" name="fonction" class="d-none" value="caisse">
                                                <button type="submit" class="btn btn-primary" @if($fiche_approv_caisse->statut  == 'en attente' )  disabled @endif>
                                                    Signez en cliquant ici
                                                </button>
                                            @else
                                                En attente de signature
                                            @endif
                                        @endif
                                    </form> --}}

                                    @if($fiche_approv_caisse->statut == 'encaissé')
                                        OK<br>
                                        <span class="badge badge-danger">Observation</span><br>
                                        <ul>
                                                <li>{{ $fiche_approv_caisse->observation_caisse }}</li>

                                        </ul>
                                    @else

                                        @if (auth()->user()->isCaissier())
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#observation_caisse{{ $fiche_approv_caisse->id }}"@if($fiche_approv_caisse->statut  == 'en attente' )  disabled @endif>
                                                Signez en cliquant ici
                                            </button>
                                        @else
                                            En attente de signature
                                        @endif
                                    @endif

                                     {{-- modal observation caisse --}}

                                    <div class="modal fade" id="observation_caisse{{ $fiche_approv_caisse->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Faites une observation</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('cash_register_supply_sheet.validation_fac', $fiche_approv_caisse->id) }}" method="POST">
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

                                <!-- validation Aprovisionneur -->
                                <td>
                                    {{-- <form action="{{ route('cash_register_supply_sheet.validation_fac', auth()->user()->id) }}" method="post">
                                        @csrf
                                        <input type="number" name="fiche_approv_caisse_id" class="d-none" value="{{ $fiche_approv_caisse->id }}">
                                        @if($fiche_approv_caisse->statut == 'validée par approvisionneur'|| $fiche_approv_caisse->statut  == 'encaissé' )
                                            OK
                                        @else
                                            @if (auth()->user()->id == $fiche_approv_caisse->approvisionneur)
                                                <input type="text" name="fonction" class="d-none" value="approvisionneur">
                                                <button type="submit" class="btn btn-primary" >
                                                    Signez en cliquant ici
                                                </button>
                                            @else
                                                En attente de signature
                                            @endif
                                        @endif
                                    </form> --}}

                                    @if($fiche_approv_caisse->statut == 'encaissé'|| $fiche_approv_caisse->statut == 'validée par approvisionneur')
                                        OK<br>
                                        <span class="badge badge-danger">Observation</span><br>
                                        <ul>
                                                <li>{{ $fiche_approv_caisse->observation_approvisionneur }}</li>

                                        </ul>
                                    @else

                                        @if (auth()->user()->id==$fiche_approv_caisse->approvisionneur)
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#observation_approvisionneur{{ $fiche_approv_caisse->id }}">
                                                Signez en cliquant ici
                                            </button>
                                        @else
                                            En attente de signature
                                        @endif
                                    @endif

                                     {{-- modal observation retourneur --}}

                                    <div class="modal fade" id="observation_approvisionneur{{ $fiche_approv_caisse->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Faites une observation</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('cash_register_supply_sheet.validation_fac', $fiche_approv_caisse->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="fonction" class="d-none" value="approvisionneur">
                                                        <input type="text" class="form-control" name="observation_approvisionneur" id="observation_approvisionneur" placeholder="saisire ici!" >
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

                                <!-- validation Initiateur -->
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
