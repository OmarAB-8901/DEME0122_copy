@extends('layouts.app')

@section('contenido')
<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                    <h1 class="m-0 font-weight-light text-primary font-italic display-3" style="text-align:center; font-family:Serif,Times New Roman,Brush Script MT;">Andon</h1>
                    {{-- <input type="date" class="form-control" name="date" id="date" value="{{$date}}">      --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-body">
                                <form action="{{route('const_work_order')}}" role="form" method="post"  class="form-horizontal">
                                    {{ csrf_field() }}
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <select class="form-control" name="work_order" required>
                                                    <option value="" disabled selected>Seleccione Orden de Trabajo</option>
                                                    @foreach($planes as $var)
                                                        <option value="{{$var['id']}}">{{$var['work_order']}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary">Cambiar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                    <hr class="sidebar-divider">
                                @foreach($work_order as $var)
                                    <div class="form-row">
                                      <div class="form-group col-md-8">
                                        <label for="inputEmail4">#Modelo</label>
                                        <input type="text" class="form-control" name="modelo" placeholder="Modelo" value="{{$var['model']}}" readonly="readonly">
                                      </div>
                                      <div class="form-group col-md-10">
                                        <label for="inputPassword4">Descripci??n</label>
                                        <input type="text" class="form-control" name="descripcion" placeholder="Descripci??n" value="{{$var['description']}}" readonly="readonly">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                         <div class="form-group col-md-6">
                                            <label for="inputCity">Pzs x Hora</label>
                                            <input type="text" class="form-control" name="ict" placeholder="Pzs x Hora" value="{{$var['valor_std']*60}}" readonly="readonly">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="inputZip">Plan</label>
                                            <input type="text" class="form-control" name="plan" placeholder="Plan" value="{{$var['plan']}}" readonly="readonly">
                                          </div>
                                    </div>
                                @endforeach    
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3" >
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Estado Actual</h2>
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Linea</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6" style="background-color:#008f39;border-color:#008f39">
                                        <center>
                                            <a>
                                               <h5 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">PIEZAS OK</h5>
                                               <img src="{{ asset('img/check.png')}}" width="40" heigth="40">
                                               <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">{{$piezas_ok}}</h1>
                                            </a>
                                        </center>
                                    </div>
                                    <div class="col-xl-6" style="background-color:rgb(213,77,84);border-color:rgb(213,77,84)">
                                        <center>
                                            <a>
                                                <h5 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">DEFECTOS</h5>
                                                <img src="{{ asset('img/icono_remove.png')}}" width="40" heigth="40">
                                                <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">{{$piezas_scrap}}</h1>
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-3">

                       <!-- Default Card Example -->
                       <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3"> 
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Eficiencia</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="echarts" id="chart-panel" style="width: 500px; height: 250px;"></div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg-6">
                                        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">0</h6>

                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">1435</h6>
                                    </div>

                                </div> --}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3"> 
                                <h5 class="m-0 font-weight-bold text-primary" style="text-align:center">Paros</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class=" col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(56, 115, 139)">MANTENIMIENTO</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(56, 139, 111)">CALIDAD</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(56, 115, 139)">MATERIALES</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(56, 139, 111)">PERSONAL</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(56, 115, 139)">SET UP</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(56, 139, 111)">OTROS</button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3"> 
                                <h5 class="m-0 font-weight-bold text-primary" style="text-align:center">Defectos</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class=" col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(128, 128, 128)">22001</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(128, 128, 128)">22005</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(128, 128, 128)">21001</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(128, 128, 128)">3002</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(128, 128, 128)">21007</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="boton3d" style="background-color:rgb(128, 128, 128)">48002</button>
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
               myChart.resize();
           });
      });
   
</script>
<script src="{{ asset('vendor/echarts/echarts.min.js')}}"></script>
<script src="{{ asset('js/efficiency.js')}}"></script>
@endsection