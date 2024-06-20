<?php 
    session_start(); 
    require_once ('conexion.php');

    if($_SESSION["id"]==null){
        echo "<script>window.location.href = '../index.php'</script>";
    }else{
        $id_user = $_SESSION['id'];
        
    }
   
    $sacar_query = "SELECT * FROM usuario WHERE id_usuario='$id_user'";
    $resultado_query = mysqli_query($conn, $sacar_query);

    if($resultado_query) {
        $usuario = mysqli_fetch_assoc($resultado_query);
    } else {
        echo "Error al obtener la información del usuario: " . mysqli_error($conn);
        exit;
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-statistics@7.0.0/dist/simple-statistics.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <link rel="stylesheet" href="../Css/doctor4.css">
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
            <div class="name"> <p> Doctor: <?php echo htmlspecialchars($_SESSION['nombre']) ?> </p>  
            

                <div class="img_notificaion" ></div>   </div>
               

                <!-- <div class="img_usuario"></div> -->
                <div class="img_usuario" style="background-image: url('../<?php echo htmlspecialchars($usuario['imagen']); ?>');"></div>

        </div>

    </div>
    <div class="congeneral"><!--barra lateral -->

        <div class="con_menu"><!-- contenedor del menu -->
            <div class="check-boton" id="closemenu">
                <i class="fa-solid fa-xmark"></i>
            </div>


                <div class="inicio"><!-- contenedores de el menu -->
                    <a href="#" id="dash">
                        
                        <div class="con_imagen" id="icono"></div>
                    
                        <div class="enunciado" id="grafica">Dash</div>
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
                            <li><a href="#" id="citas_programadas">Citas Programadas</a></li>
                            <li><a href="#" id="lista_espera">Lista de espera</a></li>
                            <li><a href="#" id="historial_citas">Historial Citas</a></li>
                        </ul>
                    </div>
                </div>

                <div class="notificaciones"> <p class="letras">--------- Modificar datos</p> <div class="linea"><p></p></div> </div>
                <div class="combo1_notificacion" >
                    <a href="#" id="modificar_datos">
                            
                        <div class="con_imagen_editar" id="icono"> </div>
                    
                        <div class="enunciado2" >  Modificar mis datos</div>
                    </a>
                </div>

                
                <div class="close_sesion" >
                    <a href="cerrarsesion.php" class="texto_sesion">
                        <i class="fa-solid fa-power-off" style="color: #080808;"></i> <p>Cerrar Sesión</p>
                    </a>
                </div>
        </div>
        <main class="principal">


            <!----------------------Grafica dashboard--------------------------------------- -->

            <div id="contain_grafica" class="historialcita">
                <div class="cont_titulo">
                    <p>Grafica Citas Medicas</p>
                </div>
                <div class="cont_general_all">
                    <div class="contain_grafica" id="contain_grafica_v">
                        <?php
                            include "Doctor/Grafica.php";
                        ?>

                    </div>
                </div>
            </div>


                    <!-------------------------- Citas programadas ------------------------------- -->
        <div id="contain_citas_programadas" class="historialcita">
                <div class="cont_titulo">
                    <p>Citas Programadas</p>
                </div>

                    <div class="cont_general_all">
                        <div class="notificacion2">
                        <?php
                        $idoc = $_SESSION['idoc'];
                        $sql1 = "SELECT * FROM preagendamiento p
                                INNER JOIN citas_agendadas ca ON p.id_preagendamiento = ca.id_preagendamiento 
                                INNER JOIN doctores d ON d.id_doctor = ca.id_DoctorAsignado 
                                INNER JOIN doctor_consultorio dc ON dc.id_doctor = d.id_doctor 
                                INNER JOIN usuario u ON u.id_usuario = d.id_usuario 
                                WHERE ca.id_DoctorAsignado = '$idoc'";

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
                                        <th>Consultorio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($resultado = mysqli_fetch_array($consulta_citas)): ?>
                                    <tr>
                                        <td class="t"><?php echo $resultado['FechaAsignada']; ?></td>
                                        <td><?php echo $resultado['HoraAsignado']; ?></td>
                                        <td><?php echo $resultado['nombre']; ?></td>
                                        <td><?php echo $resultado['id_consultorio']; ?></td>
                                        <td>
                                            <form action="Doctor/CitasProgramadas" class="form_ver_detalle" data-form="<?php echo $resultado['id_preagendamiento']; ?>">
                                                <input type="text" name="ver_detalle" value="<?php echo $resultado['id_preagendamiento']; ?>">
                                                <button class="buton_detalles" type="submit">Detalles</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>

                    <!-------------------------- Lista De Espera------------------------------- -->
        <div id="contain_lista_espera" class="historialcita">
                <div class="cont_titulo">
                    <p>Lista De Espera</p>
                </div>

                    <div class="cont_general_all">
                        <div class="notificacion2">
                        <?php
                        
                        $sql1 = "SELECT * FROM preagendamiento p
                                INNER JOIN sugerencias_citas ca ON p.id_preagendamiento = ca.id_preagendamiento 
                                INNER JOIN doctores d ON d.id_doctor = ca.doctor_asignado 
                                INNER JOIN doctor_consultorio dc ON dc.id_doctor = d.id_doctor 
                                INNER JOIN usuario u ON u.id_usuario = d.id_usuario 
                                WHERE ca.doctor_asignado= '$idoc'";

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
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($resultado = mysqli_fetch_array($consulta_citas)): ?>
                                    <tr>
                                        <td class="t"><?php echo $resultado['fecha']; ?></td>
                                        <td><?php echo $resultado['hora_reservada']; ?></td>
                                        <td><?php echo $resultado['nombre']; ?></td>
                                        <td><?php echo $resultado['id_consultorio']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>

                    <!-------------------------- Historial Citas ------------------------------- -->
        <div id="contain_historialCitas" class="historialcita">
                <div class="cont_titulo">
                    <p>Historial Citas</p>
                </div>

                    <div class="cont_general_all">
                        <div class="notificacion2">
                        <?php
                        $id_user = $_SESSION['id'];
                        $sql1 = "SELECT * FROM historia_clinica p
                                WHERE p.id_doctor = '$idoc'";

                        $consulta_citas = mysqli_query($conn, $sql1);
                        ?>

                        <?php if (mysqli_num_rows($consulta_citas) > 0): ?>
                            <table class="tabla">
                                <thead>
                                    <tr>
                                        <th>Fecha </th>
                                        <th>Hora </th>
                                        <th>Observacion</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($resultado = mysqli_fetch_array($consulta_citas)): ?>
                                    <tr>
                                        <td class="t"><?php echo $resultado['fecha_ingreso']; ?></td>
                                        <td><?php echo $resultado['hora']; ?></td>
                                        <td><?php echo $resultado['aspecto_general']; ?></td>
                                        <td><?php echo $resultado['Asistencia']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>


            <!--------- -----------------HISTORIA CLINICA---------------------- -->



            <!-- ------------------------MODIFICAR MIS DATOS ----------------------------------->
            <div id="modificar_datos" class="historialcita">
                <?php
                $sql2 = "SELECT * FROM usuario WHERE id_usuario = '$id_user'";
                $consulta = mysqli_query($conn, $sql2);

                if(mysqli_num_rows($consulta) > 0){
                    $datos = mysqli_fetch_assoc($consulta);
                ?>
                    <div class="cont_titulo">
                        <p>Mis datos</p>
                    </div>
                    <div class="cont_general_all_modi">
                        <form action="./Usuario/actualizar_user.php" method="post" class="actualizar" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                            <div class="part1">
                                <p class="labels">Telefono</p>
                                <input type="text" name="telefono" id="input_modi2" value="<?php echo $datos['telefono']; ?>">
                                <p class="labels">Correo</p>
                                <input type="email" name="correo" id="input_modi2" value="<?php echo htmlspecialchars($datos['correo']); ?>">
                                <p class="labels">Estado civil</p>
                                <input type="text" name="estado_civil" id="input_modi2" value="<?php echo htmlspecialchars($datos['estado_civil']); ?>">
                            </div>

                            <div class="cont_part3">
                                            <div class="cont_img_subir">
                                                <input type="file" id="input-foto" name="foto" accept="image/*" style="display:none;">
                                                <button type="button" class="bto-foto" onclick="document.getElementById('input-foto').click();">Subir foto</button>
                                                <div class="imagen_subir"></div>
                                                
                                            </div>
                                            <button type="submit" class="bto-modi">Actualizar</button>
                            </div>

                            <div class="part2">
                                <p class="labels">Direccion</p>
                                <input type="text" name="direccion" id="input_modi" value="<?php echo htmlspecialchars($datos['direccion']); ?>">
                                <p class="labels">Ciudad-Departamento</p>
                                <input type="text" name="procedencia" id="input_modi" value="<?php echo htmlspecialchars($datos['procedencia']); ?>">
                                <p class="labels">Contraseña</p>
                                <input type="text" name="pass" id="input_modi" value="<?php echo htmlspecialchars($datos['contrasena']); ?>">
                            </div>
                        </form>
                    </div>
                <?php
                } else {
                    echo "<p>No se encontraron datos para este usuario.</p>";
                }
                ?>
            </div>
                    


        
        


        </main>
            <!-- HTML del alerta de todas las notificaciones-->

        <div id="custom-alert" class="custom-alert">
            <div class="alert-content">
                <h2 id="alert-title"></h2>
                <p id="alert-message"></p>
                <button id="close-alert">Aceptar</button>
            </div>
        </div>


                    <!----------------------Modal_Detalle_De_Cita--------------------------------------- -->
                <div class="modal_oculta" id="Modal_DetalleC">
                <!-- <div  class="historialcita oculto">
                        <div class="cont_titulo">
                            <p>Detalles Cita</p>
                        </div>
                        <div class="cont_general_all">
                            <form action="" class="form_detalle_cita">

                                <div class="form_sect1">
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Paciente:</label>
                                        <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Doctor:</label>
                                        <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Fecha Ingreso:</label>
                                        <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Hora:</label>
                                        <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Estado Paciente:</label>
                                        <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre" >
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Tipo Cita:</label>
                                        <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Patologia:</label>
                                        <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre">
                                    </div>
                                    <div class="campos_form large">
                                        <label for="nombre" class="label">Descripcion Enfermedad:</label>
                                        <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre">
                                    </div>
                                </div>

                                <div class="form_sect2">
                                    <div class="sub_form1">
                                        <div class="campos_form ampliar">
                                            <label for="nombre" class="label">Observaciones:</label>
                                            <input type="text" id="nombre" class="input-field" placeholder="Ingresa tu nombre">
                                        </div>
                                    </div>
                                    <div class="imagen_form">

                                    </div>
                                    
                                </div>
                                <div class="contain_botones_form">
                                    <form class="form_none"><button type="submit" class="button_detalles" >Confirmar</button></form>
                                    <form class="form_none"><button type="submit" class="button_detalles" style="background-color: #d63232;">No Asistio</button></form>
                                    <form class="form_none"><button type="submit" class="button_detalles" style="background-color: #8b8686;" onclick="cerrar_modal()">Cancelar</button></form>

                                </div>
                            </form>

                        </div>
                    </div> -->
                </div>

        
                                  

    </div>  
    <script src="../Js/User/desplegar_menu.js"></script>
    <script src="../Js/Doctor/Cambiar_Contain.js"></script>
    <script src="../Js/Doctor/AjaxCitasProgramadas2.js"></script>               
    <script src="../Js/User/cargar_img.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('generate-pdf').addEventListener('click', () => {
        const historialElement = document.getElementById('historial');

        // Añadir clase CSS antes de la captura
        historialElement.classList.add('expand-height');
        historialElement.classList.add('pdf-style');

        html2canvas(historialElement, {
            useCORS: true
        }).then(canvas => {
            // Quitar clase CSS después de la captura
            historialElement.classList.remove('expand-height');
            historialElement.classList.remove('pdf-style');

            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4');
            const imgProps = doc.getImageProperties(imgData);
            const pdfWidth = doc.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            doc.save('historia_clinica.pdf');
        });
    });
});

</script>


</body>
</html>
