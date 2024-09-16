<main>
    <div class="container mt-5">
        <div class="row">
            <div style="background-color:#f0f0f0; border-radius:30px; " id="vista-alertas"  class="col-md-9">
            <br>
            <h4 style="color:black; text-align: center;">Incidencias por resolver</h4>
			<br>
                <!-- Mapa interactivo usando la API de mapas -->
                <div id="map" style="height: 600px;"></div>
            </div>
            
            <script>
            window.onload = function() {
                initMap('mapa-incidencias');
            };
            </script>
