<?php
session_start();
require_once('conexion.php');


$correo= $_POST["correo"];
$password= $_POST["pass"];

$sql="SELECT * FROM usuario INNER JOIN historia_clinica ON historia_clinica.id_usuario= usuario.id_usuario INNER JOIN patologias ON patologias.id_patologia= historia_clinica.id_patologia INNER JOIN estado ON estado.id_estado=historia_clinica.id_estado WHERE correo='$correo' AND contrasena='$password'";
$consulta= mysqli_query($conn,$sql);

// $validacion_doc="SELECT * FROM usuario WHERE id_rol=1 AND contrasena='$password' AND correo='$correo'";
// $consulta2= mysqli_query($conn,$validacion_doc);
if(mysqli_num_rows($consulta)>0){
    $datos= mysqli_fetch_array($consulta);
    $nombreCompleto = $datos['nombre'];
    $partesDelNombre = explode(' ', $nombreCompleto); // Divide la cadena en un array usando el espacio como delimitador
    $primerNombre = $partesDelNombre[0];     // Accede al primer elemento del array, que sería el primer nombre
    $_SESSION['nombre'] = $primerNombre;
    $_SESSION['nombre_completo']= $nombreCompleto;
    $_SESSION['id']=$datos['id_usuario'];
    $_SESSION['edad']=$datos['edad'];
    $_SESSION['telefono']=$datos['telefono'];
    $_SESSION['tipo_documento']=$datos['tipo_documento'];
    $_SESSION['tipo_afiliacion']=$datos['tipo_afiliacion'];
    $_SESSION['patologia']=$datos['nombre_patologia'];    
    $_SESSION['puntuacion']=$datos['puntuacion'];

    $_SESSION['estado']=$datos['estado'];
    $_SESSION['id_rol']=$datos['id_rol'];

    $_SESSION['autenticado']=true;

    
    if($datos['id_rol']==1){
        echo "<script> window.location='admin.php'</script>";
    }
    else if($datos['id_rol']==2){
       // $_SESSION['id_patologia']=$datos[''];  INNER JOIN historia_clinica ON historio_clinica.id_usuario= usuario.id_usuario
        // echo "<script> window.location='../index.php'</script>";
        echo "<script>window.location.href = '../index.php?success=1'</script>";
    }else{
        echo "<script> window.location='doctor.php'</script>";
    }
}else{
    //echo "<script>window.location.href = '../index.php?success=3'</script>";
     $validacion_doc="SELECT * FROM usuario u INNER JOIN doctores dc ON u.id_usuario=dc.id_usuario WHERE  contrasena='$password' AND correo='$correo'";
    $consulta2= mysqli_query($conn,$validacion_doc);
    if(mysqli_num_rows($consulta2)>0){
        $datos= mysqli_fetch_array($consulta2);
        $nombreCompleto = $datos['nombre'];
        $partesDelNombre = explode(' ', $nombreCompleto); // Divide la cadena en un array usando el espacio como delimitador
        $primerNombre = $partesDelNombre[0];     // Accede al primer elemento del array, que sería el primer nombre
        $_SESSION['nombre'] = $primerNombre;
        $_SESSION['nombre_completo']= $nombreCompleto;
        $_SESSION['id']=$datos['id_usuario'];
        $_SESSION['idoc']=$datos['id_doctor'];
        $_SESSION['edad']=$datos['edad'];
        $_SESSION['telefono']=$datos['telefono'];
        $_SESSION['tipo_documento']=$datos['tipo_documento'];
        $_SESSION['tipo_afiliacion']=$datos['tipo_afiliacion'];
        echo "<script> window.location='doctor.php'</script>";
    }
}

?>