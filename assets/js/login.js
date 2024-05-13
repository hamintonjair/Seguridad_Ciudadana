//login
function insertar() {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    const correo = document.querySelector('#correo').value;
    const clave = document.querySelector('#clave').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'login/iniciar_session',
        dataType: "json",
        data: {
            correo: correo,
            clave: clave
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
                setTimeout(function() {

                    if (response.rol == "admin") {
                        window.location.href = base_url + 'ver/alert';
                    } else {
                        window.location.href = base_url;
                    }
                }, 2000);

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
}
document.addEventListener('DOMContentLoaded', function() {


});