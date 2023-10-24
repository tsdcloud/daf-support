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
          <h1 class="m-0">Liste des bons de sortie matériel Archivées</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Liste des BSM archivées</li>
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
                <form action="{{ route('material_release_form.exportation') }}" method="post" class="row"enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-3" id="date_debut_exportation_div">
                        <h3 class="card-title">Liste des bons de sortie matériel Archivées</h3>
                    </div>
                    <div class="form-group col-md-3" id="date_debut_div">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="date_debut">Date debut exp:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-5">
                                <input type="date" class="form-control @error('date_debut')
                                is-invalid
                                @enderror" id="date_debut" name="date_debut" value="" placeholder="Date debut exportation"/>
                                @error('date_debut')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3" id="date_fin_div">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="date_fin">Date fin exp:</label>
                            </div>
                            <div class="col-md-5">
                                <input type="date" class="form-control @error('date_fin')
                                is-invalid
                                @enderror" id="date_fin" name="date_fin" value="" placeholder="Date debut fin"/>
                                @error('date_fin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        {{-- <label for="extension">Famille article<span class="text-danger" >*</span></label> --}}
                        <select name="extension" id="extension"  class="@error('extension') is-invalid @enderror form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                            <option value="xlsx" selected >.xlsx</option>
                            <option value="csv" >.csv</option>
                        </select>
                        @error('family_article_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 " id="date_fin_exportation_div">
                        <button type="submit" onclick="return confirm('voulez vous exporter cette période d\'activité ? si oui cliquez sur ok')"
                            id="register"
                            class="btn btn-primary">
                            Exporter bon
                        </button>
                    </div>
                </form>

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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
