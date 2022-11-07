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
    <link href="{{ asset('css/boton3d.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/sweetalert/sweetalert2.css') }}" rel="stylesheet" type="text/css" />

</head>
<body id="page-top">
    
  <!-- Page Wrapper -->
  <div id="wrapper">
    @if(Auth::check())
        @if (Auth::user()->hasRole('Lider'))
        @elseif (Auth::user()->idgroup==1)
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
                    <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/Mammotome.png')}}" height="50">
                    </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                @if(Auth::check())
                        @if (Auth::user()->hasRole('admin'))
                            @include('menu.menuadministrador')
                        @elseif (Auth::user()->idgroup==1)
                            @include('menu.menuusuario')
                        @endif

                @endif
                
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle">
                    </button>
                </div>

            </ul>
            <!-- End of Sidebar -->
        @endif
    
    @endif

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    @if (Auth::user()->hasRole('Lider'))
                        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
                            <div class="sidebar-brand-icon">
                                <img src="{{asset('img/Mammotome.png')}}" alt="" height="50">
                            </div>
                        </a>
                    @endif

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/icono_usuario.png')}}" alt="" height="25">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="color:rgb(0,51,100)" > {{ Auth::user()->name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Cerrar Sesión
                                </a>
                            </div>
                        </li>
                        {{-- <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="sidebar-brand-icon">
                                <img src="{{asset('img/Logo_Sinci.svg')}}" alt="" height="60">
                            </div>
                        </li>  --}}
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                
                    @yield('contenido')
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color:rgb(0,51,100)">¿Listo para salir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body" style="color:rgb(0,51,100)">Da click en cerrar para salir</div>
                <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="{{ route('logout')}}" 
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Cerrar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                </form>
                </div>
            </div>
        </div>
    </div>

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
