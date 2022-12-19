function f_callOEE(){         //ver si en otra parte lo llaman para que se muestre
 
 
 
  $.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });
  $.ajax({
      url: '/andon/oee/1/1/1',      
      type: 'GET',
      success: function (response) {
          
          if(response.length>0){   
             
              response[0].forEach(function (elemento, indice) {                  
                  option_oee.series[0].data[0].value=elemento['oee'];
                  myChart_oee.setOption(option_oee);
                  option_dis.series[0].data[0].value=elemento['disponibilidad'];
                  myChart_dis.setOption(option_dis);
                  option_prod.series[0].data[0].value=elemento['eficiencia']; //prod eficiencia
                  myChart_dis.setOption(option_prod);
                  option_cal.series[0].data[0].value=elemento['calidad']; 
                  myChart_cal.setOption(option_cal);

              });       
   
}   
}

});
/*fin  de dsacar los grupos*/

}







var chart_oee = document.getElementById('chart-panel_oee');
var myChart_oee = echarts.init(chart_oee);

var chart_cal = document.getElementById('chart-panel_cal');
var myChart_cal = echarts.init(chart_cal);

var chart_dis = document.getElementById('chart-panel_dis');
var myChart_dis = echarts.init(chart_dis);

var chart_prod = document.getElementById('chart-panel_prod');
var myChart_prod = echarts.init(chart_prod);

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
          value: 0
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
          value: 0
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
          value: 0
        }
      ]
    }
  ]
};

myChart_oee.setOption(option_oee);
myChart_cal.setOption(option_cal);
myChart_dis.setOption(option_dis);
myChart_prod.setOption(option_prod);
 