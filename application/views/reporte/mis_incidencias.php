<main>
    <div class="container mt-5">
        <div class="row">
            <div style="background-color:#f0f0f0; text-align: center; border-radius:30px;" id="vista-alertas" class="col-md-9">
            <br>
                <h4 style="background-color:#226f7e; color:aliceblue">Estado de Incidencias</h4>
                <br>
                <table id="tabla-incidencias" class="display" style="width:100%">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Barrio</th>
                            <th>Tipo de Incidencia</th>
                            <th>Nivel urgencia</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Más</th> <!-- Columna para el botón "Ver más detalles" -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incidencias as $incidencia): ?>
                        <tr>
                            <td><?= $incidencia->id ?></td>
                            <td><?= $incidencia->barrio ?></td>
                            <td><?= $incidencia->tipo_incidencia ?></td>
                            <td><?= $incidencia->nivel_urgencia ?></td>
                            <td><?= $incidencia->fecha ?></td>
                            <td><?= $incidencia->hora ?></td>
                            <td
                                class="estado-celda <?= ($incidencia->estado == 'Finalizada') ? 'estado-finalizado' : 'estado-en-proceso' ?>">
                                <?= $incidencia->estado ?>
                            </td>
                            <td>
                                <!-- Agregar el botón "Ver más detalles" -->
                                <a class="btn btn-secondary ver-mas" onclick="verMas(<?= $incidencia->id ?>);"
                                    title="Ver más"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                    </tbody>

                </table>
            </div>

            <!-- Modal para mostrar detalles de la incidencia -->
            <div class="modal fade" id="detalleIncidencia" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detalles de la Incidencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="text-left">Descripción:</td>
                                        <td class="text-left" id="celDescripcion">Larry</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Avances incidencia:</td>
                                        <td class="text-left" id="celnota">Larry</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Fecha registro:</td>
                                        <td class="text-left" id="celfecha">Larry</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Hora:</td>
                                        <td class="text-left" id="celhora">Larry</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Estado:</td>
                                        <td class="text-left" id="celestado">Larry</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Fecha de cierre:</td>
                                        <td class="text-left" id="celfecha_cierre">Larry</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
