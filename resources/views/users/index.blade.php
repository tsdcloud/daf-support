@extends('layouts.master')

@section('title')
Liste des utilisateurs
@endsection

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #007bff;
        border-color: #006fe6;
        color: #fff;
        padding: 0 10px;
        margin-top: .31rem;
    }
  </style>

<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
@endsection

@section('header-section')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Listes des utilisateurs</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Accueil</a></li>
                <li class="breadcrumb-item active">Listes des utilisateurs</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('body-section')

    <section class="content">
        <div class="card">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center">
                                <h3 class="card-title">Liste des utilisateurs</h3>
                            </div>
                            <div class="col-md-8">
                                <button class="float-md-right btn btn-primary" type="button"  data-toggle="modal" data-target="#addusers">
                                    <i class="fa fa-user-plus"></i> Nouveau utilisateur
                                </button>
                                <div class="text-left modal fade" id="addusers" tabindex="-1" role="dialog" aria-labelledby="addusers"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addusers"><i class="fa fa-user-plus"></i> Ajouter un utilisateur</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="fname">Nom<span class="text-danger"><sub>*</sub></span></label>
                                                                    <input type="text" name="fname" id="fname" value="{{ @old('fname') }}" class="form-control  @error('fname') is-invalid @enderror" placeholder="Nom" required>
                                                                    @error('fname')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="lname">Prénom<span class="text-danger"><sub>*</sub></span></label>
                                                                    <input type="text" name="lname" id="lname" value="{{ @old('lname') }}" class="form-control  @error('lname') is-invalid @enderror" placeholder="Prénom"  required>
                                                                    @error('lname')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="email">E-mail<span class="text-danger"><sub>*</sub></span></label>
                                                                    <input type="email" name="email" id="email" value="{{ @old('email') }}" class="form-control  @error('email') is-invalid @enderror" placeholder="E-mail" required>
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="phone">Téléphone<span class="text-danger"><sub>*</sub></span></label>
                                                                    <input type="number" name="phone" id="phone" value="{{ old('phone') }}" class="form-control  @error('phone') is-invalid @enderror" placeholder="Téléphone" required>
                                                                    @error('phone')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="entity_id">Entité<span class="text-danger"><sub>*</sub></span></label>
                                                                    <select id="entity_id" name="entity_id" class="form-control @error('entity_id') is-invalid @enderror" required>
                                                                        <option selected="" disabled=""> ---- Choisir une entité ----</option>
                                                                        @foreach ($entities as $entity)
                                                                            <option value="{{ $entity->id }}">{{ $entity->sigle }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('entity_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="grade_id">Grade<span class="text-danger"><sub>*</sub></span></label>
                                                                    <select id="grade_id" name="grade_id" class="form-control @error('grade_id') is-invalid @enderror" required>
                                                                        <option selected="" disabled=""> ---- Choisir un grade ----</option>
                                                                        @foreach ($grades as $grade)
                                                                            <option value="{{ $grade->id }}">{{ $grade->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('grade_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="department_id">Département<span class="text-danger"><sub>*</sub></span></label>
                                                                    <select id="department_id" name="department_id" class="form-control @error('department_id') is-invalid @enderror" required>
                                                                        <option selected="" disabled=""> ---- Choisir un département ----</option>
                                                                        @foreach ($departments as $department)
                                                                            <option value="{{ $department->id }}">{{ $department->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('department_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="fonction">Fonction<span class="text-danger"><sub>*</sub></span></label>
                                                                    <input type="text" id="fonction" name="fonction" value="{{ old('fonction') }}" class="form-control @error('fonction') is-invalid @enderror" placeholder="Titre de la fonction" required>
                                                                </div>
                                                                @error('fonction')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="category_id">Catégorie<span class="text-danger"><sub>*</sub></span></label>
                                                                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                                                        <option selected="" disabled=""> ---- Choisir une catégorie ----</option>
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('category_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="echelon_id">Echelon<span class="text-danger"><sub>*</sub></span></label>
                                                                    <select id="echelon_id" name="echelon_id" class="form-control @error('echelon_id') is-invalid @enderror" required>
                                                                        <option selected="" disabled=""> ---- Choisir un échelon ----</option>
                                                                        @foreach ($echelons as $echelon)
                                                                            <option value="{{ $echelon->id }}">{{ $echelon->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('echelon_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="role">Rôle</label>
                                                                    <select id="role" name="role[]" class="select2 form-control  @error('role') is-invalid @enderror" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                                        <option value=""> ---- Choisir un rôle ----</option>
                                                                        @foreach ($roles as $role)
                                                                            <option value="{{ $role->id }}"> {{ $role->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('role')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="matricule">Matricule</label>
                                                                <input id="matricule" name="matricule" class="form-control @error('matricule') is-invalid @enderror">
                                                            </div>
                                                            @error('matricule')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer row" style="margin-right: 0px!important;margin-left: 0px!important;">
                                                    <div class="col" style="margin-left: -15px!important;">
                                                        <button type="button" class="btn grey btn-danger" data-dismiss="modal">
                                                            <i class="fa fa-times"></i>
                                                            Fermer
                                                        </button>
                                                    </div>
                                                    <div class="col" style="margin-right: -15px!important;">
                                                        <button type="submit" class="float-right btn btn-primary">
                                                            <i class="fa fa-plus"></i>
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Entitée(s)</th>
                                    <th>Rôle(s)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->id }}
                                        </td>
                                        <td>
                                            {{ $user->fname }}
                                        </td>
                                        <td>
                                            {{ $user->lname }}
                                        </td>
                                        <td>
                                            {{ $user->phone }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            <ul style="padding-left: -25px!important">
                                                @foreach ($user->user_entity as $entity)
                                                    <li>{{ $entity->entity->sigle }}</li>
                                                @endforeach
                                            </ul>
                                        <td>
                                            <ul style="padding-left: -25px!important">
                                                @foreach ($user->privileges as $privilege)
                                                    <li>{{ $privilege->role->title }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary" title="Cliquez pour voir les details">
                                            <i class="fa fa-eye"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Entitée(s)</th>
                                    <th>Rôle(s)</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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

<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

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

<!-- Page specific script -->
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })
    });
</script>
@endsection
