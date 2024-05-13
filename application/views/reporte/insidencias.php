<main>

    <div class="container mt-5">
        <div class="row">
            <div style="background-color:#f0f0f0;" class="col-md-9">
            <br>
                <h4 style="background-color:#226f7e; color:aliceblue; text-align: center;">Reporte de Incidencia</h4>
                <br>
                <form id="formIncidencias" enctype="multipart/form-data" class="custom-form">
                    <!-- corrego y clave -->
                    <?php 
                    $this->load->model( 'ModelReporte' );
                    $validado = $this->ModelReporte->get_Session(); 
                    if(!empty($validado[0]->rol)){ ?>
                    <div class="form-row">

                        <P>Nota: <font color='red'>"Todos los campos con asterisco son obligatorios."
                            </font>
                        </P>
                    </div>
                    <?php }else{ ?>
                    <div class="form-row">

                        <P>Nota: <font color='red'>"Todos los campos con asterisco son obligatorios;
                                Además si deseas hacer seguimiento a las incidencias que reportes,
                                es importante realizar un registro en la plataforma. Ten en cuenta que tus datos
                                personales no serán compartidos con nadie, ya que esta información se utilizará
                                únicamente para que puedas llevar un seguimiento de las incidencias registradas."
                            </font>
                        </P>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-6">
                            <label for="nombre">Nombres y Apellidos <font color='red'>*</font></label>
                            <input type="text" class="form-control valid validText" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <label for="email">E-mail <font color='red'>*</font></label>
                                <input type="e-mail" class="form-control valid validEmail" id="email" name="email"
                                    required>
                            </div>
                        </div>
                    </div>

                    <?php };?>
                    <!-- Tipo de Incidencia y Fecha y Hora de la Incidencia -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tipo_incidencia">Tipo de Incidencia <font color='red'>*</font></label>
                            <select class="form-control" id="tipo_incidencia" name="tipo_incidencia" required>
                                <option value="accidente_transito">Accidente de transito</option>
                                <option value="accidente_laborales">Accidentes laborales</option>
                                <option value="agresion_violencia">Agresión o violencia</option>
                                <option value="amenazas">Amenazas o situaciones de peligro</option>
                                <option value="desaparición">Desapariciones o personas extraviadas</option>
                                <option value="desastres">Desastres naturales</option>
                                <option value="emergencia">Emergencia médica</option>
                                <option value="incidencia_ambiental">Incidencias ambientales</option>
                                <option value="incidencia_salud">Incidencias de salud pública</option>
                                <option value="incidencia_escolares">Incidencias escolares</option>
                                <option value="incendio">Incendio</option>
                                <option value="problema_seguridad">Problemas de seguridad pública</option>
                                <option value="robo_hurto">Robo o hurto</option>
                                <option value="violencia_ley">Violación de la ley</option>
                                <option value="vandalismo">Vandalismo</option>
                                <option value="otro">Otros</option>
                            </select>
                            <div class="input-group-append" id="otro_campo" style="display: none;">
                                <input type="text" class="form-control" id="otro_campo_input" name="otro_campo_input"
                                    placeholder="Detalles adicionales">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fecha">Fecha de la Incidencia <font color='red'>*</font></label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-6">
                            <label for="hora">Hora de la Incidencia <font color='red'>*</font></label>
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <label for="hora">Barrio de la Incidencia <font color='red'>*</font></label>
                                <input type="text" class="form-control" id="barrio" name="barrio" required>
                            </div>
                        </div>
                    </div>

                    <!-- Descripción de la Incidencia -->
                    <div class="form-group">
                        <label for="descripcion">Descripción de la Incidencia <font color='red'>*</font></label>
                        <textarea class="form-control valid validText" id="descripcion" name="descripcion" rows="4"
                            required></textarea>
                    </div>
                    <!-- Localización y Testigos -->
                    <div class="form-row">
                        <!-- Adjuntar archivos -->
                        <!-- <div class="form-group col-md-6">
                            <label for="adjuntos">Adjuntar archivos (si es necesario):</label>
                            <input type="file" class="form-control-file" id="adjuntos" name="adjuntos">

                        </div> -->
                        <div class="form-group col-md-6">
                            <!-- Botón para tomar la foto -->
                            <label id="tomarFoto" class="btn btn-primary custom-btn">Tomar Foto</label>

                            <!-- Elemento para mostrar la vista previa de la foto -->
                            <img id="fotoPreview" src="" alt="Vista Previa de la Foto"
                                style="display: none; max-width: 3000px; height: 150px;">

                            <!-- Input oculto para guardar la foto como archivo -->
                            <!-- <input type="file" id="fotoInput" name="fotoInput" accept="image/*" capture="camera" style="display: none;"> -->
                            <input type="file" class="form-control-file" id="fotoInput" name="fotoInput"
                                accept="image/*" capture="camera" style="display: none;">

                        </div>
                        <div class="form-group col-md-6">
                        <!-- Nivel de Urgencia -->

                        <label>Nivel de Urgencia <font color='red'>*</font></label><br>
                        <div class=" form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgencia" id="urgencia_bajo" value="bajo"
                                required>
                            <label class="form-check-label" for="urgencia_bajo">Bajo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgencia" id="urgencia_medio"
                                value="medio">
                            <label class="form-check-label" for="urgencia_medio">Medio</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgencia" id="urgencia_alto"
                                value="alto">
                            <label class="form-check-label" for="urgencia_alto">Alto</label>
                        </div>
                    </div>
            </div>

            <!-- Mapa interactivo -->
            <div class="form-group">
                <label for="mapa">Mi ubicación actual:</label>
                <div id="mapa" style="height: 300px;"></div>
                <input type="hidden" id="coordenadas" name="coordenadas" required>
                <input type="hidden" id="coordenadas1" name="coordenadas1" required>
            </div>
            <!-- Botones de Enviar y Cancelar -->
            <div class="form-group text-center idreport">
                <button type="submit" class="btn btn-primary custom-btn">Enviar reporte</button>
            </div>
            </form>
          <br>
        </div>
        <script>
        window.onload = function() {
            initMap('mapa-reporte');
        };
        document.addEventListener('DOMContentLoaded', function() {
            // Manejar el cambio en el campo de selección
            $("#tipo_incidencia").change(function() {
                // Obtener el valor seleccionado
                var selectedValue = $(this).val();

                // Ocultar/mostrar el campo de entrada adicional según la opción seleccionada
                if (selectedValue === "otro") {
                    $("#otro_campo").show();
                } else {
                    $("#otro_campo").hide();
                }
            });
        });
        </script>