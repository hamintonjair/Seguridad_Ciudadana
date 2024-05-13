<main>
    <div class="container mt-5">
        <div class="row">
            <div style="background-color:#f0f0f0;" id="vista-alertas" style="text-align: center;" class="col-md-9">
            <br>
                <h4 style="background-color:#226f7e; color:aliceblue">Usuarios y funcionarios</h4>
                <br>
                <?php
                    $this->load->model( 'ModelReporte' );
                        $validado = $this->ModelReporte->get_Session(); 
                
                    ; ?>
                <table id="tabla-usuarios" class="display" style="width:100%">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <?php if($validado[0]->rol =='admin'){ ?>

                            <th>Acciones</th> <!-- Columna para el botón "Ver más detalles" -->
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td style="text-align: left;"><?= $u->id ?></td>
                            <td style="text-align: left;"><?= $u->nombre ?></td>
                            <td style="text-align: left;"><?= $u->correo ?></td>
                            <td style="text-align: left;"><?= $u->rol ?></td>
                            <?php if($validado[0]->rol =='admin'){ ?>
                            <td>
                                <!-- Agregar el botón "Ver más detalles" -->
                                <a onclick="EliminarUsuario(<?= $u->id ?>);" title="Eliminar"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                            <?php } ?>
                                       
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>