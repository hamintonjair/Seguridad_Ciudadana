<main>
    <div class="container mt-5">
        <div class="row">
            <div style="background-color:#f0f0f0;" id="vista-alertas"  class="col-md-9">
            <br>
            <h4  style="background-color:#226f7e; color:aliceblue; text-align: center;">Incidencias por resolver</h4>
                <!-- Mapa interactivo usando la API de mapas -->
                <div id="map" style="height: 600px;"></div>
            </div>
            
            <script>
            window.onload = function() {
                initMap('mapa-incidencias');
            };
            </script>