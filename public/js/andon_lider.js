// var var_name = $('#var_name').val();
// var description = '(' + $('#description').val() +')' ;
// var varname = $('#var_name').val();
// $('#nom_var').val(var_name);
// var idvariable = $('#idvariable').val();
// var eu = $('#eu').val();
// var dates = $('#date').val(); 
var chart = document.getElementById('chart-panel');
var myChart = echarts.init(chart);
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

var option;

option = {
  series: [
    {
      type: 'gauge',
      axisLine: {
        lineStyle: {
          width: 10,
          color: [
            [0.95, '#fd666d'],
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
        fontSize: 10
      },
      detail: {
        valueAnimation: true,
        fontSize: 20,
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
// setInterval(function () {
//   myChart.setOption({
//     series: [
//       {
//         data: [
//           {
//             value: +(Math.random() * 100).toFixed(2)
//           }
//         ]
//       }
//     ]
//   });
// }, 2000);
myChart.setOption(option);
 