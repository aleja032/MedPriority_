<?php
//require_once('../conexion.php');
//session_start();
echo "a";

    if(isset($_SESSION['idoc'])) {

    $idoc=$_SESSION['idoc'];


    $data = array(
        "labels" => ["Total De Citas","Asistidas", "No Asistidas"],
        "datasets" => array()
    );
    
    $sql = "SELECT fecha_ingreso, COUNT(Asistencia) AS total, COUNT(CASE WHEN Asistencia = 1 THEN 1 END) AS num_asistieron, COUNT(CASE WHEN Asistencia = 0 THEN 1 END) AS num_no_asistieron FROM historia_clinica WHERE id_doctor='$idoc' GROUP BY fecha_ingreso";

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
            "label" => $fila['fecha_ingreso'],
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
