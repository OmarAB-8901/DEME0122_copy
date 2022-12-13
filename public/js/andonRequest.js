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
            urlTelegram:    "http://10.11.30.126:1880",
            urlPLC:         "http://10.11.24.233:1880",
            urlServer:      "http://10.11.30.126:1880",
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

var vveriflinea;
function f_verif_linea(vveriflinea){
     //Se alamacena en el sitema no se requiere paro.
     
}







