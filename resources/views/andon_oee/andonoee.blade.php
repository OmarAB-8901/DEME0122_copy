@extends('andon_oee.contenido')

@section('andonoee')
<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                    <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Línea 1 Real Time</h2>
                    {{-- <input type="date" class="form-control" name="date" id="date" value="{{$date}}">      --}}
                    <hr class="sidebar-divider">
            </div>
            
            <div class="card-body">
                {{-- <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-1">
                                <button  class="btn btn-success btn-icon-split" id="b_dia" name="b_dia">Por Dia</button>
                                <br>
                                <br>
                                <button  class="btn btn-success btn-icon-split" id="b_mes" name="b_mes">Por Mes</button>
                                
                            </div>
                            <div class="col-lg-2">
                                <label class="form-control-label" for="fecha" style="color:rgb(0,51,100)">Selecciona una fecha:</label><br>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="i_dia" name="dia" placeholder="YYYY-MM-DD"/>
                                    <input type="text" class="form-control" id="i_mes" name="mes" placeholder="YYYY-MM" style="display: none;"/>
                                    <input type="hidden" class="form-control" id="i_date" name="date"/>
                                    <input type="hidden" class="form-control" id="i_caso" name="caso"/>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div> --}}
                <hr class="sidebar-divider">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="border-color:#84329B">
                            <div class="card-header py-3" style="background-color:#008000;border-color:#008000"> 
                                <h4 class="m-0 font-weight-bold" style="text-align:center;color:white;">OEE</h4>
                             </div>
                            <div class="card-body">
                                <div class="col-xl-12">
                                    <center>
                                            <img src="{{ asset('img/gauge-stage-oee2.png')}}" width="500" heigth="500">
                                            {{-- <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">2</h1> --}}
                                        
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- Default Card Example -->
                                <div class="card shadow mb-4" style="border-color:#84329B">
                                    <div class="card-header py-3" style="background-color:#37a2da;border-color:#37a2da">
                                        <h4 class="m-0 font-weight-bold" style="text-align:center;color:white;">Performance</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-12" >
                                                <center>
                                                    <img src="{{ asset('img/gauge-stage-oee3.png')}}" width="300" heigth="300">
                                                    {{-- <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">6</h1> --}}
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <!-- Default Card Example -->
                                <div class="card shadow mb-4" style="border-color:#84329B">
                                    <div class="card-header py-3" style="background-color:#008000;border-color:#008000">
                                        <h4 class="m-0 font-weight-bold" style="text-align:center;color:white;">Quality</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-12" >
                                                <center>
                                                       <img src="{{ asset('img/gauge-stage-oee1.png')}}" width="300" heigth="300">
                                                       {{-- <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">6</h1> --}}
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <!-- Default Card Example -->
                                <div class="card shadow mb-4" style="border-color:#84329B">
                                    <div class="card-header py-3"style="background-color:#fd666d;border-color:#fd666d">
                                        <h4 class="m-0 font-weight-bold" style="text-align:center;color:white;">Availability</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-12" >
                                                <center>
                                                       <img src="{{ asset('img/gauge-stage-oee4.png')}}" width="300" heigth="300">
                                                       {{-- <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality">6</h1> --}}    
                                                </center>
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
</div>
@endsection
@section('scripts')
{{-- <script src="{{ asset('js/andon.js')}}"></script>
<script src="{{ asset('js/andon5.js')}}"></script> --}}
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
     
    $(function () {
        $('#i_dia').datepicker({
            format: "yyyy-mm-dd"
            }).datepicker("setDate", new Date());
        $('#i_mes').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months"
            });
        $('#i_year').datepicker({
                    format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });

        });   
</script>
<script>
$(document).ready(function () {
    $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
    $('#i_dia').keyup(function () {
        var fecha = $(this).val();
        $('#i_date').val(fecha);
    });
});
$(document).ready(function () {
    $('#i_mes').keyup(function () {
        var fecha = $(this).val();
        $('#i_date').val(fecha);
    });
});
</script>
<!-- Page level custom scripts -->
@endsection