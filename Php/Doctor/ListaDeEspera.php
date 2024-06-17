<?php
require_once('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['opcion_actual']) && isset($_POST['id_user'])) {
    }

    $identificacion=$_POST['identificacion'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['pass'];
    
 $sql= "SELECT * FROM usuario WHERE id_usuario='$identificacion' AND correo='$correo'";
 $resultado=mysqli_query($conn, $sql);
 
 if($resultado->num_rows){
    while($dato= $resultado->fetch_assoc()){
    }
}


}


?>
