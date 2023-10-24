<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BFC_DAF_Support</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="Logo-BFC.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/dashboard')}}" class="nav-link">Accueil</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://www.bfclimited.com/" class="nav-link">Contact</a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://www.bfclimited.com/" class="brand-link">
      <img src="Logo-BFC.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BFC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="image_user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Utilisateur courant</a>
        </div>
      </div>

      <!-- Menu de la side barre -->
      <nav class="mt-2">
        @include('sidebar')
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content horizontal -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listing des fiches d'approvisionnement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="{{ url('/dashboard')}}{{ url('/dashboard')}}"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">/Historique</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="card col-12">
                <div class="card-header">
                  <h3 class="card-title">Modèle par défaut de base de donnée</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Editée par</th>
                        <th>Approvisionneur</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Provenance</th>
                        <th>Numérode dossier</th>
                        <th>Statut</th>
                        <th>Action</th>
                        {{-- <th>Grade</th> --}}
                        {{-- <th>Numero contribuable</th>
                        <th>Mode paiement</th> --}}
                    </tr>
                    </thead>
                    <tbody>

                        @forelse ($fiche_approv_caisse as $fiche_approv_caisse)
                          <tr>
                              <td>{{ $fiche_approv_caisse->id }}</td>
                              <td>{{ $fiche_approv_caisse->user->email }}</td>
                              <td>{{ $fiche_approv_caisse->approvisionneur }}</td>
                              <td>{{ $fiche_approv_caisse->created_at }}</td>
                              <td>{{ $fiche_approv_caisse->montant}}</td>
                              <td>{{ $fiche_approv_caisse->provenance}}</td>
                              <td>{{ $fiche_approv_caisse->num_dossier}}</td>
                              <td>{{ $fiche_approv_caisse->statut }}</td>
                              {{-- <td>
                                  <span class=" ">
                                      {{ $fiche_depense->num_comptable}}
                                  </span>
                              </td> --}}
                              <td>
                                  <a  href="{{ route('visual_fac', $fiche_approv_caisse->id) }}" class="btn btn-primary">
                                      <i class="fa fa-eye"></i>
                                      Voir
                                  </a>
                              </td>
                          </tr>

                        @empty
                        <tr class="text-center">
                          <td colspan="10">
                            Aucune fiche encours
                          </td>
                        </tr>
                        @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>N°</th>
                            <th>Editée par</th>
                            <th>Nom approvisionneur</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Provenance</th>
                            <th>Numérode dossier</th>
                            <th>Statut</th>
                            <th>Action</th>
                            {{-- <th>Grade</th> --}}
                            {{-- <th>Numero contribuable</th>
                            <th>Mode paiement</th> --}}
                        </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Allez sur le site officiel <a href="https://www.bfclimited.com/">BFC.com</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
    <b></b>
    </div>
  </footer>

  <!-- Control Sidebar (controleur de l'affichage) -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="dist/js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
