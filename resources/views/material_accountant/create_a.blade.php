@extends('layouts.master')

@section('title')
Création des articles
@endsection

@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">


    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">


    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    @livewireStyles
@endsection

@section('header-section')
<div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0">Créer un article</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">créer article</li>
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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Renseignez les champs ci-dessous</h3>
                        </div>



                        <!-- form start -->
                        <form method="POST" id="fd_form" action={{ route('material_accountant.store_a') }} >
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="family_article_id">Famille article<span class="text-danger" >*</span></label>
                                        <select name="family_article_id" id="family_article_id"  class="@error('family_article_id') is-invalid @enderror form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                                            <option value="">Séléctionner la famille de l'article</option>
                                            @foreach ($family_articles as $family_article)
                                                <option value="{{ $family_article->id }}">{{ $family_article->label }}</option>
                                            @endforeach
                                        </select>
                                        @error('family_article_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="Intitule">
                                        <label for="label">Nom article<span class="text-danger" >*</span></label>
                                        <input type="text" class="form-control @error('banque')
                                        is-invalid
                                        @enderror" name="label" value="{{ @old('label') }}" placeholder="saisir ici!">
                                        @error('label')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="uuid">
                                        <label for="uuid">code Article<span class="text-danger" >*</span></label>
                                        <input type="text" class="form-control @error('uuid')
                                        is-invalid
                                        @enderror" name="uuid" value="{{ @old('uuid') }}" placeholder="Identifiant de l'article">
                                        @error('uuid')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="description" >
                                        <label for="description">description</label>
                                        <input type="text" class="form-control @error('description')
                                        is-invalid
                                        @enderror" name="description" value="{{ @old('description') }}" placeholder="saisir ici!">
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div><!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" onclick="return confirm('Avez-vous correctement rempli les champs ? si oui cliquez sur ok')"
                                 id="register"
                                   class="btn btn-primary">
                                   Soumettre
                                </button>
                            </div>
                        </form>
                    </div><!-- /.card -->
                    <div class="card-body">
                        <div class="table-responsive">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th># code article</th>
                                    <th>Nom article</th>
                                    <th>Famille article</th>
                                    {{-- <th>description</th> --}}
                                    {{-- <th>Initiateur</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $article->uuid }}</td>
                                    <td>{{ $article->label }} </td>
                                    {{-- <td>{{ $article->family_article_id? $article->family_article->label}} </td> --}}
                                    <td>{{ $article->family_article->uuid}} </td>
                                    {{-- <td>{{ $article->description}}</td> --}}
                                    {{-- <td>{{ $article->creator}}</td> --}}
                                    <td>
                                        <a  href="#" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                            Voir
                                        </a>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th># code article</th>
                                    <th>Nom article</th>
                                    <th>Famille article</th>
                                    {{-- <th>description</th> --}}
                                    {{-- <th>Initiateur</th> --}}
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                      <!-- /.card-body -->

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')

<!-- jQuery UI 1.11.4 -->
{{-- <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    // $.widget.bridge('uibutton', $.ui.button)

//   let btn = document.querySelector('btn_submit');
//     document.getElementById('#form_fd').addEventListener("submit", function(e){
//         btn.$(selector).append(content);
//     })

    window.addEventListener('load', (event) => {
        document.getElementById('destinataire').style.display = 'block';
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

{{-- <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script> --}}

<script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //désactiver le bouton du formulaire lors de l'envoi
        $('#fd_form').on('submit', function () {
            $('#register').attr('disabled', 'true');
        });
    })
  </script>
  //plugins tableau
{{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> --}}

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


  @livewireScripts
@endsection
