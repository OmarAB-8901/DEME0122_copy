$(document).ready(function(){ 
    $("#exportA").on( "click", function() {
        var date = $('#i_date').val();
        var idmachine = $('#idmachine').val();
        var var_name = $('#var_name').val();
        var caso =  $('#i_caso').val();
        window.location="/events/"+caso+"/"+date+"/"+idmachine+"/"+var_name+"/export";
       
     });
     $("#exportT").on( "click", function() {
        var date = $('#i_dia').val();
        var idvar = $('#idvariable').val();
        var var_name = $('#var_name').val();
        var caso =  'd';
        window.location="/trends/"+caso+"/"+date+"/"+idvar+"/"+var_name+"/export";
       
     });
     $("#exportO").on( "click", function() {
      var caso =  $('#i_caso').val();
      var idmachine = $('#idmachine').val();
      var date = $('#i_date').val();
      var casoS = $('#i_casoS').val();
      var partid = $('#i_partid').val();
      var lotid = $('#i_loteid').val();
      var idshift = $('#i_shift').val();
   
      var var_name = $('#var_name').val();
     
      window.location="/oee/"+idmachine+"/"+caso+"/"+date+"/"+casoS+"/"+partid+"/"+lotid+"/"+idshift+"/"+var_name+"/export";
     
     
   });
    
});