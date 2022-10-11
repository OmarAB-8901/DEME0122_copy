//consultas para graficar
var var_name = $('#var_name').val();
var idmachine = $('#idmachine').val();
var date = $('#date').val();
$('#i_dia').val(date);
$('#i_date').val(date);
$('#i_caso').val('d');
var maxy = 0
//var Acumulado= []
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/Events/' + idmachine + '/d/' + date + '/datos',
        type: 'GET',
        success: function (response) {

            chartData.labels.length = 0;
            chartData.datasets[1].data.length = 0; 
            chartData.datasets[0].data.length = 0;

        
                //para limpiar el grid
                $("#dataTable").dataTable().fnDestroy();
                $("#cuerpo").empty();
        
            
            response[0].forEach(function (elemento, indice) {

                chartData.labels.push(elemento['descriptions'])
                chartData.datasets[1].data.push(elemento['Total'])
                //chartData.datasets[1].data.push(elemento['Porc']) //opcional sustituir por porcentajes
                chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
                maxy = elemento['Acumulado']
                
            });
            response[1].forEach(function (elemento, indice) {
                
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
function Mostrar(btn){
    var route = "/events/"+btn.value+"/editm";

    $.get(route, function(res){
        $("#id").val(btn.value);
        $("#idmachines").val(res.idmachine);
        $("#just").val(res.justification);
    });
}


var chartData = {

    labels: [],
    datasets: [{
        type: 'line',
        label: 'Porcentaje Acumulado',
        borderColor: 'rgb(0,51,100)',
        borderWidth: 2,
        fill: false,
        data: [], //Porcentaje acumulado
        yAxisID: "y-axis1"
    }, {
        type: 'bar',
        label: 'Tiempo Acumulado de falla',
        backgroundColor: 'rgb(255,185,46)',
        data: [], //Frecuencia
        yAxisID: "y-axis2",
    }]

};
var canvas = document.getElementById("canvas")
//var canvas = $("#Canvas")
var options = {
    type: 'bar',
    data: chartData,
    options: {

        defaultFontSize: 20,

        responsive: true,
        legend: {
            labels: {
                defaultFontSize: 1
            }
        },
        title: {
            display: true,
            text: ''
        },

        tooltips: {
            mode: 'index',
            intersect: true
        },

        scales: {
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    autoSkipPadding: 0,  
                    maxRotation: 80, 
                    minRotation: 80 
                }
            }],

            yAxes: [{
                id: "y-axis1",
                position: "right",
                scaleLabel:{
                    labelString:"Porcentaje",
                    display:true
                },
                ticks: {
                    beginAtZero: true
                },
                gridLines: {
                    offsetGridLines: false
                }

            },
            {
                display: true,
                id: "y-axis2",
                scaleLabel:{
                    labelString:"Tiempo Acumulado (Hras)",
                    display:true
                },
                ticks: {
                    beginAtZero: true,
                    //max: 101
                },

                gridLines: {
                    offsetGridLines: false,

                }
            }
            ]

        },
        plugins: {
            datalabels: {
                color: 'Black',
                anchor: 'end',
                align: 'end',
                offset: -5,

                font: {
                    weight: 'bold'
                },

            }
        }
    }
}

window.onload = function () {
    window.myMixedChart = new Chart(canvas, options);

}




