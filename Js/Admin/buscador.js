//FORMULARIO DOCTOR
$(document).ready(function() {
    // Función que se ejecuta cuando se envía un formulario
   $('#form_search_doctor').submit(function(event) {
   event.preventDefault(); // Prevenir la acción predeterminada del envío del formulario (redireccionamiento)

   //var form_id = $(this).data('form'); // Obtener el identificador único del formulario

   $.ajax({
       url: 'Admin/Buscador.php', // Ruta a tu script PHP que procesará los datos
       type: 'POST', // Método HTTP que se utilizará para enviar la solicitud
       data: $(this).serialize(),  // Datos que se enviarán con la solicitud (en este caso, los datos del formulario y el identificador único)
       success: function(respuesta) {
         $('#contain_tablas').html(respuesta);
       },
   });
});
});

// FORMULARIO PACIENTE
$(document).ready(function() {
   
   $('#form_search_paciente').submit(function(event) {
   event.preventDefault(); 

   $.ajax({
       url: 'Admin/Buscador.php', 
       type: 'POST', 
       data: $(this).serialize(),  
       success: function(respuesta) {
         $('#contain_tablas_pac').html(respuesta);
       },
   });
});
});

// FORMULARIO PREAGENDAMIENTO
$(document).ready(function() {
   
    $('#form_search_preagendamiento').submit(function(event) {
    event.preventDefault(); 
 
    $.ajax({
        url: 'Admin/Buscador.php', 
        type: 'POST', 
        data: $(this).serialize(),  
        success: function(respuesta) {
          $('#contain_tabla_preagendamiento').html(respuesta);
        },
    });
 });
 });

 // FORMULARIO CITAS AGENDADAS
$(document).ready(function() {
   
    $('#form_search_citas_agendadas').submit(function(event) {
    event.preventDefault(); 
 
    $.ajax({
        url: 'Admin/Buscador.php', 
        type: 'POST', 
        data: $(this).serialize(),  
        success: function(respuesta) {
          $('#contain_tabla_citas').html(respuesta);
        },
    });
 });
 });


 // FORMULARIO PATOLOGIA
$(document).ready(function() {
   
    $('#form_search_patologia').submit(function(event) {
    event.preventDefault(); 
 
    $.ajax({
        url: 'Admin/Buscador.php', 
        type: 'POST', 
        data: $(this).serialize(),  
        success: function(respuesta) {
          $('#contain_tablas_pato').html(respuesta);
        },
    });
 });
 });

  // FORMULARIO TIPO CITA
$(document).ready(function() {
   
    $('#form_search_tipo_cita').submit(function(event) {
    event.preventDefault(); 
 
    $.ajax({
        url: 'Admin/Buscador.php', 
        type: 'POST', 
        data: $(this).serialize(),  
        success: function(respuesta) {
          $('#contain_tablas_tipocita').html(respuesta);
        },
    });
 });
 });

   // FORMULARIO ESPECIALIDADES
$(document).ready(function() {
   
    $('#form_search_especialidades').submit(function(event) {
    event.preventDefault(); 
 
    $.ajax({
        url: 'Admin/Buscador.php', 
        type: 'POST', 
        data: $(this).serialize(),  
        success: function(respuesta) {
          $('#contain_tablas_especialidad').html(respuesta);
        },
    });
 });
 });