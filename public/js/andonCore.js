/*
    Funciones que se necesitam en la vista button.blade.php
    FEME 03/12/2022
*/
//Cambiar la producción

var banderaSolicitud = 0;
var tickftimeratencion

var estacion = {
    id: 0,
    nombre: "",
    pos: 0
}

async function f_SetPlan() {
    var vid;
    let lineData = getLocalStorage("lineData");

    // vid = $("#planes").children(":selected").attr("value");
    vid = document.getElementById('planes').value.split(":")[1];

    let objPlanes2
    for (let objPlanes of listaPlanes) {

        if (objPlanes.id == vid) {

            objPlanes2 = {
                id: objPlanes['id'],
                wo: objPlanes['wo'],
                nombre: objPlanes.nombre,
                cantasoc: objPlanes.cantasoc,
                lote: objPlanes.lote,
                ict: objPlanes.ict,
                estado: objPlanes.estado
            }
        }
    }

    // console.log( 'id:' + objPlanes2.id+" "+ objPlanes2.wo,objPlanes2.lote,objPlanes2.ict)

    let urlSend = getLocalStorage("URLPLC");
    let tags = {
        tagsSBL: [
            { tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Ready[" + lineData.id + "]", type: "Int32", value: 1 },
            { tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Run[" + lineData.id + "]", type: "Int32", value: 1 },
            { tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.TotalParts[" + lineData.id + "]", type: "Int32", value: 1 },
            { tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.Scrap[" + lineData.id + "]", type: "Int32", value: 0 },
            { tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.ICT[" + lineData.id + "]", type: "Float", value: objPlanes2.ict },
            { tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.loteid[" + lineData.id + "]", type: "String", value: objPlanes2.lote },
            { tag: "ns=3;s=[PLC_ANDON]BD_Entradas_OEE.parteid[" + lineData.id + "]", type: "String", value: objPlanes2.wo }
        ]
    }

    for (let tag of tags.tagsSBL) {

        let headers = {
            method: 'POST',
            body: JSON.stringify(tag),
            headers: {
                "content-type": "application/json; charset=utf-8"
            }
        };

        await fetch(urlSend.urlPLC + urlSend.urlPLCwr, headers);
    }
127
7

    let newPlan = document.getElementById('planes').value;
    f_ConInfoAndon(true, newPlan);
}

async function f_ListenPLC() {
    //Escucha la CPU del PLC para extraer si hay alguna peticion por parte del Lider

    let lineData = getLocalStorage("lineData");
    let urlSend = getLocalStorage("URLPLC");
    let headers = {
        method: 'GET',
        headers: { "content-type": "application/json; charset=utf-8" }
    };

    try {

        var tag = JSON.stringify({ tag: "ns=3;s=[" + urlSend.namePLC + "]linea_entradas_andon[" + lineData.id + "].sol_lider", type: "Int32" });
        var solLider = await fetch(urlSend.urlPLC + urlSend.urlPLCrd + tag, headers).then(response => response.json()).then(data => data.data);

        if (solLider == 1) {

            f_MostrarEstaciones();
            clearInterval(timeEscuchaPLC);
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
    catch (err) {
        console.log(err.message);
        /*
        swal(
            'Error conexion datos de produción Errno:24',
            err.message,
            'error'

        );*/
    }
} //f_ListenPLC()

async function f_MostrarEstaciones() {
    /*Se debe de agregar las botoneras que se presionan */
    let headers = {
        method: 'GET',
        headers: { "content-type": "application/json; charset=utf-8" }
    };

    let lEstaciones = getLocalStorage("estaciones");
    let urlSend = getLocalStorage("URLPLC");
    let lineData = getLocalStorage("lineData");
    let btnsignal = { btn: 0, signal: 0 };
    let aux = 1;
    while (aux <= 4) {

        var tag = JSON.stringify({ tag: "ns=3;s=[" + urlSend.namePLC + "]linea_entradas_andon[" + lineData.id + "].operador[" + aux + "]", type: "Int32" });
        var operador = await fetch(urlSend.urlPLC + urlSend.urlPLCrd + tag, headers).then(response => response.json()).then(data => data.data);
        // console.log(operador);
        //console.log(urlSend.urlPLC+urlSend.urlPLCrd+tag);

        if (operador == true) {
            btnsignal.btn = aux;
            btnsignal.signal = 1;
            aux = 5;
        }
        aux++;
    }

    //   btnsignal.btn=3;  // etse es para el boton que presionation
    // btnsignal.signal=1; //este es para la se;at de que si se efetuo\

    // console.log(btnsignal.btn);

    var HeaderEficiencia = document.getElementById('HeaderPanelCenter');
    HeaderEficiencia.innerHTML = `<h2 class='m-0 font-weight-bold text-primary  text-light' style='text-align:center'>
                                            Solicitud de apoyo
                                            </h2>`;
    var divEstaciones = document.getElementById('cardBodyCenter');
    divEstaciones.innerHTML = "";
    divEstaciones.style.backgroundColor = 'orange';
    for (let index = 0; index < lEstaciones.length; index++) {
        let ogroup = lEstaciones[index];
        if (ogroup.button == btnsignal.btn) {
            divEstaciones.innerHTML = divEstaciones.innerHTML +
                `<div class="row form-group">
                                <div class="col-xl-12">
                                    <button class="btn btn-block  bg-secondary text-white" onclick="f_SelectStation(${ogroup.id})" >
                                     Est. ${ogroup.pos}   </button>
                                </div>
                                </div>`;


        }

    }
    //console.log(timeEscuchaPLC);
    //clearTimeout(timeEscuchaPLC );
    //Reduce el mensaje a una hora
    
}




var vstation;
function f_SelectStation(vstation) {
    let lineData = getLocalStorage("lineData");
    lineData.solstation = vstation;
    f_save_LineData(lineData.id, lineData.name, vstation, 0, "")  //Se guarda la estación

    let lEstaciones = getLocalStorage("estaciones");
    for (let index = 0; index < lEstaciones.length; index++) {
        let ogroup = lEstaciones[index];
        if (ogroup.id == vstation) {
            estacion.id = vstation;
            estacion.nombre = ogroup.estacion;
            estacion.pos = ogroup.pos;
        }

    }


    var HeaderEficiencia = document.getElementById('HeaderPanelCenter');
    HeaderEficiencia.innerHTML = `<h4 class='m-0 font-weight-bold text-primary text-light' style='text-align:left'> 
                                         Solicitud de apoyo Est.  ${estacion.pos} ${estacion.nombre}  </h4>`;

    f_SolicitudApoyo();
}


function f_SolicitudApoyo() {
    const elementoTable = document.getElementById('cardBodyCenter');
    elementoTable.innerHTML = "";
    let listGroups = getLocalStorage("catHelp");


    for (let index = 0; index < listGroups.length; index++) {

        let ogroup = listGroups[index];
        //console.log(ogroup);

        elementoTable.innerHTML = elementoTable.innerHTML +
            `<div class="row form-group">
                        <div class="col-xl-12">
                            <button class="btn btn-block btn-primary" onclick="f_SolicitudApoyoArea(${ogroup.id} )" >
                            ${ogroup.name}</button></div></div>`;

    }
}


var nombreApoyoArea;

function f_SolicitudApoyoArea(solApoyoArea) {
    //Guardamos el dato de apoyo.
    //Sin perder tiempo se desarrolla la ayuda por telegram
    let lineData = getLocalStorage("lineData");
    let listGroups = getLocalStorage("catHelp");
    let elementodiv = document.getElementById('cardBodyCenter');
    elementodiv.innerHTML = "";

    for (let index = 0; index < listGroups.length; index++) {
        let ogroup = listGroups[index];
        if (ogroup.id == solApoyoArea) {
            //console.log(ogroup);
            elementodiv.innerHTML = elementodiv.innerHTML +
                `<div class="row form-group"><div class="col-xl-12"><h2>Solicitud de apoyo: ${ogroup.name}</h2> </div></div>`;
            f_save_LineData(lineData.id, lineData.name, lineData.solstation, solApoyoArea, ogroup.name)
        }
    }

    /*Aqui va la carga de los que realizaremos mensajes de telegram */
    // console.log(lineData.line);                
    if (solApoyoArea > 99) {
        f_callInitGroup(solApoyoArea);
    }
    else {
        //Desplegar la ayuda de solicitud de Apoyo sin paro de linea
        elementodiv.innerHTML = elementodiv.innerHTML +
            `<div class="row form-group">
                                <div class="col-xl-4">
                                    <button id="btn2" class="btn bg-gold  btn-lg btn-block bg-secondary text-white" onclick=f_verif_linea(1)>  
                                            <h6>Junta/Entrenamiento</h6></button>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xl-4">
                                    <button id="btn2" class="btn bg-gold  btn-lg btn-block bg-secondary text-white" onclick=f_verif_linea(2)>  
                                            <h6>Seguridad</h6></button>
                                </div>                    
                            </div>
                            <div class="row form-group">
                                <div class="col-xl-4">
                                    <button id="btn2" class="btn bg-gold  btn-lg btn-block bg-secondary text-white" onclick=f_verif_linea(3)>  
                                            <h6>Sanitario</h6></button>
                                </div>                    
                            </div>
                            <div class="row form-group">
                            <div class="col-xl-4">
                                <button id="btn2" class="btn bg-gold  btn-lg btn-block bg-secondary text-white" onclick=f_verif_linea(4)>      
                                        <h6>Otros</h6></button>
                            </div>                    
                            </div>`                 ;
    }
}

async function solApoyoParoLinea(datoPLC) {
    let lineData = getLocalStorage("lineData");
    let urlSend = getLocalStorage("URLPLC");

    try {

        var tags = {
            tagsSBL: [
                { tag: 'ns=3;s=[' + urlSend.namePLC + ']linea_entradas_andon[' + lineData.id + '].retro_lider', type: 'Int32', value: datoPLC },
            ]
        }
        for (let tag of tags.tagsSBL) {

            let headers = {
                method: 'POST',
                body: JSON.stringify(tag),
                headers: {
                    "content-type": "application/json; charset=utf-8"
                }
            };

            await fetch(urlSend.urlPLC + urlSend.urlPLCwr, headers);
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
async function f_writeDataOK(OKDATA) {

    let lineData = getLocalStorage("lineData");
    if (OKDATA == -1) { OKDATA = lineData.solarea; }
    let urlSend = getLocalStorage("URLPLC");
    var tags = {
        tagsSBL: [
            { tag: 'ns=3;s=[' + urlSend.namePLC + ']linea_entradas_andon[' + lineData.id + '].Return', type: 'Int32', value: OKDATA }]
    }
    for (let tag of tags.tagsSBL) {

        let headers = {
            method: 'POST',
            body: JSON.stringify(tag),
            headers: {
                "content-type": "application/json; charset=utf-8"
            }
        };

        await fetch(urlSend.urlPLC + urlSend.urlPLCwr, headers);
    }
}

async function f_writeDataOK2(OKDATA) {

    let lineData = getLocalStorage("lineData");
    if (OKDATA == -1) { OKDATA = lineData.solarea; }
    let urlSend = getLocalStorage("URLPLC");
    var tags = {
        tagsSBL: [
            { tag: 'ns=3;s=[' + urlSend.namePLC + ']linea_entradas_andon[' + lineData.id + '].retro_lider', type: 'Int32', value: OKDATA }]
    }
    for (let tag of tags.tagsSBL) {

        let headers = {
            method: 'POST',
            body: JSON.stringify(tag),
            headers: {
                "content-type": "application/json; charset=utf-8"
            }
        };

        await fetch(urlSend.urlPLC + urlSend.urlPLCwr, headers);
    }

    f_ConInfoAndon();
}



var idEventos = "";

//------------------------------------------------------------------------------------------------
var ListAtencion = [];
var vgroup;
function f_callInitGroup(vgroup) {         //ver si en otra parte lo llaman para que se muestre
    //console.log("grupoayuda"+vgroup);
    let lineData = getLocalStorage("lineData");
    var elementoTable = document.getElementById('cardBodyCenter');
    var elemtablePersonal = document.getElementById('tblPersonalOpcion'); //tblPersonalOpcion
    elementoTable.innerHTML = elementoTable.innerHTML + `<div  class="row form-group"><div class="col-xl-6">
            <h4 id="timeratencion">00:00:00</h4>
            </div></div>`;
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        url: '/button/andon/orgchart/2/' + vgroup + '/1',
        type: 'GET',
        success: function (response) {

            if (response.length > 0) {
                let contador1 = 0;
                //elementoTable.innerHTML=elementoTable.innerHTML+'<div id="tblGroupPersonal">';
                response[0].forEach(function (elemento, indice) {
                    elemtablePersonal.innerHTML = elemtablePersonal.innerHTML +
                        `<div class="row form-group"><div class="col-xl-6"><h4>Personal: ${elemento["name"]}</h4></div> 
                            <div class="col-xl-6"><button class="btn btn-secondary btn-block" onclick="f_atender( ${elemento["id"]})">Atender</button></div></div>
                           `;

                    contador1 = contador1 + parseInt(elemento['time1'])
                    let objAtencion = {
                        id: elemento['id'],
                        name: elemento['name'],
                        time1: elemento['time1'],
                        time2: elemento['time2'],
                        telegramId: elemento['telegramId'],
                        ord_num: elemento['ord_num'],
                        tipoatencion: elemento['tipo'],
                        acumulado1: contador1,
                        idgroup: elemento['idgroup'],
                        idgroupt: elemento['idgroupt'],
                        shiftid: elemento['shiftId'],
                        lineData: lineData.id
                    }
                    ListAtencion.push(objAtencion);
                });
                elemtablePersonal.innerHTML = elemtablePersonal.innerHTML + `</div>`;

                solApoyoParoLinea(vgroup);


                tickftimeratencion = setInterval(f_timerAtencion, 1000);

                //Se comenta para poder avanzar
            }
        }

    });
    /*fin  de dsacar los grupos*/

}


function f_reportarDefecto() {

    //Reportar defecto  para que pueda ser incluido en los defectos de la linea               

    let lineData = getLocalStorage("lineData");
    //Tomar el codigo capturado
    var txtcodigo = document.getElementById('txtcodigo').value;

    var txtcantidad = document.getElementById('txtcantidad').value;
    var lote = "F12201230D"; //Se puede obtener del info andon





    //  lineData.id;

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        url: '/button/andon/setdefectos/' + txtcodigo + '/' + txtcantidad + '/' + lineData.id + '/' + lote,
        type: 'GET',
        success: function (response) {
            if (response.length > 0) {
                response[0].forEach(function (elemento, indice) {
                    // console.log('elemento:' + elemento['name']);
                    //Se modifica la grafica
                    elementoTable.innerHTML = elementoTable.innerHTML +
                        '<tr><td> <h6>' + elemento["name"] + '00:03:00' + '</h6></td></tr>'
                    '<tr><td> <button><h4>Atender</h4></button></td></tr>';

                    //+ elemento["time1"] 
                });


            }
        }
    });

    txtcodigo = '';
    txtcantidad = '';


}


async function f_SolucionarPeticionTemp() {
    // console.log("Temporales");
    let urlSend = getLocalStorage("URLPLC");
    let lineData = getLocalStorage("lineData");
    var tag = JSON.stringify({ tag: "ns=3;s=[" + urlSend.namePLC + "]linea_entradas_andon[" + lineData.id + "].Return", type: "Int32", value: lineData.solarea });

    let headers = {
        method: 'POST',
        body: tag,
        headers: {
            "content-type": "application/json; charset=utf-8"
        }
    };

    var datoLeido = await fetch(urlSend.urlPLC + urlSend.urlPLCwr, headers).then(response => response.json()).then(data => data.data);
}

var vopcion = 0;
//-------------------------------------------------------------------------------------------------
function f_atender(vatender) {

    let lineData = getLocalStorage("lineData");
    let catHelp = getLocalStorage("catHelp"); //Estar pendiente de quien atiende cuando se reasigna
    document.getElementById("tblPersonalOpcion").style.display = 'none';
    document.getElementById("HeaderPanelCenter").style.color = "Red";
    var elem = document.getElementById('tblPersonalOpcion2');
    elem.innerHTML = "";
    /*Se atiende falta el boton dende incluye la linea de atencion */


    /*
    
    Se establece la información de quien atiende.
    */


    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        url: '/button/andon/seteventos/' + lineData.id + '/' + lineData.solarea + '/' + vatender + '/' + vopcion,
        type: 'GET',
        success: function (response) {
            if (response.length > 0) {
                response[0].forEach(function (elemento) {
                    console.log(elemento);
                });


            }
        }
    });





    elem.innerHTML = elem.innerHTML + `       <div class="row">
                                                <div class="col-xl-12"><h4>Atiende: ${ListAtencion[vatender].name} </h4></div></div>
                                                <div class="row">
                                                <div class="col-xl-12" id="Incidencia">
                                                        <button onclick="f_SolucionarPeticionTemp()" class="btn btn-block bg-devicor text-white">
                                                        <h4>Finalizar Operación</h4></button></div></div>
                                                <div class="row">
                                                        <div class="col-xl-12">
                                                            <button class="btn btn-block bg-devicor text-white" onclick='f_reasignar()'><h4>Reasignar</h4></button>
                                                        </div>
                                                </div>` ;

}


var secondsatencion = 1;
var pasaatencion = 0;
var auxatencion = 0
var timeratencion = 0;

function f_timerAtencion() {
    if (secondsatencion == 1) {
        let lineData = getLocalStorage("lineData");
        //Se enviara id group pero se le preguntara a Carlos Omar

        f_callTelegram(ListAtencion[0].idgroup, ListAtencion[0].id, lineData.id, "Suceso en la linea:" + lineData.name + " estacion:" + lineData.solstation);
        timeratencion = ListAtencion[0].acumulado1;
        //console.log('timer:' + timeratencion);
    }
    else if (secondsatencion == timeratencion) {
        auxatencion++;
        f_callTelegram(ListAtencion[auxatencion].idgroup, ListAtencion[auxatencion].id, lineData.id, "Suceso en la linea" + lineData.name + " estacion:" + lineData.solstation);
        timeratencion = ListAtencion[auxatencion].acumulado1;
        //console.log( 'timer 180:' + timeratencion);
    }

    let duration = moment.duration(secondsatencion, 'seconds');
    document.getElementById("timeratencion").innerHTML = duration.hours() + ':' + duration.minutes() + ':' + duration.seconds();
    secondsatencion++;
}

/* La funcion para los eventos
function f_consultaEvento(){

    ///--------------------------------------

          
           $.ajaxSetup({
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
           });
           //http://127.0.0.1:8000/button/andon/coneventos/1/100/1
           $.ajax({
               url: '/button/andon/orgchart/2/' + vgroup + '/1',
               type: 'GET',
               success: function (response) {
                   
                   if(response.length>0){   
                      let contador1=0;
                      
                       response[0].forEach(function (elemento, indice) {                            
                           elementoTable.innerHTML=elementoTable.innerHTML +      
                           `<div class="row form-group"><div class="col-xl-6"><h4>Personal: ${elemento["name"]}</h4></div> 
                            <div class="col-xl-6"><button class="btn btn-secondary btn-block" onclick="f_atender( ${elemento["id"]})">Atender</button></div>
                           </div>`;     
                          
                           contador1=contador1 + parseInt(elemento['time1'])
                           let objAtencion={                               
                               id:             elemento['id'],
                               name:           elemento['name'],
                               time1:          elemento['time1'],
                               time2:          elemento['time2'],
                               telegramId:     elemento['telegramId'],
                               ord_num:        elemento['ord_num'],
                               tipoatencion:   elemento['tipo'],
                               acumulado1:     contador1,
                               idgroup:        elemento['idgroup'],
                               idgroupt:       elemento['idgroupt'],
                               shiftid:        elemento['shiftId'],
                               lineData:       lineData.id                                    
                           }                           
                           ListAtencion.push(objAtencion);                            
                       });       
                       elementoTable.innerHTML=elementoTable.innerHTML +
                        `<div class="col-xl-12" id="Incidencia">
                           <button onclick="f_SolucionarPeticionTemp()" class="btn btn-block bg-devicor">
                               Terminar operacion</button> 
                           </div>`;
                         
                       solApoyoParoLinea(vgroup);     
                       

                       tickftimeratencion= setInterval( f_timerAtencion,1000);
            
             //Se comenta para poder avanzar
         }   
     }
     
   });
    


    //--------------------------------------
}
*/