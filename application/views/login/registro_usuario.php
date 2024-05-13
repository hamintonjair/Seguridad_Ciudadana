<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_login.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.css">

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Registro de usuario</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" >
                            <div class="form-group">
                                <label for="nombre">Nombres y Apellodos</label>
                                <input type="text" class="form-control valid validText" id="nombre" placeholder="Ingrese su nombre y apellidos">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" class="form-control valid validEmail" id="correo" placeholder="Ingrese su correo">
                            </div>
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input type="password" class="form-control" id="clave"
                                    placeholder="Ingrese su contraseña">
                            </div>
                            <button type="button" onclick="registrarUsuario();" class="btn btn-primary">Registrarse</button>
                        </form>
                        <p>¿Ya tienes una cuenta? <a href="<?php echo base_url(); ?>login">Inicia Sesión</a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registrar_usuario.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/functions_admin.js"></script>


</html>