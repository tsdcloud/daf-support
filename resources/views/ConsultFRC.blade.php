<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BFC_DAF_Support</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

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

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="Logo-BFC.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  @include('sweet::alert')
   <!-- Navbar -->
   @include('navbar')
   <!-- /.navbar -->
   @include('sidebar')


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
            <h1 class="m-0">Listing des fiches de retours en caisse</h1>
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
                  <h4 class="card-title">NB: FD renvois à fiche de dépense </h4>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>N°</th>
                        <th>Réceveur/se</th>
                        <th>Retourneur</th>
                        <th>Date création</th>
                        <th>Montant</th>
                        <th>Reliquat</th>
                        <th>N° contribuable</th>
                        <th>Ref. FD originelle</th>
                        <th>Date FD originelle</th>
                        <th>Statut</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        @forelse ($fiche_retour_caisse as $fiche_retour_caisse)
                          <tr>
                              <td>{{ $fiche_retour_caisse->id }}</td>
                              <td>{{ $fiche_retour_caisse->user->email }}</td>
                              <td>{{ $fiche_retour_caisse->retourneurs->email }}</td>
                              <td>{{ $fiche_retour_caisse->date_etablissement }}</td>
                              <td>{{ $fiche_retour_caisse->montant}}</td>
                              <td>{{ $fiche_retour_caisse->reliquat}}</td>
                              <td>{{ $fiche_retour_caisse->numero_contribuable}}</td>
                              <td>{{ $fiche_retour_caisse->reference_fd_original }}</td>
                              <td>{{ $fiche_retour_caisse->date_fd_original }}</td>
                              <td>{{ $fiche_retour_caisse->statut }}</td>
                              <td>
                                  <a  href="{{ route('visual_frc', $fiche_retour_caisse->id) }}" class="btn btn-primary">
                                      <i class="fa fa-eye"></i>
                                      Voir
                                  </a>
                              </td>
                              {{-- <td>
                                  <span class=" ">
                                      {{ $fiche_depense->num_comptable}}
                                  </span>
                              </td> --}}
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
                            <th>Réceveur/se</th>
                            <th>Retourneur</th>
                            <th>Date création</th>
                            <th>Montant</th>
                            <th>Reliquat</th>
                            <th>N° contribuable</th>
                            <th>Ref. FD originelle</th>
                            <th>Date FD originelle</th>
                            <th>Statut</th>
                            <th>Action</th>
                          </tr>
                      </tfoot>
                    </table>
                  </div>
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
  });
</script>



 <script>
    @if(Session::has('message'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
      toastr.success("{{ session('message') }}");
    @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>
</body>
</html>
