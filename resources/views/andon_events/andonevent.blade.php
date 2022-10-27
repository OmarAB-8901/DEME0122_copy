@extends('andon_events.contenido')

@section('andonevent')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                    
                @foreach($machines as $machine)
                    <h1 class="m-0 font-weight-bold text-primary" style="text-align:center">Alarmas {{$machine['name']}}</h1>
                    <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$machine['name']}}">
                    <input type="hidden" class="form-control" name="idmachine" id="idmachine" value="{{$machine['id']}}">
                    <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">
                @endforeach
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3"> 
                                <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Mantenimiento</h2>
                             </div>
                            <div class="card-body">
                                
                                <div class="col-xl-12" style="background-color:green;border-color:green">
                                    <center>
                                        <a>
                                            {{-- <img src="{{ asset('img/mantenimiento.png')}}" width="60" heigth="60"> --}}
                                            <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">2</h1>
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">

                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3">
                                <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Calidad</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12" style="background-color:rgb(0,161,203);border-color:rgb(0,161,203)">
                                        <center>
                                            <a>
                                               {{-- <img src="{{ asset('img/calidad.png')}}" width="60" heigth="60"> --}}
                                               <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">6</h1>
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
                                <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Materiales</h2>
                            </div>
                            <div class="card-body">
                                <div class="col-xl-12" style="background-color:gray;border-color:gray">
                                    <center>
                                        <a>
                                            {{-- <img src="{{ asset('img/materiales.png')}}" width="60" heigth="60"> --}}
                                            <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">4</h1>
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-3">

                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="border-color:#84329B">
                             <div class="card-header py-3"> 
                                <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Personal</h2>
                             </div>
                             <div class="card-body">
                                
                                <div class="col-xl-12" style="background-color:orange;border-color:orange">
                                    <center>
                                        <a>
                                            {{-- <img src="{{ asset('img/entrenamiento.png')}}" width="60" heigth="60"> --}}
                                            <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">5</h1>
                                        </a>
                                    </center>
                                </div>
                            </div>
                         </div>
 
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3"> 
                                <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Listado</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Inicio evento</th>
                                                <th>Fin Evento</th>
                                                <th>Descripción</th>
                                                <th>Línea</th>
                                                <th>Estación</th>
                                                <th>Tipo evento</th>
                                                <th>Duración</th>
                                            </tr>
                                        </thead>
                                      <tbody>
                                        <tr>
                                            <td>2022-09-13 15:34:04	</td>
                                            <td>2022-09-13 03:35:06</td>
                                            <td>El paro de emergencia</td>
                                            <td>Línea 77 Hydromark Pouch</td>
                                            <td>2</td>
                                            <td>Mantenimiento</td>
                                            <td>61</td>
                                        </tr>
                                        <tr>
                                            <td>2022-09-13 15:27:14	</td>
                                            <td>2022-09-13 03:27:39</td>
                                            <td>El paro de emergencia</td>
                                            <td>Línea 77 Hydromark Pouch</td>
                                            <td>4</td>
                                            <td>Mantenimiento</td>
                                            <td>24</td>
                                           </tr>
                                      </tbody>
                                    </table>
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
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<!-- Page level custom scripts -->
@endsection