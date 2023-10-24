
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BFC_DAF_Support</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
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

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mx-1">
                    <div class="col-sm-6">
                        <h5>Fiche d' approvisionnement caisse numéro {{ $fiche_approv_caisse->id }}</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"> Historique</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row mx-1">
                    <div class="invoice p-3 mb-3 col-12">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    {{-- <i class="fas fa-globe"></i> AdminLTE, Inc. --}}
                                    <small class="float-right"><b>Date de création:</b> {{ $fiche_approv_caisse->created_at }}</small>
                                </h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-primary">
                                    <b>Fiche d'approvisionnement caisse N° {{ $fiche_approv_caisse->id }}</b><br>
                                </button>
                            </div>

                            <div class="col-md-4">
                                <button class="btn btn-primary">
                                    <b>N° de dossier: {{ $fiche_approv_caisse->num_dossier }}</b><br>
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
                                        @if (auth()->user()->isComptable() && $fiche_approv_caisse->statut == 'validée')
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default{{ $fiche_depense->id }}">
                                                Ajouter une référence comptable
                                            </button>
                                        @endif
                                    @endif
                                </div>
                                {{-- Modal pour comptable --}}
                                <div class="modal fade" id="modal-default{{ $fiche_approv_caisse->id }}">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Entrez une référence comptable</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>

                                        <form action="{{ route('add.num_comptable', $fiche_approv_caisse->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                            <input type="text" class="form-control" name="num_comptable" id="num_comptable" placeholder="saisire ici!" required>
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
                            </div>
                        </div>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <strong>Editeur</strong><br>
                                <div class="row invoice-info">
                                    <div class="col-sm-3 invoice-col">
                                        <address>
                                            <b>Nom</b><br>
                                            <b>Prénom</b><br>
                                            <b>Téléphone</b><br>
                                            <b> Em</b>ail
                                        </address>
                                    </div>
                                    <div class="col-sm-8 offset-sm-1 invoice-col">
                                        <address>
                                        :{{ $fiche_approv_caisse->user->lname }}<br>
                                        :{{ $fiche_approv_caisse->user->fname }} <br>
                                        :{{ $fiche_approv_caisse->user->phone }}<br>
                                        :{{ $fiche_approv_caisse->user->email }}<br>
                                        </address>
                                    </div>
                                </div>
                            </div>


                                <div class="col-sm-4 invoice-col">
                                    <strong class="float-none">Approvisionneur</strong><br>
                                    <div class="row invoice-info">
                                        <div class="col-sm-3 invoice-col">
                                            <address>
                                            <b> Nom</b><br>
                                            <b> Prénom</b><br>
                                            <b> Téléphone</b><br>
                                            <b> Email</b>
                                            </address>
                                        </div>
                                        <div class="col-sm-8 offset-sm-1 invoice-col">
                                            <address>
                                            :{{ $fiche_approv_caisse->approvisionneur }}<br>
                                            :val_prénom <br>
                                            :val_tel<br>
                                            :val_email<br>
                                            </address>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-4 invoice-col">
                                    <br>
                                    <div class="row invoice-info">
                                        <div class="col-sm-3 invoice-col">

                                            <b>Fonction</b><br>
                                            <b>Matricule<br></b>
                                            <b>_____</b><br>
                                            <b>_____</b>
                                        </div>
                                        <div class="col-sm-8 offset-sm-1 invoice-col">
                                            :{{ $fiche_approv_caisse->fonction }}<br>
                                            :{{ $fiche_approv_caisse->Matricule }}</b>
                                            :4F3S8J<br>
                                            :2/22/2014
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="button" class="btn btn-secondary p-1 rounded">
                                    <strong>Libellé :</strong> {{ $fiche_approv_caisse->libelle }}
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Montant en F.cfa</th>
                                                <th>Provenance</th>
                                                <th>Mode d'approvisionnement</th>
                                                {{-- <th>Description</th>
                                                <th>Subtotal</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $fiche_approv_caisse->montant }}</td>
                                                <td>{{ $fiche_approv_caisse->provenance }}</td>
                                                <td>{{ $fiche_approv_caisse->mode_approv }}</td>
                                                {{-- <td>El snort testosterone trophy driving gloves handsome</td>
                                                <td>$64.50</td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- <div class="row">

                                <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                                </div>

                                <div class="col-6">
                                    <p class="lead">Amount Due 2/22/2014</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>$250.30</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                    Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
  </body>
  </html>


