<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/sinci.ico')}}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Devicor Medical Products, Inc.</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    
    
    <!-- Styles -->
    <link href="{{ asset('css/fuentes.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/sweetalert/sweetalert2.css') }}" rel="stylesheet" type="text/css" />

</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
                        <div class="sidebar-brand-icon">
                            <img src="{{asset('img/Mammotome.png')}}" alt="" height="50">
                        </div>
                    </a>
                    <!-- Topbar Navbar -->

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                
                    @yield('andonevent')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <p class="elementor-heading-title elementor-size-default">&copy; {{ date("Y") }} Devicor Medical Products, Inc.</p>
                    <div class="copyright text-center my-auto">
                        <span><img src="{{ asset('img/Logo_Sinci_Simplificada.png')}}" height="20"></span>
                    </div>
                </div>
            </footer> 
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

  </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

   
   
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  
    @yield('scripts')
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.min.js')}}"></script>
    
    <script src="{{ asset('js/mspace.js') }}"></script>
    <script src="{{ asset('js/controlesyear.js') }}"></script>
    <script src="{{ asset('js/btnexport.js') }}"></script>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->

</body>
</html>
