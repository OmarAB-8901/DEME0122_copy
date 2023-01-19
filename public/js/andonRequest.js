function f_save_LineData(vidline,vlinename,vstation,vsolarea,vsolareaname){
    //Save into LocalStorage the line Data  FEME
    let Line={
            id:             vidline,
            name :          vlinename,
            solstation :    vstation,
            solarea :       vsolarea,
            solareaName:    vsolareaname
        };
    localStorage.setItem("lineData",JSON.stringify(Line));
}

function f_save_UrlServerAPIs(){
    //Save de URL into local Storage FEME}
    let URLRequest={
    //         urlTelegram:    "http://10.11.30.126:1880",
    //         urlPLC:         "http://10.11.30.126:1880",
    //         urlServer:      "http://10.11.30.126:1880",
            urlTelegram:    "http://127.0.0.1:1880",
            urlPLC:         "http://127.0.0.1:1880",
            urlServer:      "http://127.0.0.1:1880",
            urlPLCwr:       "/sbl_tags/writeTags",
            urlPLCrd:       "/sbl_tags/readSolLider?data=",
            urlTelwr:       "/sbl/sendTelegramMessage",
            namePLC:        "PLC_ANDON"
        };
    localStorage.setItem("URLPLC",JSON.stringify(URLRequest));
}

var vlocalstorage;
function getLocalStorage(vlocalStorage){
    let localst="";
    if (localStorage.getItem(vlocalStorage)){
        localst=JSON.parse(localStorage.getItem(vlocalStorage));
    }
    return localst;
}


//Saber objeto para ver la información de cada linea.


var vveriflinea;
function f_verif_linea(vveriflinea){
    //Enviar como seal el numer 99
     //Se alamacena en el sitema no se requiere paro.
     //Colocar los componentes del almacenamiento de la linea
     let lineData=   getLocalStorage("lineData");
     let listGroups = getLocalStorage("catHelp");  
     let elementodiv = document.getElementById('cardBodyCenter');
     elementodiv.innerHTML="";
     elementodiv.innerHTML=`<div class='row'><div class='col-xl-12'>Personal</div></div>
                                <div class='row  form-group'>
                                        <div class='col-xl-4'>Descripción</div>
                                        <div class='col-xl-8'>                                            
                                                <textarea name="mensaje" placeholder="Descripción"></textarea>
                                            </div>
                                </div>
                                <div class='row  form-group'>
                                    <div class='col-xl-4'>Credencial de usuario 1:</div>
                                    <div class='col-xl-8'><input type="text"></div>
                                </div>
                                <div class='row  form-group'>
                                    <div class='col-xl-4'>Credencial de usuario 2:</div>
                                    <div class='col-xl-8'><input type="text"></div>
                                </div>
                                <div class='row  form-group'>
                                    <div class='col-xl-4'></div>
                                    <div class='col-xl-8'><input  id="btnEnviarPersonal" onclick="f_writeDataOK2(99)" type="submit" value="Enviar mensaje"></p></div>
                                </div>
                                
                            </div>`
                            
     //{"id":"1","name":"77 Gel","solstation":16,"solarea":99,"solareaName":"Personal"}

     //f_writeDataOK2(99); // ha que almacenar la fecha  y hora de la salida.
    



}

//{"id":"1","scrapname":"001","scrapdescription":"Medici\u00f3n de col\u00e1geno","defectosaceptados":"5","codigo":"3","idtiposscrap":"1","tiposcrap":"AJUSTES (Set-up)","idgroup":"6","gruponame":"Produccion"},
class Scrap { 
    constructor(id, scrapname,scrapdescription,defectosaceptados,codigotiposcrap, idtiposcrap,tiposscrap,idgroup,groupname) {
      this.id = id;
      this.scrapname = scrapname;
      this.scrapdescription=scrapdescription;
      this.defectosaceptados=defectosaceptados;
      this.codigotiposcrap=codigotiposcrap;
      this.idtiposcrap=idtiposcrap;
      this.tiposscrap=tiposscrap;
      this.idgroup=idgroup;
      this.groupname=groupname;      

    }
  }






