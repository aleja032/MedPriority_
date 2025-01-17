<?php
require_once ('../conexion.php');

if(isset($_POST['opcion_actual']) && isset($_POST['id_user'])) {
    $opcion_actual = $_POST['opcion_actual'];
    $id_user = $_POST['id_user'];
    $fecha = $_POST['fecha'];

    function getHistoriaClinica($id_tipocita, $id_user, $fecha, $conn) {
        $sql = "SELECT * FROM historia_clinica hc 
        WHERE id_tipocita = '$id_tipocita' 
        AND id_usuario = '$id_user' ";

        if (empty($fecha)) {
            $sql .= "ORDER BY fecha_ingreso DESC, hora DESC LIMIT 1"; //limit 1 es para decirle que de los resultado saque un solo valor de la tabla y como esta en descendiente
        } else {
            $sql .= "AND fecha_ingreso = '$fecha'";
        }
        
        $consulta = mysqli_query($conn, $sql);

        if(mysqli_num_rows($consulta) > 0){
            $result = '';
            while($datos = mysqli_fetch_assoc($consulta)){
                $result .= '<p class="p">N° Historia: ' . $datos['id_historia'] . '</p>';
                $result .= '<p class="p">Fecha ingreso: ' . $datos['fecha_ingreso'] . '---'. $datos['hora'] .'</p>';
                $result .= '<p class="p">Fecha Folio: ' . $datos['fecha_ingreso'] . '</p>';
                $result .= '<p class="p">Folio: ' . $datos['numero_folio'] . '</p>';
            }
            return $result;
        } else {
            return '<p>No se encontraron resultados.</p>';
        }
    }

    echo getHistoriaClinica($opcion_actual, $id_user, $fecha, $conn);
} else {
    echo '<p>Error: Datos incompletos.</p>';
}
?>
