<?php 
    session_start(); 
    require_once ('conexion.php');

    if($_SESSION["id"]==null){
        echo "<script>window.location.href = '../index.php'</script>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> <!--Libreria de awesone-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Añadir jQuery aquí -->


    <link rel="stylesheet" href="../Css/style_user4.css">
    <title>MedPriority</title>
</head>
<body>

    <div class="conheader"> <!-- contenedor header -->

        <div class="logo">
                <input type="checkbox" id="toggleMenu">
                <label for="toggleMenu"><i class="fa fa-bars" class="img_logo"></i></label>
            <div class="img_logo">         
               
            </div>

            <div class="letras_logo">
                <p>MEDPRIORITY</p>
            </div>
        </div>

        <div class="datos_barra">
            <div class="name"><p> <?php echo htmlspecialchars($_SESSION['nombre']) ?> </p>  
            <div class="img_notificaion"></div>   </div>
            <div class="img_usuario"></div>
        </div>

    </div>
    <div class="congeneral"><!--barra lateral -->

        <div class="con_menu"><!-- contenedor del menu -->
            <div class="check-boton" id="closemenu">
                <i class="fa-solid fa-xmark"></i>
            </div>


                <div class="inicio"><!-- contenedores de el menu -->
                    <a href="../index.php">
                        
                        <div class="con_imagen" id="icono"> </div>
                    
                        <div class="enunciado">  Inicio</div>
                    </a>
                </div>
                <div class="notificaciones"> <p class="letras">Sesion Notificaciones </p> <div class="linea"><p></p> </div> </div>

                <div class="combo1_notificacion" >
                    <a href="#notificaciones">
                            
                        <div class="con_imagen2" id="icono"> </div>
                    
                        <div class="enunciado2" id="notificacion">  Notificaciones</div>
                    </a>
                </div>
                <div class="notificaciones"> <p class="letras">Sesion Hisotria Clinica </p> <div class="linea"><p></p></div> </div>

                <div class="combo1_notificacion" >
                    <a href="#inicio">
                        
                        <div class="con_imagen3" id="icono"> </div>
                
                        <div class="enunciado2" id="historia_clinica">  Historia Clinica</div>
                    </a>
                </div>
              <div class="notificaciones"> <p class="letras">Sesion Citas </p> <div class="linea"><p></p></div> </div>
              
                <div class="combo1_notificacion">
                    <div class="menu-item">
                        <div class="menu-title">
                            <div class="con_imagen4" id="icono"> </div>
                            <div class="enunciado2">  Citas</div>
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <ul class="submenu">
                            <li><a href="#AgregarCita" id="add_cita">Agregar Citas</a></li>
                            <li><a href="#HistorialCitas">Historial de Citas</a></li>
                            <li><a href="#EstadoCitas" id="estado_cita">Estado Citas</a></li>
                        </ul>
                    </div>
                </div>
        </div>
        <main class="principal">

            <div id="prueba2" class="historialcita">
                <div class="cont_titulo">
                    <p> Historia Clinica</p>
                </div>
                <div class="cont_general_all" >
                    hola
                </div>
            </div>
            <!----------------------NOTIFICACIONES--------------------------------------- -->
            <div id="prueba" class="historialcita">
                <div class="cont_titulo">
                    <p>Estado Citas</p>
                </div>

                    <div class="cont_general_all">
                        <div class="notificacion">
                            <?php
                            $id_user = $_SESSION['id'];
                            $sql2 = "SELECT * FROM preagendamiento p
                                    INNER JOIN sugerencias_citas sc ON p.id_preagendamiento = sc.id_preagendamiento 
                                    WHERE p.id_usuario = '$id_user'";

                            $consulta_sugerencias = mysqli_query($conn, $sql2);
                            ?>

                            <?php if (mysqli_num_rows($consulta_sugerencias) > 0): ?>
                                <table class="tabla">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($resultado = mysqli_fetch_array($consulta_sugerencias)): ?>
                                        <tr>
                                            <td><?php echo $resultado['fecha']; ?></td>
                                            <td><?php echo $resultado['hora_reservada']; ?></td>
                                            <td><?php echo $resultado['estado']; ?></td>
                                            <td>
                                                <form method="POST" action="citas_confirmadas.php" style="display:inline;">
                                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                    <button type="submit">Agendar</button>
                                                </form>
                                                <form method="POST" action="liberar_citas.php" style="display:inline;">
                                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                    <button type="submit">No Agendar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="no-citas">
                                    <p>No se encontraron citas para este usuario.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>

    
            <div id="agregar_cita" class="historialcita">
                <div class="cont_titulo">
                    <p>Agregar Cita</p>
                </div>
                <div class="cont_general_all">
                    <div class="preguntas_formulario">
                        <div class="cont_preguntas">
                            <p>Identificación</p>
                            <input type="text" id="identificacion" name="identificacion" value="<?php echo $_SESSION['id'] ?>" disabled>
                        </div>
                        <div class="cont_preguntas" id="tipo_identificacion">
                            <p>Tipo de Identificación</p>
                            <input type="text" id="tipo_identificacion" name="tipo_identificacion" value="<?php echo $_SESSION['tipo_documento'] ?>" disabled>
                        </div>
                        <div class="cont_preguntas" id="nombre">
                            <p>Nombres</p>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['nombre_completo'] ?>" disabled>
                        </div>
                    </div>
    
                    <form action="./Usuario/procesar_cita.php" method="post" class="contenedor_formulario" id="formulario_general">
                        
                        <div class="preguntas_formulario2">
                            <div class="cont_preguntas2">
                                <p>Edad</p>
                                <input type="text" id="edad" name="edad" value="<?php echo $_SESSION['edad'] ?>" disabled>
                            </div>
                            <div class="cont_preguntas2" id="tipo_afiliacion">
                                <p>Tipo de Afiliación</p>
                                <input type="text" id="tipo_afiliacion" name="tipo_afiliacion" value="<?php echo $_SESSION['tipo_afiliacion'] ?>" disabled>
                            </div>
                            <div class="cont_preguntas2" id="trabajo">
                                <p>Trabajo</p>
                                <input type="text" id="trabajo" name="trabajo" value="<?php echo $_SESSION['estado'] ?>" disabled>
                            </div>
                        </div>

                        <div class="preguntas_formulario2">
                            <div class="cont_preguntas2" id="enfermedads">
                                <p>Enfermedad </p>
                                <input type="text" id="enfermedad" name="enfermedad" value="<?php echo $_SESSION['patologia'] ?>" disabled>
                            </div>
                            <div class="cont_preguntas" id="tipo_identificacion">
                            </div>
                            <div class="cont_preguntas2" id="nivel_gravedad">
                                <p>Nivel de Gravedad</p>
                                <input type="text" id="nivel_gravedad" name="nivel_gravedad" value="<?php  ?>" disabled>
                            </div>
                        </div>

                        <!--Agendar cita-->

                    <div class="preguntas_formulario2">
                            <div class="cont_preguntas3">
                                <p>Tipo de Cita</p>
                                <select class="tipocita" name="tipocita">
                                <?php
                                        $sql="SELECT * FROM tipo_cita";
                                        $consul= mysqli_query($conn,$sql);

                                            if($consul){
                                                while($desplegar= $consul->fetch_assoc()){
                                                    echo "<option value='".$desplegar['id']."'>".$desplegar['enombre']."</option>";
                                                }
                                            }
                                        ?>
                                </select>

                            </div>
                        <div class="cont_preguntas3" id="fecha">
                            <p>Fecha</p>
                            <input type="date" id="fecha1" name="fecha"  min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>

                        </div>
                        <div class="cont_preguntas3" id="hora_inicio">
                            <p>Hora Inicio</p>
                            <select name="hora_inicio" id="hora_rango1" required>
                            <option value="">Seleccionar</option>

                            <?php
                                        $sql="SELECT * FROM horarios WHERE EXTRACT(MINUTE FROM hora_inicio) IN (0, 30);";
                                        $consul2= mysqli_query($conn,$sql);

                                        if($consul2){
                                            while($desplegar2= $consul2->fetch_assoc()){
                                                echo "<option value='".$desplegar2['id_horario']."'>".$desplegar2['hora_inicio']."</option>";
                                            }
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="cont_preguntas3" id="hora_final">
                            <p>Hora Final</p>
                            <select name="hora_fin" id="rango" required></select>
                        </div>

                        <div class="cont_preguntas3_add">
                            <p>Añadir Cita: </p>
                            <div class="img"></div>
                        </div>

                    </div>
                    <div class="preguntas_formulario2">
                       
                        <div class="cont_preguntas2" id="fecha2_">
                            <p>Fecha</p>
                            <input type="date" id="fecha2" name="fecha2" >

                        </div>
                        <div class="cont_preguntas2" id="hora_inicio">
                            <p>Hora Inicio</p>

                            <select name="hora_inicio_2" id="hora_rango2" >
                                    <option value="">Seleccionar</option>
                            <?php
                                        $sql="SELECT * FROM horarios WHERE EXTRACT(MINUTE FROM hora_inicio) IN (0, 30);";
                                        $consul2= mysqli_query($conn,$sql);

                                        if($consul2){
                                            while($desplegar3= $consul2->fetch_assoc()){
                                                echo "<option value='".$desplegar3['id_horario']."'>".$desplegar3['hora_inicio']."</option>";
                                            }
                                        }
                                    ?>
                            </select>
                        </div>

                        <div class="cont_preguntas2" id="hora_final">
                            <p>Hora Final</p>
                            <select name="hora_fin2" id="rango_2"></select>
                        </div>


                    </div>
                    
                    <div class="cont_enviar"> <button type="" class="submit-btn" id="solicitar">Enviar</button></div> 

                    </form>
                </div>
            </div>
            <!----------------------------------Estado de la cita ------------------------------------->
                
        <div id="estadocita" class="historialcita">
            <div class="cont_titulo">
                <p>Estado Citas</p>
            </div>

            <div class="cont_general_all">
                <div class="notificacion">

                <?php
                $id_user = $_SESSION['id'];
                $sql1 = "SELECT * FROM preagendamiento p
                        INNER JOIN citas_agendadas ca ON p.id_preagendamiento = ca.id_preagendamiento 
                        INNER JOIN doctores d ON d.id_doctor = ca.id_DoctorAsignado 
                        INNER JOIN doctor_consultorio dc ON dc.id_doctor = d.id_doctor 
                        INNER JOIN usuario u ON u.id_usuario = d.id_usuario 
                        WHERE p.id_usuario = '$id_user'";

                $consulta_citas = mysqli_query($conn, $sql1);
                ?>

                <?php if (mysqli_num_rows($consulta_citas) > 0): ?>
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Fecha Asignada</th>
                                <th>Hora Asignada</th>
                                <th>Doctor</th>
                                <th>Consultorio</th>
                                <th>Estado</th>
                                <th>Cancelar</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($resultado = mysqli_fetch_array($consulta_citas)): ?>
                            <tr>
                                <td><?php echo $resultado['FechaAsignada']; ?></td>
                                <td><?php echo $resultado['HoraAsignado']; ?></td>
                                <td><?php echo $resultado['nombre']; ?></td>
                                <td><?php echo $resultado['id_consultorio']; ?></td>
                                <td>Agendada</td>
                                <td><form method="POST" action="cancelar_cita.php" style="display:inline;">
                                    <input type="hidden" name="id_preagendamiento" value="<?php echo $resultado['id_preagendamiento']; ?>">
                                    <button type="submit">Cancelar Cita</button>
                                </form></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>

                    
                <?php else: ?>
                    <?php
                    $sql2 = "SELECT * FROM preagendamiento p
                            INNER JOIN sugerencias_citas sc ON p.id_preagendamiento = sc.id_preagendamiento 
                            WHERE p.id_usuario = '$id_user'";

                    $consulta_sugerencias = mysqli_query($conn, $sql2);
                    ?>

                    <?php if (mysqli_num_rows($consulta_sugerencias) > 0): ?>
                        <table class="tabla">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($resultado = mysqli_fetch_array($consulta_sugerencias)): ?>
                                <tr>
                                    <td><?php echo $resultado['fecha']; ?></td>
                                    <td><?php echo $resultado['hora_reservada']; ?></td>
                                    <td><?php echo $resultado['estado']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="no-citas">
                            <p>No se encontraron citas para este usuario.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    
        </main>
        <div id="custom-alert" class="custom-alert">
            <div class="alert-content">
                <h2 id="alert-title"></h2>
                <p id="alert-message"></p>
                <button id="close-alert">Aceptar</button>
            </div>
        </div>

    </div>
    <script>
        function showAlert(title, message) {
        document.getElementById('alert-title').innerText = title;
        document.getElementById('alert-message').innerText = message;
        document.getElementById('custom-alert').style.display = 'block';
        }

        document.getElementById('close-alert').addEventListener('click', function() {
            document.getElementById('custom-alert').style.display = 'none';
        });

        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                const success = urlParams.get('success');
                console.log(success);
                switch (success) {
                    case '1':
                        showAlert('Solicitud Enviada', 'La solicitud de su cita ha sido enviada. Tendrá respuesta el día de mañana en horas de la mañana.');
                        break;
                    case '3':
                        showAlert('Cita cancelada correctamente', 'Ahora tienes disponible el formulario para agendar otra cita.');
                        break;
                    default:
                        showAlert('Error', 'Hubo un problema al enviar la solicitud. Por favor, inténtelo nuevamente.');
                        break;
                }
                // Limpiar los parámetros de la URL
                window.history.replaceState(null, null, window.location.pathname);
            }
        });

    </script>
    <script>
          document.addEventListener('DOMContentLoaded', function () {
            var toggleMenu = document.getElementById('toggleMenu');
            var menuContainer = document.querySelector('.con_menu');
            var closeMenu = document.getElementById('closemenu');

            toggleMenu.addEventListener('change', function () {
                if (toggleMenu.checked) {
                    menuContainer.classList.add('menu-abierto');
                    menuContainer.style.display='flex';
                    menuContainer.style.visibility='visible';
                    console.log("chekeado");

                } 
            });

            closeMenu.addEventListener('click', function () {
                toggleMenu.checked = false;
                menuContainer.classList.remove('menu-abierto');
            });
        });

         // Obtener referencias a los enlaces y sections
        const notificacion = document.querySelector('#notificacion');
        const historia_clini = document.querySelector('#historia_clinica');
        const addcita = document.querySelector('#add_cita');
        const mirarcita = document.querySelector('#estado_cita');


        const sectionNotifi = document.querySelector('#prueba');
        const sectionhistoria = document.querySelector('#prueba2');
        const agregarcita = document.querySelector('#agregar_cita');
        const vercita = document.querySelector('#estadocita');



        // Función para mostrar la sección de Agendar citas
        function showNotifi() {
            sectionNotifi.style.display = 'flex';
            sectionNotifi.style.visibility = 'visible';
            sectionhistoria.style.display = 'none';
            sectionhistoria.style.visibility = 'hidden';
            agregarcita.style.visibility='hidden';
            agregarcita.style.display='none';
            vercita.style.visibility='hidden';
            vercita.style.display='none';

        }

        // Función para mostrar la sección de Mis citas
        function showhistoria_clinica() {
            sectionNotifi.style.display = 'none';
            sectionNotifi.style.visibility = 'hidden';
            sectionhistoria.style.display = 'flex';
            sectionhistoria.style.visibility = 'visible';
            agregarcita.style.visibility='hidden';
            agregarcita.style.display='none';
            vercita.style.visibility='hidden';
            vercita.style.display='none';
        }
        function show_agregarcitas() {
            sectionNotifi.style.display = 'none';
            sectionNotifi.style.visibility = 'hidden';
            sectionhistoria.style.display = 'none';
            sectionhistoria.style.visibility = 'hidden';
            agregarcita.style.visibility='visible';
            agregarcita.style.display='flex';
            vercita.style.visibility='hidden';
            vercita.style.display='none';
        }
        function mirarcitas_estado() {
            sectionNotifi.style.display = 'none';
            sectionNotifi.style.visibility = 'hidden';
            sectionhistoria.style.display = 'none';
            sectionhistoria.style.visibility = 'hidden';
            agregarcita.style.visibility='none';
            agregarcita.style.display='none';
            vercita.style.visibility='visible';
            vercita.style.display='flex';
        }
        // Agregar eventos a los enlaces
        notificacion.addEventListener('click', showNotifi);
        historia_clini.addEventListener('click', showhistoria_clinica);
        addcita.addEventListener('click', show_agregarcitas);
        mirarcita.addEventListener('click', mirarcitas_estado);


        // Por defecto, mostramos la sección de Agendar citas al cargar la página
        show_agregarcitas();

</script>
    <script>
 
    // Función para deshabilitar la fecha seleccionada en fecha2 y un día más
    document.getElementById('fecha1').addEventListener('input', function() {
            // Obtener la fecha seleccionada en fecha1
            const fechaSeleccionada = new Date(this.value);
            // Agregar un día a la fecha seleccionada
            fechaSeleccionada.setDate(fechaSeleccionada.getDate() + 1);
            // Formatear la fecha seleccionada con el formato YYYY-MM-DD
            const fechaMinima = fechaSeleccionada.toISOString().split('T')[0];
            // Establecer la fecha mínima en fecha2
            document.getElementById('fecha2').setAttribute('min', fechaMinima);
        });
        
    let hora_rango1 = document.getElementById("hora_rango1");
    let opcion_actual;
    
    let hora_rango2 = document.getElementById("hora_rango2");
    let opcion_actual2;
    $(document).ready(function() {
    $("#hora_rango1").change(function() {
        opcion_actual = $(this).val();
        console.log("Opción seleccionada 1: ", opcion_actual);        

        $.ajax({
            url: "Usuario/horarios.php",
            type: "POST",
            data: { opcion_actual: opcion_actual },
            success: function(respon3) {
                console.log("Respuesta del servidor:", respon3);
                $("#rango").html(respon3);
            },
            error: function() {
                alert("Error al cargar las opciones del select rango_2");
            }
        });
    });

    $("#hora_rango2").change(function() {
        opcion_actual2 = $(this).val();
        console.log("Opción seleccionada 2: ", opcion_actual2);        

        $.ajax({
            url: "Usuario/horarios.php",
            type: "POST",
            data: { opcion_actual2: opcion_actual2 },
            success: function(respon4) {
                console.log("Respuesta del servidor:", respon4);
                $("#rango_2").html(respon4);
            },
            error: function() {
                alert("Error al cargar las opciones del select rango_2");
            }
        });
    });
});


</script>

</body>
</html>
