@extends('andon_lider.contenido')
@section('andonlider')
<div class="container-fluid" id="principal">
    <!--Declaracion de variables-->
    <input type="hidden" id="IdStation" name="IdStation" value="0">
    <input type="hidden" id="AyudaPLC" name="IdStation" value="0">
    <!------------------------------    END OF VARIABLES    ------------------------------------->
    <div class="row">
        <div class="col-xl-12" id="menu">

            <nav class="navbar  ">
                <a class="navbar-brand" href="#">
                    <img src="/img/Mammotomelarge.jpg" width="506" height="60" alt=""> </a>

                @foreach($linea as $varline)
                <input type="hidden" id="lineId" name="lineId" value="{{$varline['id']}}"> </input>
                <input type="hidden" id="lineDesc" name="lineDesc" value="{{$varline['name']}}"> </input>
                <input type="hidden" id="lotIdH" name="lotIdH" value="1"> </input>
                <h2 id="lineName" class="display-5 text-dark ">Andon: {{$varline['name']}}</h2>
                <div>
                    <h4 id="clock" class="text-dark"></h4>
                </div>
                @endforeach
                {{-- <input type="date" class="form-control" name="date" id="date" value="{{$date}}"> --}}
            </nav>
        </div>
    </div>
    <!------------------------------    END OF TITLE  ------------------------------------------>
    <div class="row" id="contenido">
        <div class="col-xl-4" id="panelLeft">
            <div class="row" id="ordenTrabajo">
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header  bg-devicorinfo  rounded" id="HeaderWorkOrder">
                            <h3 class="m-0 font-weight-bold text-primary text-light " style="text-align:center">Orden de Trabajo</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row form-group">
                                        <div class="col-xl-12">
                                            <label for="planes" class="text-black">Seleccione orden de trabajo:</label>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xl-8">
                                            <!-- <select name="planes" id="planes" class="form-control  form-select" aria-label="Seleccione"></select> -->
                                            <input type="text" name="planes" id="planes" class="form-control  form-select" aria-label="Seleccione" list="allPlanes">
                                            <datalist id="allPlanes" class="testDataList"></datalist>
                                        </div>
                                        <div class="col-xl-4">
                                            <button class="btn btn-block bg-devicor form-control text-white " onClick=" f_SetPlan()">Cambiar.</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row form-group">
                                            <div class="col-xl-4 ">Modelo</div>
                                            <div class="col-xl-8">Descripci&oacute;n</div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-xl-4" id="lblModelo">#Modelo</div>
                                            <div class="col-xl-8" id="lblDescripcionModelo">#Descripci&oacute;n</div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-xl-6">Piezas/hora</div>
                                            <div class="col-xl-6">Plan</div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-xl-6" id="lblPiezasHora">#Piezas/Hora</div>
                                            <div class="col-xl-6" id="lblPlan">#Plan</div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!------------------   FIN DE ORDEN DE TRABAJO --------------------------------->
            <div class="row" id="Defectos">
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header  bg-devicorinfo  rounded" id="HeaderWorkOrder">
                            <h3 class="m-0 font-weight-bold text-primary text-light " style="text-align:center">Defectos</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row form-group">
                                        <div class="col-xl-6">
                                            <label for="txtCantidad">Cantidad</label>
                                        </div>
                                        <div class="col-xl-6">
                                            <input type="text" value="" placeholder="Cantidad..." id="txtcantidad" class="form">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xl-6">
                                            <label for="txtDefecto">Codigo Defecto:</label>
                                        </div>
                                        <div class="col-xl-6">
                                            <input type="text" value="" placeholder="Codigo Defecto..." id="txtcodigo" class="form">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xl-12">
                                            <button id="btnReportar" onclick="f_reportarDefecto()" class="btn btn-lg btn-block bg-devicor text-white">Reportar</button>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row form-group">
                                                <div class="col-xl-4">
                                                    <button id="btn1" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">3007</button>
                                                </div>
                                                <div class="col-xl-4">
                                                    <button id="btn2" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">3008</button>
                                                </div>
                                                <div class="col-xl-4">
                                                    <button id="btn3" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">3009</button>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-xl-4">
                                                    <button id="btn5" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">7007</button>
                                                </div>
                                                <div class="col-xl-4">
                                                    <button id="btn5" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">7008</button>
                                                </div>
                                                <div class="col-xl-4">
                                                    <button id="btn6" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">7009</button>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-xl-4">
                                                    <button id="btn5" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">15007</button>
                                                </div>
                                                <div class="col-xl-4">
                                                    <button id="btn8" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">15008</button>
                                                </div>
                                                <div class="col-xl-4">
                                                    <button id="btn9" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">15009</button>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-xl-4">
                                                    <button id="btn10" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">21007</button>
                                                </div>
                                                <div class="col-xl-4">
                                                    <button id="btn11" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">21008</button>
                                                </div>
                                                <div class="col-xl-4">
                                                    <button id="btn12" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">21009</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div> <!--Fin de Cardbody----->
                    </div>
                </div>
            </div> <!------------------   FIN DE DEFECTOS--------------------------------->

        </div> <!-----------------------  FIN DE PANEL LEFT---------------------------------------->
        <div class="col-xl-8" id="panelCenter">
            <div class="row" id="rowEstadistica">
                <div class="col-xl-12">
                    <div class="card shadow rounded">
                        <div class="card-header bg-devicorinfo rounded" id="HeaderPanelCenter">
                            <h3 class="m-0 font-weight-bold text-primary text-light " id="labelPanelCenter" style="text-align:center">Estadistica de trabajo</h3>
                        </div>
                        <div class="card-body rounded">
                            <div class="row">
                                <div class="col-xl-12" id="cardBodyCenter"></div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12" id="tblPersonalOpcion"></div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12" id="tblPersonalOpcion2"></div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card shadow">
                                        <div class="card-header  bg-devicorinfo  rounded" id="HeaderWorkOrder">
                                            <h3 class="m-0 font-weight-bold text-primary text-light " style="text-align:center">Eficiencia de la linea:</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="echarts" id="chart-panel_avance" style="width: 700px; height:250px;"></div>
                                        </div>
                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!------------------   FIN DE ESTADISTICA DE TRABAJO --------------------------------->



            </div> <!------------------   FIN DE PANEL CENTER --------------------------------->

        </div> <!---------------------------    FIN DE CONTENIDO-------------------------------------------->

    </div><!------------------------------      END OF PRINCIPAL    --------------------------------------------------------->

    @endsection
    @section('scripts')
    <script>
        var timeEscuchaPLC;
        var escuchaSolicitud = 2000;
        var myChart_avance;

        $(document).ready(function() {
            vstation = $('input[name="lineId"]').val();
            timeEscuchaPLC = setInterval(f_ListenPLC, escuchaSolicitud);

            window.addEventListener('resize', function() {
                // myChart_oee.resize();
                myChart_avance.resize();
                //myChart_defectos.resize(); Se quita porque me indican que no es de utilizad 20221217

            });

            f_get_estado2(); //Traerse la información de todos los planes de la linea             
            f_set_catScrap();
            f_ConInfoAndon();
            f_get_station(vstation);
            f_util_get_local_help();
            f_save_UrlServerAPIs(); //Set URL Routes local storage
            f_set_dataLine(); //Set into local storage dataline
            f_setClock(); //Set the time permanently;
            //Load the andon's information OEE, Events and WorkPlan, the graphical status
            f_GetEventsType()

            //Listen PLC's signals

            setInterval(async () => {
                let lotId = document.getElementById('lotIdH').value;
                await calculateEficienciaLinea(true, lotId);
            }, 2000);
        });
        /* 
        window.addEventListener('resize',function(){
        myChart.resize();
        });*/

        function f_set_dataLine() {
            var vLine = $('input[name="lineId"]').val();
            var vDesc = $('input[name="lineDesc"]').val();
            var vStation = 0;
            var vSolarea = 0;
            var vSolareaName = "";
            f_save_LineData(vLine, vDesc, vStation, vSolarea, vSolareaName);
        }
    </script>
    <script src="{{ asset('vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{ asset('vendor/moments/moment.min.js')}}"></script>
    <script src="{{ asset('js/efficiency.js')}}"></script>
    <script src="{{ asset('js/andonRequest.js')}}"></script>
    <script src="{{ asset('js/andonCore.js')}}"></script>
    <script src="{{ asset('js/andonUtils.js')}}"></script>
    <script src="{{ asset('js/andonChart.js')}}"></script>

    @endsection