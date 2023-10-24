@extends('layouts.master')

@section('title')
Liste des Bon de sortie 
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
                <h3 class="card-title">Liste des bon de sortie matériel</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N° bon de sortie</th>
                            <th>Date sortie</th>
                            <th>Initiateur</th>
                            <th>Béneficiaire</th>
                            <th>Désignation</th>
                            <th>Qte sortie</th>
                            <th>N° DMD</th>
                            <th>Statut</th>
                            <th>Confirmer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($material_realise_forms as $material_realise_form)
                            <tr>
                                <td>{{ $material_realise_form->id }}</td>
                                <td>{{ $material_realise_form->created_at }}</td>
                                <td>
                                    @foreach ($users as $user )
                                        @if($user->id== $material_realise_form->comptable_matiere)
                                            {{ $user->fname }} {{ $user->lname }} - {{ $user->email }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($users as $user )
                                        @if($user->id== $material_realise_form->beneficiaire)
                                            {{ $user->fname }} {{ $user->lname }} - {{ $user->email }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $material_realise_form->designation }}</td>
                                <td>{{ $material_realise_form->quantite_compta_mat }}</td>
                                <td>{{ $material_realise_form->availability_request_sheet_id }}</td>
                                <td>{{ $material_realise_form->statut }}</td>
                                <td>
                                    <form action="{{ route('material_release_form.validation') }}" method="POST">
                                        @csrf
                                        @if(auth()->user()->id == $material_realise_form->beneficiaire && $material_realise_form->statut == 'en attente')
                                            <input type="number" name="bsm_id" id="bsm_id_{{ $material_realise_form->id }}" class="d-none" value="{{ $material_realise_form->id }}">
                                            <button type="submit" onclick="return confirm('Confirmez vous avoir reçu cette quantité ? si oui cliquez sur ok')"
                                                class="btn btn-primary">
                                                <i class="fa-solid fa-floppy-disk"></i>
                                                confirmez
                                            </button>
                                        @else
                                            <span class="badge badge-danger">En attente</span><br>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>N° bon de sortie</th>
                            <th>Date sortie</th>
                            <th>Initiateur</th>
                            <th>Béneficiaire</th>
                            <th>Désignation</th>
                            <th>Qte sortie</th>
                            <th>N° DMD</th>
                            <th>Statut</th>
                            <th>Confirmer</th>
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
