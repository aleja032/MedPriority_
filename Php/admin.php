<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medpriority ADMIN</title>
    <link rel="stylesheet" href="../Css/admin9.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<!-- -------------------------------MODAL------------------------------------------ -->

<?php
    require_once 'conexion.php';

    $bruh = "SELECT * FROM usuario WHERE id_rol='3' OR id_rol='2'";   //jiji
    $q = mysqli_query( $conn, $bruh );
        if(mysqli_num_rows($q)>0){
            while($ff =mysqli_fetch_assoc($q)){
                $modalId = 'modal_' . $ff['id_usuario'];
                $identi = $ff['id_usuario'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>" data-form="<?php echo $modalId?>">
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
<div id="overlay"></div>

    <section class="general_todo">
        <div class="conheader">  <!-- contenedor header o barra principal -->


            <div class="logo"><!-- contenedor del logo y la letras del logo -->
                <div class="img_logo"></div>
                <div class="letras_logo">
                    <p>MedPriority</p>
                </div>
            </div>

            <div class="datos_barra">
                <p>ADMIN</p>

                <div class="img_notificaion"></div>
    
                <div class="img_usuario"></div>
            </div>

        </div>

        <div class="congeneral"><!--contendor 2 general para el menu y los formularios -->

            <div class="con_menu"><!-- contenedor del menu -->
                <div class="cont_menu_sub">


                
                <div class="inicio"><!-- contenedores de el menu -->
                    <a href="#inicio">
                        <div class="con_imagen" id="icono"> <img src="../Img/casa.png" alt=""></div>
                    </a>
                    <a href="#inicio" class="inicio">
                        <div class="con_opcion">
                            <h4>Inicio</h4>
                        </div>
                    </a>
                </div>


                
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar medicos</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>
                <div class="inicio">
                    <a href="#reg_med">
                        <div class="con_imagen" id="icono"> <img src="../Img/resume.png" alt=""></div>
                    </a>
                    <a href="#reg_med" class="inicio">
                        <div class="con_opcion">
                            <h4>Registrar medico</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_med">
                        <div class="con_imagen" id="icono"> <img src="../Img/customer.png" alt=""></div>
                    </a>
                    <a href="#panel_med" class="inicio">
                        <div class="con_opcion">
                            <h4>Panel medicos</h4>
                        </div>
                    </a>
                </div>

                
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar pacientes</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>
                <div class="inicio">
                    <a href="#reg_pac">
                        <div class="con_imagen" id="icono"> <img src="../Img/historiaclinica.png" alt=""></div>
                    </a>
                    <a href="#reg_pac" class="inicio">
                        <div class="con_opcion">
                            <h4>Registrar paciente</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_pac">
                        <div class="con_imagen" id="icono"> <img src="../Img/user_panel.png" alt=""></div>
                    </a>
                    <a href="#panel_pac" class="inicio">
                        <div class="con_opcion">
                            <h4>Panel pacientes</h4>
                        </div>
                    </a>
                </div>

                </div>
            </div> 


            <!--   contenedor main donde se recargaran los contenedores  -->
            <main>

                    <div id="inicio" class="contain_main">
                        <div class="cont_titulo">
                            <p>Home</p>
                        </div>
                        
                        <div class="cont_general_all">
                            since youve been like this.
                            <BR>
                            baby i dont wanna really be in like this.
                        </div>
                    </div>

                    <!-- ---------------REGISTRO MEDICOS---------------- -->
                    <div id="reg_med" class="contain_main">
                        <div class="cont_titulo">
                            <p>Registrar medico</p>
                        </div>
                        
                            <div class="cont_general_all">

                                <div class="survey-container">
                                    <div class="question">
                                        <label for="id-number">No. Identificación</label>
                                        <input type="text" name="doc_id-number" required>
                                    </div>
                                    <div class="question">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="doc_name" required>
                                    </div>
                                    <div class="question">
                                        <label for="age">Edad</label>
                                        <input type="text" name="doc_age" required>
                                    </div>
                                    <div class="question">
                                        <label for="phone-number">Teléfono</label>
                                        <input type="text" name="doc_phone-number" required>
                                    </div>
                                    <div class="question">
                                        <label for="email">Correo Electronico</label>
                                        <input type="email" name="doc_email" required>
                                    </div>
                                    <div class="question">
                                        <label for="sex">Sexo</label>
                                        <input type="text" name="doc_sex" required>
                                    </div>
                                    <div class="save">
                                        <div class="save-button">
                                        <a href="#" id="guardar-button">Guardar</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>

                    <!-- --------------PANEL MEDICOS----------------- -->
                    <div id="panel_med" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel medicos</p>
                        </div>
                        <div class="cont_general_all">

                            <div class="panel-main" id="contain_tablas"> 
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
                                        
                                        require_once 'conexion.php';

                                        $sql = "SELECT * FROM usuario WHERE id_rol='3'";    //medico
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
                                            <td><button id="delete" data-user-id="<?php echo $fila['id_usuario'];?>" data-role='3'>Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- --------------REGISTRO PACIENTES-------------- -->
                    <div id="reg_pac" class="contain_main">
                        <div class="cont_titulo">
                            <p>Registrar paciente</p>
                        </div>
                            <div class="cont_general_all">

                                    <div class="pat-survey-container">
                                        <div class="pat-question">
                                            <label for="pat-id-type">Tipo de Documento</label>
                                            <select name="pat-id-type" id="pat-id-type">
                                                <option value="null"></option>
                                                <option value="Cedula de Ciudadania">Cédula de Ciudadanía</option>
                                                <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                                <option value="Registro Civil">Registro Civil</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                            </select>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-id-number">No. Documento</label>
                                            <input type="text" name="pat_id-number" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-name">Nombres</label>
                                            <input type="text" name="pat_name" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-email">Correo Electronico</label>
                                            <input type="text" name="pat_email" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-age">Edad</label>
                                            <input type="text" name="pat_age" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-phone-number">Teléfono</label>
                                            <input type="text" name="pat_phone-number" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-sex">Genero</label>
                                            <input type="text" name="pat_sex" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-residence-area">Tipo de Afiliacion</label>
                                            <select name="pat-afi" id="pat-afi">
                                                <option value="null"></option>
                                                <option value="Contributivo">Contributivo</option>
                                                <option value="Subsidiado">Subsidiado</option>
                                            </select>
                                        </div>
                                        <div class="save-patient">
                                            <div class="save-pat-button">
                                                <a href="#" id="paciente-nuevo">Guardar</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>

                    <!-- ------------PANEL PACIENTES--------------- -->
                    <div id="panel_pac" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel pacientes</p>
                        </div>
                            <div class="cont_general_all">
                            <div class="patient-main">
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

                            require_once  'conexion.php';
 
                            $sql2 = "SELECT * FROM usuario WHERE id_rol='2'";   //paciente
                            $query = mysqli_query($conn, $sql2 );
                            if(mysqli_num_rows($query)>0){
                                while($row = mysqli_fetch_assoc($query)){

                            ?>
                                <tr id=table_row_<?php echo $row['id_usuario']?>>
                                    <td><?php echo $row['id_usuario'];?></td>
                                    <td><?php echo $row['nombre'];?></td>
                                    <td><?php echo $row['edad'];?></td>
                                    <td><?php echo $row['genero'];?></td>
                                    <td><button data-modal-target="#modal_<?php echo $row['id_usuario'];?>">Detalles</button></td>
                                    <td><button id="delete" data-user-id="<?php echo $row['id_usuario'];?>" data-role='2'>Eliminar</button></td>
                                </tr>
                                    
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                            </div>

                    </div>

            </main>
        </div>
    </section>

</body>

<form action="" id="none" style="display:none">
    <input type="hidden" name="non">
</form>
<script src="../Js/sql1.js"></script>

<script>

    // function enviar_datos() {
    //         $.ajax({
    //             url: "update.php",
    //             type: "POST",
    //             data: $(".for").serialize(),
    //             success: function (respo) {
    //                 if(respo=="Si"){
    //                     Good('Si');
    //                 }
    //                 else{
    //                     Good('No');
    //                 }
                   
    //             }
    //         });
    //     }

    //     $("#registroo").click(function () {

    //         enviarvalidacion();
    //     });


        // $(document).ready(function () {
        //     // Función que se ejecuta cuando se envía un formulario
        //     $('.modal').submit(function (event) {
        //         event.preventDefault(); // Prevenir la acción predeterminada del envío del formulario (redireccionamiento)

        //         var form_id = $(this).data('form'); // Obtener el identificador único del formulario

        //         $.ajax({
        //             url: 'modificar.php', // Ruta a tu script PHP que procesará los datos
        //             type: 'POST', // Método HTTP que se utilizará para enviar la solicitud
        //             data: $(this).serialize() + '&form_id=' + form_id, // Datos que se enviarán con la solicitud (en este caso, los datos del formulario y el identificador único)
        //             success: function (respuesta) {
        //                 $('#contain_tablas').html(respuesta); // Actualizar el contenido de la página web con la respuesta del servidor
        //             },
        //         });
        //     });
        // });
</script>
</html>