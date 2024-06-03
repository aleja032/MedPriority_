<?php
require_once('../conexion.php');

if(isset($_POST['id_user'])) {
    $id_user = $_POST['id_user'];
    
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $estado_civil = $_POST['estado_civil'];
    $direccion = $_POST['direccion'];
    $procedencia = $_POST['procedencia'];
    $pass = $_POST['pass'];

    // Corrección de la sentencia SQL UPDATE
    $sql = "UPDATE usuario SET telefono='$telefono', correo='$correo', estado_civil='$estado_civil', direccion='$direccion', procedencia='$procedencia', contrasena='$pass' WHERE id_usuario='$id_user'";
    $resultado = mysqli_query($conn, $sql);

    if($resultado) {
        
        echo "<script>window.location.href = '../user.php?success=2'</script>";

        // echo "Registro actualizado correctamente.";
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($conn);
    }
} else {
    echo "No se ha enviado el ID de usuario.";
}
?>
