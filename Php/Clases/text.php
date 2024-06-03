<?php
// Fecha inicial
$fecha = '2024-05-17';
echo $fecha;

// Crear un objeto DateTime a partir de la fecha
$datetime = new DateTime($fecha);

// Sumar un día a la fecha
$datetime->modify('+1 day');

// Obtener la fecha resultante en formato 'Y-m-d'
$fecha_modificada = $datetime->format('Y-m-d');

// Mostrar la fecha modificada
echo $fecha_modificada;
?>
