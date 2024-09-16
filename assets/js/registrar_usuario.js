//registrar usuario
function registrarUsuario() {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    const nombre = document.querySelector('#nombre').value;
    const correo = document.querySelector('#correo').value;
    const clave = document.querySelector('#clave').value;

    $.ajax({
        type: 'post',
        url: base_url + 'panel/registrar_usuario',
        dataType: 'json',
        data: {
            'nombre': nombre,
            'correo': correo,
            'clave': clave
        },

        success: function(response) {
            if (response.ok == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    setTimeout(function() {
                        window.location.href = base_url + "login";
                    }, 2000);
                }

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: response.post,
                    showConfirmButton: false,
                    timer: 2200
                })

            }
        }

    });
};
