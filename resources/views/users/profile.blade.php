@extends('layouts.master')

@section('title')
Mon profil
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
          <h1 class="m-0">Mon profil</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Mon profil</li>
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
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/default_profil.jpg') }}" alt="User profile picture">
                            </div>
                                <h3 class="profile-username text-center{{ asset('images/default_profil.jpg') }}">{{ auth()->user()->lname}} {{ auth()->user()->fname }}</h3>
                                {{-- <p class="text-center text-muted">Software Engineer</p> --}}
                            </div>
                        </div>
                    </div>


                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="text-left">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="ml-1 card-title"> Modifier mes informations</h4>
                                        </div>
                                        <div class="col-12">
                                            <form action="{{ route('users.update', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fname">Nom</label>
                                                                    <input type="text" name="fname" id="fname" value="{{ old('fname', auth()->user()->fname) }}" class="form-control  @error('fname') is-invalid @enderror" placeholder="Nom" required>
                                                                    @error('fname')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="lname">Prénom</label>
                                                                    <input type="text" name="lname" id="lname" value="{{ old('lname', auth()->user()->lname) }}" class="form-control  @error('lname') is-invalid @enderror" placeholder="Prénom"  required>
                                                                    @error('lname')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">E-mail</label>
                                                                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="form-control  @error('email') is-invalid @enderror" placeholder="E-mail" required>
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone">Téléphone</label>
                                                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-control  @error('phone') is-invalid @enderror" placeholder="Téléphone" required>
                                                                    @error('phone')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="password">Mot de passe</label>
                                                                    <input type="password" name="password" id="password" class="form-control @error('password')
                                                                        is-invalid
                                                                    @enderror" placeholder="Mot de passe">
                                                                    @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="password-confirmation">Confirmation de mot de passe</label>
                                                                    <input type="password" name="password_confirmation" id="password-confirmation" class="form-control" placeholder="Confirmation de mot de passe">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer row" style="margin-right: 0px!important;margin-left: 0px!important;">
                                                    <div class="col" style="margin-left: -15px!important;">

                                                    </div>
                                                    <div class="col" style="margin-right: -15px!important;">
                                                        <button type="submit" class="float-right btn btn-success">
                                                            <i class="ft-plus"></i>
                                                            Mettre à jour
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
                                {{-- Gestion de fonction --}}
                    {{-- <div class="table-responsive">
                        <h4 class="ml-1 card-title"> Gestion des fonctions</h4>
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#N°</th>
                            <th>Fonction</th>
                            <th>Grade</th>
                            <th>Département</th>
                            <th>Cathégorie</th>
                            <th>Echélon</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                    <tr>
                                        <td>{{ old('email', auth()->user()) }}</td>
                                        <td>{{ old('email', auth()->user()->email) }}</td>
                                        <td>{{ old('email', auth()->user()->email) }}</td>
                                        <td>{{ old('email', auth()->user()->email) }}</td>
                                        <td>{{ old('email', auth()->user()->email) }}</td>
                                        <td>{{ old('email', auth()->user()->email) }}</td>
                                        <td>
                                            <a  href="{{ old('email', auth()->user()->email) }}" class="btn btn-primary">
                                                <i class="fa fa-eye"></i>
                                                Voir
                                            </a>
                                        </td>
                                    </tr>
                        </tbody>
                        </table>

                    </div>
                    <div class="table-responsive">
                        <h4 class="ml-1 card-title"> Gestion des rôles</h4>
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Rôle</th>
                            <th>Entité</th>
                            <th>Ville</th>
                            <th>pays</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                    <tr>
                                        <td>{{ old('email', auth()->user()->email) }}</td>
                                        <td>{{ old('email', auth()->user()->email) }}</td>
                                        <td>{{ old('email', auth()->user()->email) }}</td>
                                        <td>{{ old('email', auth()->user()->fonction) }}</td>
                                        <td>
                                            <a  href="{{ old('email', auth()->user()->email) }}" class="btn btn-primary">
                                                <i class="fa fa-eye"></i>
                                                Voir
                                            </a>
                                        </td>
                                    </tr>
                        </tbody>
                        </table>

                    </div> --}}
                </div>
            </div>
        </div>
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
