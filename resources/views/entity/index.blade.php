@extends('layouts.master')

@section('title')
Configurations des entités
@endsection

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
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
          <h1 class="m-0">Liste des Entités</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Enregistrement des entité</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('body-section')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="card col-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center">
                            <h3 class="card-title">Journal des Entités</h3>
                        </div>

                        <div class="col-md-8">
                            <button class="float-md-right btn btn-primary" type="button"  data-toggle="modal" data-target="#addentity">
                                <i class="fa fa-user-plus"></i> Nouvelle Entité
                            </button>
                            <div class="text-left modal fade" id="addentity" tabindex="-1" role="dialog" aria-labelledby="addentity" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addentity"><i class="fa fa-user-plus"></i> Ajouter une entité</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{ route('entity.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-body">

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="title">Nom entité<span class="text-danger"><sub>*</sub></span></label>
                                                                <input type="texte" name="title" id="title" value="{{ @old('title') }}" class="form-control  @error('title') is-invalid @enderror" placeholder="Nom entité" required>
                                                                @error('title')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="sigle">Sigle<span class="text-danger"><sub>*</sub></span></label>
                                                                <input type="texte" name="sigle" id="sigle" value="{{ old('sigle') }}" class="form-control  @error('sigle') is-invalid @enderror" placeholder="Sigle" required>
                                                                @error('sigle')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="logo">Logo<span class="text-danger"><sub>*</sub></span></label>
                                                                <select id="logo" name="logo" class="form-control @error('logo') is-invalid @enderror" required>
                                                                    <option selected="" disabled="true"> ---- Choisir le logo ----</option>
                                                                    <option value="arec_logo.jpg"> Logo AREC</option>
                                                                    {{-- <option value="bfc_logo.png"> Logo BFC</option>
                                                                    <option value="dpws_logo.png"> Logo DPWS</option>
                                                                    <option value="bes_logo.jpeg"> Logo BES</option>
                                                                    <option value="bsm_logo.jpeg"> Logo BSM</option>
                                                                    <option value="esd_logo.jpeg"> Logo ESD</option>
                                                                    <option value="msd_logo.jpeg"> Logo MSD</option>
                                                                    <option value="tsd_logo.jpeg"> Logo TSD</option>
                                                                    <option value="wsd_logo.jpeg"> Logo WSD</option> --}}
                                                                    <option value="scoopts_tecast_logo.jpeg"> annonime</option>
                                                                </select>
                                                            </div>
                                                            @error('logo')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="city">ville</label>
                                                                <select id="city" name="city[]" class="select2 form-control  @error('city') is-invalid @enderror" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                                    <option selected="" disabled="true"> ---- Choisir une ville ----</option>
                                                                    @foreach ($cities as $city)
                                                                        <option value="{{ $city->id }}"> {{ $city->label }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('role')
                                                                <span class="invalid-feedback" city="alert">
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nom Entité</th>
                    <th>Sigle</th>
                    <th>Logo</th>
                    <th>Ville(s)</th>
                    {{-- <th>Action</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($configuration_entities as $configuration_entitie)
                      <tr>
                          <td>{{ $configuration_entitie->id }}</td>
                          <td>{{ $configuration_entitie->title }} </td>
                          <td>{{ $configuration_entitie->sigle }} </td>
                          <td>{{ $configuration_entitie->logo}} </td>
                          <td>
                            <ul style="padding-left: -25px!important">
                                @foreach ($configuration_entitie->city_entities as $city_entity)
                                    <li>{{ $city_entity->city->label }}</li>
                                @endforeach
                            </ul>
                          </td>
                          {{-- <td>
                              <a  href="{{ route('cash_register_supply_sheet.show', $fiche_approv_caisse->id) }}" class="btn btn-primary">
                                  <i class="fa fa-eye"></i>
                                  Voir
                              </a>
                          </td> --}}
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                    <th>N°</th>
                    <th>Nom Entité</th>
                    <th>Sigle</th>
                    <th>Logo</th>
                    <th>Ville(s)</th>
                    {{-- <th>Action</th> --}}
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
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
