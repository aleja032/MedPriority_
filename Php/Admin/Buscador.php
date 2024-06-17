<?php 
session_start(); 
require_once ('../conexion.php');



//Buscar Paciente------------------------------------------
            if(isset($_POST["buscar_doctor"])){


                $patron=$_POST["buscar_doctor"];
                ?>

                <body>
<!-- -------------------------------MODAL------------------------------------------ -->

<?php

$patron=$_POST["buscar_doctor"];
$sql = "SELECT * FROM usuario u WHERE u.id_rol=3
    AND (u.nombre LIKE '%$patron%' 
    OR u.edad LIKE '%$patron%' 
    OR u.telefono LIKE '%$patron%' 
    OR u.correo LIKE '%$patron%' 
    OR u.genero LIKE '%$patron%' 
    OR u.tipo_documento LIKE '%$patron%' 
    OR u.estado_civil LIKE '%$patron%' 
    OR u.direccion LIKE '%$patron%' 
    OR u.id_rol LIKE '%$patron%' 
    OR u.tipo_afiliacion LIKE '%$patron%')";
   // $bruh = "SELECT * FROM usuario WHERE id_rol='3' OR id_rol='2'";   //jiji
    $q = mysqli_query( $conn, $sql );
        if(mysqli_num_rows($q)>0){
            while($ff =mysqli_fetch_assoc($q)){
                $modalId = 'modal_' . $ff['id_usuario'];
                $identi = $ff['id_usuario'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($ff['nombre'])?></span>
        <span><?php echo htmlspecialchars($identi)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">Tipo de Documento
            <input type="text" required name=m_id_type value="<?php echo htmlspecialchars($ff['tipo_documento'])?>">
        </div>
        <div class="edit-modal">Numero de Documento
            <input type="text" disabled required name=m_id value="<?php echo htmlspecialchars($ff['id_usuario'])?>">
        </div>
        <div class="edit-modal">Nombre
            <input type="text" required name=m_name value="<?php echo htmlspecialchars($ff['nombre'])?>">
        </div>
        <div class="edit-modal">Edad
            <input type="text" required name=m_age value="<?php echo htmlspecialchars($ff['edad'])?>">
        </div>
        <div class="edit-modal">Sexo
            <input type="text" required name=m_sexmoneyfeelingsdie value="<?php echo htmlspecialchars($ff['genero'])?>">
        </div>
        <div class="edit-modal">Direccion
            <input type="text" required name=m_address value="<?php echo htmlspecialchars($ff['direccion'])?>">
        </div>
        <div class="edit-modal">Telefono
            <input type="text" required name=m_pickupyophonebaby value="<?php echo htmlspecialchars($ff['telefono'])?>">
        </div>
        <div class="edit-modal">Correo Electronico
            <input type="email" required name=m_email value="<?php echo htmlspecialchars($ff['correo'])?>">
        </div>
        <div class="edit-modal">Tipo de Afiliacion
            <input type="text" required name=m_afi value="<?php echo htmlspecialchars($ff['tipo_afiliacion'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button"  data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
            </div>
<?php
            }
        }
?>
</body>
    
    <table>
        <thead>
            <tr>
                <th>Identificación</th>
                <th>Nombres</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th style="width: 15%;"></th>
                <th style="width: 15%;"></th>
            </tr>
        </thead>

        <tbody>
            <?php 
            
            require_once '../conexion.php';

            $sql = "SELECT * FROM usuario u WHERE u.id_rol=3
    AND (u.nombre LIKE '%$patron%' 
    OR u.edad LIKE '%$patron%' 
    OR u.telefono LIKE '%$patron%' 
    OR u.correo LIKE '%$patron%' 
    OR u.genero LIKE '%$patron%' 
    OR u.tipo_documento LIKE '%$patron%' 
    OR u.estado_civil LIKE '%$patron%' 
    OR u.direccion LIKE '%$patron%' 
    OR u.id_rol LIKE '%$patron%' 
    OR u.tipo_afiliacion LIKE '%$patron%')"; //medico
            $consulta = mysqli_query($conn, $sql);
            if(mysqli_num_rows($consulta)>0){
                while($fila =mysqli_fetch_assoc($consulta)){
            ?>
            <tr id=table_row_<?php echo $fila['id_usuario']?>>
                <td> <?php echo $fila['id_usuario'];?></td>
                <td> <?php echo $fila['nombre'];?></td>
                <td> <?php echo $fila['edad'];?></td>
                <td> <?php echo $fila['telefono'];?></td>
                <td><button data-modal-target="#modal_<?php echo $fila['id_usuario'];?>">Detalles</button></td>
                <td><button class="delete" data-user-id="<?php echo $fila['id_usuario'];?>" data-role='medico'>Eliminar</button></td>
            </tr>

            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <?php
            }
            if(isset($_POST["buscar_paciente"])){
                $patron=$_POST["buscar_paciente"];

                ?>


<body>
<!-- -------------------------------MODAL------------------------------------------ -->

<?php

$sql = "SELECT * FROM usuario u WHERE u.id_rol=2
AND (u.nombre LIKE '%$patron%' 
OR u.edad LIKE '%$patron%' 
OR u.telefono LIKE '%$patron%' 
OR u.correo LIKE '%$patron%' 
OR u.genero LIKE '%$patron%' 
OR u.tipo_documento LIKE '%$patron%' 
OR u.estado_civil LIKE '%$patron%' 
OR u.direccion LIKE '%$patron%' 
OR u.id_rol LIKE '%$patron%' 
OR u.tipo_afiliacion LIKE '%$patron%')";
    //$bruh = "SELECT * FROM usuario WHERE id_rol='3' OR id_rol='2'";   //jiji
    $q = mysqli_query( $conn, $sql );
        if(mysqli_num_rows($q)>0){
            while($ff =mysqli_fetch_assoc($q)){
                $modalId = 'modal_' . $ff['id_usuario'];
                $identi = $ff['id_usuario'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($ff['nombre'])?></span>
        <span><?php echo htmlspecialchars($identi)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">Tipo de Documento
            <input type="text" required name=m_id_type value="<?php echo htmlspecialchars($ff['tipo_documento'])?>">
        </div>
        <div class="edit-modal">Numero de Documento
            <input type="text" disabled required name=m_id value="<?php echo htmlspecialchars($ff['id_usuario'])?>">
        </div>
        <div class="edit-modal">Nombre
            <input type="text" required name=m_name value="<?php echo htmlspecialchars($ff['nombre'])?>">
        </div>
        <div class="edit-modal">Edad
            <input type="text" required name=m_age value="<?php echo htmlspecialchars($ff['edad'])?>">
        </div>
        <div class="edit-modal">Sexo
            <input type="text" required name=m_sexmoneyfeelingsdie value="<?php echo htmlspecialchars($ff['genero'])?>">
        </div>
        <div class="edit-modal">Direccion
            <input type="text" required name=m_address value="<?php echo htmlspecialchars($ff['direccion'])?>">
        </div>
        <div class="edit-modal">Telefono
            <input type="text" required name=m_pickupyophonebaby value="<?php echo htmlspecialchars($ff['telefono'])?>">
        </div>
        <div class="edit-modal">Correo Electronico
            <input type="email" required name=m_email value="<?php echo htmlspecialchars($ff['correo'])?>">
        </div>
        <div class="edit-modal">Tipo de Afiliacion
            <input type="text" required name=m_afi value="<?php echo htmlspecialchars($ff['tipo_afiliacion'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button"  data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
            </div>
<?php
            }
        }
?>
</body>
                        
                        <table>
                            <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombres</th>
                                <th>Edad</th>
                                <th>Género</th>
                                <th style="width: 15%;"></th>
                                <th style="width: 15%;"></th>
                            </tr>
                            </thead>
                            
                            <tbody>

                            <?php

                            
 
                            //$sql2 = "SELECT * FROM usuario WHERE id_rol='2'";   //paciente
                            $query = mysqli_query($conn, $sql );
                            if(mysqli_num_rows($query)>0){
                                while($row = mysqli_fetch_assoc($query)){

                            ?>
                                <tr id=table_row_<?php echo $row['id_usuario']?>>
                                    <td><?php echo $row['id_usuario'];?></td>
                                    <td><?php echo $row['nombre'];?></td>
                                    <td><?php echo $row['edad'];?></td>
                                    <td><?php echo $row['genero'];?></td>
                                    <td><button data-modal-target="#modal_<?php echo $row['id_usuario'];?>">Detalles</button></td>
                                    <td><button class="delete" data-user-id="<?php echo $row['id_usuario'];?>" data-role='usuario'>Eliminar</button></td>
                                </tr>
                                    
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <?php
            }


            // BUSCADOR CITAS AGENDADAS
            if(isset($_POST["buscar_preagendamiento"])){
                $patron=$_POST["buscar_preagendamiento"];
            
                ?>
            <body>
<!-- -------------------------------MODAL CITAS------------------------------------------ -->

<?php

    $mod_cita = "SELECT * FROM preagendamiento
    INNER JOIN usuario ON preagendamiento.id_usuario = usuario.id_usuario
    INNER JOIN tipo_cita ON preagendamiento.id_tipo_cita = tipo_cita.id
    WHERE usuario.nombre LIKE '%$patron%'
       OR preagendamiento.fecha LIKE '%$patron%'
       OR preagendamiento.registro LIKE '%$patron%'
       OR tipo_cita.enombre LIKE '%$patron%'";    //cita   //  TEST MODAL CITAS

    $que = mysqli_query( $conn, $mod_cita );
        if(mysqli_num_rows($que)>0){
            while($mcita =mysqli_fetch_assoc($que)){
                $modalcId = 'modalci_' . $mcita['id_preagendamiento'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalcId?>">
    <div class="modal-header">
        <span>Cita de <?php echo htmlspecialchars($mcita['nombre'])?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">ID Cita
            <input type="text" disabled required name=mc_idcita value="<?php echo htmlspecialchars($mcita['id_preagendamiento'])?>">
        </div>
        <div class="edit-modal">Identificacion Paciente
            <input type="text" disabled required name=mc_idpaciente value="<?php echo htmlspecialchars($mcita['id_usuario'])?>">
        </div>
        <div class="edit-modal">Nombre Paciente
            <input type="text" disabled required name=mc_namepaciente value="<?php echo htmlspecialchars($mcita['nombre'])?>">
        </div>
        <div class="edit-modal">Tipo de Cita
            <select name=mc_tipocita>
                <?php 
                    $q_mcita = "SELECT * FROM tipo_cita";
                    $selmcita = mysqli_query( $conn, $q_mcita );
                    if(mysqli_num_rows($selmcita)>0){
                        while($selectmcita = mysqli_fetch_assoc($selmcita)){

                        $bot = ($selectmcita['id'] == $mcita['id']) ? 'selected' : '';
                ?>        
                    <option value="<?php echo $selectmcita['id']; ?>" <?php echo $bot?>>
                    <?php echo htmlspecialchars($selectmcita['enombre'])?>
                    </option>

                <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div class="edit-modal">Fecha (preagendamiento)
            <input type="date" required name=mc_date value="<?php echo htmlspecialchars($mcita['fecha'])?>">
        </div>
        <?php 
            $default = $mcita['id_horario'];
            $horafin = $mcita['hora_fin'];
        ?>
        <div class="edit-modal">Hora inicio (preagendamiento)
            <select name=mc_start_time> 
                <?php 
                    $q_sel_horas = "SELECT * FROM horarios";
                    $quesel = mysqli_query( $conn, $q_sel_horas );
                    if(mysqli_num_rows($quesel)>0){
                        while($select = mysqli_fetch_assoc($quesel)){

                            $selected = ($select['id_horario'] == $default) ? 'selected' : '';
                ?>        
                    <option value="<?php echo $select['id_horario']; ?>" <?php echo $selected?>>
                    <?php echo htmlspecialchars($select['hora_inicio'])?>
                    </option>

                <?php
                        }
                    }
                ?>
            </select>
        </div>
        
        <div class="edit-modal">Hora fin (preagendamiento)
            <?php 
                    $query_sel_horas = "SELECT * FROM horarios WHERE id_horario = $horafin";

                    $queryselect = mysqli_query( $conn, $query_sel_horas );
                    if(mysqli_num_rows($queryselect)>0){
                        while($select_end = mysqli_fetch_assoc($queryselect)){

                            $value = $select_end['id_horario'];
                        }
                    }
            ?>

            <select name=mc_end_time> 
                <?php 
                    $q_sel_horas = "SELECT * FROM horarios";
                    $quesel = mysqli_query( $conn, $q_sel_horas );
                    if(mysqli_num_rows($quesel)>0){
                        while($select = mysqli_fetch_assoc($quesel)){

                            $selected = ($select['id_horario'] == $value) ? 'selected' : '';
                ?>        
                    <option value="<?php echo $select['id_horario']; ?>" <?php echo $selected?>>
                    <?php echo htmlspecialchars($select['hora_inicio'])?>
                    </option>

                <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div class="edit-modal">Valoracion
            <input type="text" required name=mc_valor value="<?php echo htmlspecialchars($mcita['valoracion'])?>">
        </div>
        
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-preagendamiento" data-modal-id="<?php echo $modalcId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>
</body>
                        
<table>
                                    <thead>
                                    <tr>
                                        <th>Id PreAgendamiento</th>
                                        <th>Nombre Paciente</th>
                                        <th>Fecha</th>
                                        <th>Registro</th>
                                        <th>Tipo Cita</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                 

                                        $sql99 ="SELECT * FROM preagendamiento
                                        INNER JOIN usuario ON preagendamiento.id_usuario = usuario.id_usuario
                                        INNER JOIN tipo_cita ON preagendamiento.id_tipo_cita = tipo_cita.id
                                        WHERE  usuario.nombre LIKE '%$patron%'
                                           OR preagendamiento.fecha LIKE '%$patron%'
                                           OR preagendamiento.registro LIKE '%$patron%'
                                           OR tipo_cita.enombre LIKE '%$patron%'";  //cita
                                        $cita_query = mysqli_query($conn, $sql99);
                                        if(mysqli_num_rows($cita_query)>0){
                                            while($modalci = mysqli_fetch_assoc($cita_query)){
                                        ?>
                                        <tr id=precitatable_row_<?php echo $modalci['id_usuario']?>>
                                            <td> <?php echo $modalci['id_preagendamiento'];?></td>
                                            <td> <?php echo $modalci['nombre'];?></td>
                                            <td> <?php echo $modalci['fecha'];?></td>
                                            <td> <?php echo $modalci['registro'];?></td>
                                            <td> <?php echo $modalci['enombre'];?></td>
                                            <td><button data-modal-target="#modalci_<?php echo $modalci['id_preagendamiento'];?>">Detalles</button></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $modalci['id_preagendamiento'];?>" data-role='preagendamiento'>Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
            
                <?php
            
            }

            // BUSCADOR CITAS AGENDADAS
            if(isset($_POST["buscar_citas_agendadas"])){
                $patron=$_POST["buscar_citas_agendadas"];

                ?>
<table>
                                    <thead>
                                    <tr>
                                        <th>ID CITA</th>
                                        <th>Ident. Paciente</th>
                                        <th>Nombre Paciente</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Doctor</th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                    

                                        $sql7 = "SELECT c.id_citas, p.id_usuario, u.nombre AS usuario_nombre, c.FechaAsignada, c.HoraAsignado, d.id_doctor, du.nombre AS doctor_nombre
                                        FROM citas_agendadas c
                                        INNER JOIN preagendamiento p ON c.id_preagendamiento = p.id_preagendamiento
                                        INNER JOIN doctores d ON c.id_DoctorAsignado = d.id_doctor
                                        INNER JOIN usuario u ON p.id_usuario = u.id_usuario
                                        INNER JOIN usuario du ON d.id_usuario = du.id_usuario
                                        WHERE p.id_usuario LIKE '%$patron%'
                                           OR u.nombre LIKE '%$patron%'
                                           OR c.FechaAsignada LIKE '%$patron%'
                                           OR c.HoraAsignado LIKE '%$patron%'
                                           OR du.nombre LIKE '%$patron%'"; //cita
                                        $citasoli_query = mysqli_query($conn, $sql7);
                                        if(mysqli_num_rows($citasoli_query)>0){
                                            while($citasoli = mysqli_fetch_assoc($citasoli_query)){
                                        ?>
                                        <tr id=citatable_row_<?php echo $citasoli['id_citas']?>>
                                            <td> <?php echo $citasoli['id_citas'];?></td>
                                            <td> <?php echo $citasoli['id_usuario'];?></td>
                                            <td> <?php echo $citasoli['usuario_nombre'];?></td>
                                            <td> <?php echo $citasoli['FechaAsignada'];?></td>
                                            <td> <?php echo $citasoli['HoraAsignado'];?></td>
                                            <td> <?php echo $citasoli['doctor_nombre'];?></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $citasoli['id_citas'];?>" data-role='cita'>Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>

            <?php

            }


            // BUSCADOR PATOLOGIAS
            if(isset($_POST["buscar_patologias"])){
                $patron=$_POST["buscar_patologias"];

                ?>
<body>
<!-- -------------------------------MODAL PATOLOGIA------------------------------------------ -->

<?php

    $mod_pato = "SELECT * FROM patologias
    WHERE nombre_patologia LIKE '%$patron%'
       OR puntuacion_pt LIKE '%$patron%'";//jiji
    $q = mysqli_query( $conn, $mod_pato );
        if(mysqli_num_rows($q)>0){
            while($quack =mysqli_fetch_assoc($q)){
                $modalId = 'modalpato_' . $quack['id_patologia'];
                $identi = $quack['id_patologia'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($quack['nombre_patologia'])?></span>
        <span><?php echo htmlspecialchars($identi)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">ID Patologia
            <input type="email" disabled name=mp_id value="<?php echo htmlspecialchars($quack['id_patologia'])?>">
        </div>
        <div class="edit-modal">Nombre Patologia
            <input type="email" required name=mp_name value="<?php echo htmlspecialchars($quack['nombre_patologia'])?>">
        </div>
        <div class="edit-modal">Puntuacion
            <input type="text" required name=mp_score value="<?php echo htmlspecialchars($quack['puntuacion_pt'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-patologia" data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>
</body>
    
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID Patologia</th>
                                        <th>Nombre Patologia</th>
                                        <th>Puntuacion</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                          

                                        $sql4 = "SELECT * FROM patologias
                                        WHERE nombre_patologia LIKE '%$patron%'
                                           OR puntuacion_pt LIKE '%$patron%'";   //patologias
                                        $pato_query = mysqli_query($conn, $sql4);
                                        if(mysqli_num_rows($pato_query)>0){
                                            while($pato =mysqli_fetch_assoc($pato_query)){
                                        ?>
                                        <tr id=patotable_row_<?php echo $pato['id_patologia']?>>
                                            <td> <?php echo $pato['id_patologia'];?></td>
                                            <td> <?php echo $pato['nombre_patologia'];?></td>
                                            <td> <?php echo $pato['puntuacion_pt'];?></td>
                                            <td><button data-modal-target="#modalpato_<?php echo $pato['id_patologia'];?>">Detalles</button></td>
                                            <td><button class="delete" data-user-id="<?php echo $pato['id_patologia'];?>" data-role="patologia">Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>

            <?php

            }



            // BUSCADOR TIPO CITAS
            if(isset($_POST["buscar_tipo_cita"])){
                $patron=$_POST["buscar_tipo_cita"];

                ?>
<body>
<!-- -------------------------------MODAL TIPO CITA------------------------------------------ -->

<?php

    $mod_typecita = "SELECT * FROM tipo_cita  WHERE enombre LIKE '%$patron%'";
    $queso = mysqli_query( $conn, $mod_typecita );
        if(mysqli_num_rows($queso)>0){
            while($mytype =mysqli_fetch_assoc($queso)){
                $modalId = 'modaltipocita_' . $mytype['id'];
                $identi = $mytype['id'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($mytype['enombre'])?></span>
        <span><?php echo htmlspecialchars($identi)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">ID Tipo Cita
            <input type="email" disabled name=mtc_id value="<?php echo htmlspecialchars($mytype['id'])?>">
        </div>
        <div class="edit-modal">Nombre Patologia
            <input type="email" required name=mtc_name value="<?php echo htmlspecialchars($mytype['enombre'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-typecita" data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>
</body>
    
<table>
                                    <thead>
                                    <tr>
                                        <th>ID Tipo Cita</th>
                                        <th>Tipo de Cita</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                               

                                        $sql5 = "SELECT * FROM tipo_cita WHERE enombre LIKE '%$patron%'";   //tipo citas
                                        $tcita_query = mysqli_query($conn, $sql5);
                                        if(mysqli_num_rows($tcita_query)>0){
                                            while($tcita =mysqli_fetch_assoc($tcita_query)){
                                        ?>
                                        <tr id=tipoctable_row_<?php echo $tcita['id']?>>
                                            <td> <?php echo $tcita['id'];?></td>
                                            <td> <?php echo $tcita['enombre'];?></td>
                                            <td><button data-modal-target="#modaltipocita_<?php echo $tcita['id'];?>">Detalles</button></td>
                                            <td><button class="delete" data-user-id="<?php echo $tcita['id'];?>" data-role="tipocita" >Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>

            <?php

            }




            // BUSCADOR ESPECIALIDADES
            if(isset($_POST["buscar_especialidades"])){
                $patron=$_POST["buscar_especialidades"];

                ?>

<body>
<!-- -------------------------------MODAL ESPECIALIDAD------------------------------------------ -->

<?php

    $mod_especial = "SELECT * FROM especialidades WHERE especialidad LIKE '%$patron%'";   //jiji
    $query_special = mysqli_query( $conn, $mod_especial );
        if(mysqli_num_rows($query_special)>0){
            while($special =mysqli_fetch_assoc($query_special)){
                $modalId = 'modalspecial_' . $special['id_especialidad'];
                $identispe = $special['id_especialidad'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($special['especialidad'])?></span>
        <span><?php echo htmlspecialchars($identispe)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">ID Especialidad
            <input type="email" disabled name=ms_id value="<?php echo htmlspecialchars($special['id_especialidad'])?>">
        </div>
        <div class="edit-modal">Nombre Especialidad
            <input type="email" required name=ms_name value="<?php echo htmlspecialchars($special['especialidad'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-especial" data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>
</body>
    
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID Especialidad</th>
                                        <th>Nombre Especialidad</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                     

                                        $sql6 = "SELECT * FROM especialidades WHERE especialidad LIKE '%$patron%'";   //especialidades
                                        $consulta = mysqli_query($conn, $sql6);
                                        if(mysqli_num_rows($consulta)>0){
                                            while($especi =mysqli_fetch_assoc($consulta)){
                                        ?>
                                        <tr id=specialtable_row_<?php echo $especi['id_especialidad']?>>
                                            <td> <?php echo $especi['id_especialidad'];?></td>
                                            <td> <?php echo $especi['especialidad'];?></td>
                                            <td><button data-modal-target="#modalspecial_<?php echo $especi['id_especialidad'];?>">Detalles</button></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $especi['id_especialidad'];?>" data-role="especialidad">Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
            <?php

            }






?>