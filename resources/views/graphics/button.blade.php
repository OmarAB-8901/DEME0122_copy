@extends('layouts.app')

@section('contenido')
<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                    <h1 class="m-0 font-weight-bold text-primary" style="text-align:center">Andon</h1>
                    {{-- <input type="date" class="form-control" name="date" id="date" value="{{$date}}">      --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-body">
                                <form>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <select class="form-control" name="parte" required>
                                                    <option value="" disabled selected>Seleccione Parte</option>
                                                    @foreach($parts as $var)
                                                    <option value="{{$var['id']}}">{{$var['name']}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-control" name="linea" required>
                                                    <option value="" disabled selected>Seleccione línea</option>
                                                    @foreach($machines as $var)
                                                    <option value="{{$var['id']}}">{{$var['name']}} </option>
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
                                    <div class="form-row">
                                      <div class="form-group col-md-8">
                                        <label for="inputEmail4">#Parte</label>
                                        <input type="text" class="form-control" id="parte" placeholder="#Parte" readonly="readonly">
                                      </div>
                                      <div class="form-group col-md-10">
                                        <label for="inputPassword4">Descripción</label>
                                        <input type="text" class="form-control" id="descripcion" placeholder="Descripción" readonly="readonly">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                         <div class="form-group col-md-6">
                                            <label for="inputCity">Pzs x Hora</label>
                                            <input type="text" class="form-control" id="pzshora" placeholder="Pzs x Hora" readonly="readonly">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="inputZip">Plan</label>
                                            <input type="text" class="form-control" id="plan" placeholder="Plan" readonly="readonly">
                                          </div>
                                    </div>
                                    
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Estado Actual</h2>
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Linea</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6" style="background-color:rgb(0,161,203);border-color:rgb(0,161,203)">
                                        <center>
                                            <a>
                                               <h5 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">PIEZAS OK</h5>
                                               <img src="{{ asset('img/check.png')}}" width="40" heigth="40">
                                               <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">100</h1>
                                            </a>
                                        </center>
                                    </div>
                                    <div class="col-xl-6" style="background-color:rgb(213,77,84);border-color:rgb(213,77,84)">
                                        <center>
                                            <a>
                                                <h5 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">PIEZAS SCRAP</h5>
                                                <img src="{{ asset('img/icono_remove.png')}}" width="40" heigth="40">
                                                <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">20</h1>
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
                                <center>
                                    <a>
                                       <img src="{{ asset('img/gauge-speed.png')}}" width="350" heigth="350">
                                </center>
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
                                        <button type="submit" class="btn btn-primary" style="background-color:green">MANTENIMINIENTO</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:rgb(0, 26, 255)">CALIDAD</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:red">MATERIALES</button>
                                    </div>
                                    <div class="col-xl-1">
                                        <button type="submit" class="btn btn-primary" style="background-color:rgb(128, 128, 128)">PERSONAL</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:rgb(84, 135, 155)">VALIDACIONES</button>
                                    </div>
                                    <div class="col-xl-1">
                                        <button type="submit" class="btn btn-primary" style="background-color:rgb(74, 173, 74)">SEP UP</button>
                                    </div>
                                    <div class="col-xl-1">
                                        <button type="submit" class="btn btn-primary" style="background-color:rgb(113, 56, 139)">NO PLAN</button>
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
                                <h5 class="m-0 font-weight-bold text-primary" style="text-align:center">Scrap</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class=" col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:green">22001</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:rgb(0, 26, 255)">22005</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:rgb(66, 180, 85)">21001</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:red">3002</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:grey">21007</button>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-primary" style="background-color:rgb(128, 128, 128)">48002</button>
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
{{-- <script src="{{ asset('js/andon.js')}}"></script>
<script src="{{ asset('js/andon5.js')}}"></script> --}}
@endsection