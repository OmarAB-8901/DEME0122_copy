var diapositiva=1
var linea=1;
//var chart_oee = document.getElementById('chart-panel_oee');


LScoredCard=[];
function f_get_scored(){    
        
                
                var  elementoTable = document.getElementById('tblbodyScoredCard');
                elementoTable.innerHTML="";
                elementoTable.innerHTML= ` 
                            <div class="row">
                                <div class="col-xl-4 bg-primary text-white"><h4> HORA</h4> </div>
                                <div class="col-xl-2 bg-success text-white"><h4> META</h4></div>
                                <div class="col-xl-2 bg-devicorinfo text-white"><h4> PROD </h4></div>
                                <div class="col-xl-2 bg-devicorinfo text-white"><h4> ACUM </h4></div>
                                <div class="col-xl-2 bg-devicorinfo text-white"><h4> BALANCE</h4> </div>
                            </div>                        
                            `
                select = document.getElementById("planes");    
                mensaje = "";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }});
                $.ajax({
                            url: '/andon/consultascore/'+ linea +'/1/1',                        
                            type: 'GET',
                            success:    function (response) {
                                        if(response.length>0){                
                                            let acumuladoplan=0;
                                            let acumuladoproduccion=0;                
                                            response[0].forEach( (elemento, index)=> {                                             
                                                    acumuladoplan=acumuladoplan + parseInt(elemento['meta']);
                                                    acumuladoproduccion=acumuladoproduccion+ parseInt(elemento['total']);
                                                    let balance= parseInt(elemento['total'])  - parseInt(elemento['meta'])
                                                    elementoTable.innerHTML=elementoTable.innerHTML +
                                                    `<div class="row">
                                                    <div class="col-xl-4"><h2>${elemento['descsch']}</h2></div>
                                                    <div class="col-xl-2"><h2>${elemento['meta']}</h2></div>
                                                    <div class="col-xl-2"><h2>${elemento['total']}</h2></div>
                                                    <div class="col-xl-2"><h2>${acumuladoproduccion}</h2></div>
                                                    <div class="col-xl-2"><h2>${balance}</h2></div>
                                                    </div>`  
                                                    });             
                                                    elementoTable.innerHTML=elementoTable.innerHTML + `</tbody>  </table>   </div>`
                                            }   
                                         }      
                    });
                    
        }

        
        
    //fin de get scored
    

   
      var red='#fd0000';
      var green='#008000';
      var font=25;
      var font2=font-5;
      var fontdata=30;
      var fontdata2=fontdata-10;
//=====================================OEE ==============================================================

     var option_oee = {
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
           
            splitLine: {
              distance: 30,
              length: 10,
              lineStyle: {
                color: '#fff',
                width: 4
              }
            },
            axisLabel: {
              color: 'auto',
              distance: 25,
              fontSize: font
            },
            detail: {
              valueAnimation: true,
              fontSize: fontdata,
              formatter: '{value} %',
              color: 'auto',
              distance: -30

            },
           
            data: [
              {
                value: 0
               
              }
            ]
          }
        ]
      };
     
//==========================performance =================================
var option_performace = {
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
     
      splitLine: {
        distance: 30,
        length: 10,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'auto',
        distance: 25,
        fontSize: font
      },
      detail: {
        valueAnimation: true,
        fontSize: fontdata,
        formatter: '{value} %',
        color: 'auto',
        distance: -30

      },
     
      data: [
        {
          value: 0
         
        }
      ]
    }
  ]
};
/*=========================================quality ============================================================== */
var option_quality = {
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
     
      splitLine: {
        distance: 30,
        length: 10,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'auto',
        distance: 25,
        fontSize: font
      },
      detail: {
        valueAnimation: true,
        fontSize: fontdata,
        formatter: '{value} %',
        color: 'auto',
        distance: -30

      },
     
      data: [
        {
          value: 0
         
        }
      ]
    }
  ]
};


//=================================================availability ===============================================================
var option_availability = {
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
     
      splitLine: {
        distance: 30,
        length: 10,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'auto',
        distance: 25,
        fontSize: font
      },
      detail: {
        valueAnimation: true,
        fontSize: fontdata,
        formatter: '{value} %',
        color: 'auto',
        distance: -30

      },
     
      data: [
        {
          value: 0
         
        }
      ]
    }
  ]
};



/////////////////////////////////////////////////////////
     function   f_hideallDivs(){
      document.getElementById('tblbodyScoredCard').style.display="none";
      document.getElementById('tblgraphScoreTotal').style.display="none";

     }

     var bandera=1;
     var linea=1;

     function f_timeDashboard(){
      f_callOEE(linea);
      f_get_scored()
      if (bandera==1){
        f_hideallDivs()
        document.getElementById('tblbodyScoredCard').style.display='';  
        
        
        bandera=2;
      }
     else if (bandera==2){
      f_hideallDivs()
      
        document.getElementById('tblgraphScoreTotal').style.display='';  
        bandera=1;
        if (linea==1){
          linea=2
        }else{linea=1}

      }



     }


     /*=========================================== Establecer parametros de oee por linea =================================*/
     function f_callOEE(linea){         //ver si en otra parte lo llaman para que se muestre            
          $.ajaxSetup({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
              });
          $.ajax({
                    url: '/andon/oee/'+ linea +'/1/1',    //cc:  AndonOEEController //bd:sp_oee ???
                    type: 'GET',
                    success: function (response) {              
                        if(response.length>0){                    
                              response[0].forEach(function (elemento, indice) {                  
                                  option_oee.series[0].data[0].value=elemento['oee'];
                                  option_availability.series[0].data[0].value=elemento['disponibilidad'];                      
                                  option_performace.series[0].data[0].value=elemento['eficiencia']; //prod eficiencia
                                  option_quality.series[0].data[0].value=elemento['calidad']; 

                                  document.getElementById( "act_availabiility").innerHTML=`Modelo: ${elemento['modelo']} <hr> ${elemento['ultact']} `
                                  document.getElementById( "act_oee").innerHTML=`Modelo: ${elemento['modelo']} <hr> ${elemento['ultact']} `
                                  document.getElementById( "act_performance").innerHTML=`Modelo: ${elemento['modelo']} <hr> ${elemento['ultact']} `
                                  document.getElementById( "act_quality").innerHTML=`Modelo: ${elemento['modelo']} <hr> ${elemento['ultact']} `
                                  document.getElementById("lbllinea").innerHTML=`<h1 id="lbllinea" class="m-0 font-weight-bold text-white" style="text-align:left">
                                  Estad&iacute;stica: L&iacute;nea: ${elemento['linea']}</h1>`;
                                  myChart.setOption(option_oee);
                                  myChartPerformace.setOption(option_performace);   
                                  myChartQuality.setOption(option_quality);
                                  myChartAvailability.setOption(option_availability);
                      
                                });       
                            
                          }   
                        }    
                });
        }

        
       /*===============================================Establecer relog ========================================= */
        function f_setClock(){ 
          document.getElementById("clock").innerHTML = moment().format('DD/MM/YYYY HH:mm:ss ');
          setTimeout("f_setClock()",1000);
        }
