<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div style="background-color:#f0f0f0; border-radius:30px; " id="vista-alertas"  class="col-md-9">
            <br>
                <h4 style="color:black; text-align: center;">Registro de lineas de emergencias</h4>
  
                <div class="card" style="background-color:#f0f0f0;color:aliceblue;">
                    <!-- <div class="card-header" style="background-color:#226f7e; color:aliceblue; text-align: center;" >Registro de lineas de emergencias</div> -->
                    <div class="card-body">
                        <font color="blue">Nota: "Las líneas de emergencias son aquellas donde la ciudadanía pueda
                            comunicarse si lo desean
                            y reportar el incidente de acuerdo al caso."</font>

                        <form enctype="multipart/form-data" id="frmRegistro">
                            <div class="form-group">
                                <label for="entidad">Entidad</label>
                                <input type="text" class="form-control valid validText" id="entidad" name="entidad"
                                    placeholder="Ingrese la entidad">
                            </div>
                            <div class="form-group">
                                <label for="nota">Línea</label>
                                <input type="numeric" class="form-control valid validNumber" id="linea" name="linea"
                                    placeholder="Ingrese la línea">
                            </div>
                            <div class="form-group">
                                <label for="nota">Nota</label>
                                <textarea id="nota" name="nota" rows="5" cols="60"
                                    placeholder="Ingrese una descripción para que es la línea"></textarea>
                            </div>
                            <button type="button" onclick="registrarLineas();" class="btn btn-primary">Aceptar</button>
                        </form>
                    </div>
                </div>
            </div>
