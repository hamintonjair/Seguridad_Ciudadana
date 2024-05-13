<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div style="background-color:#f0f0f0;" id="vista-alertas" style="text-align: center;" class="col-md-6">
            <br>
                <h4 style="background-color:#226f7e; color:aliceblue">link videos de youtube</h4>
                <?php
                    $this->load->model( 'ModelReporte' );
                        $validado = $this->ModelReporte->get_Session(); 
                
                    ; ?>
                <hr>
                <table id="tabla-link" class="display" style="width:100%">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Link youtube</th>
                            <?php if ($validado[0]->rol == 'admin') { ?>

                                <th>Acciones</th> <!-- Columna para el botón "Ver más detalles" -->
                            <?php } ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($link as $linke) : ?>
                            <tr>
                                <td style="text-align: left;"><?= $linke->id ?></td>
                                <td style="text-align: left;"><?= $linke->url ?></td>
                                <?php if($validado[0]->rol =='admin'){ ?>
                                <td>
                                    <!-- Agregar el botón "Ver más detalles" -->
                                    <a onclick="EliminarLink(<?= $linke->id ?>);" title="Eliminar"><i class="fas fa-trash"></i></a>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
            </div>


            <script>
                $('#exampleModal').on('show.bs.modal', event => {
                    var button = $(event.relatedTarget);
                    var modal = $(this);
                    // Use above variables to manipulate the DOM

                });
            </script>