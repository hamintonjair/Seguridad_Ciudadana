<style>
	/* Para pantallas grandes (laptops/desktops) */
	@media (max-width: 1200px) {
		#graficoEstadisticas {
			width: 1000px;
			height: auto;
		}
	}

	/* Para pantallas medianas (tablets en orientación horizontal, laptops más pequeños) */
	@media (max-width: 1024px) {
		#graficoEstadisticas {
			width: 800px;
			height: auto;
		}
	}

	/* Para pantallas medianas (tablets en orientación vertical o pequeñas laptops) */
	@media (max-width: 768px) {
		#graficoEstadisticas {
			width: 600px;
			height: auto;
		}
	}

	/* Para pantallas pequeñas (smartphones grandes) */
	@media (max-width: 576px) {
		#graficoEstadisticas {
			width: 500px;
			height: auto;
		}
	}

	@media (max-width: 425px) {
		#graficoEstadisticas {
			width: 400px;
			height: auto;
		}
	}

	/* Para pantallas extra pequeñas (smartphones pequeños) */
	@media (max-width: 375px) {
		#graficoEstadisticas {
			width: 300px;
			height: auto;
		}
	}

	.btn-container {
		display: flex;
		gap: 10px;
	}

	.btn-container button {
		display: none;
		/* Inicialmente ocultar los botones */
	}
</style>


<!-- Sección de Estadísticas y Análisis -->
<main>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div style="background-color:#f0f0f0; text-align: center; border-radius:30px;" class="estadisticas-container col-md-9">
				<br>
				<h4 style="color:black">Estadísticas por mes</h4>

				<div class="col-md-12">
					<div id="estadisticas">
						<br>
						<br>
						<!-- Canvas para el gráfico -->
						<canvas id="graficoEstadisticas" width="800px" height="auto"></canvas>
						<br>
						<br>
					</div>
				</div>
				<hr>
				<button id="generarPdf" class="btn btn-success mt-3">Generar reporte y Predicciones</button>
				<div class="btn-container mt-3">
					<button id="reportesPatronesBarrios" class="btn btn-warning">Patrones en Barrios</button>
					<button id="reportesPatronesTipo" class="btn btn-info">Patrones Tipo de Incidencias</button>
				</div>
				<br>
				<br>

			</div>

			<script>
				document.addEventListener('DOMContentLoaded', function() {
					const base_url = 'http://localhost/Seguridad_Ciudadana/';

					// Obtener datos para el gráfico y predicciones
					$.ajax({
						url: base_url + 'panel/getIncidenciasGraf/',
						type: 'GET',
						dataType: 'json',
						success: function(resultado) {
							crearGrafico(resultado.datos);
						},
						error: function(error) {
							Swal.fire({
								position: 'top-end',
								icon: 'error',
								title: 'Error al obtener datos.',
								showConfirmButton: false,
								timer: 2200
							});
						}
					});
				});

				function crearGrafico(datos) {
					let nombresMeses = [
						'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
						'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
					];

					let colores = [
						'rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)',
						'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)',
						'rgba(255, 0, 0, 0.5)', 'rgba(0, 255, 0, 0.5)', 'rgba(0, 0, 255, 0.5)',
						'rgba(255, 192, 203, 0.5)', 'rgba(255, 165, 0, 0.5)', 'rgba(128, 0, 128, 0.5)'
					];

					let etiquetas = datos.map(item => nombresMeses[item.mes - 1]);
					let valores = datos.map(item => item.cantidad);

					let backgroundColors = etiquetas.map((label, index) => colores[index % colores.length]);

					let datosGrafico = {
						labels: etiquetas,
						datasets: [{
							label: 'Número de Incidentes reportados',
							backgroundColor: backgroundColors,
							borderWidth: 1,
							data: valores
						}]
					};


					let opciones = {
						responsive: true,
						plugins: {
							legend: {
								position: 'top',
							},
							title: {
								display: true,
								text: 'Incidencias por Mes'
							}
						}
					};

					let ctx = document.getElementById('graficoEstadisticas').getContext('2d');
					new Chart(ctx, {
						type: 'bar',
						data: datosGrafico,
						options: opciones
					});
				}


				// generar metricas de analisis de datos
				document.getElementById('generarPdf').addEventListener('click', function() {
					const base_url = 'http://localhost/Seguridad_Ciudadana/';

					// Muestra el mensaje de carga
					Swal.fire({
						title: 'Generando gráfico',
						text: 'Por favor, espere mientras se genera el gráfico y el PDF.',
						didOpen: () => {
							Swal.showLoading();
						}
					});

					// Obtener datos para el gráfico y predicciones
					$.ajax({
						url: base_url + 'panel/getDatosEstadisticasYPredicciones/',
						type: 'GET',
						dataType: 'json',
						success: function(resultado) {
							// Después de crear el gráfico, ocultar el mensaje de carga y mostrar un mensaje de confirmación
							Swal.fire({
								title: 'Generado PDF',
								text: 'Se ha generando el PDF con las gráficas para el analisis.',
								showConfirmButton: true

							});
						},
						error: function(error) {
							Swal.fire({
								icon: 'error',
								title: 'Error al generar las gráficas.',
								text: 'No se pudieron obtener los datos para el gráfico.',
								showConfirmButton: true
							});
						}
					});
				});

				
				// para oculyat los botones
				document.getElementById('generarPdf').addEventListener('click', function() {
					document.getElementById('reportesPatronesBarrios').style.display = 'inline-block';
					document.getElementById('reportesPatronesTipo').style.display = 'inline-block';
				});
				document.getElementById('reportesPatronesBarrios').addEventListener('click', function() {
					const base_url = 'http://localhost/Seguridad_Ciudadana/';
					window.open(base_url + 'incidencias/patrones_barrios', '_blank');
				});
				document.getElementById('reportesPatronesTipo').addEventListener('click', function() {
					const base_url = 'http://localhost/Seguridad_Ciudadana/';
					window.open( base_url + 'incidencias/patrones_tipos', '_blank');

					// Muestra el mensaje de carga
				
				});
			</script>
