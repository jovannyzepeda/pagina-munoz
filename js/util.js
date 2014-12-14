
$( document ).ready(function() {
  if ($(".alertas > .alerta").length>0){
  	var max_time = 0;
      $('.alertas > .alerta').each( function( key, value ) {
        alerta = $(this);
        if(alerta.attr('time')*1000>max_time)max_time=alerta.attr('time')*1000;
        $(function() {setTimeout(function() {alerta.hide();}, alerta.attr('time')*1000);});
      });
      $(function() {setTimeout(function(max_time) {$(".alertas").hide();}, max_time);});
  }

});