@extends('layouts.master')

@section('title')
Configuration comptable
@endsection

@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">


    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
    @livewireStyles
@endsection

@section('header-section')
<div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0">Créer une configuration compte</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Configuration comptable</li>
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
                            <h3 class="card-title">Veuiller remplir les champs ci-dessous</h3>
                        </div>



                        <!-- form start -->
                        <form method="POST" id="fd_form" action={{ route('book_keeper.store') }} }}>
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="entity_id">Entité<span class="text-danger" >*</span></label>
                                        <select name="entity_id" id="entity_id"  class="@error('entity_id') is-invalid @enderror form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                                            @foreach ($entites as $entite)
                                                <option value="{{ $entite->id }}">{{ $entite->sigle }}</option>
                                            @endforeach
                                        </select>
                                        @error('entity_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="Intitule">
                                        <label for="banque">Banque<span class="text-danger" >*</span></label>
                                        <input type="text" class="form-control @error('banque')
                                        is-invalid
                                        @enderror" name="banque" value="{{ @old('banque') }}" placeholder="Définir la banque">
                                        @error('banque')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="Intitule">
                                        <label for="intitule">Intitulé de compte<span class="text-danger" >*</span></label>
                                        <input type="text" class="form-control @error('intitule')
                                        is-invalid
                                        @enderror" name="intitule" value="{{ @old('intitule') }}" placeholder="Intitulé de compte">
                                        @error('intitule')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="numero_compte">
                                        <label for="numero_compte">Numéro de compte<span class="text-danger" >*</span></label>
                                        <input type="text" class="form-control @error('numero_compte')
                                        is-invalid
                                        @enderror" name="numero_compte" value="{{ @old('numero_compte') }}" placeholder="saisir ici!">
                                        @error('numero_compte')
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
  @livewireScripts
@endsection
