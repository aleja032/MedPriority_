
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
                                            <td><button class="delete" data-user-id="<?php echo $fila['id_usuario'];?>" data-role='3'>Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>

                                <script src="../Js/testt.js"></script>

                               
                                
