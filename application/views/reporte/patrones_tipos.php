<?php

// URL pública del archivo CSV en GitHub
$github_url = 'https://raw.githubusercontent.com/hamintonjair/ml_scripts/main/patrones_tipos.csv';

// Descargar el archivo CSV desde GitHub
$csv_content = file_get_contents($github_url);

// Verificar si se obtuvo correctamente el contenido
if ($csv_content === false) {
    die("El archivo CSV no existe o no es legible. Verifica la URL: $github_url");
}

// Procesar el contenido del CSV
$data = array_map('str_getcsv', explode("\n", trim($csv_content)));

// Obtener la cabecera y los datos
$header = array_shift($data); // Obtener la cabecera

// Comprobar que la cabecera no esté vacía y procesar los datos
if (!empty($header)) {
    $data = array_filter($data); // Filtrar filas vacías
    $data = array_map(function($row) use ($header) {
        if (count($header) === count($row)) {
            return array_combine($header, $row); // Combinar cabecera con los datos de cada fila
        }
        return null; // Devolver null si no coinciden las longitudes
    }, $data);

    // Filtrar nulos del resultado
    $data = array_filter($data);
} else {
    die("La cabecera del CSV está vacía o no se pudo leer.");
}

?>

<style>
.card {
    margin-bottom: 1rem;
}

.card-header {
    background-color: #226f7e;
    color: #ffffff;
}

.card-body {
    background-color: #f0f0f0;
}

.card-body .row {
    margin-bottom: 0.5rem;
}

.card-body .col-md-3 {
    font-weight: bold;
}
</style>

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div style="background-color:#f0f0f0; border-radius:30px; " class="col-md-12">
                <br>
                <h4 class="text-center" style="color:black;">Patrones por Tipo de Incidencia</h4>
                <br>
                <div class="card" style="background-color:#f0f0f0; color:aliceblue;">
                    <!-- <div class="card-header" style="background-color:#226f7e; color:aliceblue; text-align: center;" >Registro de lineas de emergencias</div> -->
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($data as $row): ?>
                            <div class="col-md-4">
                                <div class="card card-custom">
                                    <div class="card-header card-header-custom">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['tipo_incidencia']); ?>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p style="color:black;"><strong>Total de Incidencias:</strong>
                                            <?php echo htmlspecialchars($row['cantidad']); ?></p>
                                        <p style="color:black;"><strong>Predicción de Regresión Promedio:</strong>
                                            <?php echo number_format((float)$row['cantidad_pred'], 3, '.', ''); ?></p>
                                        <p style="color:black;"><strong>Moda de Predicción de Clasificación:</strong>
                                            <?php echo htmlspecialchars($row['prediccion_clasificacion_mode']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?php base_url(); ?>estadisticas" class="btn btn-primary">Volver</a>

                    </div>
                </div>
            </div>
</main>