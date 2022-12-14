// var var_name = $('#var_name').val();
// var description = '(' + $('#description').val() +')' ;
// var varname = $('#var_name').val();
// $('#nom_var').val(var_name);
// var idvariable = $('#idvariable').val();
// var eu = $('#eu').val();
// var dates = $('#date').val(); 
var chart_oee = document.getElementById('chart-panel_oee');
var myChart_oee = echarts.init(chart_oee);

var chart_cal = document.getElementById('chart-panel_cal');
var myChart_cal = echarts.init(chart_cal);

var chart_dis = document.getElementById('chart-panel_dis');
var myChart_dis = echarts.init(chart_dis);

var chart_prod = document.getElementById('chart-panel_prod');
var myChart_prod = echarts.init(chart_prod);
// $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
//     }
// }); 
//         $.ajax({
//                 url:'/trends/'+idvariable+'/d/'+dates+'/datos',
//                 type:'GET',
//                 success:function(response){
//                     option.xAxis.data.length = 0;
//                     option.series[0].data.length = 0; 
//                     option.series[1].data.length = 0;
//                     option.series[2].data.length = 0;
                    
//                 response.forEach(function (elemento, indice) {
                      
//                     option.xAxis.data.push(elemento['date'])
//                     option.series[0].data.push(elemento['value']);
//                     option.series[1].data.push(elemento['highLimit']);
//                     option.series[2].data.push(elemento['lowLimit']);
                    

//                 });
//                 setTimeout(() => {
//                     $('#myModalLoading').modal('hide');
//                 }, 3); 
//                 myChart.setOption(option);
                
//                 }
                
               
//         });

var option_oee;
var option_cal;
var option_dis;
var option_prod;

var red='#fd0000';
var green='#008000';
var font=25;
var font2=font-5;
var fontdata=30;
var fontdata2=fontdata-10;
option_oee = {
  series: [
    {
      type: 'gauge',
      axisLine: {
        lineStyle: {
          width: 10,
          color: [
            [0.95, red],
            [1, green]
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 5,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 10,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'auto',
        distance: 5,
        fontSize: font
      },
      detail: {
        valueAnimation: true,
        fontSize: fontdata,
        formatter: '{value} %',
        color: 'auto'
      },
      data: [
        {
          value: 96.7
        }
      ]
    }
  ]
};

option_cal = {
  series: [
    {
      type: 'gauge',
      axisLine: {
        lineStyle: {
          width: 10,
          color: [
            [0.99, red],
            [1, green]
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 5,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 10,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'auto',
        distance: 5,
        fontSize: font-2
      },
      detail: {
        valueAnimation: true,
        fontSize: fontdata2,
        formatter: '{value} %',
        color: 'auto'
      },
      data: [
        {
          value: 96.7
        }
      ]
    }
  ]
};

option_dis = {
  series: [
    {
      type: 'gauge',
      axisLine: {
        lineStyle: {
          width: 10,
          color: [
            [0.95, red],
            [1, green]
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 5,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 10,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'auto',
        distance: 5,
        fontSize: font2
      },
      detail: {
        valueAnimation: true,
        fontSize: fontdata2,
        formatter: '{value} %',
        color: 'auto'
      },
      data: [
        {
          value: 95.7
        }
      ]
    }
  ]
};

option_prod = {
  series: [
    {
      type: 'gauge',
      axisLine: {
        lineStyle: {
          width: 10,
          color: [
            [0.95, red],
            [1, green]
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 5,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 10,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'auto',
        distance: 5,
        fontSize: font2
      },
      detail: {
        valueAnimation: true,
        fontSize: fontdata2,
        formatter: '{value} %',
        color: 'auto'
      },
      data: [
        {
          value: 96.7
        }
      ]
    }
  ]
};

myChart_oee.setOption(option_oee);
myChart_cal.setOption(option_cal);
myChart_dis.setOption(option_dis);
myChart_prod.setOption(option_prod);
 