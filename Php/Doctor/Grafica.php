<?php
//require_once('../conexion.php');
//session_start();


    if(isset($_SESSION['idoc'])) {
    
    $idoc=$_SESSION['idoc'];
    echo $idoc;

    $data = array(
        "labels" => ["Total De Citas","Asistidas", "No Asistidas"],
        "datasets" => array()
    );
    
    $sql = "SELECT h_fecha, COUNT(h_estado) AS total, COUNT(CASE WHEN h_estado = 'Asistio' THEN 1 END) AS num_asistieron, COUNT(CASE WHEN h_estado = 'No Asistio' THEN 1 END) AS num_no_asistieron FROM historial_cita WHERE h_doctor='$idoc' GROUP BY h_fecha";

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        $usedColors = array(); // Array para almacenar los colores ya utilizados

    while ($fila = $resultado->fetch_assoc()) {
        do {
            // Generar componentes RGB aleatorios
            $red = rand(0, 255);
            $green = rand(0, 255);
            $blue = rand(0, 255);

            // Generar el color en formato RGBA
            $backgroundColor = "rgba($red, $green, $blue, 0.5)";

            // Comprobar si el color ya ha sido utilizado
        } while (in_array($backgroundColor, $usedColors));

        // Agregar el color a la lista de colores utilizados
        $usedColors[] = $backgroundColor;

        // Agregar el conjunto de datos con el color de fondo aleatorio
        array_push($data['datasets'], array(
            "label" => $fila['h_fecha'],
            "backgroundColor" => $backgroundColor,
            "data" => [$fila['total'], $fila['num_asistieron'], $fila['num_no_asistieron']]
        ));
    }
                


        ?>

            <canvas id="bar-chart"></canvas>

            <script>

                var data = <?php echo json_encode($data); ?>
               
                var options = {
                    scales: {

                    }
                };

                
                var ctx = document.getElementById("bar-chart").getContext("2d");
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options
                });
            </script>



        <?php
    }

    }else{
        echo "no";
    }

?>
