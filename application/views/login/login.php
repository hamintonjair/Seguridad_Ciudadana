<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_login.css">
    <link rel = "stylesheet"  href="<?php echo base_url();?>assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Seguridad ciudadana - Iniciar Sesión</div>
                    <div class="card-body">
                        <form >
                            <div class="form-group">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" class="form-control valid validEmail" id="correo" name="correo" placeholder="Ingrese su correo">
                            </div>
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input type="password" class="form-control " id="clave" nameid="clave"
                                    placeholder="Ingrese su contraseña">
                            </div>
                            <button type="button" onclick="insertar();" class="btn btn-primary">Iniciar Sesión</button>
                        </form>
                        <p>¿No tienes una cuenta? <a
                                href="<?php echo base_url(); ?>registro-nuevo-usuario">Regístrate</a></p>
                                <p>Volver <a
                                href="<?php echo base_url(); ?>">Principal</a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/functions_admin.js"></script>


</html>