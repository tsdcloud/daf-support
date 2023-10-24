@extends('layouts.master')

@section('title')
Création de FAC
@endsection

@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">


   <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0')}}">

    @livewireStyles
@endsection

@section('header-section')
<div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0">Créer une FAC</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Créer une FAC</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('body-section')
<section class="content">
    <div class="container-fluid">
      @if(Session::has('error'))
      {{ Session::get('error') }}

      @foreach ($errors->any as $error)
          {{ $error }}
      @endforeach

      @endif
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">Paramètres spécifiques</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" id="fd_form" action={{ route('cash_register_supply_sheet.store') }} enctype= "multipart/form-data">
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
                        <!-- approvisionneur -->
                        <div class="form-group col-md-6">
                            <label for="approvisionneur">approvisionneur<span class="text-danger">*</span></label>
                            <select name="approvisionneur" id="approvisionneur" class="form-control @error('approvisionneur')
                            is-invalid
                            @enderror select2" style="width: 100%;" required>
                                <option disabled selected="selected">Saisir son nom - Email</option>
                                @foreach ($users as $user)
                                    @if (old('approvisionneur') == $user->id)
                                        <option selected value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>

                                    @endif
                                @endforeach
                            </select>
                            @error('approvisionneur')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group col-md-6" id="Matricule">
                            <label for="Matricule">Matricule</label>
                            <input type="text" id="matricule" class="form-control @error('matricule')
                            is-invalid
                        @enderror" name="Matricule" value="{{ @old('Matricule') }}" placeholder="Matricule de l'approvisionneur">
                        @error('Matricule')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                            <!--Fonction -->
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="fonction">Fonction<span class="text-danger"><sub>*</sub></span></label>
                                <input type="text" id="fonction" name="fonction" value="{{ old('fonction') }}" class="form-control @error('fonction') is-invalid @enderror" placeholder="Titre de la fonction" required>
                            </div>
                            @error('fonction')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <div class="form-group col-md-6" id="fonction">
                            <label for="fonction">Fonction</label>
                            <input type="text" class="form-control @error('fonction')
                            is-invalid
                        @enderror" name="fonction" value="{{ @old('fonction') }}" placeholder="fonction de l'approvisionneur">
                        @error('fonction')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                            <!-- Contact -->

                        <div class="form-group col-md-6" id="Contact">
                            <label for="Contact">Contact</label>
                            <input type="text" class="form-control @error('contact')
                            is-invalid
                        @enderror" name="Contact" value="{{ @old('contact') }}" placeholder="téléphone de l'approvisionneur">
                        @error('contact')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                            <!-- Contact -->

                        <div class="form-group col-md-6" id="numero_contribuable">
                            <label for="numero_contribuable">N°Contribuable</label>
                            <input type="text" class="form-control @error('numero_contribuable')
                            is-invalid
                        @enderror" name="numero_contribuable" value="{{ @old('numero_contribuable') }}" placeholder="Numéro contribuable de l'approvisionneur">
                        @error('numero_contribuable')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                        <!-- Montant -->
                        <div class="form-group col-md-6">
                            {{-- <input type="number" class="form-control @error('montant') is-invalid @enderror" name="montant" id="montant" value="{{ @old('montant') }}" placeholder="saisire ici!" required> --}}
                            <livewire:parse-input-value />
                            @error('montant')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="provenance">provenance de l'approvisionnement<span class="text-danger">*</span></label>
                            <select name="provenance" id="provenance"  class="@error('provenance')
                            is-invalid @enderror form-control select2" required>

                                <option disabled selected >Selectionner l'approvisionnement</option>
                                <option value="Retrait bancaire" @if (old('provenance') == "Retrait bancaire") {{ 'selected' }} @endif >Retrait bancaire</option>
                                <option value="Apport en compte courant" @if (old('provenance') == "Apport en compte courant") {{ 'selected' }} @endif>Apport en compte courant</option>
                                <option value="Emprunt privé" @if (old('provenance') == "Emprunt privé") {{ 'selected' }} @endif>Emprunt privé</option>
                                <option value="Encaissement client" @if (old('provenance') == "Encaissement client") {{ 'selected' }} @endif>Encaissement client</option>
                                {{-- <option value="versement issu d\'un point de vente" @if (old('provenance') == "versement issu d\'un point de vente") {{ 'selected' }} @endif>Versement issu d'un point de vente</option> --}}
                                {{-- <option value="Espèces">Espèces</option> --}}
                            </select>
                            @error('provenance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mode_approv">Mode d'approvisionnement<span class="text-danger">*</span></label>
                            <select name="mode_approv" id="mode_approv"
                            class="@error('mode_approv')is-invalid @enderror form-control select2" required>
                                <option value="Dépos direct d'espèces" selected="selected" disabled>Sélectionner un mode d'approvisionnement</option>
                                <option value="Dépos direct d'espèces" @if (old('mode_approv') == "Dépos direct d'espèces") {{ 'selected' }} @endif >Dépot direct d'espèces</option>
                                <option value="Retrait d'espèces sur chèque bancaire" @if (old('mode_approv') == "Retrait d'espèces sur chèque bancaire") {{ 'selected' }} @endif>Retrait d'espèces sur chèque bancaire</option>
                                <option value="Retrait d'espèces sur paiment mobile" @if (old('mode_approv') == "Retrait d'espèces sur paiment mobile") {{ 'selected' }} @endif>Retrait d'espèces sur paiment mobile</option>
                                <option value="Retrait d'espèces sur carte bancaire" @if (old('mode_approv') == "Retrait d'espèces sur carte bancaire") {{ 'selected' }} @endif>Retrait d'espèces sur carte bancaire</option>
                                <option value="Retrait d'espèces sur mandat électronique" @if (old('mode_approv') == "Retrait d'espèces sur mandat électronique") {{ 'selected' }} @endif>Retrait d'espèces sur mandat électronique</option>
                            </select>
                            @error('mode_approv')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6" id="num_dossier">
                            <label for="num_dossier">Numéro de dossier :</label>
                            <input type="text" class="form-control @error('num_dossier')
                            is-invalid
                        @enderror" name="num_dossier" value="{{ @old('num_dossier') }}" placeholder="numéro de dossier">
                        @error('num_dossier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        {{-- Libellé --}}
                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        libellé
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <textarea name="libelle" id="summernote" class="form-control @error('libelle')
                                    is-invalid
                                @enderror" >{{ @old('libelle') }}</textarea>

                                @error('libelle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
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

                      {{-- <div class="col-md-12">
                          <div class="card card-outline card-info">
                              <div class="card-header">
                                  <h3 class="card-title">
                                  Description
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
                      </div> --}}
                  </div><!-- /.card-body -->

                  <div class="card-footer">
                      <button type="submit" id="register"  class="btn btn-primary"
                      onclick="return confirm('Avez-vous correctement rempli les champs ? si oui cliquez sur ok')"
                      >Soumettre</button>
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
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- <script>
    // $.widget.bridge('uibutton', $.ui.button)

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
</script> --}}
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
