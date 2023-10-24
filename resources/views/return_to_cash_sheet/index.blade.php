@extends('layouts.master')

@section('title')
Liste des FRC
@endsection

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
@endsection

@section('header-section')
<div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0">Liste des FRC</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Liste des FRC</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('body-section')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="card col-12">
            <div class="card-header">
              <h3 class="card-title">Liste des fiches de retour en caisse</h3>

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
                    <th>Ref. FD originelle</th>
                    <th>Date FD originelle</th>
                    <th>N° contribuable</th>
                    <th>Statut</th>
                    {{-- <th>Montant XAF</th>
                    <th>Reliquat</th> --}}
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        @foreach ($fiche_retour_caisses as $fiche_retour_caisse)
                        <tr>
                            <td>{{ $fiche_retour_caisse->id }}</td>
                            <td>{{ $fiche_retour_caisse->user->email }}</td>
                            <td>{{ $fiche_retour_caisse->retourneurs->email }}</td>
                            <td>{{ $fiche_retour_caisse->created_at }}</td>
                            <td>{{ $fiche_retour_caisse->fiche_depense->num_comptable}}</td>
                            <td>{{ $fiche_retour_caisse->fiche_depense->created_at}}</td>
                            <td>{{ $fiche_retour_caisse->numero_contribuable }}</td>
                            <td>{{ $fiche_retour_caisse->statut }}</td>
                            {{-- <td>{{ $fiche_retour_caisse->montant}}</td>
                            <td>{{ $fiche_retour_caisse->reliquat}}</td> --}}
                            <td>
                                <a  href="{{ route('return_to_cash_sheet.show', $fiche_retour_caisse->id) }}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                    Voir
                                </a>
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Réceveur/se</th>
                        <th>Retourneur</th>
                        <th>Date création</th>
                        <th>Ref. FD originelle</th>
                        <th>Date FD originelle</th>
                        <th>N° contribuable</th>
                        <th>Statut</th>
                        {{-- <th>Montant XAF</th>
                        <th>Reliquat</th> --}}
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
@endsection
