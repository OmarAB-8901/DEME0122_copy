/*
    Funciones que se necesitam en la vista button.blade.php
    FEME 03/12/2022
*/

async function f_SetPlan(){
    var lote ="21492565_test1";
    var plan="F12201230D_test1"; //partid

    var urlPLC = 'http://10.11.24.233:1880/'
    
    let tags = {
        tagsSBL: [
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Ready[1]", type: "Bool", value: 1},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Run[1]", type: "Bool", value: 1},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.TotalParts[1]", type: "Int32", value: 1},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Scrap[1]", type: "Int32", value: 0},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.ICT[1]", type: "Int32", value: 56},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.HabSensor[1]", type: "Bool", value: 0},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.loteid[1]", type: "String", value: lote},
            {tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.parteid[1]", type: "String", value: plan}
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
                //wait(2);                
            let lineData=   getLocalStorage("lineData");
            let urlSend=    getLocalStorage("URLPLC");
            let headers = {
                method: 'GET',
                headers: {"content-type": "application/json; charset=utf-8"}
            };
            
            try { 
                
                var tag = JSON.stringify({tag: "ns=3;s=["+urlSend.namePLC+"]linea_entradas_andon["+ lineData.id +"].sol_lider", type: "Int32"});            
                var solLider = 1//await fetch(urlSend.urlPLC+urlSend.urlPLCrd+tag, headers).then(response => response.json()).then(data => data.data);            
                
                
                if (solLider == 1 && lineData.solstation ==0 ){              
                  //  wait(2);
                    swal({
                        title: "¡Solicitud de atención!",
                        text: "Se solicita apoyo en estación!",
                        icon: "info",
                        button: "Revisar condición",
                        });
                    f_MostrarEstaciones();
                }
                 else if (solLider=1 && lineData.solstation>0 && lineData.solApoyoArea<0)   {
                    //Aqui nos quedamos hay que buscar dentro de las solicitudfes de la linea
                    //solApoyoParoLinea(7, 1); 
                    //wait(13);
                    //writeDataOK(7, 1);
                    f_SelectStation(lineData.solstation);
                }           
                else if (solLider=1 && lineData.solstation>0 && lineData.solApoyoArea>0) {
                    f_SolicitudApoyo()
                    
                }             
            }
            catch(err) {
                swal(
                    'Error conexion datos de produción Errno:24',
                    err.message,
                    'error'

                );
            }
            setTimeout("f_ListenPLC()",60000);
            } //f_ListenPLC()

function    f_MostrarEstaciones(){   
            let lEstaciones =getLocalStorage("estaciones");
            var HeaderEficiencia=document.getElementById('HeaderEficiencia');
            HeaderEficiencia.innerHTML="<h4 class='m-0 font-weight-bold text-primary  text-light' style='text-align:center'>Solicitud de apoyo</h4>";   
            var tblEstaciones = document.getElementById('consola');  
            tblEstaciones.innerHTML="<tr>";  

            for (let index=0;index<lEstaciones.length;index++){
                    let ogroup= lEstaciones[index];
                    tblEstaciones.innerHTML= tblEstaciones.innerHTML +                                                             
                    '<tr><td><button class="btn btn-block" onclick=\"f_SelectStation('+ ogroup.id +')" >'
                    + 'Est.' + ogroup.pos + ' ' + ogroup.estacion+ '</button></td></tr>';
                }
            }


var vstation;
function    f_SelectStation(vstation){            
            let lineData=   getLocalStorage("lineData");
            lineData.solstation=vstation;
            f_save_LineData(lineData.id,lineData.name,vstation,0,"")  //Se guarda la estación
            var HeaderEficiencia=document.getElementById('HeaderEficiencia');
            HeaderEficiencia.innerHTML="<h4 class='m-0 font-weight-bold text-primary " + 
                                        " text-light' style='text-align:left'>" +
                                        " Solicitud de apoyo Est." + vstation + "</h4>";   
                                      
            f_SolicitudApoyo();
            }


function    f_SolicitudApoyo(){              
            const elementoTable = document.getElementById('consola');
            elementoTable.innerHTML="";
            let listGroups=   getLocalStorage("catHelp");
                
                for (let index=0;index<listGroups.length;index++){
                    let ogroup= listGroups[index];
                    elementoTable.innerHTML=elementoTable.innerHTML +                                                             
                    '<tr><td><button class="btn btn-block" onclick=\"f_SolicitudApoyoArea('+ ogroup.id +')" >'
                    + ogroup.name+ '</button></td></tr>';

                }
            }
          

var nombreApoyoArea;

function f_SolicitudApoyoArea(solApoyoArea){
            //Guardamos el dato de apoyo.
                //Sin perder tiempo se desarrolla la ayuda por telegram
                let lineData=   getLocalStorage("lineData");
                let listGroups = getLocalStorage("catHelp");  
                const elementoTable = document.getElementById('consola');
                elementoTable.innerHTML="";

                for (let index=0;index<listGroups.length;index++){
                    let ogroup= listGroups[index];
                    if (ogroup.id==solApoyoArea){
                        //console.log(ogroup);
                        elementoTable.innerHTML=elementoTable.innerHTML +      
                        '<tr><td><h6>Solicitud de apoyo1: '+ ogroup.name +'</h6></td></tr>';
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
                    
                      // await fetch(urlSend.urlPLC+ urlSend.urlPLCwr, headers); 
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
           // console.log(vgroup);
            var elementoTable = document.getElementById('consola');
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
                            '<tr><td><h6>'+ elemento["name"] + ' ' + elemento["time1"] + '</h6></td></tr>';     
                        });            
              //f_callTelegram(2,1,)
              //Se comenta para poder avanzar
          }   
      }
      
    });
     /*fin  de dsacar los grupos*/

    }



//-------------------------------------------------------------------------------------------------