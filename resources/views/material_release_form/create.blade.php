@extends('layouts.master')

@section('title')
Liste des BSM
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
          <h1 class="m-0">Liste des bons de sortie matériel </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Liste des BSM</li>
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
                <h3 class="card-title">Liste BSD à initier</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Béneficiaire</th>
                        <th>Désignation</th>
                        <th>N° DMD</th>
                        <th>Date début usage</th>
                        <th>Qte attendue</th>
                        <th>Qte sortie</th>
                        <th>Céer le bon</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($wording_availability_request_sheets as $wording_availability_request_sheet)

                        <tr>
                            <td>
                                @foreach ($users as $user )
                                    @if($user->id== $wording_availability_request_sheet->beneficiaire)
                                        {{ $user->fname }} {{ $user->lname }} - {{ $user->email }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $wording_availability_request_sheet->designation }}</td>
                            <td>{{ $wording_availability_request_sheet->availability_request_sheet_id }}</td>
                            <td>{{ $wording_availability_request_sheet->date_debut_usage }}</td>
                            <td>{{ $wording_availability_request_sheet->quantite_reliquat }}</td>
                            <form action="{{ route('material_release_form.store') }}" method="POST">
                                @csrf
                                <td>
                                    <input type="number" name="max" id="max" class="d-none" value="{{ $wording_availability_request_sheet->quantite_reliquat }}">
                                    <input type="text" name="wordinavailability_request_sheet_id" id="wordinavailability_request_sheet_id" class="d-none" value="{{ $wording_availability_request_sheet->id }}">
                                    <input type="number" min = 0 max = {{ $wording_availability_request_sheet->quantite_reliquat }}  name=" quantite" id="quantite" class="form-control" @error('quantite')
                                    is-invalid
                                    @enderror" name="quantite" value="" required>
                                    @error('quantite')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>

                                <td>
                                    <button type="submit" onclick="return confirm('Voulez vous faire un bon de sorti de pour la resource  ? si oui cliquez sur ok')"
                                        class="btn btn-primary">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        Soumettre
                                    </button>
                                </td>
                            </form>

                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <tr>
                            <th>Béneficiaire</th>
                            <th>Désignation</th>
                            <th>N° DMD</th>
                            <th>Date début usage</th>
                            <th>Qte attendue</th>
                            <th>Qte sortie</th>
                            <th>Céer le bon</th>
                        </tr>
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
