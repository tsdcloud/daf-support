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
            <h1 class="m-0">Fiche retour caisse</h1>
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
                <form method="POST" action={{ route('fiche_retour_caisse') }}>
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            {{-- numéro contribuable --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="retourneur">Rerourneur :</label>
                                        <select name="retourneur" id="retourneur" class="form-control @error('retourneur')
                                          is-invalid
                                        @enderror select2" style="width: 100%;" required>
                                            <option selected="selected">Saisir son nom - Email</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"  @selected(old('retourneur') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('retourneur')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                    <div class="form-group col-md-6" id="numero_contribuable">
                                        <label for="numero_contribuable">Numéro contribuable :</label>
                                        <input type="number" class="form-control @error('numero_contribuable')
                                        is-invalid
                                      @enderror" name="numero_contribuable" value="{{ @old('numero_contribuable') }}" placeholder="saisir ici!">
                                      @error('numero_contribuable')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <livewire:input-frc-mountain />
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-4" id="reference_fd_original">
                                        <label for="reference_fd_original">reference fiche de dépense originelle :</label>
                                        <input type="text" class="form-control @error('reference_fd_original')
                                        is-invalid
                                      @enderror" name="reference_fd_original" value="{{ @old('reference_fd_original') }}" placeholder="référence fiche de dépense originelle">
                                      @error('reference_fd_original')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>

                                    <div class="form-group col-md-4" id="date_fd_original">
                                        <label for="date_fd_original">Date fiche de dépense originelle :</label>
                                        <input type="date" name="date_fd_original" value="{{ @old('date_fd_original') }}" placeholder="Date fiche de dépense originelle" class="form-control @error('date_fd_original')
                                        is-invalid
                                      @enderror">
                                      @error('date_fd_original')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                    <div class="form-group col-md-4" id="num_dossier">
                                        <label for="num_dossier">Numéro de dossier :</label>
                                        <input type="text" name="num_dossier" value="{{ @old('num_dossier') }}" placeholder="numéro de dossier" class="form-control @error('num_dossier')
                                        is-invalid
                                      @enderror">
                                      @error('num_dossier')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <fieldset class="col-md-12 border px-3 mx-2" id="dynamicAddRemove">
                                <legend class="w-auto px-2 h6 text-primary text-sm-center text-md-left text-bold" style="font-size: 1.025em">Libellé du retour en caisse</legend>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="libelle">Libellé</label>
                                        <input type="text" name="addMoreInput[0][libelle]" value="{{ @old('addMoreInput[0][libelle]') }}" placeholder="Entrer le libellé" class="form-control @error('addMoreInput.*.libelle')
                                        is-invalid
                                    @enderror" required/>
                                        @error('addMoreInput.*.libelle')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dossier">Dossier d'affectation</label>
                                        <input type="text" name="addMoreInput[0][dossier]" placeholder="Entrer un dossier" class="form-control @error('addMoreInput.*.dossier')
                                        is-invalid
                                    @enderror" required/>
                                        @error('addMoreInput.*.dossier')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="montant">montant</label>
                                        <input type="number" name="addMoreInput[0][montant]" placeholder="Entrer le montant" class="form-control @error('addMoreInput.*.montant')
                                        is-invalid
                                    @enderror" required/>
                                        @error('addMoreInput.*.montant')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group mt-3 mt-md-0"><label for="montan" class="text-white d-none d-sm-none d-md-block">  montant</label>
                                        <button type="button" name="add" class="btn btn-primary w-100 dynamic-ar"> <i class="fa fa-plus-circle"></i> Ajout de libellé</button>
                                    </div>
                                </div>
                            </fieldset>
                            {{-- <form action="#" method="POST">
                                @csrf
                                @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                                @endif


                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <th>Libellé</th>
                                        <th>Dossier d'affectation</th>
                                        <th>montant</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="addMoreInput[0][name]" placeholder="Enter subject" class="form-control" />
                                        </td>
                                        <td>
                                            <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Name</button>
                                        </td>
                                    </tr>
                                </table> --}}
                            {{--  --}}


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


    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/boo..."></script>
    <script type="text/javascript">
        var i = 0;
        $(".dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<div class="row row_line border-top py-2"><div class="col-md-3 mb-2"><label for="libelle">Nouveau libellé</label><input type="text" name="addMoreInput[' + i +
                '][libelle]" placeholder="Nouveau libellé" class="form-control" required/></div><div class="col-md-3 mb-2"><label for="dossier">Nouveau dossier</label><input type="text" name="addMoreInput[' + i +
                '][dossier]" placeholder="Nouveau dossier" class="form-control" required/></div><div class="col-md-3 mb-2"><label for="montant">Nouveau montant</label><input type="number" name="addMoreInput[' + i +
                '][montant]" placeholder="Entrer le montant" class="form-control" required/></div><div class="col-md-3 mb-2"><label for="montan" class="text-white d-none d-sm-none d-md-block">  montant</label><button type="button" class="btn btn-danger w-100 remove-input-field"><i class="fa fa-trash"></i> Rétirer</button></div></div>'
                );
            // $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInput[' + i +
            //     '][name]" placeholder="Enter name" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            //     );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('.row_line').remove();
        });
    </script>
@livewireScripts
@stack('scripts')

</body>
</html>
