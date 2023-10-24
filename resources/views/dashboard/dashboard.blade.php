@extends('layouts.master')

@section('title')
Tableau de bord
@endsection

@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

   <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0')}}">
@endsection

@section('header-section')
<div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0">Tableau de bord</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Accueil</a></li>
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
                <div class="col-lg-4 col-6">
                <!-- TB FAC-->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                {{ $nb_fac }}
                                <sup style="font-size: 20px"></sup>
                            </h3>

                            <p><br>Fiche(s) d'approvisionnement<br> caisse enregistrée(s)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('cash_register_supply_sheet.index')}}" class="small-box-footer">Consulter <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- TB FDE -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                {{ $nb_fd }}
                                <sup style="font-size: 20px"></sup>
                            </h3>

                            <p><br> Ficfe(s) de dépense <br> enregistrées</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('expense_sheet.encours')}}" class="small-box-footer">consultez <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                {{-- <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div> --}}
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- TB FSC -->
                    <div class="small-box bar bg-primary">
                        <div class="inner">
                            <h3>{{ $nb_frc }}</h3>

                            <p> <br> Fiche(s) de retour <br> caisse Enregistrées</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('return_to_cash_sheet.index')}}" class="small-box-footer">consultez <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            </div>

            <div class="row">
                <div class="col-lg-4 col-6">
                <!-- TB FAC-->
                    <div class="small-box bg-primary" style="--bs-bg-opacity: .5;">
                        <div class="inner">
                            <h3>
                                {{ $nb_dmd }}
                                <sup style="font-size: 20px"></sup>
                            </h3>

                            <p><br>DMD<br>  enregistrée(s)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('availability_request_sheet.index')}}" class="small-box-footer">Consulter <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- TB FDE -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                {{ $nb_fr }}
                                <sup style="font-size: 20px"></sup>
                            </h3>

                            <p><br> Ficfe(s) de recette <br> enregistrées</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('recipe_sheet.index')}}" class="small-box-footer">consultez <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                @if (auth()->user()->isAdmin() ||auth()->user()->isComptable_matiere())
                    <div class="col-lg-4 col-6">
                        <!-- TB FSC -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    {{ $nb_bsm }}
                                </h3>

                                <p> <br> Bon(s) de sortie matériel <br>Enregistrées</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('material_release_form.index')}}" class="small-box-footer">consultez <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div><!-- ./col -->
                @endif
            </div>

            {{-- @if (Auth::user()->role == "admin 2")

            @endif --}}
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script> --}}

<script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>
@endsection
