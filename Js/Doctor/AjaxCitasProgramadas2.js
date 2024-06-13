$(document).ready(function() {
    // Función que se ejecuta cuando se envía un formulario
   $('.form_ver_detalle').submit(function(event) {
   event.preventDefault(); // Prevenir la acción predeterminada del envío del formulario (redireccionamiento)

   var form_id = $(this).data('form'); // Obtener el identificador único del formulario

   $.ajax({
       url: 'Doctor/citasProgramadas.php', // Ruta a tu script PHP que procesará los datos
       type: 'POST', // Método HTTP que se utilizará para enviar la solicitud
       data: $(this).serialize() + '&form_id=' + form_id,  // Datos que se enviarán con la solicitud (en este caso, los datos del formulario y el identificador único)
       success: function(respuesta) {
           $('#Modal_DetalleC').html(respuesta);
           //Modal_("Si"); 
           var modal = document.querySelector('#Modal_DetalleC');
           modal.style.display='flex';
           modal.style.visibility='visible';
       },
   });
});
});

function cerrar_modal(){
    var modal = document.querySelector('#Modal_DetalleC');
           modal.style.display='none';
           modal.style.visibility='hidden';
}

$(document).ready(function() {
    // Función que se ejecuta cuando se envía un formulario
   $('.form_detalle_cita').submit(function(event) {
   event.preventDefault(); // Prevenir la acción predeterminada del envío del formulario (redireccionamiento)

   //var form_id = $(this).data('form'); // Obtener el identificador único del formulario

   $.ajax({
       url: 'Doctor/citasProgramadas.php', // Ruta a tu script PHP que procesará los datos
       type: 'POST', // Método HTTP que se utilizará para enviar la solicitud
       data: $(this).serialize(),  // Datos que se enviarán con la solicitud (en este caso, los datos del formulario y el identificador único)
       success: function(respuesta) {
          
           cerrar_modal();
           alert(respuesta);
       },
   });
});
});

$(document).ready(function() {
    // Función que se ejecuta cuando se envía un formulario
   $('#NoAsistio').submit(function(event) {
   event.preventDefault(); // Prevenir la acción predeterminada del envío del formulario (redireccionamiento)

   //var form_id = $(this).data('form'); // Obtener el identificador único del formulario

   $.ajax({
       url: 'Doctor/citasProgramadas.php', // Ruta a tu script PHP que procesará los datos
       type: 'POST', // Método HTTP que se utilizará para enviar la solicitud
       data: $(this).serialize(),  // Datos que se enviarán con la solicitud (en este caso, los datos del formulario y el identificador único)
       success: function(respuesta) {
           cerrar_modal();
           alert(respuesta);
       },
   });
});
});