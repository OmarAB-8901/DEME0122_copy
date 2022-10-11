$(document).ready(function () {
    $("#i_dia").click(function() {
        $('.datepicker').css("display", "block");
    });
    $("#i_dia").change(function () {
        $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
        var date = $('#i_dia').val();
        $('.datepicker').css("display", "none");
        var idmachine = $('#idmachine').val();
        $('#i_date').val(date);
        $('#i_casoS').val('1');
        var caso =  $('#i_caso').val();
        var casoS = $('#i_casoS').val();
        var partid = $('#i_partid').val();
        var lotid = $('#i_loteid').val();
        var idshift = $('#i_shift').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/oee/' + idmachine + '/'+ caso +'/' + date +'/'+ casoS +'/'+ partid +'/'+ lotid +'/'+ idshift + '/datos',
            type: 'GET',
            success: function (response) {
                config.data.labels.length = 0;
                config.data.datasets[0].data.length = 0;
                config.data.datasets[1].data.length = 0;
                config.data.datasets[2].data.length = 0;
                config.data.datasets[3].data.length = 0;
                config.options.scales.xAxes[0].scaleLabel.labelString= "Dia";
                
                $("#dataTable").dataTable().fnDestroy();
                $("#cuerpo").empty();
                $('#i_partid').empty();
                $('#i_loteid').empty();
                $('#i_shift').empty();
                $('#i_partid').prepend("<option value='all'  selected>Select all</option>");
                $('#i_loteid').prepend("<option value='all'  selected>Select all</option>");
                $('#i_shift').prepend("<option value='all'  selected>Select all</option>");
                response[1].forEach(function(elemento, indice){
                    configDis.data.datasets[0].data=[elemento.AvailabilityG,elemento.AvailabilityR]
                    configEf.data.datasets[0].data=[elemento.performanceG,elemento. performanceR]
                    configQty.data.datasets[0].data=[elemento.qualityG,elemento.qualityR]
                    configM1.data.datasets[0].data=[elemento.OEEG,elemento.OEER]

                    configDis.options.elements.center.text = elemento.AvailabilityG+'%';
                    configEf.options.elements.center.text = elemento.performanceG+'%';
                    configQty.options.elements.center.text = elemento.qualityG+'%';
                    configM1.options.elements.center.text = elemento.OEEG+'%';

                    var resAvailability = elemento.AvailabilityG+'%';
                    $("#resAvailability").html(resAvailability);

                    var resThroghput = elemento.performanceG+'%';
                    $("#resThroghput").html(resThroghput);

                    var resQuality = elemento.qualityG+'%';
                    $("#resQuality").html(resQuality);

                });
                if (response[1][0].date == null) {
                    
                    configDis.options.elements.center.text = 'No Data';
                    configEf.options.elements.center.text = 'No Data';
                    configQty.options.elements.center.text = 'No Data';
                    configM1.options.elements.center.text = 'No Data';
                    $("#resAvailability").html('No Data');
                    $("#resThroghput").html('No Data');
                    $("#resQuality").html('No Data');

                }

                response[0].forEach(function (elemento, indice) {
                    config.data.labels.push(elemento['date']);
                    config.data.datasets[0].data.push(elemento['availability'])
                    config.data.datasets[1].data.push(elemento['performance'])
                    config.data.datasets[2].data.push(elemento['quality'])
                    config.data.datasets[3].data.push(elemento['oee'])

                });
                response[2].forEach(function (elemento, indice) {
                    var tr = `<tr>
                        <td style="font-size:90%;">`+elemento['date']+`</td>
                        <td style="font-size:90%;">`+elemento['oee']+`</td>
                        <td style="font-size:90%;">`+elemento['availability']+`</td>
                        <td style="font-size:90%;">`+elemento['performance']+`</td>
                        <td style="font-size:90%;">`+elemento['quality']+`</td>
                        <td style="font-size:90%;">`+elemento['runTime']+`</td>
                        <td style="font-size:90%;">`+elemento['availableTime']+`</td>
                        <td style="font-size:90%;">`+elemento['ict']+`</td>
                        <td style="font-size:90%;">`+elemento['totalPieces']+`</td>
                        <td style="font-size:90%;">`+elemento['goodParts']+`</td>
                        <td style="font-size:90%;">`+elemento['partId']+`</td>
                        <td style="font-size:90%;">`+elemento['lotId']+`</td>
                        <td style="font-size:90%;">`+elemento['turno']+`</td>
                    </tr>`
                        $("#cuerpo").append(tr)

                });
                $('#dataTable').DataTable({
                        "pageLength": 50,
                        "order": [[ 1, "desc" ]],
                        "searching": false
                });
                response[3].forEach(function (elemento, indice) {
                    $("#RunningTime").html(elemento['RunningTime']);
                    $("#AvailableTime").html(elemento['AvailableTime']);

                    $("#TotalParts").html(elemento['TotalParts']);
                    $("#IdealCycleTime").html(elemento['ICT']);
                    $("#RunningTime2").html(elemento['RunningTime']);

                    $("#GoodParts").html(elemento['GoodParts']);
                    $("#TotalParts2").html(elemento['TotalParts']);

                    
                });
                response[4].forEach(function (elemento, indice) {
                    var opt = `<option value="`+elemento['partId']+`">`+elemento['partId']+`</option>`;
                    $("#i_partid").append(opt);
                });
                response[5].forEach(function (elemento, indice) {
                    var opt = `<option value="`+elemento['lotId']+`">`+elemento['lotId']+`</option>`;
                    $("#i_loteid").append(opt);
                });
                response[6].forEach(function (elemento, indice) {
                    var opt = `<option value="`+elemento['idShift']+`">`+elemento['turno']+`</option>`;
                    $("#i_shift").append(opt);
                });
                if (response[3][0].date == null) {
                        
                        $("#RunningTime").html('No Data');
                        $("#AvailableTime").html('No Data');

                        $("#TotalParts").html('No Data');
                        $("#IdealCycleTime").html('No Data');
                        $("#RunningTime2").html('No Data');

                        $("#GoodParts").html('No Data');
                        $("#TotalParts2").html('No Data');
            
                }
                setTimeout(() => {
                    $('#myModalLoading').modal('hide');
                }, 3);
                window.myLine.update()
                window.myMaq5.update()
                window.myMaq6.update()
                window.myMaq7.update()
                window.myMaq8.update()
            }
        });

    });
    $("#i_mes").click(function() {
        $('.datepicker').css("display", "block");
    });
    $("#i_mes").change(function () {
        $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
        var date = $('#i_mes').val();
        $('.datepicker').css("display", "none");
        $('#i_date').val(date);
        $('#i_casoS').val('1');
        var caso =  $('#i_caso').val();
        var casoS = $('#i_casoS').val();
        var partid = $('#i_partid').val();
        var lotid = $('#i_loteid').val();
        var idshift = $('#i_shift').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/oee/' + idmachine + '/'+ caso +'/' + date +'/'+ casoS +'/'+ partid +'/'+ lotid +'/'+ idshift + '/datos',
            type: 'GET',
            success: function (response) {
                config.data.labels.length = 0;
                config.data.datasets[0].data.length = 0;
                config.data.datasets[1].data.length = 0;
                config.data.datasets[2].data.length = 0;
                config.data.datasets[3].data.length = 0;
                config.options.scales.xAxes[0].scaleLabel.labelString= "Mes"
                
                $("#dataTable").dataTable().fnDestroy();
                $("#cuerpo").empty();
                $('#i_partid').empty();
                $('#i_loteid').empty();
                $('#i_shift').empty();
                $('#i_partid').prepend("<option value='all'  selected>Select all</option>");
                $('#i_loteid').prepend("<option value='all'  selected>Select all</option>");
                $('#i_shift').prepend("<option value='all'  selected>Select all</option>");
                response[1].forEach(function(elemento, indice){
                    configM1.data.datasets[0].data=[elemento.OEEG,elemento.OEER]
                    configEf.data.datasets[0].data=[elemento.performanceG,elemento. performanceR]
                    configDis.data.datasets[0].data=[elemento.AvailabilityG,elemento.AvailabilityR]
                    configQty.data.datasets[0].data=[elemento.qualityG,elemento.qualityR]
                    configM1.options.elements.center.text = elemento.OEEG+'%';
                    configEf.options.elements.center.text = elemento.performanceG+'%';
                    configDis.options.elements.center.text = elemento.AvailabilityG+'%';
                    configQty.options.elements.center.text = elemento.qualityG+'%';

                    var resAvailability = elemento.AvailabilityG+'%';
                    $("#resAvailability").html(resAvailability);

                    var resThroghput = elemento.performanceG+'%';
                    $("#resThroghput").html(resThroghput);

                    var resQuality = elemento.qualityG+'%';
                    $("#resQuality").html(resQuality);

                });
                if (response[1][0].date == null) {
                    
                    configDis.options.elements.center.text = 'No Data';
                    configEf.options.elements.center.text = 'No Data';
                    configQty.options.elements.center.text = 'No Data';
                    configM1.options.elements.center.text = 'No Data';
                    $("#resAvailability").html('No Data');
                    $("#resThroghput").html('No Data');
                    $("#resQuality").html('No Data');
        
                }
                response[0].forEach(function (elemento, indice) {
                    config.data.labels.push(elemento['date']);
                    config.data.datasets[0].data.push(elemento['availability']);
                    config.data.datasets[1].data.push(elemento['performance']);
                    config.data.datasets[2].data.push(elemento['quality']);
                    config.data.datasets[3].data.push(elemento['oee']);

                });
                response[2].forEach(function (elemento, indice) {
                    var tr = `<tr>
                        <td style="font-size:90%;">`+elemento['date']+`</td>
                        <td style="font-size:90%;">`+elemento['oee']+`</td>
                        <td style="font-size:90%;">`+elemento['availability']+`</td>
                        <td style="font-size:90%;">`+elemento['performance']+`</td>
                        <td style="font-size:90%;">`+elemento['quality']+`</td>
                        <td style="font-size:90%;">`+elemento['runTime']+`</td>
                        <td style="font-size:90%;">`+elemento['availableTime']+`</td>
                        <td style="font-size:90%;">`+elemento['ict']+`</td>
                        <td style="font-size:90%;">`+elemento['totalPieces']+`</td>
                        <td style="font-size:90%;">`+elemento['goodParts']+`</td>
                        <td style="font-size:90%;">`+elemento['partId']+`</td>
                        <td style="font-size:90%;">`+elemento['lotId']+`</td>
                        <td style="font-size:90%;">`+elemento['turno']+`</td>
                    </tr>`
                        $("#cuerpo").append(tr)

                });
            $('#dataTable').DataTable({
                        "pageLength": 50,
                        "order": [[ 1, "desc" ]],
                        "searching": false
                });
                response[3].forEach(function (elemento, indice) {
                    $("#RunningTime").html(elemento['RunningTime']);
                    $("#AvailableTime").html(elemento['AvailableTime']);

                    $("#TotalParts").html(elemento['TotalParts']);
                    $("#IdealCycleTime").html(elemento['ICT']);
                    $("#RunningTime2").html(elemento['RunningTime']);

                    $("#GoodParts").html(elemento['GoodParts']);
                    $("#TotalParts2").html(elemento['TotalParts']);
                });
                response[4].forEach(function (elemento, indice) {
                    var opt = `<option value="`+elemento['partId']+`">`+elemento['partId']+`</option>`;
                    $("#i_partid").append(opt);
                });
                response[5].forEach(function (elemento, indice) {
                    var opt = `<option value="`+elemento['lotId']+`">`+elemento['lotId']+`</option>`;
                    $("#i_loteid").append(opt);
                });
                response[6].forEach(function (elemento, indice) {
                    var opt = `<option value="`+elemento['idShift']+`">`+elemento['turno']+`</option>`;
                    $("#i_shift").append(opt);
                });
                if (response[3][0].date == null) {
                        
                        $("#RunningTime").html('No Data');
                        $("#AvailableTime").html('No Data');

                        $("#TotalParts").html('No Data');
                        $("#IdealCycleTime").html('No Data');
                        $("#RunningTime2").html('No Data');

                        $("#GoodParts").html('No Data');
                        $("#TotalParts2").html('No Data');
            
                }
                setTimeout(() => {
                    $('#myModalLoading').modal('hide');
                }, 3);
                window.myLine.update()
                window.myMaq5.update()
                window.myMaq6.update()
                window.myMaq7.update()
                window.myMaq8.update()
            }
        });
    });
   


});