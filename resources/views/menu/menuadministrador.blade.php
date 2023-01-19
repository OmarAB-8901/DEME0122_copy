 <!-- Nav Item - Dashboard -->
   
    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <center>
        <img src="{{ asset('img/icono_WorkCell_configuracion.png')}}" height="60">
        <br>
        <span>Configuración</span>
        </center>
        
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">componentes:</h6>
            <a class="collapse-item" href="{{route('machine')}}">Catálogo de l&iacute;neas</a>
            <a class="collapse-item" href="{{route('planes')}}">Plan de Producción</a>
            <a class="collapse-item" href="{{route('models')}}">Catálogo de Modelos</a>
            <!-- <a class="collapse-item" href="{{route('areas')}}">Catálogo de Áreas</a> -->
            <a class="collapse-item" href="{{route('areas')}}">Catálogo de Estaciones</a>
            <a class="collapse-item" href="{{route('scrap')}}">Catálogo de Scrap</a>
            {{-- <a class="collapse-item" href="{{route('variable')}}">Variables</a> --}}
            {{-- <a class="collapse-item" href="{{route('typeevent')}}">Catálogo de Eventos</a> --}}
            <a class="collapse-item" href="{{route('shift')}}">Catálogo de Turnos</a>
        </div>
        </div>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <center>
            <img src="{{ asset('img/icono_acceso.png')}}" height="60">
            <br>
            <span>Acceso</span>
        </center>
        
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">componentes:</h6>
            <a class="collapse-item" href="{{route('group')}}">Grupos</a>
            <a class="collapse-item" href="{{route('user')}}">Usuarios</a>
        </div>
        </div>
    </li>