<?php
session_start();
require_once('conexion.php');


$correo= $_POST["correo"];
$password= $_POST["pass"];
// $sql="SELECT * FROM usuario INNER JOIN historia_clinica ON historia_clinica.id_usuario= usuario.id_usuario INNER JOIN patologias ON patologias.id_patologia= historia_clinica.id_patologia INNER JOIN estado ON estado.id_estado=historia_clinica.id_estado WHERE correo='$correo' AND contrasena='$password'";

$sql="SELECT * FROM usuario  WHERE correo='$correo' AND contrasena='$password'";
$consulta= mysqli_query($conn,$sql);

if(mysqli_num_rows($consulta)>0){
    $datos= mysqli_fetch_array($consulta);
    $nombreCompleto = $datos['nombre'];
    $partesDelNombre = explode(' ', $nombreCompleto); // Divide la cadena en un array usando el espacio como delimitador
    $primerNombre = $partesDelNombre[0];     // Accede al primer elemento del array, que sería el primer nombre
    $ID = $datos['id_usuario'];
    $_SESSION['nombre'] = $primerNombre;
    $_SESSION['nombre_completo']= $nombreCompleto;
    $_SESSION['id']=$ID;
    $_SESSION['edad']=$datos['edad'];
    $_SESSION['telefono']=$datos['telefono'];
    $_SESSION['tipo_documento']=$datos['tipo_documento'];
    $_SESSION['id_rol']=$datos['id_rol'];
    $_SESSION['autenticado']=true;

    if($datos['id_rol']==1){

        echo "<script> window.location='admin.php'</script>";

    }
    else if($datos['id_rol']==2){
        $sqlU="SELECT * FROM usuario LEFT JOIN historia_clinica ON historia_clinica.id_usuario= usuario.id_usuario LEFT JOIN patologias ON patologias.id_patologia= historia_clinica.id_patologia LEFT JOIN estado ON estado.id_estado=historia_clinica.id_estado WHERE usuario.id_usuario=$ID";
        $consultaU= mysqli_query($conn,$sqlU);
        if(mysqli_num_rows($consultaU)>0){
            $datos= mysqli_fetch_array($consultaU);

            $_SESSION['tipo_afiliacion']=$datos['tipo_afiliacion'];
            $_SESSION['patologia']=$datos['nombre_patologia'];    
            $_SESSION['puntuacion']=$datos['puntuacion'];
            $_SESSION['estado']=$datos['estado'];
        }
        
        echo "<script>window.location.href = '../index.php?success=1'</script>";

    }else if($datos['id_rol']==3){

        $validacion_doc="SELECT * FROM usuario u INNER JOIN doctores dc ON u.id_usuario=dc.id_usuario WHERE  contrasena='$password' AND correo='$correo'";
        $consulta2= mysqli_query($conn,$validacion_doc);
        
        if(mysqli_num_rows($consulta2)>0){

            $datos= mysqli_fetch_array($consulta2);

            $_SESSION['idoc']=$datos['id_doctor'];

        
        }

        echo "<script> window.location='doctor.php'</script>";

    }
}
?>