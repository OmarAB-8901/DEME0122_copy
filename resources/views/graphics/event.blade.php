@extends('layouts.app')

@section('contenido')
<div class="row">
    <div class="col-xl-9 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                @foreach($machines as $machine)
                <h6 class="m-0 font-weight-bold text-primary" style="color:rgb(0,51,100)">Tiempos Muertos</h6>
                <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$machine['name']}}">
                <input type="hidden" class="form-control" name="idmachine" id="idmachine" value="{{$machine['id']}}">
                <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">
                @include('controles.editevent')
                @endforeach
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-lg-12">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Actualizar Justificación</th>
                                <th>Inicio evento</th>
                                <th>Fin Evento</th>
                                <th>Descripción</th>
                                <th>Justificación</th>
                                <th>Tipo evento</th>
                                <th>Duración</th>
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
    @include('controles.fechaaño')
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>
<script src="{{ asset('js/Paretos.js')}}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
$(function() {
    $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
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

$(document).ready(function() {
    $("#i_dia").click(function() {
        $('.datepicker').css("display", "block");
    });
    $("#i_dia").change(function() {
        $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
        var date = $('#i_dia').val();
        $('.datepicker').css("display", "none");
        $('#i_date').val(date);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/Events/' + idmachine + '/d/' + date + '/datos',
            type: 'GET',
            success: function(response) {
                chartData.labels.length = 0;
                chartData.datasets[0].data.length = 0;
                chartData.datasets[1].data.length = 0;

                //para limpiar el grid
                $("#dataTable").dataTable().fnDestroy();
                $("#cuerpo").empty();

                response[0].forEach(function(elemento, indice) {
                    chartData.labels.push(elemento['descriptions'])
                    chartData.datasets[1].data.push(elemento['Total'])
                    chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
                    maxy = elemento['Acumulado']

                });
                response[1].forEach(function(elemento, indice) {
                    var tr = `<tr>
                        <td>  
                        <button value="`+elemento['idevent']+`" OnClick='Mostrar(this);' data-toggle="modal" data-target="#myModalEdit" type="button" class="btn btn-primary2 btn-sm">
                            <img src="/img/icono_editar_actualizar.png" height="35">
                        </button> &nbsp;
                        </td>
                        <td>`+elemento['startTime']+`</td>`;
                        if (elemento['endTime'] != null){
                            tr = tr + `<td>`+elemento['endTime']+`</td>`
                            }else{
                                tr = tr + `<td></td>`
                            }
                         tr = tr + `<td>`+elemento['descriptions']+`</td>`;

                        if (elemento['justification'] != null){
                        tr = tr + `<td>`+elemento['justification']+`</td>`
                        }else{
                            tr = tr + `<td></td>`
                        }
                        tr = tr +`<td>`+elemento['event']+`</td>`;

                        if (elemento['duration'] != null){
                            tr = tr + `<td>`+elemento['duration']+`</td>`
                        }else{
                            tr = tr + `<td></td>`
                        }
                        tr = tr + `</tr>`
                    $("#cuerpo").append(tr)

                });
                $('#dataTable').DataTable({
                    "pageLength": 100,
                "searching": false
                });

                options.options.scales.yAxes[1].ticks.max = parseFloat(maxy)
                setTimeout(() => {
                    $('#myModalLoading').modal('hide');
                }, 3);
                window.myMixedChart.update()
            }
        });

    });
    $("#i_mes").click(function() {
        $('.datepicker').css("display", "block");
    });
    $("#i_mes").change(function() {
        $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
        var date = $('#i_mes').val();
        $('.datepicker').css("display", "none");
        $('#i_date').val(date);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/Events/' + idmachine + '/m/' + date + '/datos',
            type: 'GET',
            success: function(response) {
                chartData.labels.length = 0;
                chartData.datasets[1].data.length = 0;
                chartData.datasets[0].data.length = 0;

                response[0].forEach(function(elemento, indice) {

                    chartData.labels.push(elemento['descriptions'])
                    chartData.datasets[1].data.push(elemento['Total'])
                    chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
                    maxy = elemento['Acumulado']

                });
                //para limpiar el grid
                $("#dataTable").dataTable().fnDestroy();
                $("#cuerpo").empty();
                response[1].forEach(function(elemento, indice) {
                    var tr = `<tr>
                        <td>  
                        <button value="`+elemento['idevent']+`" OnClick='Mostrar(this);' data-toggle="modal" data-target="#myModalEdit" type="button" class="btn btn-primary2 btn-sm">
                            <img src="/img/icono_editar_actualizar.png" height="35">
                        </button> &nbsp;
                        </td>
                        <td>`+elemento['startTime']+`</td>`;
                        if (elemento['endTime'] != null){
                            tr = tr + `<td>`+elemento['endTime']+`</td>`
                            }else{
                                tr = tr + `<td></td>`
                            }
                        tr = tr + `<td>`+elemento['descriptions']+`</td>`;

                        if (elemento['justification'] != null){
                        tr = tr + `<td>`+elemento['justification']+`</td>`
                        }else{
                            tr = tr + `<td></td>`
                        }
                        tr = tr +`<td>`+elemento['event']+`</td>`;

                        if (elemento['duration'] != null){
                            tr = tr + `<td>`+elemento['duration']+`</td>`
                        }else{
                            tr = tr + `<td></td>`
                        }
                        tr = tr + `</tr>`
                    $("#cuerpo").append(tr)

                });
                $('#dataTable').DataTable({
                    "pageLength": 100,
                    "searching": false
                });
                options.options.scales.yAxes[1].ticks.max = parseFloat(maxy)
                setTimeout(() => {
                    $('#myModalLoading').modal('hide');
                }, 3);	 
                window.myMixedChart.update()
            }
        });
    });
    $("#i_year").change(function() {
        $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
        var date = $('#i_year').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/Events/' + idmachine + '/y/' + date + '/datos',
            type: 'GET',
            success: function(response) {
                chartData.labels.length = 0;
                chartData.datasets[1].data.length = 0;
                chartData.datasets[0].data.length = 0;

                //para limpiar el grid
                $("#dataTable").dataTable().fnDestroy();
                $("#cuerpo").empty();

                response[0].forEach(function(elemento, indice) {

                    chartData.labels.push(elemento['descriptions'])
                    chartData.datasets[1].data.push(elemento['Total'])
                    chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
                    maxy = elemento['Acumulado']

                });
                response[1].forEach(function(elemento, indice) {
                    var tr = `<tr>
                            <td>  
                            <button value="`+elemento['idevent']+`" OnClick='Mostrar(this);' data-toggle="modal" data-target="#myModalEdit" type="button" class="btn btn-primary btn-circle btn-sm">
                                <i class="fas fa-fw fa-wrench"></i>
                            </button> &nbsp;
                            </td>
                            <td>`+elemento['startTime']+`</td>
                            <td>`+elemento['endTime']+`</td>
                            <td>`+elemento['descriptions']+`</td>`;

                            if (elemento['justification'] != null){
                            tr = tr + `<td>`+elemento['justification']+`</td>`
                            }else{
                                tr = tr + `<td></td>`
                            }
                            tr = tr +`<td>`+elemento['event']+`</td>
                                    <td>`+elemento['duration']+`</td>
                            </tr>`
                        $("#cuerpo").append(tr)

                });
                $('#dataTable').DataTable({
                    "pageLength": 100,
                    "searching": false
                });
                options.options.scales.yAxes[1].ticks.max = parseFloat(maxy)
                setTimeout(() => {
                    $('#myModalLoading').modal('hide');
                }, 3);
                window.myMixedChart.update()
            }
        });
    });
});
</script>
<script src="{{ asset('js/monitoreo.js')}}"></script>
@endsection