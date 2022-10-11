//consultas para graficar
var var_name = $('#var_name').val();
var idmachine = $('#idmachine').val();
var eu = "";
var date = $('#date').val(); 
$('#i_date').val(date);
$('#i_caso').val('d');
$('#i_casoS').val('1');

var caso =  $('#i_caso').val();
var casoS = $('#i_casoS').val();
var partid = $('#i_partid').val();
var lotid = $('#i_loteid').val();
var idshift = $('#i_shift').val();

//arrays de prueba ver los valores
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/oee/' + idmachine + '/'+ caso +'/' + date +'/'+ casoS +'/'+ partid +'/'+ lotid +'/'+ idshift + '/datos',
        type: 'GET',
        success: function (response) {
            
            config.data.labels.length = 0;
            config.data.datasets[0].data.length = 0;
            config.data.datasets[1].data.length = 0;
            config.data.datasets[2].data.length = 0;
            config.data.datasets[3].data.length = 0;
            config.options.scales.xAxes[0].scaleLabel.labelString= "Dia"
            //para limpiar el grid
            $("#dataTable").dataTable().fnDestroy();
            $("#cuerpo").empty();
            
            response[1].forEach(function(elemento, indice){

                configDis.data.datasets[0].data=[elemento.AvailabilityG,elemento.AvailabilityR]
                configEf.data.datasets[0].data=[elemento.performanceG,elemento. performanceR]        
                configQty.data.datasets[0].data=[elemento.qualityG,elemento.qualityR]
                configM1.data.datasets[0].data=[elemento.OEEG,elemento.OEER]
                
                configDis.options.elements.center.text = elemento.AvailabilityG+'%';
                configEf.options.elements.center.text = elemento.performanceG+'%';
                configQty.options.elements.center.text = elemento.qualityG+'%';
                configM1.options.elements.center.text = elemento.OEEG+'%';

                var resAvailability = elemento.AvailabilityG+'%';
                $("#resAvailability").html(resAvailability);

                var resThroghput = elemento.performanceG+'%';
                $("#resThroghput").html(resThroghput);

                var resQuality = elemento.qualityG+'%';
                $("#resQuality").html(resQuality);


            });
            if (response[1][0].date == null) {
                            
                configDis.options.elements.center.text = 'No Data'
                configEf.options.elements.center.text = 'No Data'
                configQty.options.elements.center.text = 'No Data'
                configM1.options.elements.center.text = 'No Data';
                $("#resAvailability").html('No Data');
                $("#resThroghput").html('No Data');
                $("#resQuality").html('No Data');



            }
            response[0].forEach(function (elemento, indice) {
                config.data.labels.push(elemento['date']);
                config.data.datasets[0].data.push(elemento['availability'])
                config.data.datasets[1].data.push(elemento['performance'])
                config.data.datasets[2].data.push(elemento['quality'])
                config.data.datasets[3].data.push(elemento['oee'])

            });
            response[2].forEach(function (elemento, indice) {
                
            var tr = `<tr>
                        <td style="font-size:90%">`+elemento['date']+`</td>
                        <td style="font-size:90%">`+elemento['oee']+`</td>
                        <td style="font-size:90%">`+elemento['availability']+`</td>
                        <td style="font-size:90%">`+elemento['performance']+`</td>
                        <td style="font-size:90%">`+elemento['quality']+`</td>
                        <td style="font-size:90%">`+elemento['runTime']+`</td>
                        <td style="font-size:90%">`+elemento['availableTime']+`</td>
                        <td style="font-size:90%">`+elemento['ict']+`</td>
                        <td style="font-size:90%">`+elemento['totalPieces']+`</td>
                        <td style="font-size:90%">`+elemento['goodParts']+`</td>
                        <td style="font-size:90%">`+elemento['partId']+`</td>
                        <td style="font-size:90%">`+elemento['lotId']+`</td>
                        <td style="font-size:90%">`+elemento['turno']+`</td>
                    </tr>`
                    $("#cuerpo").append(tr)

            });
            $('#dataTable').DataTable({
                "pageLength": 50,
                "order": [[ 1, "desc" ]],
                "searching": false
            });
            response[3].forEach(function (elemento, indice) {
                $("#RunningTime").html(elemento['RunningTime']);
                $("#AvailableTime").html(elemento['AvailableTime']);

                $("#TotalParts").html(elemento['TotalParts']);
                $("#IdealCycleTime").html(elemento['ICT']);
                $("#RunningTime2").html(elemento['RunningTime']);
                

                $("#GoodParts").html(elemento['GoodParts']);
                $("#TotalParts2").html(elemento['TotalParts']);
                
            });
            response[4].forEach(function (elemento, indice) {
                var opt = `<option value="`+elemento['partId']+`">`+elemento['partId']+`</option>`;
                $("#i_partid").append(opt);
            });
            response[5].forEach(function (elemento, indice) {
                var opt = `<option value="`+elemento['lotId']+`">`+elemento['lotId']+`</option>`;
                $("#i_loteid").append(opt);
            });
            response[6].forEach(function (elemento, indice) {
                var opt = `<option value="`+elemento['idShift']+`">`+elemento['turno']+`</option>`;
                $("#i_shift").append(opt);
            });
            if (response[3][0].date == null) {
                            
                $("#RunningTime").html('No Data');
                $("#AvailableTime").html('No Data');

                $("#TotalParts").html('No Data');
                $("#IdealCycleTime").html('No Data');
                $("#RunningTime2").html('No Data');

                $("#GoodParts").html('No Data');
                $("#TotalParts2").html('No Data');
    
            }
            setTimeout(() => {
                $('#myModalLoading').modal('hide');
            }, 3);
            window.myLine.update()
            window.myMaq5.update()
            window.myMaq6.update()
            window.myMaq7.update()
            window.myMaq8.update()
        }
    });
});


var configM1 = {
    type: 'doughnut',
    data: {
        labels: ["%", "%"],

        datasets: [{
            data: [],
            backgroundColor: [
                'rgb(98,118,138)',
                'rgb(0,51,100)',
            ],
            labels: [
                'Lgreen',
                'Lred',

            ]
        }]
    },
    options: {
        rotation: 90,
        cutoutPercentage: 80,
        responsive: true,
        legend: {
            position: 'top',
            display: false
        },
        title: {
            display: true,
            text: 'OEE',
            fontSize: '25',
            fontColor: 'rgb(0,51,100)'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            center: {
                text: '',
                color: 'rgb(0,51,100)', // Default is #000000
                fontStyle: 'Arial', // Default is Arial
                sidePadding: 20 // Defualt is 20 (as a percentage)
            }
        },
        plugins: {
            datalabels: {
                backgroundColor: function (context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                anchor: 'end',
                color: 'white',
                font: {
                    weight: 'bolder',
                    size: 50,

                },
                formatter: Math.round
            }
        }
    }

};

var configEf = {
    type: 'doughnut',
    data: {
        labels: ["%", "%"],

        datasets: [{
            data: [],
            backgroundColor: [
                'rgb(0,161,203)',
                'rgb(142,142,142)'
            ],
            labels: [
                'Lgreen',
                'Lred',

            ]
        }]
    },
    options: {
        rotation: 90,
        cutoutPercentage: 80,
        responsive: true,
        legend: {
            position: 'top',
            display: false
        },
        title: {
            display: true,
            text: 'Rendimiento',
            fontSize: '25',
            fontColor: 'rgb(0,51,100)'
            //fontFamily:
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            center: {
                text: '',
                color: 'rgb(0,51,100)', // Default is #000000
                fontStyle: 'Arial', // Default is Arial
                sidePadding: 20 // Defualt is 20 (as a percentage)
            }
        },
        plugins: {
            datalabels: {
                backgroundColor: function (context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                anchor: 'end',
                color: 'white',
                /*display: function (context) {
                    var dataset = context.dataset;
                    var count = dataset.data.length;
                    var value = dataset.data[context.dataIndex];
                    return value > count * 1.5;
                },*/
                font: {
                    weight: 'bolder',
                    size: 50,

                },
                formatter: Math.round
            }
        }


    },

};

var configDis = {
    type: 'doughnut',
    data: {
        labels: ["%", "%"],

        datasets: [{
            data: [],
            backgroundColor: [
                'rgb(239,159,78)',
                'rgb(142,142,142)'
            ],
            labels: [
                'Lgreen',
                'Lred',

            ]
        }]
    },
    options: {
        rotation: 90,
        cutoutPercentage: 80,
        responsive: true,
        legend: {
            position: 'top',
            display: false
        },
        title: {
            display: true,
            text: 'Disponibilidad',
            fontSize: '25',
            fontColor: 'rgb(0,51,100)'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            center: {
                text: '',
                color: 'rgb(0,51,100)', // Default is #000000
                fontStyle: 'Arial', // Default is Arial
                sidePadding: 20 // Defualt is 20 (as a percentage)
            }
        },
        plugins: {
            datalabels: {
                backgroundColor: function (context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                anchor: 'end',
                color: 'white',
                /*display: function (context) {
                    var dataset = context.dataset;
                    var count = dataset.data.length;
                    var value = dataset.data[context.dataIndex];
                    return value > count * 1.5;
                },*/
                font: {
                    weight: 'bolder',
                    size: 50,

                },
                formatter: Math.round
            }
        }


    },

};
var configQty = {
    type: 'doughnut',
    data: {
        labels: ["%", "%"],

        datasets: [{
            data: [],
            backgroundColor: [
                'rgb(213,77,84)',
                'rgb(142,142,142)'
            ],
            labels: [
                'Lgreen',
                'Lred',

            ]
        }]
    },
    options: {
        rotation: 90,
        cutoutPercentage: 80,
        responsive: true,
        legend: {
            position: 'top',
            display: false
        },
        title: {
            display: true,
            text: 'Calidad',
            fontSize: '25',
            fontColor: 'rgb(0,51,100)'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            center: {
                text: '',
                color: 'rgb(0,51,100)', // Default is #000000
                fontStyle: 'Arial', // Default is Arial
                sidePadding: 20 // Defualt is 20 (as a percentage)
            }
        },
        plugins: {
            datalabels: {
                backgroundColor: function (context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                anchor: 'end',
                color: 'white',
                /*display: function (context) {
                    var dataset = context.dataset;
                    var count = dataset.data.length;
                    var value = dataset.data[context.dataIndex];
                    return value > count * 1.5;
                },*/
                font: {
                    weight: 'bolder',
                    size: 50,

                },
                formatter: Math.round
            }
        }


    },

};

window.onload = function () {
    var ctx = document.getElementById("Canvas1").getContext("2d");
    window.myMaq5 = new Chart(ctx, this.configDis);

    var ctx2 = document.getElementById("Canvas2").getContext("2d");
    window.myMaq6 = new Chart(ctx2, this.configEf);

    var ctx3 = document.getElementById("Canvas3").getContext("2d");
    window.myMaq7 = new Chart(ctx3, this.configQty);

    var ctx4 = document.getElementById("Canvas4").getContext("2d");
    window.myMaq8 = new Chart(ctx4, this.configM1);

    var ctx5 = document.getElementById("Canvas").getContext("2d");
    window.myLine = new Chart(ctx5, config);

};


var config = {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: "Disponibilidad",
            backgroundColor: 'rgb(0,161,203)',
            borderColor: 'rgb(0,161,203)',
            data: [],
            fill: false,
        }, {
            label: "Rendimiento",
            fill: false,
            backgroundColor: 'rgb(239,159,78)',
            borderColor: 'rgb(239,159,78)',
            data: [],
        }, {
            label: "Calidad",
            fill: false,
            backgroundColor: 'rgb(98,118,138)',
            borderColor: 'rgb(98,118,138)',
            data: [],
        }, {
            label: "OEE",
            fill: false,
            backgroundColor: 'rgb(213,77,84)',
            borderColor: 'rgb(213,77,84)',
            data: [],
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: ''
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        elements:{
            point:{
                radius:0,
                pointHoverRadius:10,
            }
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: ''
                }

            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: ''
                },
                ticks: {
                    min: 0,
                    max: 100
                }
            }]
        }
    }
};



Chart.pluginService.register({
    beforeDraw: function (chart) {
        if (chart.config.options.elements.center) {
            //Get ctx from string
            var ctx = chart.chart.ctx;

            //Get options from the center object in options
            var centerConfig = chart.config.options.elements.center;
            var fontStyle = centerConfig.fontStyle || 'Arial';
            var txt = centerConfig.text;
            var color = centerConfig.color || '#000';
            var sidePadding = centerConfig.sidePadding || 20;
            var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
            //Start with a base font of 30px
            ctx.font = "30px " + fontStyle;

            //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
            var stringWidth = ctx.measureText(txt).width;
            var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

            // Find out how much the font can grow in width.
            var widthRatio = elementWidth / stringWidth;
            var newFontSize = Math.floor(30 * widthRatio);
            var elementHeight = (chart.innerRadius * 2);

            // Pick a new font size so it will not be larger than the height of label.
            var fontSizeToUse = Math.min(newFontSize, elementHeight);

            //Set font settings to draw it correctly.
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
            var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
            ctx.font = fontSizeToUse + "px " + fontStyle;
            ctx.fillStyle = color;

            //Draw text in center
            ctx.fillText(txt, centerX, centerY);
        }
    }
});
