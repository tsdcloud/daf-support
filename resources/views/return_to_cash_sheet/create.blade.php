@extends('layouts.master')

@section('title')
Création de FRC
@endsection

@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

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
          <h1 class="m-0">Créer une FRC</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Création de FRC</li>
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
              <form method="POST" id="frc_form" action={{ route('return_to_cash_sheet.store') }} enctype="multipart/form-data">
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

                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6" id="reference_fd_original">
                                <label for="reference_fd_original">référence  fiche de dépense originelle :</label>
                                <select name="fiche_depense_id" id="fiche_depense_id" class="form-control select2" class="form-control @error('fiche_depense_id')
                                is-invalid
                                @enderror" required>
                                    @foreach ($fiche_depenses as $fiche_depense)
                                        <option value="{{ $fiche_depense->id }}">{{ $fiche_depense->num_comptable }}</option>
                                    @endforeach
                                </select>
                                @error('fiche_depense_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group col-md-6" id="num_dossier">
                                <label for="num_dossier">Numéro de dossier :</label>
                                <input type="text" name="num_dossier" value="{{ @old('num_dossier') }}" placeholder="numéro de dossier" class="form-control @error('num_dossier')
                                is-invalid
                                @enderror">
                                @error('num_dossier')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>

                      <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="retourneur">Retourneur <span class="text-danger" >*</span></label>
                                        <select name="retourneur" id="retourneur" class="form-control @error('retourneur')
                                            is-invalid
                                        @enderror select2" style="width: 100%;" required>
                                            <option selected="selected" disabled>Saisir son nom - Email</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"  @selected(old('retourneur') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('retourneur')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6" id="numero_contribuable">
                                        <label for="numero_contribuable">Numéro contribuable :</label>
                                        <input type="number" class="form-control @error('numero_contribuable')
                                        is-invalid
                                        @enderror" name="numero_contribuable" value="{{ @old('numero_contribuable') }}" placeholder="saisir ici!">
                                        @error('numero_contribuable')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <livewire:input-frc-mountain />
                            </div>
                            <fieldset class="px-3 mx-2 border col-md-12" id="dynamicAddRemove">
                                <legend class="w-auto px-2 h6 text-primary text-sm-center text-md-left text-bold" style="font-size: 1.025em">Libellé du retour en caisse</legend>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="libelle">Libellé</label>
                                        <input type="text" name="addMoreInput[0][libelle]" value="{{ @old('addMoreInput[0][libelle]') }}" placeholder="Entrer le libellé" class="form-control @error('addMoreInput.*.libelle')
                                        is-invalid
                                    @enderror" required/>
                                        @error('addMoreInput.*.libelle')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dossier">Dossier d'affectation</label>
                                        <input type="text" name="addMoreInput[0][dossier]" placeholder="Entrer un dossier" class="form-control @error('addMoreInput.*.dossier')
                                        is-invalid
                                    @enderror" required/>
                                        @error('addMoreInput.*.dossier')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="montant">montant</label>
                                        <input type="number" name="addMoreInput[0][montant]" placeholder="Entrer le montant" class="form-control @error('addMoreInput.*.montant')
                                        is-invalid
                                    @enderror" required/>
                                        @error('addMoreInput.*.montant')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-3 col-md-3 form-group mt-md-0">
                                        <label for="montan" class="text-white d-none d-sm-none d-md-block">
                                            montant
                                        </label>
                                        <button type="button" name="add" class="btn btn-primary w-100 dynamic-ar">
                                             <i class="fa fa-plus-circle"></i> Ajout de libellé
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                      </div>
                  </div><!-- /.card-body -->
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="filenames">Pièces jointes</label>
                        <input type="file" name="filenames[]" multiple id="filenames" class="@error('filenames.*') is-invalid @enderror form-control" style="width: 100%;">
                        @error('filenames.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                  <div class="card-footer">
                      <button type="submit" id="register" class="btn btn-primary">Soumettre</button>
                  </div>
              </form>
              {{-- <livewire:return-to-cash-sheet.create :users="$users" :fiche_depenses="$fiche_depenses" :cities="$cities" :sites="$sites" /> --}}
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
<script>
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
        //désactiver le bouton du formulaire
        $('#frc_form').on('submit', function () {
            $('#register').attr('disabled', 'true');
        });
    })
  </script>

<script type="text/javascript">
    var i = 0;
    $(".dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<div class="py-2 row row_line border-top"><div class="mb-2 col-md-3"><label for="libelle">Nouveau libellé</label><input type="text" name="addMoreInput[' + i +
            '][libelle]" placeholder="Nouveau libellé" class="form-control" required/></div><div class="mb-2 col-md-3"><label for="dossier">Nouveau dossier</label><input type="text" name="addMoreInput[' + i +
            '][dossier]" placeholder="Nouveau dossier" class="form-control" required/></div><div class="mb-2 col-md-3"><label for="montant">Nouveau montant</label><input type="number" name="addMoreInput[' + i +
            '][montant]" placeholder="Entrer le montant" class="form-control" required/></div><div class="mb-2 col-md-3"><label for="montan" class="text-white d-none d-sm-none d-md-block">  montant</label><button type="button" class="btn btn-danger w-100 remove-input-field"><i class="fa fa-trash"></i> Rétirer</button></div></div>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('.row_line').remove();
    });
</script>
  @livewireScripts
@endsection
