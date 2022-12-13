var chart_oee = document.getElementById('chart-panel_oee');
var chart_avance = document.getElementById('chart-panel_avance');
var myChart_oee = echarts.init(chart_oee);
var myChart_avance=echarts.init(chart_avance);
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
    data: ['PROD:'],
    fontSize: 35
  },
    series: [
    {
      name: 'Producido',
      type: 'bar',
      stack: 'total',
      label: {
        show: true
      },
      emphasis: {
        focus: 'series'
      },
      data: [900]
    },
    {
      name: 'Por producir',
      type: 'bar',
      stack: 'total',
      label: {
        show: true
      },
      emphasis: {
        focus: 'series'
      },
      data: [1100]
    }
  ]

};


myChart_oee.setOption(option_oee);
myChart_avance.setOption(option_avance);

