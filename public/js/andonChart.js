/*var chart_defectos=document.getElementById('chart-panel_defectos'); 
var chart_oee = document.getElementById('chart-panel_oee');*/
var chart_avance = document.getElementById('chart-panel_avance'); 

/*var myChart_oee = echarts.init(chart_oee);*/
var myChart_avance=echarts.init(chart_avance);
/*var myChart_defectos=echarts.init(chart_defectos); */
var option_oee;

var 
/*Grafica  OEE */
option_oee = {
  series: [
    {
      type: 'gauge',
      axisLine: {
        lineStyle: {
          width: 10,
          color: [
            [0.95, '#ff0000'],
            [1, '#008f39']
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
        fontSize: 15
      },
      detail: {
        valueAnimation: true,
        fontSize: 45,
        formatter: '{value}%',
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



option_avance={
    
  series: [
    {
      type: 'gauge',
      axisLine: {
        lineStyle: {
          width: 10,
          color: [
            [0.95, '#ff0000'],
            [1, '#008f39']
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
        fontSize: 15
      },
      detail: {
        valueAnimation: true,
        fontSize: 45,
        formatter: '{value}%',
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

/* =======================================================Defectos ===========================================*/

//Se comenta al 12/12/2022 ya que para el cliente no considera relevante
option_defectos={  
    
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      // Use axis to trigger tooltip
      type: 'shadow' // 'shadow' as default; can also be 'line' or 'shadow'
    }
  },
  legend: {},
  grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true
  },
  xAxis: {
    type: 'value'
  },
  yAxis: {
    type: 'category',
    data: ['Defectos:'],
    fontSize: 18
  },
    series: [
    {
      name: 'Detectados',
      type: 'bar',
      stack: 'total',      
      label: {
        show: true
      },
      emphasis: {
        focus: 'series'
      },
      data: [41],
      color:'orange'
      
    },
    {
      name: 'Permitidos',
      type: 'bar',
      stack: 'total',
      label: {
        show: true
      },
      emphasis: {
        focus: 'series'
      },
      data: [1]
    }
  ]

};
/*=======================================================Fin de defectos ============================================*/


//myChart_oee.setOption(option_oee);
myChart_avance.setOption(option_avance);
//myChart_defectos.setOption(option_defectos);

