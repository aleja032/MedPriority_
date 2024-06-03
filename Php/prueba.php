<?php
session_start();
require_once('conexion.php');

if ($_SESSION["id"] == null) {
    echo "<script>window.location.href = '../index.php'</script>";
    exit;
} else {
    $id_user = $_SESSION['id'];
}

ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../Css/prueba.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <title>Document</title>
</head>
<body>
<div class="comb" id="form_1">
                                <input type="radio" name="consulta" id="radio" value="1" checked>
                                <p>Consulta Externa</p>
                            </div>  

                            <div class="comb">
                                <input type="radio" name="consulta" id="radio1" value="3">
                                <p>Consulta Odontológica</p>
                            </div>
    <button id="generate-pdf">Generar PDF</button>

    <div class="historial_clinico" id="historial">
        <div class="cont_logo_name">
            <div class="img_log"></div>
            <p>MEDPRIORITY</p>
        </div>
        <p class="nit">Nit:  1122540000-1</p>

        <div class="datos_historia" id="datos"></div>
        
        <div class="title">DATOS PERSONALES</div>

        <div class="general">
            <?php
            $sql = "SELECT * FROM usuario WHERE id_usuario = '$id_user'";
            $consulta = mysqli_query($conn, $sql);

            if (mysqli_num_rows($consulta) > 0) {
                $datos = mysqli_fetch_assoc($consulta);
            ?>
                <div class="container1">
                    <div class="cont-1"><p class="negrita">Nombre Paciente:</p><p class="resultados"><?php echo $datos['nombre']; ?></p></div>
                    <div class="cont-1"><p class="negrita">Fecha de Nacimiento:</p><p class="resultados"><?php echo $datos['fecha_nacimiento']; ?></p></div>
                    <div class="cont-1"><p class="negrita">Dirección:</p><p class="resultados"><?php echo $datos['direccion']; ?></p></div>
                    <div class="cont-1"><p class="negrita">Procedencia:</p><p class="resultados"><?php echo $datos['procedencia']; ?></p></div>
                    <div class="cont-1"><p class="negrita">Estado Civil:</p><p class="resultados"><?php echo $datos['estado_civil']; ?></p></div>
                </div>

                <div class="container1">
                    <div class="cont-1"><p class="negrita">Identificación:</p><p class="resultados"><?php echo $datos['id_usuario']; ?></p></div>
                    <div class="cont-1"><p class="negrita">Edad:</p><p class="resultados"><?php echo $datos['edad']; ?></p></div>
                    <div class="cont-1"><p class="negrita">Teléfono:</p><p class="resultados"><?php echo $datos['telefono']; ?></p></div>
                    <div class="cont-1"><p class="negrita">Tipo de Documento:</p><p class="resultados"><?php echo $datos['estado_civil']; ?></p></div>
                    <div class="cont-1"><p class="negrita">Sexo:</p><p class="resultados"><?php echo $datos['genero']; ?></p></div>
                </div>
            </div>

            <div class="afil">
                <div class="title2">DATOS AFILIACION</div>
                <div class="cont-2"><p class="afi">Tipo de Afiliación:</p><p class="resultados"><?php echo $datos['tipo_afiliacion']; ?></p></div>
            </div>
            <?php
            } else {
                echo '<p>No se encontraron resultados.</p>';
            }
            ?>
            <div class="title">ANAMNESIS</div>

            <div class="descripcion_paciente" id="anamesis">
                <!-- Aquí puedes agregar más información si es necesario -->
            </div>
        </div>
    </div>
</body>
</html>
<script>
        
        document.addEventListener('DOMContentLoaded', function() {
      // Función para enviar la opción seleccionada
      function enviarOpcionSeleccionada(opcionSeleccionada) {
          $.ajax({
              url: "./Usuario/historia_clinica.php",
              type: "POST",
              data: { 
                  opcion_actual: opcionSeleccionada,
                  id_user: <?php echo json_encode($id_user); ?>
              },
              success: function(respon3) {
                  console.log("Respuesta del servidor:", respon3);
                  document.getElementById('datos').innerHTML = respon3;
              },
              error: function() {
                  alert("Error al cargar la opción seleccionada");
              }
          });
      }
      function enviarOpcionSeleccionada2(opcionSeleccionada) {
          $.ajax({
              url: "./Usuario/enfermedades.php",
              type: "POST",
              data: { 
                  opcion_actual: opcionSeleccionada,
                  id_user: <?php echo json_encode($id_user); ?>
              },
              success: function(respon3) {
                  console.log("Respuesta del servidor2-------:", respon3);
                  document.getElementById('anamesis').innerHTML = respon3;
              },
              error: function() {
                  alert("Error al cargar la opción seleccionada");
              }
          });
      }
      // Enviar la opción por defecto al cargar la página
      const opcionPorDefecto = document.querySelector('input[name="consulta"]:checked').value;
      enviarOpcionSeleccionada(opcionPorDefecto);
      enviarOpcionSeleccionada2(opcionPorDefecto);

      // Asignar evento click a los radios
      document.querySelectorAll('input[name="consulta"]').forEach(radio => {
          radio.addEventListener('click', () => {
              const opcionSeleccionada = radio.value;
              console.log('Valor seleccionado:', opcionSeleccionada);
              enviarOpcionSeleccionada(opcionSeleccionada);
              enviarOpcionSeleccionada2(opcionSeleccionada);

          });
      });
  });

</script>
<script>
       document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('generate-pdf').addEventListener('click', function () {
                    // Opciones de configuración para html2pdf
                    var opt = {
                        margin: 1,
                        filename: 'historial_clinico.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };

                    // Obtener el contenido del contenedor con el id "historial" y generar el PDF
                    var element = document.getElementById('historial');
                    html2pdf().from(element).set(opt).outputPdf()
                    .then(function(pdf) {
                        pdf.save();
                    })
                    .catch(function(error) {
                        console.error('Error al generar el PDF:', error);
                    });
                });
            });
</script>
