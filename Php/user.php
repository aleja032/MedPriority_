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
    <link rel="stylesheet" href="../Css/style_user1.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Añadir jQuery aquí -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.2/purify.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


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
                <div class="notificaciones"> <p class="letras">Sesion Modificar datos</p> <div class="linea"><p></p></div> </div>
                <div class="combo1_notificacion" >
                    <a href="#modificar_datos" id="modificar_datos">
                            
                        <div class="con_imagen_editar" id="iconon"> </div>
                    
                        <div class="enunciado2" id="modificar_datos">  Modificar mis datos</div>
                    </a>
                </div>
                <div class="notificaciones"> <p class="letras">Sesion Hisotria Clinica </p> <div class="linea"><p></p></div> </div>

                <div class="combo1_notificacion" >
                    <a href="#inicio">
                        
                        <div class="con_imagen3" id="iconox"> </div>
                
                        <div class="enunciado2" id="historia_clinica">  Historia Clinica</div>
                    </a>
                </div>
              <div class="notificaciones"> <p class="letras">Sesion Citas </p> <div class="linea"><p></p></div> </div>
              
                <div class="combo1_notificacion">
                    <div class="menu-item">
                        <div class="menu-title">
                            <div class="con_imagen4" id="iconos"> </div>
                            <div class="enunciado2">  Citas</div>
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <ul class="submenu">
                            <li><a href="#AgregarCita" id="add_cita">Agendar Citas</a></li>
                            <li><a href="#HistorialCitas" id="historial_cita">Historial de Citas</a></li>
                            <li><a href="#EstadoCitas" id="estado_cita">Estado Citas</a></li>
                        </ul>
                    </div>
                </div>

                
                <div class="close_sesion" >
                    <a href="cerrarsesion.php" class="texto_sesion">
                        <i class="fa-solid fa-power-off" style="color: #080808;"></i> <p>Cerrar Sesión</p>
                    </a>
                </div>
        </div>
        <main class="principal">
             <!--------- -----------------HISTORIA CLINICA---------------------- -->

             <div id="prueba2" class="historialcita">
                <div class="cont_titulo">
                    <p> Historia Clinica</p>
                </div>

                <div class="cont_general_all2" >
                    <div class="cont2_elegir" id="cont2_historial">
                            <h4 id="tipo-cita" >Elige el tipo de historia clinica:</h4>
                            
                            <div class="comb" id="form_1">
                                <input type="radio" name="consulta" id="radio" value="1" checked>
                                <p>Consulta Externa</p>
                            </div>  

                            <div class="comb">
                                <input type="radio" name="consulta" id="radio1" value="3">
                                <p>Consulta Odontológica</p>
                            </div>
                            <!-- <form action="pr.php" method="post" class="comb">
                                <button type="submit">Descargar PDF</button>
                            </form> -->
                            <div class="comb">
                                <!-- <a href="prueba.php">descargar</a> -->
                                <button id="generate-pdf">Generar PDF</button>

                            </div>
                    </div>
                    <form class="consultar">
                     <h4 id="fechacita"  > Ingrese la fecha de su cita:</h4> <div class="div"><input type="date" name="fecha" id="lupa" required> <i class="fa-solid fa-magnifying-glass" style="color: #000000;" id="consulta_folio"></i></div>
                    </form>
                    <div class="historial_clinico" id="historial" >
                        <div class="cont_logo_name" >
                            <div class="img_log"></div>
                            <p id="med">MEDPRIORITY</p>
                        </div>
                        <p class="nit">Nit:  1122540000-1</p>

                        <div class="datos_historia" id="datos">  </div>
                        
                            <div class="title" id="titles">DATOS PERSONALES</div>

                            <div class="general">
                                <?php
                                $sql = "SELECT * FROM usuario WHERE id_usuario = '$id_user'";
                                $consulta = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($consulta) > 0){
                                    $datos = mysqli_fetch_assoc($consulta);
                                ?>
                                    <div class="container1">
                                         <div class="cont-1">    <p class="negrita" id="nompaciente">Nombre Paciente: </p> <p  id="nompaciente" class="resultados"><?php echo $datos['nombre']; ?></p></div>
                                         <div class="cont-1">    <p class="negrita"  id="fecha">Fecha de Nacimiento: </p><p id="fecha" class="resultados"><?php echo $datos['fecha_nacimiento']; ?></p></div>
                                         <div class="cont-1">    <p class="negrita" id="dire">Dirección:</p><p  id="dire" class="resultados"><?php echo $datos['direccion']; ?></p></div>
                                         <div class="cont-1">    <p class="negrita" id="procede">Procedencia:</p><p id="proceden" class="resultados"><?php echo $datos['procedencia']; ?></p></div>
                                         <div class="cont-1">    <p class="negrita" id="estado"> Estado Civil:</p><p id="estado" class="resultados"><?php echo $datos['estado_civil']; ?></p></div>
                                    </div>

                                    <div class="container1">
                                    <div class="cont-1">        <p class="negrita"  id="identi">Identificación:</p><p  id="identis" class="resultados"><?php echo $datos['id_usuario']; ?></p></div>
                                    <div class="cont-1">        <p class="negrita" id="eda">Edad: </p><p id="eda" class="resultados"><?php echo $datos['edad']; ?></p></div>
                                    <div class="cont-1">        <p class="negrita" id="telefo">Teléfono: </p><p  id="telefo"class="resultados"><?php echo $datos['telefono']; ?></p></div>
                                    <div class="cont-1">        <p class="negrita" id="tipodocu">Tipo de Documento: </p><p   id="tipodocu"  class="resultados"><?php echo $datos['estado_civil']; ?></p></div>
                                    <div class="cont-1">        <p class="negrita"  id="sex">Sexo: </p><p id="sex"  class="resultados"><?php echo $datos['genero']; ?></p></div>
    
                                </div>
                            </div>
                                    <div class="afil">
                                        <div class="title2" id="title2">DATOS AFILIACION</div>
                                        <div class="cont-2">    <p class="afi" id="tipoafili">Tipo de Afiliación: </p> <p  id="tipoafili" class="resultados"><?php echo $datos['tipo_afiliacion']; ?></p></div>

                                        <!-- <p class="afi">Tipo de Afiliación: <?php echo $datos['tipo_afiliacion']; ?></p> -->

                                    </div>
                                            <?php
                                            } else {
                                                echo '<p>No se encontraron resultados.</p>';
                                            }
                                            ?>
                            <div class="title" id="title">ANAMNESIS</div>

                            <div class="descripcion_paciente" id="anamesis">


                            </div>
                    </div>

                
                                         
                </div>
            </div>
            <!----------------------NOTIFICACIONES--------------------------------------- -->
            <div id="prueba" class="historialcita">
                <div class="cont_titulo">
                    <p>Estado Citas</p>
                </div>

                    <div class="cont_general_all">
                        <div class="notificacion2">
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
                                                    <input type="hidden" name="id_sugerencia" value="<?php echo $id_user; ?>">
                                                    <button type="submit" class="boton_tabla" id="btnagregar">Agendar</button>
                                                </form>
                                                <form method="POST" action="liberar_citas.php" style="display:inline;">
                                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                    <button type="submit" class="boton_tabla_eli">No Agendar</button>
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

            <!-- ------------------------MODIFICAR MIS DATOS ----------------------------------->
            <div id="modificar" class="historialcita">
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
                        <form action="./Usuario/actualizar_user.php" method="post" class="actualizar"  id="fotico" enctype="multipart/form-data">
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
                                                <button type="button" class="bto-foto"   id="subirimagen"      onclick="document.getElementById('input-foto').click();">Subir foto</button>
                                                <div class="imagen_subir" ></div>
                                                
                                            </div>
                                            <button type="submit" id="btnactualizar"  class="bto-modi">Actualizar</button>
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
                    

            <!----------------------Agendar Cita--------------------------------------- -->

            <div id="agregar_cita" class="historialcita">
                <div class="cont_titulo">
                    <p>Agregar Cita</p>
                </div>
                <div class="cont_general_all">
                    <div class="preguntas_formulario">
                        <div class="cont_preguntas">
                            <p id="identifi">Identificación</p>
                            <input type="text" id="identificacion" name="identificacion" value="<?php echo $_SESSION['id'] ?>" disabled>
                        </div>
                        <div class="cont_preguntas" id="tipo_identificacionn">
                            <p>Tipo de Identificación</p>
                            <input type="text" id="tipo_identificacion" name="tipo_identificacion" value="<?php echo $_SESSION['tipo_documento'] ?>" disabled>
                        </div>
                        <div class="cont_preguntas" id="nombres">
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
                            <div class="cont_preguntas2" id="tipo_afiliacionn">
                                <p>Tipo de Afiliación</p>
                                <input type="text" id="tipo_afiliacion" name="tipo_afiliacion" value="<?php echo $_SESSION['tipo_afiliacion'] ?>" disabled>
                            </div>
                            <div class="cont_preguntas2" id="trabajos">
                                <p>Trabajo</p>
                                <input type="text" id="trabajo" name="trabajo" value="<?php echo $_SESSION['estado'] ?>" disabled>
                            </div>
                        </div>

                        <div class="preguntas_formulario2">
                            <div class="cont_preguntas2" id="enfermedads">
                                <p>Patología </p>
                                <input type="text" id="enfermedad" name="enfermedad" value="<?php echo $_SESSION['patologia'] ?>" disabled>
                            </div>
                            <div class="cont_preguntas" id="tipo_identificacion">
                            </div>
                            <div class="cont_preguntas2" id="nivel_gravedads">
                                <p>Nivel de Gravedad</p>
                                <input type="text" id="nivel_gravedad" name="nivel_gravedad"  disabled>
                            </div>
                        </div>

                        <!--Agendar cita-->

                    <div class="preguntas_formulario2">
                            <div class="cont_preguntas3">
                                <p id="tipocicta">Tipo de Cita</p>
                                <select     class="tipocita" name="tipocita"  id="tiposita">
                                <?php
                                        
                                        
                                        $sql="SELECT * FROM tipo_cita";
                                        $consul= mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($consul)>0){
                                                while($desplegar= $consul->fetch_assoc()){ 
                                                    $id=$desplegar['id'];
                                                     $validar_citas="SELECT * FROM citas_agendadas ca  INNER JOIN preagendamiento p ON ca.id_preagendamiento= p.id_preagendamiento WHERE id_usuario='$id_user' AND id_tipo_cita = '$id'";
                                                     $consul2= mysqli_query($conn,$validar_citas);
                                                    if(mysqli_num_rows($consul2)>0){
                                                        while($sihay= $consul2->fetch_assoc()){
                                                            echo "<option value='".$desplegar['id']."' disabled>".$desplegar['enombre']."</option>";
                                                        }
                                                    }else{
                                                        echo "<option value='".$desplegar['id']."' >".$desplegar['enombre']."</option>";   
                                                    }
                                                }
                                        }
                                    
                                ?>
                                </select>

                            </div>
                        <div class="cont_preguntas3" id="fecha">
                            <p id="fechista">Fecha</p>
                            <input type="date" id="fecha1" name="fecha"  min="<?php echo date('Y-m-d', strtotime('+2 day')); ?>" required>
                        </div>
                        <div class="cont_preguntas3" id="hora_inicio">
                            <p id="horitaincio">Hora Inicio</p>
                            <select name="hora_inicio" id="hora_rango1" required>
                            <option value=""  id="sele">Seleccionar</option>

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
                            <p id="horitafina">Hora Final</p>
                            <select name="hora_fin" id="rango" required></select>
                        </div>

                        <div class="cont_preguntas3_add">
                            <p>Añadir Citas: </p>
                            <div class="img"></div>
                        </div>

                    </div>
                    <div class="preguntas_formulario2">
                       
                        <div class="cont_preguntas2" id="fecha2_">
                            <p>Fecha</p>
                            <input type="date" id="fecha2" name="fecha2" >

                        </div>
                        <div class="cont_preguntas2" id="hora_inicio">
                            <p id="horaini">Hora Inicio</p>

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
                <div class="notificacion2">

                <?php
                $id_user = $_SESSION['id'];

                $fecha_actual = (new DateTime())->format('Y-m-d');
                                
                $sql1 = "SELECT * FROM preagendamiento p
                        INNER JOIN citas_agendadas ca ON p.id_preagendamiento = ca.id_preagendamiento 
                        INNER JOIN doctores d ON d.id_doctor = ca.id_DoctorAsignado 
                        INNER JOIN doctor_consultorio dc ON dc.id_doctor = d.id_doctor 
                        INNER JOIN usuario u ON u.id_usuario = d.id_usuario INNER JOIN tipo_cita tc ON tc.id=p.id_tipo_cita
                        WHERE p.id_usuario = '$id_user' AND FechaAsignada >= '$fecha_actual'";

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
                                <th>Tipo de cita</th>
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
                                <td><?php echo $resultado['enombre']; ?></td>

                                <td>Agendada</td>

                                <td><form method="POST" action="Usuario/cancelar_cita.php" style="display:inline;">
                                    <input type="hidden" name="id_preagendamiento" value="<?php echo $resultado['id_preagendamiento']; ?>">
                                    <button type="submit" class="boton_tabla_eli">Cancelar Cita</button>
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
                                                    <button type="submit" class="boton_tabla">Agendar</button>
                                                </form>
                                                <form method="POST" action="liberar_citas.php" style="display:inline;">
                                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                    <button type="submit" class="boton_tabla">No Agendar</button>
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
                <?php endif; ?>
                </div>
            </div>
        </div>
        <!-------------------------- HISTORIAL CITA ------------------------------- -->
        <div id="histo" class="historialcita">
                <div class="cont_titulo">
                    <p>Historial Citas</p>
                </div>

                    <div class="cont_general_all">
                        <div class="notificacion2">
                        <?php
                        $id_user = $_SESSION['id'];
                        $sql1 = "SELECT * FROM preagendamiento p
                                INNER JOIN citas_agendadas ca ON p.id_preagendamiento = ca.id_preagendamiento 
                                INNER JOIN doctores d ON d.id_doctor = ca.id_DoctorAsignado 
                                INNER JOIN doctor_consultorio dc ON dc.id_doctor = d.id_doctor 
                                INNER JOIN usuario u ON u.id_usuario = d.id_usuario INNER JOIN tipo_cita tc ON tc.id=p.id_tipo_cita
                                WHERE p.id_usuario = '$id_user' ORDER BY FechaAsignada DESC";

                        $consulta_citas = mysqli_query($conn, $sql1);
                        ?>

                        <?php if (mysqli_num_rows($consulta_citas) > 0): ?>
                            <table class="tabla">
                                <thead>
                                    <tr>
                                        <th>Fecha Asignada</th>
                                        <th>Hora Asignada</th>
                                        <th>Tipo de Cita</th>
                                        <th>Doctor</th>
                                        <th>Consultorio</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($resultado = mysqli_fetch_array($consulta_citas)): ?>
                                    <tr>
                                        <td class="t"><?php echo $resultado['FechaAsignada']; ?></td>
                                        <td><?php echo $resultado['HoraAsignado']; ?></td>
                                        <td><?php echo $resultado['enombre']; ?></td>
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
        </main>
            <!-- HTML del alerta de todas las notificaciones-->

        <div id="custom-alert" class="custom-alert">
            <div class="alert-content">
                <h2 id="alert-title"></h2>
                <p id="alert-message"></p>
                <button id="close-alert">Aceptar</button>
            </div>
        </div>
        
                                  

    </div>  
    <script src="../Js/User/alertas.js"></script>
    <script src="../Js/User/desplegar_menu.js"></script>
    <script src="../Js/User/desplegar_containers2.js"></script>
    <script src="../Js/User/desabilitadias_calendario.js"></script>                    
    <script src="../Js/User/ajax.js"></script>
    <script src="../Js/User/cargar_img.js"></script>
    <script>
document.getElementById('generate-pdf').addEventListener('click', function() {
    const opcionSeleccionada = document.querySelector('input[name="consulta"]:checked').value;
    let fecha = document.querySelector('input[name="fecha"]').value;
    let formattedFecha = null;

    if (fecha.trim() !== '') {
        formattedFecha = formatFecha(fecha);
    }

    // Send the data to the server
    enviarOpcionSeleccionada3(opcionSeleccionada, formattedFecha);
});

// Function to send selected option and date to the server
function enviarOpcionSeleccionada3(opcionSeleccionada, fecha) {
    $.ajax({
        url: "./Usuario/generarPDF.php",
        type: "POST",
        data: { 
            opcion_actual: opcionSeleccionada,
            id_user: <?php echo json_encode($id_user); ?>,
            fecha: fecha
        },
        success: function(response) {
            console.log("PDF generado correctamente");
            console.log(response);

            // Redirigir al usuario a la URL de descarga del PDF
            window.location.href = './Usuario/generarPDF.php?download=1';

        },
        error: function() {
            alert("Error al generar el PDF");
        },
        complete: function() {
            console.log("Solicitud AJAX completa");
        }
    });

}


// Other functions
document.addEventListener('DOMContentLoaded', function() {

    function formatFecha(fecha) {
        const date = new Date(fecha);
        const year = date.getFullYear();
        const day = String(date.getDate()+1).padStart(2, '0'); // Ensure 2 digits
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Ensure 2 digits, months are 0-based
        return `${year}-${day}-${month}`;
    }

    function enviarOpcionSeleccionada(opcionSeleccionada, fecha) {
        $.ajax({
            url: "./Usuario/historia_clinica.php",
            type: "POST",
            data: { 
                opcion_actual: opcionSeleccionada,
                id_user: <?php echo json_encode($id_user); ?>,
                fecha: fecha
            },
            success: function(respon3) {
                document.getElementById('datos').innerHTML = respon3;
            },
            error: function() {
                alert("Error al cargar la opción seleccionada");
            }
        });
    }

    function enviarOpcionSeleccionada2(opcionSeleccionada, fecha) {
        $.ajax({
            url: "./Usuario/enfermedades.php",
            type: "POST",
            data: { 
                opcion_actual: opcionSeleccionada,
                id_user: <?php echo json_encode($id_user); ?>,
                fecha: fecha
            },
            success: function(respon3) {
                document.getElementById('anamesis').innerHTML = respon3;
            },
            error: function() {
                alert("Error al cargar la opción seleccionada");
            }
        });
    }

    function handleOptionChange() {
        const opcionSeleccionada = document.querySelector('input[name="consulta"]:checked').value;
        let fecha = document.querySelector('input[name="fecha"]').value;
        let formattedFecha = null;

        if (fecha.trim() !== '') {
            formattedFecha = formatFecha(fecha);
        }

        enviarOpcionSeleccionada(opcionSeleccionada, formattedFecha);
        enviarOpcionSeleccionada2(opcionSeleccionada, formattedFecha);
    }

    handleOptionChange();

    document.querySelectorAll('input[name="consulta"]').forEach(radio => {
        radio.addEventListener('click', handleOptionChange);
    });

    document.getElementById('consulta_folio').addEventListener('click', function() {
        handleOptionChange();
        document.querySelector('input[type="date"]').value = '';

    });
});

</script>


<?php
// $sql="SELECT * FROM preagendamiento WHERE id_usuario='$id_user'";
// $consulta=mysqli_query($conn,$sql);
// if(mysqli_num_rows($consulta)>0){
//     $datos= mysqli_fetch_array($consulta);
//     $scheduledDates =  $dato['fecha'];
// }

?>
<script>
    // // Pass the PHP array to JavaScript no dejar agendar fechas  que el usuario ya tiene agendado
    // const scheduledDates = <?php // echo json_encode($scheduledDates); ?>;

    // document.addEventListener("DOMContentLoaded", function() {
    //     const dateInput = document.getElementById('fecha1');

    //     dateInput.addEventListener('input', function() {
    //         const selectedDate = this.value;
    //         if (scheduledDates.includes(selectedDate)) {
    //             alert('This date is already scheduled. Please choose another date.');
    //             this.value = '';
    //         }
    //     });

    //     dateInput.addEventListener('focus', function() {
    //         this.setAttribute('type', 'text');
    //         this.setAttribute('type', 'date');
    //     });
    // });
</script>

</body>
</html>
