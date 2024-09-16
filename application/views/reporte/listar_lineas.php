<main>
    <div class="container mt-5">
        <div class="row">
            <div style="background-color:#f0f0f0; border-radius:30px; " id="vista-alertas"class="col-md-9">
            <br>
                <h4 style="color:black;text-align: center;">Registrar líeas & link</h4>
                <br>
                <table id="tabla-lineas" class="display" style="width:100%">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Entidad</th>
                            <th>Línea</th>
                            <th>Nota</th>
                            <th>Acciones</th> <!-- Columna para el botón "Ver más detalles" -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lineas as $e): ?>
                        <tr>
                            <td><?= $e->id ?></td>
                            <td><?= $e->entidad ?></td>
                            <td><?= $e->linea ?></td>
                            <td><?= $e->nota ?></td>
                            <td>
                                <!-- Agregar el botón "Ver más detalles" -->
                                <a onclick="EliminarLinea(<?= $e->id ?>);"
                                    title="Eliminar"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
