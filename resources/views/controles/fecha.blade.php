<div class="col-xl-3 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                <h6 class="m-0 font-weight-bold text-primary">Controles</h6>  
            </div>
            <div class="card-body">
                <div class="row align-items-start"> 
                <h5 style="color:rgb(0,51,100)">Para mostrar las tendencias</h5>
                    <label class="form-control-label" style="color:rgb(0,51,100)" for="fecha">Selecciona un día:</label><br>
                    <div class="input-group">
                        <input type="text" class="form-control" id="i_dia" name="dia" placeholder="YYYY-MM-DD"/>
                    </div>
                    
                </div>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <h4 style="color:rgb(0,51,100)">Exportar Reporte</h4>
                <div style="text-align: center;">
                    <img src="{{ asset('img/icono_descargar.svg')}}" height="30">
                    <button class="btn btn-success btn-icon-split" id="exportT" name="exportT">
                        <span class="text">Descargar</span>
                    </button>
                </div>
            </div>
        </div>
</div>