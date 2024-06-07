
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

    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        // Directorio donde se guardarán las imágenes
        $target_dir = "../../Img/";

        // Asegúrate de que el directorio de destino exista 
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real o no
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                // Ruta relativa para almacenar en la base de datos
                $relative_path = "Img/" . basename($_FILES["foto"]["name"]);

                // Actualizar la base de datos con la nueva ruta de la imagen
                $sql = "UPDATE usuario SET telefono='$telefono', correo='$correo', estado_civil='$estado_civil', direccion='$direccion', procedencia='$procedencia', contrasena='$pass', imagen='$relative_path' WHERE id_usuario='$id_user'";
                $resultado = mysqli_query($conn, $sql);

                if($resultado) {
                    echo "<script>window.location.href = '../user.php?success=2'</script>";
                } else {
                    echo "Error al actualizar el registro: " . mysqli_error($conn);
                }
            } else {
                echo "Error al subir la imagen.";
            }
        } else {
            echo "El archivo no es una imagen.";
        }
    } else {
        // Si no se subió una nueva imagen, solo actualizar los demás campos
        $sql = "UPDATE usuario SET telefono='$telefono', correo='$correo', estado_civil='$estado_civil', direccion='$direccion', procedencia='$procedencia', contrasena='$pass' WHERE id_usuario='$id_user'";
        $resultado = mysqli_query($conn, $sql);

        if($resultado) {
            echo "<script>window.location.href = '../user.php?success=2'</script>";
        } else {
            echo "Error al actualizar el registro: " . mysqli_error($conn);
        }
    }
} else {
    echo "No se ha enviado el ID de usuario.";
}
?>
