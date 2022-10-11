var var_name = $('#var_name').val();
var description = '(' + $('#description').val() +')' ;
var varname = $('#var_name').val();
$('#nom_var').val(var_name);
var idvariable = $('#idvariable').val();
var eu = $('#eu').val();
var dates = $('#date').val(); 
var chart = document.getElementById('chart-panel');
var myChart = echarts.init(chart);
$('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
}); 
        $.ajax({
                url:'/trends/'+idvariable+'/d/'+dates+'/datos',
                type:'GET',
                success:function(response){
                    option.xAxis.data.length = 0;
                    option.series[0].data.length = 0; 
                    option.series[1].data.length = 0;
                    option.series[2].data.length = 0;
                    
                response.forEach(function (elemento, indice) {
                      
                    option.xAxis.data.push(elemento['date'])
                    option.series[0].data.push(elemento['value']);
                    option.series[1].data.push(elemento['highLimit']);
                    option.series[2].data.push(elemento['lowLimit']);
                    

                });
                setTimeout(() => {
                    $('#myModalLoading').modal('hide');
                }, 3); 
                myChart.setOption(option);
                
                }
                
               
        });
        

option = {
    tooltip: {
        trigger: 'axis',
        position: function (pt) {
            return [pt[0], '10%'];
        }
    },
    title: {
        left: 'center',
        text: var_name,
        subtext: description,
        subtextStyle: {
            fontWeight: 'bolder',
            fontSize: 12
          }
    },
    toolbox: {
        show:true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none',
                title: 'Ver datos'

            },
            restore: {
               title: 'Restaurar' 
            },
            saveAsImage: {
                title: 'Descargar',
            },
            dataView: {
                readOnly: true,
                title: 'Ver datos',
                optionToContent: function(opt) {  
                    var axisData = opt.xAxis[0].data;
                    var series = opt.series;
                    var table = '<table style="width:60%;text-align:center"><tbody><tr>'
                                + '<td>'+varname+'</td>'
                                + '<td>' + series[0].name + '</td>'
                                + '<td>' + series[1].name + '</td>'
                                + '<td>' + series[2].name + '</td>'
                                + '</tr>';
                    for (var i = 0, l = axisData.length; i < l; i++) {
                        table += '<tr>'
                                + '<td>' + axisData[i] + '</td>'
                                + '<td>' + series[0].data[i] + '</td>'
                                + '<td>' + series[1].data[i] + '</td>'
                                + '<td>' + series[2].data[i] + '</td>'
                                + '</tr>';
                    }
                    table += '</tbody></table>';
                    return table;
                },
            
                lang: [var_name,'Cerrar']
            }
        }
    },
    legend: {
        top: 43,
        data: ['Valor', 'Limite superior', 'Limite inferior'],

    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: [],
        name: 'Horas del día',
        nameLocation: 'middle',
        nameGap: 22
    },
    yAxis: {
        type: 'value',
        boundaryGap: [0, '10%'],
        name: eu,
        nameLocation: 'middle',
        nameGap: 50
    },
    dataZoom: [{
        type: 'inside',
        start: 60,
        end: 100
    }, {
        start: 0,
        end: 10,
        top: '93%',
        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
        handleSize: '80%',
        handleStyle: {
            color: '#fff',
            shadowBlur: 3,
            shadowColor: 'rgba(0, 0, 0, 0.6)',
            shadowOffsetX: 2,
            shadowOffsetY: 2
        }
    }],
    
    series: [
        {
            name: 'Valor',
            type: 'line',
            smooth: true,
            symbol: 'none',
            sampling: 'average',
            itemStyle: {
                color: 'rgb(0, 0, 255)'
            },
            data: []
        },
        {
            name: 'Limite superior',
            type: 'line',
            smooth: true,
            symbol: 'none',
            sampling: 'average',
            itemStyle: {
                color: 'rgb(255, 0, 0)'
            },
            data: []
        },
        {
            name: 'Limite inferior',
            type: 'line',
            smooth: true,
            symbol: 'none',
            sampling: 'average',
            itemStyle: {
                color: 'rgb(255, 0, 0)'
            },
            data: []
        }
    ]
};