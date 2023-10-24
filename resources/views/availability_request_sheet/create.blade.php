@extends('layouts.master')

@section('title')
Fiche de DMD en cours
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
          <h1 class="m-0">Créer une DMD</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Créer une DMD</li>
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
                        {{-- <form method="POST" id="dmd_form" action={{ route('availability_request_sheet.store') }} enctype="multipart/form-data">
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
                                        <label for="service_demandeur">Service demandeur<span class="text-danger" >*</span></label>
                                        <select name="service_demandeur" id="service_demandeur" class="form-control @error('service_demandeur')
                                            is-invalid
                                        @enderror select2" style="width: 100%;" required>
                                            <option selected="selected" disabled>Choisir le service</option>
                                            @foreach ($service_demandeurs as $service_demandeur)
                                                <option value="{{ $service_demandeur->id }}"  @selected(old('service_demandeur') == $service_demandeur->id)>{{ $service_demandeur->title }} ({{ $service_demandeur->sigle }}) </option>
                                            @endforeach
                                        </select>
                                        @error('service_demandeur')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="chef_depart">Chef du département<span class="text-danger" >*</span></label>
                                        <select name="chef_depart" id="chef_depart" class="form-control @error('chef_depart')
                                            is-invalid
                                        @enderror select2" style="width: 100%;" required>
                                            <option selected="selected" disabled>Saisir son nom - Email</option>
                                            @foreach ($chef_departs as $user)
                                                <option value="{{ $user->id }}"  @selected(old('chef_depart') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('chef_depart')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="controlleur">Controleur<span class="text-danger" >*</span></label>
                                        <select name="controlleur" id="controlleur" class="form-control @error('controlleur')
                                            is-invalid
                                        @enderror select2" style="width: 100%;" required>
                                            <option selected="selected" disabled>Saisir son nom - Email</option>
                                            @foreach ($controllers as $user)
                                                <option value="{{ $user->id }}"  @selected(old('controlleur') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('controlleur')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-6" id="num_dossier">
                                        <label for="num_dossier">Numéro Dossier</label>
                                        <input type="texte" class="form-control @error('num_dossier')
                                        is-invalid
                                        @enderror" name="num_dossier" value="{{ @old('num_dossier') }}" placeholder="saisir ici!">
                                        @error('num_dossier')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="produit">
                                        <label for="produit">Produit<span class="text-danger" >*</span></label>
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="produit" value="bien" checked>
                                                <label class="form-check-label">Bien</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="produit" value="service">
                                                <label class="form-check-label">Service</label>
                                            </div>
                                        </div>
                                        @error('produit')
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

                                    <fieldset class="px-3 mx-2 border col-md-12" id="dynamicAddRemove">
                                        <legend class="w-auto px-2 h6 text-primary text-sm-center text-md-left text-bold" style="font-size: 1.025em">Contenu de La DMD</legend>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="designation">Désignation<span class="text-danger">*</span></label>
                                                <input type="text" name="addMoreInput[0][designation]" value="{{ @old('addMoreInput[0][designation]') }}" placeholder="Entrer la désignation" class="form-control @error('addMoreInput.*.designation')
                                                is-invalid
                                                @enderror" required/>
                                                @error('addMoreInput.*.designation')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <label for="quantite">Quantité<span class="text-danger">*</span></label>
                                                <input type="number" name="addMoreInput[0][quantite]" value="{{ @old('addMoreInput[0][quantite]') }}" placeholder="Entrer la quantité" class="form-control @error('addMoreInput.*.quantite')
                                                is-invalid
                                                @enderror" required/>
                                                @error('addMoreInput.*.quantite')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <label for="motif">Motif(s)<span class="text-danger">*</span></label>
                                                <input type="text" name="addMoreInput[0][motif]" placeholder="Entrer le motif" class="form-control @error('addMoreInput.*.motif')
                                                is-invalid
                                                @enderror" required/>
                                                @error('addMoreInput.*.motif')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">

                                                <label for="beneficiaire">Bénéficiaire <span class="text-danger" >*</span></label>
                                                <select name="addMoreInput[0][beneficiaire]" id="addMoreInput.*.beneficiaire" class="form-control @error('addMoreInput.*.beneficiaire') is-invalid @enderror select2" style="width: 100%;" required>
                                                    <option selected="selected">Choisir le bénéficiaire</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" @selected(old('addMoreInput[0][beneficiaire]') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                                    @endforeach
                                                </select>
                                                @error('addMoreInput.*.beneficiaire')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <label for="date_debut_usage">Date début usage     <span class="text-danger">*</span></label>
                                                <input type="date" name="addMoreInput[0][date_debut_usage]" value="{{ @old('addMoreInput[0][date_debut_usage]') }}" placeholder="Entrer le prix unitaire" class="form-control @error('addMoreInput.*.date_debut_usage')
                                                is-invalid
                                                @enderror" required/>
                                                @error('addMoreInput.*.date_debut_usage')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mt-2 col-md-2 form-group mt-md-0">
                                                <label for="montan" class="text-white d-none d-sm-none d-md-block">
                                                      montant
                                                </label>
                                                <button type="button" name="add" class="btn btn-primary w-100 dynamic-ar">
                                                    <i class="fa fa-plus-circle"></i>
                                                    Ajout de libellé
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                            </div>

                            <div class="card-footer">
                                <button type="submit" onclick="return confirm('Avez-vous correctement rempli les champs ? si oui cliquez sur ok')"
                                 id="register"
                                   class="btn btn-primary">
                                   Soumettre
                                </button>
                            </div>
                        </form> --}}
                        {{-- @dump($fonction) --}}
                        <livewire:availability-request.create :cities="$cities" :sites="$sites" :users="$users" :controllers="$controllers" :chef_departs="$chef_departs" :service_demandeurs="$service_demandeurs" :fonction="$fonction" />
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

<script type="text/javascript">
    var i = 0;
    $(".dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<div class="py-2 row row_line border-top"><div class="mb-2 col-md-2"><label for="designation">Nouveau Désignation</label><input type="text" name="addMoreInput[' + i +
            '][designation]" placeholder="Nouveau Désignation" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="quantite">Quantité</label><input type="number" name="addMoreInput[' + i +
            '][quantite]" placeholder="Quantité" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="motif">Motif(s)</label><input type="text" name="addMoreInput[' + i +
            '][motif]" placeholder="Motif" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="beneficiaire">Bénéficiaire</label><select name="addMoreInput[' + i +
            '][beneficiaire]" class="form-control @error('addMoreInput.*.beneficiaire') is-invalid @enderror select2" required><option selected="selected">Choisir le bénéficiaire</option>@foreach ($users as $user)<option value="{{ $user->id }}" @selected(old("addMoreInput[' + i +'][beneficiaire]") == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>@endforeach</select></div><div class="mb-2 col-md-2"><label for="date_debut_usage">Date début usaage</label><input type="date" name="addMoreInput[' + i +
            '][date_debut_usage]" placeholder="date début usage" class="form-control" required/></div><div class="mb-2 col-md-2"><label for="montan" class="text-white d-none d-sm-none d-md-block">  montant</label><button type="button" class="btn btn-danger w-100 remove-input-field"><i class="fa fa-trash"></i> Rétirer</button></div></div>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('.row_line').remove();
    });
</script>
  @livewireScripts
@endsection
