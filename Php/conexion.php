<?php
$host='localhost';
$root='root';
$password='';
$nombrebd='medtest4';
$conn= new mysqli($host,$root,$password,$nombrebd);
if(!$conn){
    die("No es posible conectar a la base de datos");
}
?>