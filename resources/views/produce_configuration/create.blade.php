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
          <h1 class="m-0">Créer une configuration des Produits</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Configuration des Produits</li>
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
                        <form method="POST" id="fd_form" action={{ route('produce_configuration.store') }} }}>
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

                                    {{-- <div class="form-group col-md-6">
                                        <label for="city_id">
                                            Selectionner votre ville<span class="text-danger" >*</span></label>
                                        <select name="city_id" id="city_id" class="@error('city_id') is-invalid @enderror form-control" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                                            @foreach ($cities as $city)

                                                <option value="{{ $city->pivot->id }}" @selected(old('city_id') == $city->pivot->id)>{{ $city->label }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    <div class="form-group col-md-6" id="label">
                                        <label for="label">Nom du produit<span class="text-danger" >*</span></label>
                                        <input type="text" class="form-control @error('label')
                                        is-invalid
                                        @enderror" name="label" value="{{ @old('label') }}" placeholder="Nom du site">
                                        @error('label')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="prix_unitaire">
                                        <label for="prix_unitaire">Prix unitaire<span class="text-danger" >*</span></label>
                                        <input type="text" class="form-control @error('prix_unitaire')
                                        is-invalid
                                        @enderror" name="prix_unitaire" value="{{ @old('code') }}" placeholder="prix unitaire du produit">
                                        @error('prix_unitaire')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="contionnement">
                                        <label for="contionnement">Conditionnement<span class="text-danger" >*</span></label>
                                        <input type="text" class="form-control @error('contionnement')
                                        is-invalid
                                        @enderror" name="contionnement" value="{{ @old('contionnement') }}" placeholder="conditionnement du produit">
                                        @error('contionnement')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-12" id="description">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control @error('description')
                                        is-invalid
                                        @enderror" name="localisation" value="{{ @old('description') }}"  placeholder="saisir ici!">
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
