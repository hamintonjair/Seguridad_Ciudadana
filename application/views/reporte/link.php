<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div style="background-color:#f0f0f0;" id="vista-alertas" style="text-align: center;" class="col-md-6">
            <br>
                <h4 style="background-color:#226f7e; color:aliceblue">Registrar link videos de youtube</h4>

                <div class="card" style="background-color:#226f7e; color:aliceblue;">
                    <!-- <div class="card-header" style="background-color:#226f7e; color:aliceblue; text-align: center;" >Registro de lineas de emergencias</div> -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <font color="yellow">Nota: "En este campo vas a guardar la clave que te genera el video
                                cargado en YouTube, de la URL vas a tomar la parte que resalta."</font>
                        </div>
                        <div class="col-md-12">
                            <img src="<?php echo base_url('assets/img/link.png') ?>" alt="Link Image"
                                style="width: 100%; max-height: 200px;">
                        </div>
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="liken">Nota</label>
                                <input type="text" class="form-control" id="liken" name="liken"
                                    placeholder="Ingrese la clave del video de youtube">
                            </div>
                            <button type="button" onclick="registrarLink();" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>