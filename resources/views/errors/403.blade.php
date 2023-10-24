@extends('layouts.master_auth')

@section('title', 'Voir une demande')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="mb-2 col-md-12 col-12 text-center">
            <h3 class="content-header-title">Bien vouloir choisir votre entité et fonction associée</h3>
        </div>
    </div>
    <div class="content-body"><!-- Zero configuration table -->
        <section id="configuration">
            <div class="row">
                @foreach (auth()->user()->user_entity as $entity)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="text-center">
                                <div class="card-body">
                                    <img src="{{ asset('images/' . $entity->entity->logo) }}" class="rounded-circle  height-150" alt="Card image">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</h4>
                                    @if($entity->fonctions->count() <= 1)
                                        <div class="row">
                                            <div class="col-md-12 border-top pt-4">
                                                <form action="{{ route('entity.post', $entity->fonctions->first()->id) }}" method="post">
                                                    @csrf

                                                    <div class="form-group row">
                                                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                                                            <h6 class="card-subtitle">
                                                                {{ $entity->fonctions->first()->fonction }} :
                                                            </h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="ft-log-out"></i>
                                                                Se connecter
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            @foreach ($entity->fonctions as $fonction)
                                                <div class="col-md-12 border-top pt-4">
                                                    <form action="{{ route('entity.post', $fonction->id) }}" method="post">
                                                        @csrf

                                                        <div class="form-group row">
                                                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                                                <h6 class="card-subtitle">
                                                                    {{ $fonction->fonction }} :
                                                                </h6>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="ft-log-out"></i>
                                                                    Se connecter
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <a class="btn btn-warning" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="icon-login"></i> Se déconnecter ici
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
{{-- -------------------------------- styles -------------------------------------- --}}

@section('styles')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.min.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/invoice.min.css') }}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/miniColors/jquery.minicolors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/spectrum/spectrum.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/pickers/colorpicker/colorpicker.min.css') }}">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet"> --}}

@endsection
{{-- --------------------------------scripts -------------------------------------- --}}
@section('scripts')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>
    <!-- END: Page JS-->


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/invoices-list.min.js') }}"></script>
    <!-- END: Page JS-->


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-repeater.min.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/miniColors/jquery.minicolors.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/spectrum/spectrum.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pickers/colorpicker/picker-color.min.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <!-- END: Page JS-->

@endsection

