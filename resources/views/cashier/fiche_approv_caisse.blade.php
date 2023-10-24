<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BFC_DAF_Support</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css')}}">


  {{--  --}}
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css')}}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0')}}">

  @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

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
            <h1 class="m-0">Fiche approvisionnement caisse</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="{{ url('/dashboard')}}{{ url('/dashboard')}}"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Historique</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(Session::has('error'))
        {{ Session::get('error') }}

        @foreach ($errors->any as $error)
            {{ $error }}
        @endforeach
        {{-- okoiiiiiiiiiiiiiiiiiiiiiiiiii --}}
        @endif
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Paramètres spécifiques</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action={{ route('fiche_approv_caisse') }}>
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- approvisionneur -->
                            <div class="form-group col-md-6">
                                <label for="approvisionneur">approvisionneur <sup><span class="text-danger">*</span></sup>:</label>
                                <select name="approvisionneur" id="approvisionneur" class="form-control @error('approvisionneur')
                                  is-invalid
                                @enderror select2" style="width: 100%;" required>
                                    <option selected="selected">Saisir son nom - Email</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                    @endforeach
                                </select>
                                @error('retourneur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group col-md-6" id="Matricule">
                                <label for="Matricule">Matricule :</label>
                                <input type="text" class="form-control @error('Matricule')
                                is-invalid
                              @enderror" name="Matricule" value="{{ @old('Matricule') }}" placeholder="Matricule de l'approvisionneur">
                              @error('Matricule')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                            </div>
                                                 <!--Fonction -->
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fonction">Fonction<span class="text-danger"><sub>*</sub></span></label>
                                    <input type="text" id="fonction" name="fonction" value="{{ old('fonction') }}" class="form-control @error('fonction') is-invalid @enderror" placeholder="Titre de la fonction" required>
                                </div>
                                @error('fonction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            <div class="form-group col-md-6" id="fonction">
                                <label for="fonction">Fonction :</label>
                                <input type="text" class="form-control @error('Contact')
                                is-invalid
                              @enderror" name="fonction" value="{{ @old('fonction') }}" placeholder="téléphone de l'approvisionneur">
                              @error('Contact')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                            </div>
                                                 <!-- Contact -->

                            <div class="form-group col-md-6" id="Contact">
                                <label for="Contact">Contact :</label>
                                <input type="text" class="form-control @error('Contact')
                                is-invalid
                              @enderror" name="Contact" value="{{ @old('Contact') }}" placeholder="téléphone de l'approvisionneur">
                              @error('Contact')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                            </div>
                                                 <!-- Contact -->

                            <div class="form-group col-md-6" id="numero_contribuable">
                                <label for="numero_contribuable">N°Contribuable :</label>
                                <input type="text" class="form-control @error('numero_contribuable')
                                is-invalid
                              @enderror" name="numero_contribuable" value="{{ @old('numero_contribuable') }}" placeholder="Numéro contribuable de l'approvisionneur">
                              @error('numero_contribuable')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                            </div>
                                            <!-- Montant -->
                            <div class="form-group col-md-6">
                                {{-- <input type="number" class="form-control @error('montant') is-invalid @enderror" name="montant" id="montant" value="{{ @old('montant') }}" placeholder="saisire ici!" required> --}}
                                <livewire:parse-input-value />
                                @error('montant')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="provenance">provenance de l'approvisionnement :</label>
                                <select name="provenance" id="provenance"  class="@error('provenance')
                                is-invalid
                              @enderror form-control select2" required>
                                    <option value="Retrait bancaire" selected="selected">Retrait bancaire</option>
                                    <option value="Apport en compte courant">Apport en compte courant</option>
                                    <option value="Emprunt privé">Emprunt privé</option>
                                    <option value="Encaissement client">Encaissement client</option>
                                    {{-- <option value="Espèces">Espèces</option> --}}
                                </select>
                                @error('provenance')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mode_approv">Mode d'approvisionnement :</label>
                                <select name="mode_approv" id="mode_approv"  class="@error('mode_approv')
                                is-invalid
                              @enderror form-control select2" required>
                                    <option value="Dépos direct d'espèces" selected="selected">Dépot direct d'espèces</option>
                                    <option value="Retrait d'espèces sur chèque bancaire">Retrait d'espèces sur chèque bancaire</option>
                                    <option value="Retrait d'espèces sur paiment mobile">Retrait d'espèces sur paiment mobile</option>
                                    <option value="Retrait d'espèces sur carte bancaire">Retrait d'espèces sur carte bancaire</option>
                                    <option value="Retrait d'espèces sur mandat électronique">Retrait d'espèces sur mandat électronique</option>
                                </select>
                                @error('mode_approv')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                            </div>

                            <div class="form-group col-md-6" id="num_dossier">
                                <label for="num_dossier">Numéro de dossier :</label>
                                <input type="text" class="form-control @error('num_dossier')
                                is-invalid
                              @enderror" name="num_dossier" value="{{ @old('num_dossier') }}" placeholder="numéro de dossier">
                              @error('num_dossier')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                            </div>



                            {{-- Libellé --}}
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            libellé
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <textarea name="libelle" id="summernote" class="form-control @error('libelle')
                                        is-invalid
                                      @enderror" required>{{ @old('libelle') }}</textarea>

                                      @error('libelle')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                </div>
                            </div>





                        </div>
                        {{-- <div class="col-md-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    Description
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <textarea name="description" id="summernote" class="form-control @error('description')
                                    is-invalid
                                  @enderror" required>{{ @old('description') }}</textarea>

                                  @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                            </div>
                        </div> --}}
                    </div><!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </div>
                </form>
            </div><!-- /.card -->

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
        <div class="float-right d-none d-sm-inline-block">
            <strong>Allez sur le site officiel <a href="https://www.bfclimited.com/">BFC.com</a>.</strong>
        </div>
  </footer>

  <!-- Control Sidebar (controleur de l'affichage) -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

    window.addEventListener('load', (event) => {
        document.getElementById('destinataire').style.display = 'none';
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

<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>

<script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>

<script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

{{-- <script src="../../dist/js/demo.js"></script> --}}

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
@stack('scripts')

</body>
</html>
