<div class="col-xl-3 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                <h6 class="m-0 font-weight-bold text-primary">Controles</h6>  
            </div>
            <div class="card-body">
                <div class="row align-items-start"> 
                <div class="row">
                        <div class="col-12 col-sm-12" ><h6 style="color:rgb(0,51,100);text-align:center">Para mostrar las tendencias</h6></div>
                    </div>
                    <div class="input-group" style="text-align:center">
                        <div class="col-md-6">
                            <button  class="btn btn-success btn-icon-split" id="b_dia" name="b_dia">Por Dia</button>
                        </div>
                        <div class="col-md-6">
                            <button  class="btn btn-success btn-icon-split" id="b_mes" name="b_mes">Por Mes</button><br>
                        </div>
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <label class="form-control-label" for="fecha" style="color:rgb(0,51,100)">Selecciona una fecha:</label><br>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <input type="text" class="form-control" id="i_dia" name="dia" placeholder="YYYY-MM-DD"/>
                        <input type="text" class="form-control" id="i_mes" name="mes" placeholder="YYYY-MM" style="display: none;"/>
                        <input type="hidden" class="form-control" id="i_date" name="date"/>
                        <input type="hidden" class="form-control" id="i_caso" name="caso"/>
                    </div>
                    
                </div>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <h4 style="color:rgb(0,51,100)">Exportar Reporte</h4>
                <div style="text-align: center;">
                    <img src="{{ asset('img/icono_descargar.svg')}}" height="30">
                    <button class="btn btn-success btn-icon-split" id="exportA" name="exportA">
                        <span class="text">Descargar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    