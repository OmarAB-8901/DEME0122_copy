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
            <a class="collapse-item" href="{{route('calidad')}}">Defectos</a>
            <a class="collapse-item" href="http://10.11.30.126/ReportServer/Pages/ReportViewer.aspx?%2fProduccion%2fscrap&rs:Command=Render" target="_blank">Reporte de catalogo scrap</a>
            <a class="collapse-item" href="http://10.11.30.126/ReportServer/Pages/ReportViewer.aspx?%2fProduccion%2freporteScrapCalidad&rs:Command=Render" target="_blank">Reporte de scrap</a>
        </div>
        </div>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider">

    
