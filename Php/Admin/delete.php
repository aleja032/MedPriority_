<?php

require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $data['userId'];
    $userRole = $data['userRole'];

    echo 'user '.$userId;
    echo 'role '.$userRole;

    // ----------------DELETE DOCTOR------------------------
        
    $stmt = mysqli_prepare($conn, "DELETE FROM citas_agendadas WHERE id_DoctorAsignado IN (SELECT id_doctor FROM doctores WHERE id_usuario = ?);");
    mysqli_stmt_bind_param($stmt, "s", $userId);

    $stmt2 = mysqli_prepare($conn, "DELETE FROM doctor_consultorio WHERE id_doctor IN (SELECT id_doctor FROM doctores WHERE id_usuario = ?);");
    mysqli_stmt_bind_param($stmt2, "s", $userId);

    $stmt3 = mysqli_prepare($conn, "DELETE FROM doctores WHERE id_usuario = ?");
    mysqli_stmt_bind_param($stmt3, "s", $userId);

    $stmt4 = mysqli_prepare($conn, "DELETE FROM usuario WHERE id_usuario = ?");
    mysqli_stmt_bind_param($stmt4, "s", $userId);

    if ($userRole == 3) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_execute($stmt4);
    }

    // ----------------DELETE PACIENTE------------------------
    
    $stmt5 = mysqli_prepare($conn, "DELETE FROM historia_clinica WHERE id_usuario = ?");
    mysqli_stmt_bind_param($stmt5, "s", $userId);

    $stmt6 = mysqli_prepare($conn, "DELETE FROM preagendamiento WHERE id_usuario = ?");
    mysqli_stmt_bind_param($stmt6, "s", $userId);

    $stmt7 = mysqli_prepare($conn, "DELETE FROM usuario WHERE id_usuario = ?");
    mysqli_stmt_bind_param($stmt7, "s", $userId);

    if ($userRole == 2) {
        mysqli_stmt_execute($stmt5);
        mysqli_stmt_execute($stmt6);
        mysqli_stmt_execute($stmt7);
    }
    

    if (mysqli_stmt_affected_rows($stmt4) > 0) {
        // Send a success response
        echo "User deleted successfully MEDIC";
    } else {
        // Send an error response
        echo "Error deleting user MEDIC";
    }

    if (mysqli_stmt_affected_rows($stmt7) > 0) {
        // Send a success response
        echo "User deleted successfully PATIENT";
    } else {
        // Send an error response
        echo "Error deleting user PATIENT";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt3);
    mysqli_stmt_close($stmt4);
    mysqli_stmt_close($stmt6);
    mysqli_stmt_close($stmt7);

    mysqli_close($conn);
}
?>
