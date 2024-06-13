
<?php
require_once ('../conexion.php');
require_once __DIR__ . '/vendor/autoload.php';

if(isset($_POST['opcion_actual']) && isset($_POST['id_user'])) {
    $opcion_actual = $_POST['opcion_actual'];
    $id_user = $_POST['id_user'];
    $fecha = $_POST['fecha'];

    $query_hc="SELECT * FROM historia_clinica hc INNER JOIN usuario u ON hc.id_usuario= u.id_usuario INNER JOIN  patologias p ON hc.id_patologia = p.id_patologia INNER JOIN estado e ON e.id_estado= hc.id_estado WHERE id_tipocita = '$opcion_actual' AND hc.id_usuario = '$id_user'";
   
    if (empty($fecha)) {
        $query_hc .= "ORDER BY fecha_ingreso DESC, hora DESC LIMIT 1";
    } else {
        $query_hc .= " AND fecha_ingreso = '$fecha'";
    }

    $consultahc=mysqli_query($conn,$query_hc);
    if(mysqli_num_rows($consultahc)>0){
        $resultadohc=mysqli_fetch_assoc($consultahc);
    }
    
    // Crear contenido HTML para el PDF
    $html = '
   <!DOCTYPE html>
<html>
<head>
        <title>Datos de Historia Clínica</title>
    <link rel="stylesheet" type="text/css" href="../../Css/estilo_pdf1.css">
</head>
<body>
<table>
    <tr class="cont_logo_name">
        <td class="img_log">  
            <img class="img_log2" src="../../Img/logo.png" alt="Logo"> 
        
        MEDPRIORITY</td>
    </tr>
    <tr>
        <td><p class="p"> N° Historia:' . htmlspecialchars($resultadohc['id_historia']) . '</p></td>
        <td><p class="p"> N° Historia:' . htmlspecialchars($resultadohc['id_historia']) . '</p></td>
        <td><p class="p"> Fecha de Ingreso:' . htmlspecialchars($resultadohc['fecha_ingreso']).'---'.htmlspecialchars($resultadohc['hora'])  . '</p></td>
        <td><p class="p"> Fecha Folio:' . htmlspecialchars($resultadohc['fecha_ingreso']) . '</p></td>
        <td><p class="p"> Folio:' . htmlspecialchars($resultadohc['numero_folio']) . '</p></td>
    </tr>

    <tr>
        <td class="title">DATOS PERSONALES</td>
    </tr>
    <tr>
        <td class="negrita">Nombre Paciente:</td>
        <td>' . htmlspecialchars($resultadohc['nombre']) . '</td>
    </tr>
    <tr>
        <td class="negrita">Fecha de Nacimiento:</td>
        <td>' . htmlspecialchars($resultadohc['fecha_nacimiento']) . '</td>
    </tr>
    <tr>
        <td class="negrita">Dirección:</td>
        <td>' . htmlspecialchars($resultadohc['direccion']) . '</td>
    </tr>
    <tr>
        <td class="negrita">Procedencia:</td>
        <td>' . htmlspecialchars($resultadohc['procedencia']) . '</td>
    </tr>
    <tr>
        <td class="negrita">Estado Civil:</td>
        <td>' . htmlspecialchars($resultadohc['estado_civil']) . '</td>
    </tr>
    <tr>
        <td class="negrita">Identificación:</td>
        <td>' . htmlspecialchars('1') . '</td>
    </tr>
    <tr>
        <td class="negrita">Edad:</td>
        <td>' . htmlspecialchars($resultadohc['edad']) . '</td>
    </tr>
    <tr>
        <td class="negrita">Teléfono:</td>
        <td>' . htmlspecialchars($resultadohc['telefono']) . '</td>
    </tr>
    <tr>
        <td class="negrita">Tipo de Documento:</td>
        <td>' . htmlspecialchars($resultadohc['tipo_documento']) . '</td>
    </tr>
    <tr>
        <td class="negrita">Sexo:</td>
        <td>' . htmlspecialchars($resultadohc['genero']) . '</td>
    </tr>

    <tr>
        <td class="title">DATOS AFILIACION</td>
    </tr>
    <tr>
        <td class="afi">Tipo de Afiliación: ' . htmlspecialchars($resultadohc['tipo_afiliacion']) . '</td>
    </tr>
    <tr>
        <td class="title">ANAMNESIS</td>
    </tr>
    
    <tr>
                <td class="negrita2">Sintomático Respiratorio:</td>
            <td class="demas">' . htmlspecialchars($resultadohc['sintomatico_respiratorio']) . '</td>
            <td class="negrita2">Enfermedad Actual:</td>
            <td class="demas">' . htmlspecialchars($resultadohc['enfermedad_actual']) . '</td>
    </tr>

    <tr>
        <td class="title2">ASPECTO Y ESTADO GENERAL DEL PACIENTE</td>
    </tr>
    <tr>
            <td class="negrita2">Descripción:</td>
            <td class="demas">' . htmlspecialchars($resultadohc['aspecto_general']) . '</td>
            <td class="negrita2">Estado:</td>
            <td class="demas">' . htmlspecialchars($resultadohc['estado']) . '</td>
    </tr>

    <tr>
        <td class="title">DATOS DE GRAVEDAD DE LA PATOLOGÍA</td>
    </tr>
    <tr>
        <td class="cont_gravedad">
            <td class="negrita2">Patología:</td>
            <td class="demas">' . htmlspecialchars($resultadohc['nombre_patologia']) . '</td>
            <td class="negrita2">Gravedad-patología:</td>
            <td class="demas">' . htmlspecialchars($resultadohc['puntuacion']) . '</td>
        </td>
    </tr>
</table>
</body>
</html>';


    // Crear instancia de MPDF con formato carta (8.5 x 11 pulgadas)
    $mpdf = new \Mpdf\Mpdf(['format' => 'Letter']);

    // Escribir el contenido HTML al PDF
    $mpdf->WriteHTML($html);

    // Guardar el PDF en el servidor
    $pdf_path = 'historia_clinica.pdf';
    $mpdf->Output($pdf_path, 'F');

    // Enviar respuesta al cliente
    echo json_encode(['message' => 'PDF generado correctamente', 'pdf_path' => $pdf_path]);
}


// Manejar la descarga del PDF
if (isset($_GET['download']) && $_GET['download'] == '1') {
    $file = 'historia_clinica.pdf';

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        unlink($file);

        exit;
    } else {
        echo 'El archivo no existe.';
    }
}
?>