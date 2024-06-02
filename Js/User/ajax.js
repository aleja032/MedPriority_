
let hora_rango1 = document.getElementById("hora_rango1");
let opcion_actual;

let hora_rango2 = document.getElementById("hora_rango2");
let opcion_actual2;
$(document).ready(function() {
$("#hora_rango1").change(function() {
    opcion_actual = $(this).val();
    console.log("Opción seleccionada 1: ", opcion_actual);        

    $.ajax({
        url: "Usuario/horarios.php",
        type: "POST",
        data: { opcion_actual: opcion_actual },
        success: function(respon3) {
            console.log("Respuesta del servidor:", respon3);
            $("#rango").html(respon3);
        },
        error: function() {
            alert("Error al cargar las opciones del select rango_2");
        }
    });
});

$("#hora_rango2").change(function() {
    opcion_actual2 = $(this).val();
    console.log("Opción seleccionada 2: ", opcion_actual2);        

    $.ajax({
        url: "Usuario/horarios.php",
        type: "POST",
        data: { opcion_actual2: opcion_actual2 },
        success: function(respon4) {
            console.log("Respuesta del servidor:", respon4);
            $("#rango_2").html(respon4);
        },
        error: function() {
            alert("Error al cargar las opciones del select rango_2");
        }
    });
});
});