@extends('layouts.master')

@section('title')
Fiche de dépense en cours
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
          <h1 class="m-0">Créer une fiche de dépense</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Créer une FD</li>
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
                        <div class="card-header mb-1">
                            <h3 class="card-title">Veuiller remplir les champs ci-dessous</h3>
                        </div>
                        <!-- /.card-header -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- form start -->
                        <form method="POST" id="fd_form" action={{ route('expense_sheet.store') }} enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="city_entity_id">
                                            Selectionner votre ville<span class="text-danger" >*</span></label>
                                        <select name="city_entity_id" id="city_entity_id" class="@error('city_entity_id') is-invalid @enderror form-control" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                                            @foreach ($cities as $city)
                                                {{-- <p>{{ $city->pivot->id }}</p> --}}
                                                <option value="{{ $city->pivot->id }}" @selected(old('city_entity_id') == $city->pivot->id)>{{ $city->label }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_entity_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="site_id">
                                            Selectionner votre site<span class="text-danger" >*</span></label>
                                        <select name="site_id" id="site_id" class="@error('site_id') is-invalid @enderror form-control" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                                            @foreach ($sites as $site)
                                                <option value="{{ $site->id }}" @selected(old('city_entity_id') == $site->id)>{{ $site->label }}</option>
                                            @endforeach
                                        </select>
                                        @error('site')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="beneficiaire">Bénéficiaire <span class="text-danger" >*</span></label>
                                        <select name="beneficiaire" id="beneficiaire" class="form-control @error('beneficiaire') is-invalid @enderror select2" style="width: 100%;" required>
                                            <option selected="selected">Choisir le bénéficiaire</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @selected(old('beneficiaire') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('beneficiaire')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{-- <input type="number" class="form-control @error('montant') is-invalid @enderror" name="montant" id="montant" value="{{ @old('montant') }}" placeholder="saisire ici!" required> --}}
                                        <livewire:parse-input-value />
                                        @error('montant')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="controlleur">Contrôleur <span class="text-danger" >*</span></label>
                                        <select name="controlleur" id="controlleur" class="@error('controlleur')
                                        is-invalid
                                        @enderror form-control select2" style="width: 100%;" required>
                                            <option selected="selected">Saisir son nom</option>
                                            @foreach ($controllers as $user)
                                                <option value="{{ $user->id }}" @selected(old('controlleur') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('controlleur')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ordonateur">Ordonnateur <span class="text-danger" >*</span></label>
                                        <select id="ordonateur" name="ordonateur" class="@error('ordonateur')
                                        is-invalid
                                        @enderror form-control select2" style="width: 100%;" required>
                                            <option selected="selected">Saisir son nom</option>
                                            @foreach ($ordonateurs as $user)
                                                <option value="{{ $user->id }}" @selected(old('ordonateur') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('ordonateur')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mode_paiment">Mode de paiement<span class="text-danger" >*</span></label>
                                        <select name="mode_paiment" id="mode_paiment" onChange="change(this.value);" class="@error('mode_paiment') is-invalid @enderror form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                                            <option value="Virement bancaire" selected="selected">Virement bancaire<span class="text-danger" >*</span></option>
                                            <option value="Chèque bancaire">Chèque bancaire</option>
                                            <option value="Paiement mobile">Paiement mobile</option>
                                            <option value="Carte bancaire">Carte bancaire</option>
                                            <option value="Espèces">Espèces</option>
                                        </select>
                                        @error('mode_paiment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="num_dossier">
                                        <label for="num_dossier">Numéro de dossier</label>
                                        <input type="text" class="form-control @error('num_dossier')
                                        is-invalid
                                        @enderror" name="num_dossier" value="{{ @old('num_dossier') }}" placeholder="numéro de dossier">
                                        @error('num_dossier')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="destinataire">
                                        <label for="destinataire">Destinataire</label>
                                        <input type="text" class="form-control @error('destinataire')
                                        is-invalid
                                        @enderror" name="destinataire" value="{{ @old('destinataire') }}" placeholder="Nom du destinataire">
                                        @error('destinataire')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6" id="numero_contribuable">
                                        <label for="numero_contribuable">Numéro contribuable</label>
                                        <input type="texte" class="form-control @error('numero_contribuable')
                                        is-invalid
                                        @enderror" name="numero_contribuable" value="{{ @old('numero_contribuable') }}" placeholder="saisir ici!">
                                        @error('numero_contribuable')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                            Description<span class="text-danger" >*</span>
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <textarea name="description" id="summernote" class="form-control @error('description')
                                            is-invalid
                                            @enderror" required>{{ @old('description') }}</textarea>

                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="filenames">Pièces jointes</label>
                                        <input type="file" name="filenames[]" multiple id="filenames" class="@error('filenames.*') is-invalid @enderror form-control" style="width: 100%;">
                                        @error('filenames.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
{{--  --}}
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
