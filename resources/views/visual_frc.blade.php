
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BFC_DAF_Support</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="Logo-BFC.png" alt="AdminLTELogo" height="60" width="60">
    </div>

     <!-- Navbar -->
  @include('navbar')
  <!-- /.navbar -->
  @include('sidebar')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mx-1">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row mx-1">
                    <div class="invoice p-3 mb-3 col-12">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                                    <small class="float-right">Date: 2/10/2014</small>
                                </h4>
                            </div>
                        </div>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>Admin, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Phone: (804) 123-5432<br>
                                    Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f990979f96b9989594988a989c9c9d8a8d8c9d9096d79a9694">[email&#160;protected]</a>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                    <strong>John Doe</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (555) 539-1037<br>
                                        Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="dbb1b4b3b5f5bfb4be9bbea3bab6abb7bef5b8b4b6">[email&#160;protected]</a>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                    <br>
                                    <b>Order ID:</b> 4F3S8J<br>
                                    <b>Payment Due:</b> 2/22/2014<br>
                                    <b>Account:</b> 968-34567
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Product</th>
                                                <th>Serial #</th>
                                                <th>Description</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Call of Duty</td>
                                                <td>455-981-221</td>
                                                <td>El snort testosterone trophy driving gloves handsome</td>
                                                <td>$64.50</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                                </div>

                                <div class="col-6">
                                    <p class="lead">Amount Due 2/22/2014</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>$250.30</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                    Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer">
      <strong>Allez sur le site officiel <a href="https://www.bfclimited.com/">BFC.com</a>.</strong>
      <div class="float-right d-none d-sm-inline-block">
        <b></b>
      </div>
    </footer>

    <!-- Control Sidebar (controleur de l'affichage) -->
    {{-- <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside> --}}
    <!-- /.control-sidebar -->
{{-- </div> --}}
  <!-- ./wrapper -->

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
  </body>
  </html>


