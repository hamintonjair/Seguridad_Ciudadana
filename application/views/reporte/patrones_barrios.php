<?php
// Ruta al archivo CSV de patrones por barrio
$csv_path = 'C:\\xampp\\htdocs\\Seguridad_Ciudadana\\ml_scripts\\patrones_barrios.csv';

// Verificar si el archivo existe y es legible
if (!file_exists($csv_path) || !is_readable($csv_path)) {
	die("El archivo CSV no existe o no es legible.");
}

// Leer el archivo CSV
$data = [];
if (($handle = fopen($csv_path, 'r')) !== false) {
	$header = fgetcsv($handle); // Leer la primera línea (cabecera)
	while (($row = fgetcsv($handle)) !== false) {
		$data[] = array_combine($header, $row); // Combinar cabecera con los datos de cada fila
	}
	fclose($handle);
}

// Generar el HTML
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
                <h4 class="text-center" style="color:black;">Patrones por Barrio</h4>
                <br>
                <div class="card" style="background-color:#f0f0f0; color:aliceblue;">
                    <!-- <div class="card-header" style="background-color:#226f7e; color:aliceblue; text-align: center;" >Registro de lineas de emergencias</div> -->
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($data as $row): ?>
                            <div class="col-md-4">
                                <div class="card card-custom">
                                    <div class="card-header card-header-custom">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['barrio']); ?></h5>
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