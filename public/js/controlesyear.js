$(document).ready(function(){ 
    $("#b_dia").on( "click", function() {
        $('#i_dia').show(); 
        $('#i_mes').hide();
        $('#i_mes').val('');
        $('#i_caso').val('d');
        
     });
    $("#b_mes").on( "click", function() {
        $('#i_mes').show(); 
        $('#i_dia').hide();
        $('#i_dia').val('');
        $('#i_caso').val('m');
    }); 
});