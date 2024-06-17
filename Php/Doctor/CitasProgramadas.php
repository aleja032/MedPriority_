<?php
require_once('../conexion.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Solicitud para ver los detalles de la cita
    if(isset($_POST['ver_detalle'])) {

    $id=$_POST['ver_detalle'];
        
    $sql= "SELECT * FROM citas_agendadas ca INNER JOIN preagendamiento p ON ca.id_preagendamiento=p.id_preagendamiento INNER JOIN usuario u ON p.id_usuario=u.id_usuario INNER JOIN doctores d ON ca.id_DoctorAsignado=d.id_doctor INNER JOIN tipo_cita tc ON p.id_tipo_cita=tc.id  WHERE ca.id_preagendamiento='$id' ";
    $resultado=mysqli_query($conn, $sql);
     
    if($resultado->num_rows){
        $dato= $resultado->fetch_assoc();
        ?>
<div  class="historialcita oculto">
                        <div class="cont_titulo">
                            <p>Detalles Cita</p>
                        </div>
                        <div class="cont_general_all">
                            <form action="" class="form_detalle_cita">

                                <div class="form_sect1">
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Paciente:</label>
                                        <input type="text" id="nombre" class="input-field" value="<?php echo $dato['nombre'] ?>" disabled >
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Doctor:</label>
                                        <input type="text" id="nombre" class="input-field" value="<?php echo $_SESSION["nombre"] ?>" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Fecha Ingreso:</label>
                                        <input type="text" id="nombre" class="input-field" value="<?php echo $dato['FechaAsignada'] ?>" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Hora:</label>
                                        <input type="text" id="nombre" class="input-field" value="<?php echo $dato['HoraAsignado'] ?>" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label  class="label">Estado Paciente:</label>
                                        <select type="text" name="estado_paciente" class="input-field"  >
                                            <?php
                                                    $estado="SELECT * FROM estado";
                                                    $estados=mysqli_query($conn, $estado);
                                                     
                                                    if($estados->num_rows){
                                                        while($dato1= $estados->fetch_assoc()){
                                                            echo "<option value='".$dato1['id_estado']."'>".$dato1['estado']."</option>";
                                                        }
                                                    }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Tipo Cita:</label>
                                        <input type="text" id="nombre" class="input-field" value="<?php echo $dato['enombre'] ?>" disabled>
                                    </div>
                                    <div class="campos_form">
                                        <label for="nombre" class="label">Patologia:</label>
                                        <select type="text" name="patologia" class="input-field"  >
                                            <?php
                                                    $patologia="SELECT * FROM patologias";
                                                    $patologias=mysqli_query($conn, $patologia);
                                                     
                                                    if($patologias->num_rows){
                                                        while($dato= $patologias->fetch_assoc()){
                                                            echo "<option value='".$dato['id_patologia']."'>".$dato['nombre_patologia']."</option>";
                                                        }
                                                    }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="campos_form large">
                                        <label for="nombre" class="label">Descripcion Enfermedad:</label>
                                        <input type="text" name="descripcion" class="input-field" >
                                    </div>
                                </div>

                                <div class="form_sect2">
                                    <div class="sub_form1">
                                        <div class="campos_form ampliar">
                                            <label for="nombre" class="label">Observaciones:</label>
                                            <input type="text" name="observaciones" class="input-field" >
                                        </div>
                                    </div>
                                    <div class="imagen_form">

                                    </div>
                                    
                                </div>
                                <div class="contain_botones_form">
                                    <div class="form_none" >
                                        <input type="hidden"  name="confirmar" value="<?php echo $id ?>">
                                        <button type="submit" class="button_detalles" >Confirmar</button>
                                    </div>


                                </div>
                            </form>
                            <div class="botones_afuera">
                            <form class="form_none" id="NoAsistio">
                                        <input type="hidden"  name="NoAsistio" value="<?php echo $id ?>">
                                        <button type="submit" class="button_detalles" style="background-color: #d63232;">No Asistio</button>
                                    </form>
                            <form class="form_none"><button class="button_detalles" style="background-color: #8b8686;" onclick="cerrar_modal()">Cancelar</button></form>
                            </div>


                        </div>
                    </div>
                    <script src="../Js/Doctor/AjaxCitasProgramadas2.js"></script>   

        <?php
        
    }


    }

    if(isset($_POST['NoAsistio'])) {

        $id_preagendamiento=$_POST['NoAsistio'];

        $sql= "SELECT * FROM citas_agendadas ca INNER JOIN preagendamiento p ON ca.id_preagendamiento=p.id_preagendamiento INNER JOIN usuario u ON p.id_usuario=u.id_usuario INNER JOIN tipo_cita tc ON p.id_tipo_cita=tc.id  WHERE ca.id_preagendamiento='$id_preagendamiento' ";
        $resultado=mysqli_query($conn, $sql);
         
        if($resultado->num_rows){
            $dato= $resultado->fetch_assoc();
            $fecha=$dato['FechaAsignada'];
            $hora=$dato['HoraAsignado'];
            $id_cita=$dato['id_tipo_cita'];
            $id_usuario=$dato['id_usuario'];
            $asistencia=true;
            $numero_folio=0;
            $idoc=$_SESSION['idoc'];

        $asistencia = true;
        $insert_cancelar ="INSERT INTO historia_clinica (
            id_usuario,
            id_doctor,
            id_patologia,
            fecha_ingreso,
            numero_folio,
            enfermedad_actual,
            id_estado,
            id_tipocita,
            aspecto_general,
            Asistencia,
            hora
        ) VALUES ('$id_usuario','$idoc',NULL,'$fecha',NULL,NULL,NULL,'$id_cita',NULL,$asistencia,'$hora');";

    if ($conn->query($insert_cancelar) === TRUE) {
        echo "cancelado";
    }


    }

}
    if(isset($_POST['confirmar'])) {
        $id_preagendamiento=$_POST['confirmar'];
        $estado_paciente=$_POST['estado_paciente'];
        $patologia=$_POST['patologia'];
        $descripcion=$_POST['descripcion'];
        $observaciones=$_POST['observaciones'];
        

        $sql= "SELECT * FROM citas_agendadas ca INNER JOIN preagendamiento p ON ca.id_preagendamiento=p.id_preagendamiento INNER JOIN usuario u ON p.id_usuario=u.id_usuario INNER JOIN tipo_cita tc ON p.id_tipo_cita=tc.id  WHERE ca.id_preagendamiento='$id_preagendamiento' ";
        $resultado=mysqli_query($conn, $sql);
         
        if($resultado->num_rows){
            $dato= $resultado->fetch_assoc();
            $fecha=$dato['FechaAsignada'];
            $hora=$dato['HoraAsignado'];
            $id_cita=$dato['id_tipo_cita'];
            $id_usuario=$dato['id_usuario'];
            $asistencia=true;
            $numero_folio=0;
            $idoc=$_SESSION['idoc'];

            $contar="SELECT COUNT(*) AS folio FROM historia_clinica WHERE numero_folio IS NOT NULL";
            $result = $conn->query($contar);
            if($result->num_rows>0){
                $pre= $result->fetch_assoc();
                $numero_folio=$pre['folio']+1;
            }

            $insert ="INSERT INTO historia_clinica (
                    id_usuario,
                    id_doctor,
                    id_patologia,
                    fecha_ingreso,
                    numero_folio,
                    enfermedad_actual,
                    id_estado,
                    id_tipocita,
                    aspecto_general,
                    Asistencia,
                    hora
                ) VALUES ('$id_usuario','$idoc','$patologia','$fecha','$numero_folio','$descripcion','$estado_paciente','$id_cita','$observaciones',$asistencia,'$hora');";

            if ($conn->query($insert) === TRUE) {
                echo "Nuevo registro creado exitosamente";
            }

    }
}

}


?>



