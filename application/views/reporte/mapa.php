<main>
    <div class="container mt-5">
    <div class="left-animation"></div>
        <div class="row">
            <div class="col-md-9">
                <h2 style="text-align: center;">Alerta</h2>
                <br>
                <!-- Mapa interactivo usando la API de mapas -->
                <div id="ma" style="height: 500px;"></div>
            </div>
            <script>
            function initMap() {
                // Función para obtener parámetros de la URL
                function getURLParameter(name) {
                    const urlParams = new URLSearchParams(window.location.search);
                    return urlParams.get(name);
                }

                // Obtén las coordenadas de latitud y longitud de la URL
                const latitud = getURLParameter('latitud');
                const longitud = getURLParameter('longitud');

                // Verifica que tengas las coordenadas y crea un mapa
                if (latitud && longitud) {
                    const map = new google.maps.Map(document.getElementById('ma'), {
                        center: {
                            lat: parseFloat(latitud),
                            lng: parseFloat(longitud)
                        },
                        zoom: 15, // Puedes ajustar el nivel de zoom según tus necesidades
                    });

                    // Puedes agregar un marcador en esas coordenadas si lo deseas
                    const marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(latitud),
                            lng: parseFloat(longitud)
                        },
                        map: map,
                        title: 'Ubicación',
                    });
                } else {
                    // Maneja el caso en el que no se proporcionaron coordenadas
                    alert('No se proporcionaron coordenadas de ubicación válidas.');
                }
            }
            </script>
