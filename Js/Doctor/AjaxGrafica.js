$(document).ready(function() {
    // Función que se ejecuta cuando se envía un formulario
   $('#agendar_suge').submit(function(event) {
   event.preventDefault(); // Prevenir la acción predeterminada del envío del formulario (redireccionamiento)

   //var form_id = $(this).data('form'); // Obtener el identificador único del formulario

   $.ajax({
       url: 'Usuario/sugerencias.php', // Ruta a tu script PHP que procesará los datos
       type: 'POST', // Método HTTP que se utilizará para enviar la solicitud
       data: $(this).serialize(), // Datos que se enviarán con la solicitud (en este caso, los datos del formulario y el identificador único)
       success: function(respuesta) {
          // $('#bandeja_enviados').html(respuesta);
           //Modal_("Si"); 
       },
   });
});
});