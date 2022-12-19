/*
    Funciones que se necesitam en la vista button.blade.php
    FEME 03/12/2022
*/
//Cambiar la producción

var banderaSolicitud=0;
async function f_SetPlan(){
    //Selecccionar la información de la caja de texto.    
        let lineData=   getLocalStorage("lineData");
        var combo = document.getElementById("planes");
        var selected = combo.options[combo.selectedIndex].text;        
        var res = selected.split(" ");
        //Falta el obtener el ICT       
        
    let urlSend=    getLocalStorage("URLPLC");    
    let tags = {
        tagsSBL: [
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Ready[" + lineData.id + "]", type: "Int32", value: 1},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Run[" + lineData.id + "]", type: "Int32", value: 1},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.TotalParts[" + lineData.id + "]", type: "Int32", value: 1},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Scrap[" + lineData.id + "]", type: "Int32", value: 0},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.ICT[" + lineData.id + "]", type: "Float", value: .522},          
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.loteid[" + lineData.id + "]", type: "String", value: res[0]},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.parteid[" + lineData.id + "]", type: "String", value: res[1]}
        ]
    }


    for(let tag of tags.tagsSBL){

        let headers = { 
            method: 'POST',
            body: JSON.stringify(tag),
            headers: {    
            "content-type": "application/json; charset=utf-8"
            }
        };
    
        await fetch(urlSend.urlPLC+ urlSend.urlPLCwr, headers);  
    }
    
}


async function f_ListenPLC(){
            //Escucha la CPU del PLC para extraer si hay alguna peticion por parte del Lider
                 
            let lineData=   getLocalStorage("lineData");
            let urlSend=    getLocalStorage("URLPLC");
            let headers = {
                method: 'GET',
                headers: {"content-type": "application/json; charset=utf-8"}
            };
            
            try { 
                
                var tag = JSON.stringify({tag: "ns=3;s=["+urlSend.namePLC+"]linea_entradas_andon["+ lineData.id +"].sol_lider", type: "Int32"});            
                var solLider = 1//await fetch(urlSend.urlPLC+urlSend.urlPLCrd+tag, headers).then(response => response.json()).then(data => data.data);            
                console.log("solicitando");
                
                if (solLider == 1){         
                    f_MostrarEstaciones();
                    clearInterval( timeEscuchaPLC);                  
                }
                    /*
                 else if (solLider=1 && lineData.solstation>0 && lineData.solApoyoArea<0)   {
                    //Aqui nos quedamos hay que buscar dentro de las solicitudfes de la linea
                   // solApoyoParoLinea(7, 1); 
                    //wait(13);
                    //writeDataOK(7, 1);
                    f_SelectStation(lineData.solstation);
                    clearInterval(timeEscuchaPLC);
                    
                }           
                else if (solLider=1 && lineData.solstation>0 && lineData.solApoyoArea>0) {
                    f_SolicitudApoyo()
                    
                }   */          
            }
            catch(err) {
                swal(
                    'Error conexion datos de produción Errno:24',
                    err.message,
                    'error'

                );
            }
            
            
            } //f_ListenPLC()

function    f_MostrarEstaciones(){               
                let lEstaciones =getLocalStorage("estaciones");            
                var HeaderEficiencia=document.getElementById('HeaderPanelCenter');
                HeaderEficiencia.innerHTML= `<h4 class='m-0 font-weight-bold text-primary  text-light' style='text-align:center'>
                                            Solicitud de apoyo
                                            </h4>`;   
                var divEstaciones = document.getElementById('cardBodyCenter');              
                divEstaciones.innerHTML="";
                for (let index=0;index<lEstaciones.length;index++){
                        let ogroup= lEstaciones[index];
                        divEstaciones.innerHTML= divEstaciones.innerHTML +                                                             
                        `<div class="row form-group">
                                <div class="col-xl-12">
                                    <button class="btn btn-block  bg-secondary text-white" onclick="f_SelectStation(${ogroup.id })" >
                                     Est. ${ogroup.pos }   </button>
                                </div>
                        </div>`;
                }
                //console.log(timeEscuchaPLC);
                //clearTimeout(timeEscuchaPLC );
                   //Reduce el mensaje a una hora
            }




var vstation;
function    f_SelectStation(vstation){            
                let lineData=   getLocalStorage("lineData");
                lineData.solstation=vstation;
                f_save_LineData(lineData.id,lineData.name,vstation,0,"")  //Se guarda la estación
                let estacion={
                    id:0,
                    nombre:"",
                    pos:0
                }
                let lEstaciones =getLocalStorage("estaciones");          
                for (let index=0;index<lEstaciones.length;index++){
                    let ogroup= lEstaciones[index];
                    if (ogroup.id==vstation )
                    {
                        estacion.id=vstation;
                        estacion.nombre=ogroup.estacion;
                        estacion.pos=ogroup.pos;
                    }

                }


                var HeaderEficiencia=document.getElementById('HeaderPanelCenter');
                HeaderEficiencia.innerHTML=`<h4 class='m-0 font-weight-bold text-primary text-light' style='text-align:left'> 
                                         Solicitud de apoyo Est.  ${estacion.pos} ${estacion.nombre}  </h4>`;  
                                         
              f_SolicitudApoyo();                           
            }


function    f_SolicitudApoyo(){              
            const elementoTable = document.getElementById('cardBodyCenter');
            elementoTable.innerHTML="";
            let listGroups=   getLocalStorage("catHelp");
              
                
                for (let index=0;index<listGroups.length;index++){

                    let ogroup= listGroups[index];
                    //console.log(ogroup);
                        
                    elementoTable.innerHTML=elementoTable.innerHTML +                                                             
                    `<div class="row form-group">
                        <div class="col-xl-12">
                            <button class="btn btn-block btn-primary" onclick="f_SolicitudApoyoArea(${ogroup.id } )" >
                            ${ogroup.name}</button></div></div>`;
                            
                }
            }
          

var nombreApoyoArea;

function f_SolicitudApoyoArea(solApoyoArea){
            //Guardamos el dato de apoyo.
                //Sin perder tiempo se desarrolla la ayuda por telegram
                let lineData=   getLocalStorage("lineData");
                let listGroups = getLocalStorage("catHelp");  
                const elementoTable = document.getElementById('cardBodyCenter');
                elementoTable.innerHTML="";

                for (let index=0;index<listGroups.length;index++){
                    let ogroup= listGroups[index];
                    if (ogroup.id==solApoyoArea){
                            //console.log(ogroup);
                            elementoTable.innerHTML=elementoTable.innerHTML +      
                            `<div class="row form-group"><div class="col-xl-12">Solicitud de apoyo1: ${ ogroup.name} </div></div>`;
                            f_save_LineData(lineData.id,lineData.name,lineData.solstation,solApoyoArea,ogroup.name)
                        }                            
                }

                /*Aqui va la carga de los que realizaremos mensajes de telegram */
                // console.log(lineData.line);                
                f_callInitGroup(solApoyoArea);    


                if (solApoyoArea==99){

                    //Desplegar la ayuda de solicitud de Apoyo sin paro de linea
                    elementoTable.innerHTML=elementoTable.innerHTML  +      
                    '<tr><td><button class="btn btn-block" onclick=f_verif_linea(1)><h6>Junta/Entrenamiento</h6></button></td></tr>' +
                    '<tr><td><button class="btn btn-block" onclick=f_verif_linea(2)><h6>Seguridad</h6></button></td></tr>' +
                    '<tr><td><button class="btn btn-block" onclick=f_verif_linea(3)><h6>Sanitario</h6></button></td></tr>' +
                    '<tr><td><button class="btn btn-block" onclick=f_verif_linea(4)><h6>Otros</h6></button></td></tr>' ;
                }
        }
                    
async function  solApoyoParoLinea(datoPLC) {
        let lineData=   getLocalStorage("lineData");
        let urlSend=    getLocalStorage("URLPLC");        
        
        try {
            
                    var tags = {
                        tagsSBL: [
                            {tag: 'ns=3;s=['+ urlSend.namePLC +']linea_entradas_andon['+ lineData.id +'].retro_lider', type: 'Int32', value: datoPLC},
                        ]
                    }
                    for(let tag of tags.tagsSBL){

                        let headers = { 
                            method: 'POST',
                            body: JSON.stringify(tag),
                            headers: {    
                            "content-type": "application/json; charset=utf-8"
                            }
                        };
                    
                       await fetch(urlSend.urlPLC+ urlSend.urlPLCwr, headers); 
                      // Se desactiva para efectos de mostrar resultados
                    }
                } catch (error) {
                    swal(
                        'Error al enviar mensaje datos de produción Errno:25',
                        error.message,
                        'error'                
                    );                                
                }                                
        }

            
            var OKDATA;
async function  f_writeDataOK(OKDATA) {
                
                let lineData=   getLocalStorage("lineData");
                if (OKDATA==-1){OKDATA=lineData.solarea;}
                let urlSend=    getLocalStorage("URLPLC");        
                var tags = {
                    tagsSBL: [
                    {tag: 'ns=3;s=['+ urlSend.namePLC +']linea_entradas_andon['+ lineData.id  +'].Return', type: 'Int32', value: OKDATA}]
                }
                for(let tag of tags.tagsSBL){

                    let headers = { 
                        method: 'POST',
                        body: JSON.stringify(tag),
                        headers: {    
                        "content-type": "application/json; charset=utf-8"
                        }
                    };
                
                    await fetch(urlSend.urlPLC+ urlSend.urlPLCwr, headers); 
                }
            }

//------------------------------------------------------------------------------------------------
var vgroup;
    function f_callInitGroup(vgroup){         //ver si en otra parte lo llaman para que se muestre
            console.log("grupoayuda"+vgroup);
           let lineData=   getLocalStorage("lineData");
            var elementoTable = document.getElementById('cardBodyCenter');
            $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                url: '/button/andon/orgchart/2/' + vgroup + '/1',
                type: 'GET',
                success: function (response) {
                    
                    if(response.length>0){   
                       
                        response[0].forEach(function (elemento, indice) { 
                           // console.log('elemento:' + elemento['name']);
                            elementoTable.innerHTML=elementoTable.innerHTML +      
                            `<div class="row form-group"><div class="col-xl-12">${elemento["name"]}   </div></div>`;     
                            //+ elemento["time1"] 
                        });       
                        elementoTable.innerHTML=elementoTable.innerHTML + `<div class="col-xl-12" id="Incidencia"><button onclick="f_SolucionarPeticionTemp() class="btn btn-block bg-devicor">Terminar operacion</button> </div>`;
                          
                        solApoyoParoLinea(vgroup);     
              f_callTelegram(vgroup,1,lineData.id,"Suceso en la linea" + lineData.name + " estacion:"  + lineData.solareaName );
              //Se comenta para poder avanzar
          }   
      }
      
    });
     /*fin  de dsacar los grupos*/

    }


  function   f_reportarDefecto(){
                
    
                /*/button/andon/setdefectos/{param1}/{param2}/{param3}/{param4} */

                let lineData=   getLocalStorage("lineData");
                //Tomar el codigo capturado
                var txtcodigo =  document.getElementById('txtcodigo').value;
                var txtcantidad= 2//document.getElementById('txtcantidad').value;
                var lote="F12201230D"; //Se puede obtener del info andon
                //  lineData.id;

                      $.ajaxSetup({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                        });
                        $.ajax({
                            url: '/button/andon/setdefectos/'+ txtcodigo + '/' + txtcantidad + '/'+ lineData.id +'/' + lote ,
                            type: 'GET',
                            success: function (response) {                    
                                        if(response.length>0){                          
                                                response[0].forEach(function (elemento, indice) { 
                                                        // console.log('elemento:' + elemento['name']);
                                                        //Se modifica la grafica
                                                        elementoTable.innerHTML=elementoTable.innerHTML +      
                                                        '<tr><td> <h6>'+ elemento["name"] + '00:03:00' + '</h6></td></tr>' 
                                                        '<tr><td> <button><h4>Atender</h4></button></td></tr>';     
                                                           
                                                        //+ elemento["time1"] 
                                                        });    
                                                        
                                                        
                                                }   
                            }      
                            });
                              


            }


            async function f_SolucionarPeticionTemp(){
                let urlSend=    getLocalStorage("URLPLC");
                let lineData=   getLocalStorage("lineData");
                var tag = JSON.stringify({tag: "ns=3;s=["+ urlSend.namePLC +"]linea_entradas_andon["+ lineData.id  + "].Return", type: "Int32", value: lineData.solarea });  

                let headers = {
                    method: 'POST',
                    body: tag,
                    headers: {
                    "content-type": "application/json; charset=utf-8"
                    }
                };
               
               // console.log("salida teomporal: " + lineData.solarea);
                var datoLeido = await fetch(urlSend.urlPLC+urlSend.urlPLCwr, headers).then(response => response.json()).then(data => data.data);
                //console.log(datoLeido);
               // setTimeout("f_setClock()",10000);
              
              }


//-------------------------------------------------------------------------------------------------