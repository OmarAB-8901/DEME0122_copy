function Monitoreo(){
    varh = [];
    varl = [];
    mensaje = "";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/trends/1/monitoreo',
        type: 'GET',
        success: function (response) {
            if(response.length>0){
                response.forEach(function (elemento, indice) {
                    
                    if(elemento['value'] < elemento['lowLimit']){
                        varl.push(elemento['name']);
                        varl.push(elemento['machine']);
                        varl.push(elemento['value']);
                        varl.push(elemento['lowLimit']);
                    }else{
                        varh.push(elemento['name']);
                        varh.push(elemento['machine']);
                        varh.push(elemento['value']);
                        varh.push(elemento['lowLimit']);

                    }
                });
                for (var i = 0; i < varl.length; i++) {
                    mensaje = mensaje + 'La variable: ' + varl.shift() + ' de la máquina: '+ varl.shift() + ' = ' + varl.shift() +'   <   '+varl.shift() + ' <br>' 
                }
                for (var i = 0; i < varh.length; i++) {
                    mensaje = mensaje  + 'La variable: ' + varh.shift() + ' de la máquina: '+ varh.shift()+ ' = ' +  varh.shift() +'   >   '+varh.shift() + ' <br>' 
                }
                swal(
                    'Requieren Atención',
                    mensaje,
                    'warning'

                );
            }   
        }
        
    });
}
setInterval('Monitoreo()',60000);