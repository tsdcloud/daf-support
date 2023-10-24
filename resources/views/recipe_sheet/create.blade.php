@extends('layouts.master')

@section('title')
Fiche de recette en cours
@endsection

@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">


    {{-- <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
{{-- 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/> --}}
    @livewireStyles
@endsection

@section('header-section')
<div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0">Créer une fiche de recette</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Créer une FR</li>
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
                        {{-- <form method="POST" id="fd_form" action={{ route('recipe_sheet.store') }} enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="city_entity_id">
                                            Selectionner votre ville<span class="text-danger" >*</span></label>
                                        <select name="city_entity_id" id="city_entity_id" class="@error('city_entity_id') is-invalid @enderror form-control" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                                            @foreach ($cities as $city)
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
                                        <label for="apporteur">Apporteur<span class="text-danger" >*</span></label>
                                        <select name="apporteur" id="apporteur" class="form-control @error('apporteur')
                                            is-invalid
                                        @enderror select2" style="width: 100%;" required>
                                            <option selected="selected" disabled>Saisir son nom - Email</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"  @selected(old('apporteur') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('apporteur')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="raison_sociale">
                                        <label for="raison_sociale">Raison sociale</label>
                                        <input type="text" class="form-control @error('raison_sociale')
                                        is-invalid
                                        @enderror" name="raison_sociale" value="{{ @old('raison_sociale') }}" placeholder="Nom">
                                        @error('raison_sociale')
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

                                    <!-- Contact -->
                                    <div class="form-group col-md-6" id="contact">
                                        <label for="contact">Contact</label>
                                        <input type="text" class="form-control @error('contact')
                                        is-invalid
                                        @enderror" name="contact" value="{{ @old('contact') }}" placeholder="téléphone">
                                        @error('contact')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="provenance">provenance de la recette<span class="text-danger">*</span></label>
                                        <select name="provenance" id="provenance"  class="@error('provenance')
                                        is-invalid @enderror form-control select2" required >

                                            <option value="règlement de facture" @if (old('provenance') == "règlement de facture") {{ 'selected' }} @endif >Règlement de facture</option>
                                            <option value="caution sur opération" @if (old('provenance') == "caution sur opération") {{ 'selected' }} @endif>Caution sur opération</option>

                                        </select>
                                        @error('provenance')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="mode_paiment">Mode de paiment<span class="text-danger">*</span></label>
                                        <select name="mode_paiment" id="mode_paiment"  class="@error('mode_paiment')
                                        is-invalid @enderror form-control select2" required >
                                            <option value="espèces" @if (old('mode_paiment') == "espèces") {{ 'selected' }} @endif >Espèces</option>
                                            <option value="paiement mobile" @if (old('mode_paiment') == "paiement mobile") {{ 'selected' }} @endif >Paiement mobile</option>
                                            <option value="chèque bancaire" @if (old('mode_paiment') == "chèque bancaire") {{ 'selected' }} @endif >Chèque bancaire</option>
                                            <option value="virement bancaire" @if (old('mode_paiment') == "virement bancaire") {{ 'selected' }} @endif >Virement bancaire</option>
                                            <option value="carte bancaire" @if (old('mode_paiment') == "carte bancaire") {{ 'selected' }} @endif >carte bancaire</option>

                                        </select>
                                        @error('mode_paiment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="filenames">Pièces jointes</label>
                                        <input type="file" name="filenames[]" multiple id="filenames" class="@error('filenames.*') is-invalid @enderror form-control" style="width: 100%;">
                                        @error('filenames.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <livewire:label-recipe-sheet>
                            </div>

                            <div class="card-footer">
                                <button type="submit" onclick="return confirm('Avez-vous correctement rempli les champs ? si oui cliquez sur ok')"
                                 id="register"
                                   class="btn btn-primary">
                                   Soumettre
                                </button>
                            </div>
                        </form> --}}
                        <livewire:recipe-sheet.create/>
                    </div><!-- /.card -->

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script> --}}
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

{{-- <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
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
  </script> --}}

<script type="text/javascript">
    var i = 0;
    $(".dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<div class="py-2 row row_line border-top"><div class="mb-2 col-md-2"><label for="libelle">Nouveau libellé</label><input type="text" name="addMoreInput[' + i +
            '][libelle]" placeholder="Nouveau libellé" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="dossier">Prix unitaire XAF</label><input type="number" name="addMoreInput[' + i +
            '][prix_unitaire]" placeholder="Prix unitaire" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="dossier">Quantité</label><input type="number" name="addMoreInput[' + i +
            '][quantite]" placeholder="Quantité" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="dossier">Dossier d\'affectation</label><input type="text" name="addMoreInput[' + i +
            '][dossier]" placeholder="Dossier d\'affectation" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="prix_total">Prix total XAF</label><input type="number" name="addMoreInput[' + i +
            '][prix_total]" placeholder="Prix total en XAF" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="montan" class="text-white d-none d-sm-none d-md-block">  montant</label><button type="button" class="btn btn-danger w-100 remove-input-field"><i class="fa fa-trash"></i> Rétirer</button></div></div>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('.row_line').remove();
    });
</script>
  @livewireScripts
@endsection
