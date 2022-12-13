@extends('andon_lider.contenido') 
@section('andonlider')

    <div class="container-fluid" id="principal">
        <!--Declaracion de variables-->
        <input type="hidden" id="IdStation" name="IdStation" value="0">
        <!--Falta trabajar con quien necesita ayuda el PLC-->
        <input type="hidden" id="AyudaPLC" name="IdStation" value="0">  
        <!------------------------------------------------------------>
        <div class="row">
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    
                    <nav class="navbar navbar-light bg-devicor">
                        
                        @foreach($linea as $varline)
                        <h2 id="lineName" class="display-5 text-light">Andon: {{$varline['name']}}                         
                       
                            <input type="hidden" id="lineId" name="lineId" value="{{$varline['id']}}"> </input>
                            <input type="hidden" id="lineDesc" name="lineDesc" value="{{$varline['name']}}"> </input>
                        </h2>     
                        
                        <div><h4 id="clock" class="text-light"></h4></div>
                        @endforeach                     
                        
                        {{-- <input type="date" class="form-control" name="date" id="date" value="{{$date}}">      --}} 

                    </nav>

                </div>         

            </div>
        </div>
        <!-------------------------------------------------------Fin de titulo-------------------------------------------------->
        <div class="row">
            <div class="col-xl-4 col-lg-4">       
                <div class="card shadow mb-4 rounded"  style="height: 740px" > <!--style="border-color:#84329B"-->
                    <div class="card-header py-3 bg-devicor rounded" id="HeaderWorkOrder" >
                        <h3 class="m-0 font-weight-bold text-primary text-light " style="text-align:center">Orden de Trabajo</h3>
                        
                    </div>
                    <div class="card-body rounded">
                        <!--div class="row">
                            <div clsaa="col-xl-12">                            
                                <button id="btnEstablecerplan"  onClick="f_SetPlan()"><h4>&nbsp;Establecer Plan</h4></button>
                            </div>
                        </-div>-->
                       
                        <div class="row">
                            <div clsaa="col-xl-12">
                            <table class="table" id="orden">
                            <tr>
                                <td><select name="planes" id="planes" class="form-select" aria-label="Default select example">
                                <option value="1">F12201230D CA000335003</option>
                                <option value="2">F12150403D CA000335004</option>
                                <option value="3">F12201284D CA000335004</option> 
                            </select></td>
                                <td><button class="btn btn-block bg-devicor" onClick="f_writeDataOK(500)" >Cambiar producci&oacute;n</button></td>
                            </tr>
                            <tr> 
                                <td>Captura de defectos:</td>
                                <td><input type="text" value=""  placeholder="Cantidad..." class="form"></td>
                            </tr>
                            <tr> 
                                <td><button id="3003" class="btn bg-gold  btn-lg btn-block bg-secondary text-white" >3005</button></td>
                                <td><button id="7003" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">3007</button></td>
                            </tr>
                            <tr> 
                                <td><button id="3003" class="btn bg-gold  btn-lg btn-block bg-secondary text-white" >3008</button></td>
                                <td><button id="7003" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">7004</button></td>
                            </tr>
                            <tr> 
                                
                                <td><button id="7006" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">7006</button></td>
                                <td><button id="7008" class="btn bg-gold  btn-lg btn-block bg-secondary text-white">7010</button></td>
                            </tr>
                                
                        </table>
                            </div>
                           
                                            
                        </div>
                      
                        @foreach($work_order as $var)
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">#Modelo</label>                                        
                                </div>
                                <div class="form-group col-md-10">                                        
                                    <input type="text" class="form-control" name="modelo" placeholder="Modelo" value="{{$var['model']}}" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">Descripción</label>
                                </div>
                                <div class="form-group col-md-10">
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción" value="{{$var['description']}}" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputCity">Pzs x Hora</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input type="text" class="form-control" name="ict" placeholder="Pzs x Hora" value="{{$var['valor_std']*60}}" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="form-group col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                            <label for="inputZip">Plan</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                            <input type="text" class="form-control" name="plan" placeholder="Plan" value="{{$var['plan']}}" readonly="readonly">
                                    </div>
                                </div>
                            </div>  
                            </div>      
                        @endforeach 
                    </div>
                </div>

            </div>
            <div class="col-xl-4 col-lg-4">    
                <div class="card shadow mb-4"  style="height: 740px" >
                    <div class="card-header py-3 bg-devicor" id="HeaderActual">
                        <h3 class="m-0 font-weight-bold text-primary  text-primary text-light" style="text-align:center">Estado Actual L&iacute;nea</h3>
                        
                    </div>
                    <div class="card-body">
                    <div class="echarts" id="chart-panel_avance" style="width: 400px; height:20%;"></div>  
                    <div class="echarts" id="chart-panel_oee" style="width: 300px; height:90%;"></div>     
                        <table id="estado" class="table">
                        <tr>
                        
                        </tr>
                        <tr>
                            <td>
                            
                            </td>

                        </tr>


                        </table>
                       
                       
                       
                       
                        
                    </div>
                </div>                                 
            </div>
            <div class="col-xl-4 col-lg-4">  
                <div class="card shadow mb-4"  style="height: 740px" >
                    <div class="card-header py-3 bg-devicorlight text-primary text-light bg-devicor" id="HeaderEficiencia"> 
                        <h2 class="m-0 font-weight-bold text-primary  text-light" style="text-align:center">Incidencias</h2>                        
                    </div>
                    <div class="card-body">
                        <div calss=row>
                            <div class="col-xl-12" id="Incidencia"><h4>Paros en la linea: 00:10:00 </h4></div>
                        </div>
                        <div class="row">
                            <table class="table" id="consola">
                                
                                
                            </table>
                        </div>
                       
                         
                        
                    <hr>
                        
                    </div>
				  </div>
            </div>   
            <!------------------------------------------------------Fin de gauge eiciencia------------------------------------------->

        </div>
        
 
     

       
        
            <!--div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-Warning" data-dismiss="modal">Cerrar</button>
            </!div-->        
        </div>
    </div>
</div>

</div> <!--------------------------------------------End of container fluid------------------------------------------>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){  
            vstation=$('input[name="lineId"]').val();
            f_ConInfoAndon();  
                
                        window.addEventListener('resize',function(){
                                myChart_oee.resize();
                                myChart_avance.resize();
                              
                        });
                
                
                f_get_selected();
                f_get_station(vstation);
                f_util_get_local_help();                       
                f_save_UrlServerAPIs();      //Set URL Routes local storage
                f_set_dataLine();           //Set into local storage dataline
                f_setClock();               //Set the time permanently;
                         //Load the andon's information OEE, Events and WorkPlan, the graphical status
                f_ListenPLC();   
              
                        //Listen PLC's signals
            });
                                            /* 
                                            window.addEventListener('resize',function(){
                                            myChart.resize();
                                            });*/

            function f_set_dataLine(){
                var vLine = $('input[name="lineId"]').val();
                var vDesc = $('input[name="lineDesc"]').val();    
                var vStation = 0;
                var vSolarea =0;
                var vSolareaName="";
                f_save_LineData(vLine,vDesc,vStation,vSolarea,vSolareaName);     
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