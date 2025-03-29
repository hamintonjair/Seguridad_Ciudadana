<main>

    <div class="container mt-5">
        <div class="row">
            <div style="background-color:#f0f0f0; border-radius:30px;" id="vista-alertas" class="col-md-9">
                <br>
                <h4 style="color:black; text-align: center;">Alertas de Incidencias</h4>
                <br>
                <!-- Recorre y muestra las alertas de forma dinámica -->
                <?php foreach ($alertas as $alerta): ?>
                <div class="alert" onclick="toggleContent(this)">
                    <strong>Tipo de incidencia:</strong> <?= $alerta->tipo_incidencia ?>
                    <div class="content">
                        <strong>Descripción:</strong> <?= $alerta->descripcion ?><br>
                        <strong>Nivel de Urgencia:</strong> <?= $alerta->nivel_urgencia ?><br>
                        <strong>Fecha:</strong> <?= $alerta->fecha ?><br>
                        <strong>Hora:</strong> <?= $alerta->hora ?><br>
                        <strong>Lugar incidencia:</strong> <?= $alerta->barrio ?><br>
                        <strong>Reportado por:</strong> <?= $alerta->nombre ?><br>
                        <strong>Correo:</strong> <?= $alerta->correo ?><br>
                        <!-- Agrega un enlace para dirigirse a la ubicación en el mapa -->
                        <button class="btn btn-danger" href="javascript:void(0);"
                            onclick="mostrarUbicacion(<?= $alerta->latitud ?>, <?= $alerta->longitud ?>)"><i
                                class="fas fa-map-marker-alt"></i></button>
                        <a class="btn btn-secondary"
                            href="https://api.whatsapp.com/send?text=Tipo%20de%20incidencia%20'<?= $alerta->tipo_incidencia ?>' %20Ubicación:%20https://www.google.com/maps?q=<?= $alerta->latitud ?>,<?= $alerta->longitud ?>"
                            target="_blank" class="whatsapp-button">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <button class="btn btn-primary" title="Compartir ubicación"
                            onclick="compartirUbicacion(<?= $alerta->latitud ?>, <?= $alerta->longitud ?>)"> <i
                                class="fas fa-envelope"></i></button>
                        <button class="btn btn-warning" onclick="editarIncidencia(<?= $alerta->id ?>)"> <i
                                class="fas fa-book"></i>Registrar avances</button>
                        <?php if ($alerta->estado === 'En proceso'): ?>
                        <button class="btn btn-success" onclick="finalizarAlerta(<?= $alerta->id ?>)">Finalizar
                            incidencia</button>
                        <?php endif; ?>
                    </div>
                </div>

                <?php endforeach; ?>

                <br>
                <br>
                <br>
                <!-- Mapa interactivo usando la API de mapas -->
                <div id="mapa" style="height: 400px; display: none;"></div>
                <div id="mensaje" style="display: block; text-align: center;">
                    <p>Haz clic en "Ver ubicación en el mapa" para abrir el mapa.</p>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modalAlerta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header headerAvance'">
                            <h5 class="modal-title">Registro de avances</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id='idIncidencia'></input>
                            <textarea id="notas" name="comentarios" rows="10" cols="80"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="registrarAvances();" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            // Variable para controlar si el usuario ha hecho clic en "Ver mapa"
            let mapaAbierto = false;

            // Función para alternar la visibilidad del contenido
            function toggleContent(element) {
                let content = element.querySelector('.content');
                if (content.style.display === 'none') {
                    content.style.display = 'block';
                    if (!mapaAbierto) {
                        // Si el usuario abre el contenido, muestra el mapa
                        document.getElementById('mapa').style.display = 'block';
                        document.getElementById('mensaje').style.display = 'none';
                        initMap(); // Inicializa el mapa
                        mapaAbierto = true;
                    }
                } else {
                    content.style.display = 'none';
                }
            }

            // Función para generar un color aleatorio en formato hexadecimal
            function getRandomColor() {
                let letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            // Obtener todas las alertas y asignarles un color aleatorio
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.backgroundColor = getRandomColor();
            });

            let map;

            // Inicializa el mapa solo una vez
            function initMap() {
                // Crea un mapa en el div con ID "mapa"
                map = new google.maps.Map(document.getElementById('mapa'), {
                    center: {
                        lat: 0,
                        lng: 0
                    }, // Centra inicialmente en coordenadas neutras
                    zoom: 15 // Puedes ajustar el nivel de zoom según tus necesidades
                });
            }

            // Variable para realizar un seguimiento de la alerta actualmente abierta
            let alertaAbierta = null;

            function mostrarUbicacion(latitud, longitud) {
                // Verifica si el mapa ya está inicializado
                if (!map) {
                    console.error("El mapa no está inicializado");
                    return;
                }

                // Verifica si hay una alerta abierta y si es así, ocúltala
                if (alertaAbierta) {
                    alertaAbierta.setMap(null);
                }

                // Centra el mapa en las coordenadas proporcionadas
                map.setCenter({
                    lat: parseFloat(latitud),
                    lng: parseFloat(longitud)
                });

                // Crea un marcador en las coordenadas
                let marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(latitud),
                        lng: parseFloat(longitud)
                    },
                    map: map,
                    title: 'Ubicación del incidente'
                });

                // Asigna el marcador a la variable de alerta abierta
                alertaAbierta = marker;
            }

            // Llama a initMap() al cargar la página
            window.onload = initMap;
            </script>