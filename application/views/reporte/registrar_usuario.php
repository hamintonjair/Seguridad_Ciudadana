<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div style="background-color:#f0f0f0;" id="vista-alertas" class="col-md-6">
            <br>
                <h4 style="background-color:#226f7e; color:aliceblue; text-align: center;">Registrar nuevo usuario</h4>

                <div class="card" style="background-color:#226f7e; color:aliceblue;">
                    <div class="card-body">
                        <font color="yellow">Nota: "Los usuarios registrados tendrán un perfil de operador."</font>

                        <form enctype="multipart/form-data" id="frmRegistro">
                            <div class="form-group">
                                <label for="nombre">Nombres y Apellidos</label>
                                <input type="text" class="form-control valid validText" id="nombre" placeholder="Ingrese su nombre y apellidos">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" class="form-control valid validEmail" id="correo" placeholder="Ingrese su correo">
                            </div>
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input type="password" class="form-control" id="clave" placeholder="Ingrese su contraseña">
                            </div>
                            <button type="button" onclick="registrarUsuario();" class="btn btn-primary">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
