<!-- Sección de Estadísticas y Análisis -->
<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div style="background-color:#f0f0f0;" class="estadisticas-container" style="text-align: center;" class="col-md-9">
            <br>
                <h4 style="background-color:#226f7e; color:aliceblue">Estadísticas por mes</h4>

                <div class="col-md-12">
                    <div id="estadisticas">
                        <br>
                        <br>
                        <!-- Canvas para el gráfico -->
                        <canvas id="graficoEstadisticas" width="800" height="70"></canvas>
                        <br>
                        <br>
                    </div>
                </div>

            </div>


            <!-- Sección de Estadísticas y Análisis -->
            <script>
                document.addEventListener('DOMContentLoaded',
                    function() { // Supongamos que tienes una ruta en tu backend que devuelve datos de la base de datos
                        const base_url = 'http://localhost/Seguridad_Ciudadana/';

                        // Realiza una solicitud AJAX para obtener los datos
                        $.ajax({
                            url: base_url + 'panel/getIncidenciasGraf/',
                            type: 'GET',
                            dataType: 'json',
                            success: function(datos) {
                                // Llama a la función para crear el gráfico con los datos obtenidos
                                crearGrafico(datos);
                            },
                            error: function(error) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Error al obtener datos de la base de datos.',
                                    showConfirmButton: false,
                                    timer: 2200
                                })
                            }
                        });
                    }

                )

                function crearGrafico(datos) {
                    // Nombres de los meses
                    var nombresMeses = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];

                    // Definir un conjunto de colores para los meses
                    var colores = [
                        'rgba(255, 99, 132, 0.5)', // Rojo
                        'rgba(54, 162, 235, 0.5)', // Azul
                        'rgba(255, 206, 86, 0.5)', // Amarillo
                        'rgba(75, 192, 192, 0.5)', // Verde
                        'rgba(153, 102, 255, 0.5)', // Púrpura
                        'rgba(255, 159, 64, 0.5)', // Naranja
                        'rgba(255, 0, 0, 0.5)', // Rojo claro
                        'rgba(0, 255, 0, 0.5)', // Verde claro
                        'rgba(0, 0, 255, 0.5)', // Azul claro
                        'rgba(255, 192, 203, 0.5)', // Rosa
                        'rgba(255, 165, 0, 0.5)', // Naranja claro
                        'rgba(128, 0, 128, 0.5)' // Morado
                    ];

                    // Datos de la base de datos
                    var etiquetas = datos.map(item => nombresMeses[item.mes - 1]);
                    var valores = datos.map(item => item.cantidad);

                    // Generar un color aleatorio para cada etiqueta
                    var backgroundColors = etiquetas.map((label, index) => colores[index % colores.length]);

                    var datosGrafico = {
                        labels: etiquetas,
                        datasets: [{
                            label: 'Número de Incidentes reportados',
                            backgroundColor: backgroundColors,
                            borderWidth: 1,
                            data: valores
                        }]
                    };

                    // Opciones del gráfico
                    var opciones = {
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

                    // Crear el gráfico de pastel utilizando Chart.js
                    var ctx = document.getElementById('graficoEstadisticas').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: datosGrafico,
                        options: opciones
                    });
                }
            </script>
          