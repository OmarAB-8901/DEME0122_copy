@extends('andon_oee.contenido')

@section('andonoee')
<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header " style="card-header py-3 bg-devicor rounded">
                @foreach($machines as $machine)
                    <h2 class="m-0  text-devicor" style="text-align:center">{{$machine['name']}} Tiempo Real</h2>
                    <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$machine['name']}}">
                    <input type="hidden" class="form-control" name="idmachine" id="idmachine" value="{{$machine['id']}}">
                    <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">
                @endforeach
                    <hr class="sidebar-divider">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- Default Card Example -->
                        <div class="card shadow mb-5" style="border-color:#84329B">
                            <div class="card-header py-3" style="background-color:#008000;border-color:#008000"> 
                                <h4 class="m-0 font-weight-bold" style="text-align:center;color:white;">OEE</h4>
                             </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="echarts" id="chart-panel_oee" style="width: 500px; height: 450px;"></div>                                     
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- Default Card Example -->
                                <div class="card shadow mb-4" style="border-color:#84329B">
                                    <div class="card-header py-3" style="background-color:#008f39;border-color:#008f39">
                                        <h4 class="m-0 font-weight-bold" style="text-align:center;color:white;">Eficiencia</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="echarts" id="chart-panel_prod" style="width: 500px; height: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <!-- Default Card Example -->
                                <div class="card shadow mb-4" style="border-color:#84329B">
                                    <div class="card-header py-3" style="background-color:#fd0000;border-color:#fd666d">
                                        <h4 class="m-0 font-weight-bold" style="text-align:center;color:white;">Calidad</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="echarts" id="chart-panel_cal" style="width: 500px; height: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <!-- Default Card Example -->
                                <div class="card shadow mb-4" style="border-color:#84329B">
                                    <div class="card-header py-3"style="background-color:#008f39;border-color:#008f39">
                                        <h4 class="m-0 font-weight-bold" style="text-align:center;color:white;">Disponibilidad</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="echarts" id="chart-panel_dis" style="width: 500px; height: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    $(document).ready(function()
       {
           window.addEventListener('resize',function(){
               myChart_oee.resize();
               myChart_cal.resize();
               myChart_dis.resize();
               myChart_prod.resize();
               f_callOEE();
           });
      });
   
</script>
<script src="{{ asset('vendor/echarts/echarts.min.js')}}"></script>
<script src="{{ asset('js/oee_andon.js')}}"></script>
@endsection