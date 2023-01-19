/*Establecer la hora en la computadora */





/*---------------------------------------Fin de escritura de  de telegram ------------------------------------------*/ 






async function f_getTag(){

  let headers = {
      method: 'GET',
      headers: {
      "content-type": "application/json; charset=utf-8"
      }
  };

//   var urlPLC='http://10.11.25.34:1880/'
  var urlPLC='http://127.0.0.1:1880/'
  var tag = JSON.stringify({tag: "ns=3;s=[PLC_ANDON]linea_entradas_andon[1].sol_lider", type: "Int32"});
  var datoLeido = await fetch(urlPLC+"sbl_tags/readTagData?data="+tag, headers).then(response => response.json()).then(data => data.data);
  console.log(datoLeido);
  setTimeout("f_setClock()",10000);

}




 

  var ValorEstacion=0;
  function f_callHelp(ValorEstacion){    
    
    $('input[name="IdStation"]').val(ValorEstacion);
    document.getElementById("lblDowntime").innerHTML = "Hay una incidencia en la estación: #" + ValorEstacion + ", ¿Requiere apoyo?";   
    divDowntime = document.getElementById('cardParos');
    divDowntime.style.display = ''; 

   divMenuSelecciotiempos=document.getElementById('MenuSelecciotiempos');
   divMenuSelecciotiempos.display='';
   
}
//http://127.0.0.1:8000/button/andon/coninfoandon/1/1/1
function f_ConInfoAndon(){
  varh = [];
  varl = [];
  mensaje = "";
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
      url: '/button/andon/coninfoandon/1/1/1',
      type: 'GET',
      success: function (response) {
          if(response.length>0){            
              response.forEach(function (elemento, indice) {                 
                 
                 $("#resDefectos").text( + elemento[0]['diferencia']);
                 $("#resQuality").text( + elemento[0]['goodpart']);

                 momentoActual = new Date(elemento[0]['mincapturedtime']);
                 hora = momentoActual.getHours()
                 minuto = momentoActual.getMinutes()
                 segundo = momentoActual.getSeconds()     
                     
                 horaImprimible = moment(elemento[0]['mincapturedtime']).format('DD/MM/YYYY HH:mm:ss');
                 $("#lbltiempoincio").text('Inicio de producción: ' + horaImprimible);
               




              });
              /*
              swal(
                  'Requieren Atención',
                  mensaje,
                  'warning'

              );
              */
          }   
      }
      
  });
}
//setInterval('Monitoreo()',60000);


/*dAME OPCIONES DE MENU*/
//http://127.0.0.1:8000/button/andon/coninfoandon/1/1/1
var vorgchart;
function Coninfoorgchart(vorgchart){
  varh = [];
  varl = [];
  mensaje = "";
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
      url: '/button/andon/orgchart/' + vorgchart + '/1/1',
      type: 'GET',
      success: function (response) {
          if(response.length>0){
          
            response[0].forEach(function (elemento, indice) { 

             // console.log( elemento['name'] );
            
                var timeDiv='<div class="col-xl-2 border-top-3"><button type="submit"  class="btn btn-block btn-success border border-info btnSemiCircle" onClick="f_callInitGroup('+
                elemento['id'] 
                +')" >' + 
                            '<h6>'+  elemento['name']   +'&nbsp;</h6></button></div>&nbsp;' 

                var div = document.getElementById('MenuSeleccionArea');
                div.innerHTML = div.innerHTML + timeDiv;                
            

              });
            
             
          }   
      }
      
  });
}






   

