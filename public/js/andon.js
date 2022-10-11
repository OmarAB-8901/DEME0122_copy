var idmachine = $('#idmachine').val();
var date = $('#date').val(); 
//arrays de prueba ver los valores
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/andon/' + idmachine + '/d/' + date +'/1'+ '/datos',
        type: 'GET',
        success: function (response) {
            
            response.forEach(function(elemento, indice){

                var resAvailability = elemento[0].AvailabilityG+'%';
                $("#resAvailability").html(resAvailability);

                var resThroghput = elemento[0].performanceG+'%';
                $("#resThroghput").html(resThroghput);

                var resQuality = elemento[0].qualityG+'%';
                $("#resQuality").html(resQuality);

                var resOee = elemento[0].OEEG+'%';
                $("#resOee").html(resOee);


            });
            
        }
    });
});