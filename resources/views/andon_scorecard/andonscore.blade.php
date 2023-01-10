@extends('andon_scorecard.contenido')

@section('andonscore')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header  bg-devicor   rounded">
                    @foreach($machines as $machine)
                    <div class="row">
                    <div class="bg-white rounded-circle ">
                                <img src="/img/MammotomePurple300x300.png" width="80"  alt="">                        
                        </div>
                       <div class="col-xl-12 bg-devicor">
                      
                                    <div class="row">
                                        <div class="col-xl-8 col-lg-12" id="lbllinea">
                                            
                                        </div>
                                        <div class="col-xl-4 col-lg-12">
                                            <h4 id="clock" class="text-white" style="text-align:right"></h4>

                                        </div>
                               
                        </div> 
                      
                
                    </div>  


                    </div>                       
                                            
                        <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$machine['name']}}">
                        <input type="hidden" class="form-control" name="idmachine" id="idmachine" value="{{$machine['id']}}">
                        <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">   
                        </div> 
                        

                    </div>
                    
               
                   
                   
                @endforeach
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-xl-12"  " >
                        <div class="card" id="tblbodyScoredCard">

                        </div>
                        




                    </div>                    
                </div>
                <div class="row" id="tblgraphScoreTotal">
                   
                            <div class="col-xl-3"   >
                                <div class="card border-success mb-3" >
                                        <div class="card-header bg-success text-white border-success " style="text-align:center" ><h2>OEE</h2></div>
                                        <div class="card-body text-success" id="tblgraphScoredCard" style="width: 400px;height:390px; display:''" ></div>
                                        <div class="card-footer bg-devicorinfo border-success text-white"  style="text-align:center" id="act_oee" >Actualizaci&oacute;n</div>
                                </div>                            
                            </div>    
                            <div class="col-xl-3" >
                            <div class="card border-success mb-3" >
                                    <div class="card-header bg-success text-white border-success" style="text-align:center"><h2>Rendimiento</h2></div>
                                    <div class="card-body text-success" id="tblgraphPerformance" style="width: 400px;height:390px; display:''" >                        
                                    </div>
                                    <div class="card-footer bg-devicorinfo border-success text-white"  style="text-align:center" id="act_performance">Actualizaci&oacute;n</div>
                                </div>
                            </div>    
                            <div class="col-xl-3"  >
                                <div class="card border-success mb-3" >
                                        <div class="card-header bg-success text-white border-success " style="text-align:center"><h2>Calidad</h2></div>
                                        <div class="card-body text-success" id="tblgraphQuality" style="width: 400px;height:390px; display:''" > </div>
                                        <div class="card-footer bg-devicorinfo border-success text-white"  style="text-align:center" id="act_quality" >Actualizaci&oacute;n</div>
                                </div>
                            </div> 
                            <div class="col-xl-3"  >
                                <div class="card border-success mb-3" >
                                        <div class="card-header bg-success text-white border-success" style="text-align:center"><h2>Disponibilidad</h2></div>
                                        <div class="card-body text-success" id="tblgraphAvailability" style="width: 400px;height:390px; display:''" > </div>
                                        <div class="card-footer bg-devicorinfo border-success text-white"  style="text-align:center" id="act_availabiility" >Actualizaci&oacute;n</div>
                                </div>
                            </div> 
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>    
var myChart
     $(document).ready(function(){  
        f_setClock();  
         myChart = echarts.init(document.getElementById('tblgraphScoredCard'));
           myChart.setOption(option_oee);

         myChartPerformace=echarts.init(document.getElementById('tblgraphPerformance')) ;
         myChartPerformace.setOption(option_performace)
                     

        myChartQuality= echarts.init(document.getElementById('tblgraphQuality')) ;
        myChartQuality.setOption(option_quality)  

        myChartAvailability= echarts.init(document.getElementById('tblgraphAvailability')) ;
        myChartAvailability.setOption(option_availability)
        
         timeEscuchaPLC= setInterval(f_timeDashboard ,10000);       

                              
     });


</script>
<script src="{{ asset('vendor/echarts/echarts.min.js')}}"></script>


{{-- <script src="{{ asset('js/andon.js')}}"></script>
<script src="{{ asset('js/andon5.js')}}"></script> --}}
<script src="{{ asset('js/andonscore.js') }}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/moments/moment.min.js')}}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<!-- Page level custom scripts -->
@endsection