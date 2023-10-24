<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BFC_DAF_Support</title>

  <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">

<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">

<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0')}}">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

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
            <h1 class="m-0">Historique des dépenses rejettés</h1>
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
                  <h3 class="card-title">Enregistrement</h3>
                  <h3 class="card-title"> </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Demandeur</th>
                      {{-- <th>Grade</th> --}}
                      <th>Bénéficiaire</th>
                      <th>Date création</th>
                      <th>Montant</th>
                      <th>Description</th>
                      <th>N° contribuable</th>
                      <th>Mode paiement</th>
                      <th>Statut</th>
                      <th>N° Comptable</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($fiche_depenses as $fiche_depense)
                        <tr>
                            <td>{{ $fiche_depense->user->email }}</td>
                            <td>{{ $fiche_depense->beneficiaires->email }}</td>
                            <td>{{ $fiche_depense->date_etablissement }}</td>
                            <td>{{ number_format($fiche_depense->montant),0,',','.'}}</td>
                            <td>{{ $fiche_depense->description}}</td>
                            <td>{{ $fiche_depense->numero_contribuable}}</td>
                            <td>{{ $fiche_depense->mode_paiment }}</td>
                            <td>{{ $fiche_depense->statut }}</td>
                            <td>
                                <span class=" ">
                                    {{ $fiche_depense->num_comptable}}
                                </span>
                            </td>
                            <td>
                                <a  href="{{ route('visual_fd', $fiche_depense->id) }}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                    Voir
                                </a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Demandeur</th>
                      {{-- <th>Grade</th> --}}
                      <th>Bénéficiaire</th>
                      <th>Date création</th>
                      <th>Montant</th>
                      <th>Description</th>
                      <th>N° contribuable</th>
                      <th>Mode paiement</th>
                      <th>Statut</th>
                      <th>N° Comptable</th>
                      <th>Action</th>
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0')}}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>

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
</body>
</html>
