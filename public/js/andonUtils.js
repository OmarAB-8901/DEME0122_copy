//Hacer una pausa de segundos determinados por el cliente.
function wait(espera_segundos) {
    espera = espera_segundos * 1000
    const tiempo_inicio = Date.now();
    let tiempo_actual= null;
    do {
      tiempo_actual= Date.now();
    } while (tiempo_actual - tiempo_inicio < espera);
  }   

  /*Establecer relog */
   function f_setClock(){ 
    document.getElementById("clock").innerHTML = moment().format('DD/MM/YYYY HH:mm:ss ');
    setTimeout("f_setClock()",1000);
  }




     let station_array=[];




/*Catalogo de ayudas en la linea */
function f_get_station(vstation){
  let station_array=[];
  $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });
      $.ajax({
     
              url: '/button/andon/coninfoestacion/2/'+ vstation +'/1',
              type: 'GET',
              success: function (response) {
                      if(response.length>0){
                          response[0].forEach(
                                                  function (elemento, indice) {   
                                                          let a1={
                                                              id:       parseInt(elemento['id']),
                                                              pos:      elemento['position'] ,
                                                              estacion: elemento['estacion'] ,      
                                                              button:   elemento['btn']       

                                                          };                                                      
                                                          station_array.push(  a1 );
                                                                                                                                                                            
                                                          }); 
                         
                          localStorage.setItem("estaciones",JSON.stringify(station_array));
                          }                                  
              }     

          });

}





  /*Catalogo de ayudas en la linea */
  function f_util_get_local_help(){
    let help_array=[];
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
                url: '/button/andon/orgchart/0/1/1',
                type: 'GET',
                success: function (response) {
                        if(response.length>0){
                           

                            response[0].forEach(
                                                    function (elemento, indice) {   
                                                            let a1={
                                                                id: parseInt(elemento['plc_signal']),
                                                                name: elemento['name']           
                                                            };
                                                        
                                                             help_array.push(  a1 );
                                                                                                                                                                              
                                                            }); 
                            let aotros={
                                id:     99,
                                name:   'Personal'
                            }
                            help_array.push(aotros);
                            localStorage.setItem("catHelp",JSON.stringify(help_array));
                            }   
                            
                            
                               
                                 
                }      

            });
            
}


var vgrupo;
var vestacion;
function f_callTelegram(vgrupo,vchart,vidShift,vmensaje){    
      let urlSend=    getLocalStorage("URLPLC");    
      let messageStructure = {
        idGroup: vgrupo,
        idChart: vchart,    
        idShift: vidShift,
        dbMensaje: false,
        mensaje: vmensaje ,
      }

  let headers = { 
    method: 'POST',
    body: JSON.stringify(messageStructure),
    headers: {    
      "content-type": "application/json; charset=utf-8"
    }
  };
   fetch(urlSend.urlTelegram + urlSend.urlTelwr,headers);
  //fetch("http://10.11.30.126:1880/sbl/sendTelegramMessage", headers);


}

function getListAndonTelegram(vSolicitudArea){
  let lGroupTelegram=[];
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
                url: '/button/andon/orgchart/1/'+ vSolicitudArea +'/1',
                type: 'GET',
                success: function (response) {
                        if(response.length>0){
                           

                            response[0].forEach(
                                                    function (elemento, indice) {              
                                                      let oelement={
                                                            id:         parseInt(elemento['id']),
                                                            name:       elemento['name'],
                                                            time1:      parseInt(elemento['time1']),
                                                            time2:      parseInt(elemento['time2']),
                                                            telegramID: elemento['telegramId']
                                                        }                                                      
                                                      lGroupTelegram.push(oelement);                                                                                          
                                                        }
                                                ); 
                            }   return JSON.stringify(lGroupTelegram); 
                                 
                }      

            });
           
}



function f_ConInfoAndon(){
    //console.log("Hola mundo");
    //var elementoTable = document.getElementById('estado');
   // var lblincidencia =document.getElementById('Incidencia2');
    var contenidoCentro=document.getElementById('cardBodyCenter');
    contenidoCentro.innerHTML="";
    contenidoCentro.innerHTML=` <div class="row">
                                  <div class="col-xl-6">
                                      <div class="card-body">
                                          <h2 class="card-title text-dark">Progreso de la linea</h2>   
                                          <div class="row">
                                            <div class="col-xl-6 bg-devicorredgray text-white text-center">  
                                                <h4>Piezas OK</h4>
                                            </div>
                                            <div class="col-xl-6 bg-devicorredgray text-white text-center">  
                                              <h4>Piezas Defectuosas</h4>
                                            </div>
                                          </div>        
                                          <div class="row">
                                            <div class="col-xl-6 text-center bg-danger  text-white">  
                                                <h4 id="pzasOk" >0</h4>
                                            </div>
                                            <div class="col-xl-6 text-center bg-danger  text-white">  
                                              <h4 id="pzasDefec">0</h4>
                                            </div>
                                          </div>                                                                        

                                      </div>
                                  </div>
                                  
                                </div>
                                <div class="row">
                                  <div class="col-xl-12">
                                    <div class="echarts" id="chart-panel_oee" style="width: 300px; height:300%;"></div>     
                                  </div>
                                </div>
                                
                                
                                `;
                                

    var lblmodelo= document.getElementById("lblModelo");

    var lbldescripcionmodelo=document.getElementById("lblDescripcionModelo");
    var lblpzashora=document.getElementById("lblPiezasHora");
    var lblplan=document.getElementById("lblPlan");

    varh = [];
    varl = [];
    mensaje = "";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    $.ajax({
        url: '/button/andon/coninfoandon/1/'+ vstation +'/1',
        type: 'GET',
        success: function (response) {
            if(response.length>0){            
                response.forEach(function (elemento, indice) {        
                  
                    console.log(elemento);
                  lblmodelo.innerHTML="<h4>" + elemento[0]["modelo"] +"</h4>";
                  lbldescripcionmodelo.innerHTML="<h4>" + elemento[0]["descmodelo"] +"</h4>";

                  lblpzashora.innerHTML="<h4>" + elemento[0]["pzashora"] +"</h4>";
                  lblplan.innerHTML=  "<h4>" + elemento[0]["total"] +"</h4>";

                  console.log('piezasokk' + elemento[0]["piezasok"]);
                  document.getElementById("pzasOk").innerHTML=`<h4>${elemento[0].goodpart}</h4>`;
                   
  
                });
               
            }   
        }
        
    });
    //setTimeout("f_get_selected()",80000);
  }


  //View the workplan into the select item into the lider module

var listaPlanes=[];

function f_get_estado2(){    
      //  var listaPlanes=[];
      select = document.getElementById("planes");    
        mensaje = "";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/button/andon/coninfoandon/2/'+ vstation +'/1',
            type: 'GET',
            success: function (response) {
                  if(response.length>0){                
                  
                          response[0].forEach( (elemento, index)=> {                                             
                            let objPlanes={
                              id:       elemento['id'],
                              wo:       elemento['wo'],
                              nombre:   elemento['nombre'],
                              cantasoc: elemento['cantasoc'],
                              lote:     elemento['lote'],
                              ict:      elemento['ict'],
                              estado:   elemento['estadoplanes']
                            }
                              listaPlanes.push(objPlanes);

                              option = document.createElement("option");
                              option.value = listaPlanes[index]['id'];
                              option.text = listaPlanes[index]['wo'] + '' + listaPlanes[index]['nombre'];
                              select.appendChild(option);                 
                              
                          });             
                    }       
                }      
          });
    }

var listaScrap=[]; 
function f_set_catScrap(){

      //  var listaPlanes=[];
      select = document.getElementById("planes");    
        mensaje = "";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/button/andon/coninfoandon/4/1/1',
            type: 'GET',
            success: function (response) {
                  if(response.length>0){                
                  //{,"defectosaceptados":"5","codigo":"3","":"1","tiposcrap":"AJUSTES (Set-up)","idgroup":"6","gruponame":"Produccion"},
                          response[0].forEach( (elemento, index)=> {                                             
                           
                              listaScrap.push(new Scrap(
                                elemento['id'],
                                elemento['scrapname'],
                                elemento['scrapdescription'],
                                elemento['defectosaceptados'],
                                elemento['codigo'],
                                elemento['idtiposscrap'],       
                                elemento['tiposcrap'],                                                                
                                elemento['idgroup'],
                                elemento['gruponame']
                              ) );

                              
                          });             
                    }       
                }      
          });



}



var ListEventsType=[];
function f_GetEventsType()
{   
  ListEventsType=[{id:5,nombre:'Despeje de Linea',              inicial:'A'},
                {id:6,nombre:'Liberacion de Linea Mtto. Set Up',inicial:'B'},
                {id:7,nombre:'Tiempo muerto de maquinas',inicial:'C'},
                {id:8,nombre:'Faltante de Materiales',inicial:	'D'},
                {id:9,nombre:'Faltante de etiquetas',inicial:'E'},
                {id:10,nombre:'Mal ensamble',inicial:'F'},
                {id:11,nombre:'Entrenamiento',inicial:'G'},
                {id:12,nombre:'Falta de personal',inicial:'H'},
                {id:13,nombre:'	Problemas de calidad',inicial:'I'},
                {id:14,nombre:'Almacen',inicial:'J'},
                {id:15,nombre:'Falta de plan',inicial:'K'},
                {id:16,nombre:'Otros',inicial:'L'}]
}


