@extends('layouts.master')

@section('title')
Fiche de dépense en cours
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
                <h1 class="m-0">Journal des fiches de dépense en cours</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Accueil</a></li>
                <li class="breadcrumb-item active">FD en cours</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('body-section')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Journal des fiches de dépense en cours</h3>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Demandeur</th>
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
                                    @foreach ($fiche_depenses as $fiche_depense)
                                        @if(checkFDAccess($fiche_depense))
                                            <tr>
                                                <td>{{ $fiche_depense->id }}</td>
                                                <td>{{ $fiche_depense->user->lname }} {{ $fiche_depense->user->fname }}</td>
                                                <td>{{ $fiche_depense->beneficiaires->lname }} {{ $fiche_depense->beneficiaires->fname }}</td>
                                                <td>{{ $fiche_depense->date_etablissement }}</td>
                                                {{-- <td>{{\App\Helpers\MoneyHelper::price($fiche_depense->montant)}}</td> --}}
                                                <td>{{ $fiche_depense->montant}}</td>
                                                <td>{{ $fiche_depense->description}}</td>
                                                <td>{{ $fiche_depense->numero_contribuable}}</td>
                                                <td>{{ $fiche_depense->mode_paiment }}</td>
                                                <td>{{ $fiche_depense->statut }}</td>
                                                <td>
                                                    <span class="">
                                                        {{ $fiche_depense->num_comptable}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a  href="{{ route('expense_sheet.show', $fiche_depense->id) }}" class="btn btn-primary">
                                                        <i class="fa fa-eye"></i>
                                                        Voir
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>N°</th>
                                        <th>Demandeur</th>
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
                    </div>
                </div>
            </div>
        </div>

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
      "order" : [[3, 'desc']],
      "buttons": [
        "copy", "csv", "excel", "pdf", "print", "colvis"
        ],
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
{{-- <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "order" : [[3, 'desc']],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "columns": [
          null,
          null,
          null,
          null,
          {
            render: $.fn.dataTable.render.number(' ', ',', 2, ''),
          },
          null,
          null,
          null,
          null,
          null,
          null,
        ],
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
</script> --}}
@endsection
