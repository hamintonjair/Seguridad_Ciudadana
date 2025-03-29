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
			<div style="background-color:#f0f0f0; text-align: center; border-radius:30px;"
				class="estadisticas-container col-md-9">
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
					const base_url = '<?php echo base_url(); ?>';

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
					const base_url = '<?php echo base_url(); ?>';

					// Muestra el mensaje de carga
					Swal.fire({
						title: 'Generando gráfico',
						text: 'Por favor, espere mientras se genera el gráfico y el PDF.',
						didOpen: () => {
							Swal.showLoading();
						}
					});

					// Solicita los datos y genera las URLs para los PDFs
					$.ajax({
						url: base_url + 'panel/getDatosEstadisticasYPredicciones/',
						type: 'GET',
						dataType: 'json',
<<<<<<< HEAD
						success: function(response) {
							if (response.predicciones && response.predicciones.datos) {
								const {
									pdf1_url,
									pdf2_url
								} = response.predicciones.datos;

								// Ocultar el mensaje de carga y mostrar confirmación
								Swal.fire({
									title: 'PDF Generado',
									text: 'Los PDFs se han generado correctamente.',
									showConfirmButton: true
								});

								// Validar y abrir automáticamente los PDFs en nuevas pestañas
								if (pdf1_url) {
									window.open(pdf1_url, '_blank');
								}
								if (pdf2_url) {
									window.open(pdf2_url, '_blank');
								}
							} else if (response.predicciones && response.predicciones.error) {
								// Mostrar el error específico
								Swal.fire({
									icon: 'error',
									title: 'Error',
									text: response.predicciones.error,
									showConfirmButton: true
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Error en la respuesta del servidor',
									text: 'No se pudieron obtener los datos necesarios.',
									showConfirmButton: true
								});
							}
=======
						success: function(resultado) {
														// Después de obtener las URLs de los PDFs, ocultar el mensaje de carga y mostrar un mensaje de confirmación
							Swal.fire({
								title: 'Generado PDF',
								text: 'Se han generado los PDFs con las gráficas para el análisis.',
								showConfirmButton: true
							}).then(() => {
								// Abrir los PDF en nuevas pestañas
							
								if (resultado.predicciones.datos.pdf1_url && resultado.predicciones.datos.pdf2_url) {
									window.open(resultado.predicciones.datos.pdf1_url, '_blank');
									window.open(resultado.predicciones.datos.pdf2_url, '_blank');
								}
							});
>>>>>>> c7656391e3640500f149c8f89428c702d686e55c
						},
						error: function(xhr, status, error) {
							let errorMessage = 'Error al generar las gráficas.';
							if (xhr.responseJSON && xhr.responseJSON.predicciones && xhr.responseJSON
								.predicciones.error) {
								errorMessage = xhr.responseJSON.predicciones.error;
							}

							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: errorMessage,
								showConfirmButton: true
							});
						}
					});
				});

<<<<<<< HEAD
				// Opcional: Mostrar u ocultar botones después de generar PDFs
=======


				// para oculyat los botones
>>>>>>> c7656391e3640500f149c8f89428c702d686e55c
				document.getElementById('generarPdf').addEventListener('click', function() {
					document.getElementById('reportesPatronesBarrios').style.display = 'inline-block';
					document.getElementById('reportesPatronesTipo').style.display = 'inline-block';
				});
<<<<<<< HEAD

				document.getElementById('reportesPatronesBarrios').addEventListener('click', function() {
					const base_url = '<?php echo base_url(); ?>';
					window.open(base_url + 'ml_scripts/patrones_barrios.pdf', '_blank');
				});

				document.getElementById('reportesPatronesTipo').addEventListener('click', function() {
					const base_url = '<?php echo base_url(); ?>';
					window.open(base_url + 'ml_scripts/patrones_tipos.pdf', '_blank');
=======
				document.getElementById('reportesPatronesBarrios').addEventListener('click', function() {
					const base_url = 'http://localhost/Seguridad_Ciudadana/';
					window.open(base_url + 'incidencias/patrones_barrios', '_blank');
				});
				document.getElementById('reportesPatronesTipo').addEventListener('click', function() {
					const base_url = 'http://localhost/Seguridad_Ciudadana/';
					window.open(base_url + 'incidencias/patrones_tipos', '_blank');

					// Muestra el mensaje de carga

>>>>>>> c7656391e3640500f149c8f89428c702d686e55c
				});
			</script>
