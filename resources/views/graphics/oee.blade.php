@extends('layouts.app')

@section('contenido')
<div class="row">
    <div class="col-xl-9 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-body">
                @foreach($machines as $machine)
                    <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$machine['name']}}">
                    <input type="hidden" class="form-control" name="idmachine" id="idmachine" value="{{$machine['id']}}">
                    <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">
                @endforeach
                <div class="table-responsive" >
                    <div class="row" >
                        <div class="col-xs-3">
                            <canvas id="Canvas1" data-toggle="modal" data-target="#myModalDis" style="cursor: pointer;"></canvas>
                        </div>
                        <div class="col-xs-3">
                            <canvas id="Canvas2" data-toggle="modal" data-target="#myModalRen" style="cursor: pointer;"></canvas>
                        </div>
                        <div class="col-xs-3">
                           <canvas id="Canvas3" data-toggle="modal" data-target="#myModalCal" style="cursor: pointer;"></canvas>
                        </div>
                        <div class="col-xs-3">
                            <canvas id="Canvas4"></canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <canvas id="Canvas"></canvas>
                        </div>
                    </div>
                </div>
                @include('controles.comoee')
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="80%" cellspacing="0">
                    <thead>
                        <tr>
                        <th style="font-size:85%;">Date</th>
                        <th style="font-size:85%;">OEE</th>
                        <th style="font-size:85%;">Availability</th>
                        <th style="font-size:85%;">Performance</th>
                        <th style="font-size:85%;">Quality</th>
                        <th style="font-size:85%;">RunTime</th>
                        <th style="font-size:85%;">AvailableTime</th>
                        <th style="font-size:85%;">ICT</th>
                        <th style="font-size:85%;">TotalParts</th>
                        <th style="font-size:85%;">GoodParts</th>
                        <th style="font-size:85%;">PartId</th>
                        <th style="font-size:85%;">LotId</th>
                        <th style="font-size:85%;">Shift</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo">
                    </tbody>
                    </table>
              </div>
            </div>
        </div>
    </div>
    <!--Inicio del modal Loading-->
    <div class="modal fade" id="myModalLoading" aria-labelledby="myModalLoading" aria-hidden="true" style="lefto:auto">
                <div class="modal-dialog modal-primary modal-lg modal-dialog-centered " role="document">
                    <div class="modal-content" style="background:transparent; border:none; align-self: center;">
                        <div class="spinner-border text-dangerr" style="width:250px; height: 250px; align-self: center; color:rgb(128,34,36);" role="status"></div>
                        <br>
                        <h5 style="align-self: center; color:rgb(128,34,36);">Loading...</h5>
                    </div>
                </div>
    </div>
    <!--Fin Modal Loading -->
    @include('controles.fechaaño2')
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>
<script src="{{ asset('js/oeetemplate.js')}}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
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
<script src="{{ asset('js/selectfecha.js') }}"></script>
<script src="{{ asset('js/selectfechaid.js') }}"></script>
<script src="{{ asset('js/monitoreo.js')}}"></script>
@endsection
