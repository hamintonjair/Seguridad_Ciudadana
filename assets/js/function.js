//funciones para el mapa
document.addEventListener('DOMContentLoaded', function() {
    initMap();
});

function initMap(containerId) {

    if (containerId == 'mapa-reporte') {
        let latitud;
        let longitud;
        let map = new google.maps.Map(document.getElementById('mapa'), {
            center: { lat: 0, lng: 0 }, // Las coordenadas iniciales pueden ser cualquier valor
            zoom: 14, // Establece el nivel de zoom deseado
        });

        let marker = new google.maps.Marker({
            map: map,
            draggable: true, // Permite arrastrar el marcador
        });

        // Escucha el evento de arrastre del marcador para obtener las coordenadas
        google.maps.event.addListener(marker, 'dragend', function(event) {
            let latLng = event.latLng;
            latitud = latLng.lat();
            longitud = latLng.lng();
            document.getElementById('coordenadas').value = latitud;
            document.getElementById('coordenadas1').value = longitud;
        });

        // Obtiene la ubicación del usuario usando la geolocalización
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                let userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                latitud = userLocation.lat;
                longitud = userLocation.lng;

                map.setCenter(userLocation); // Centra el mapa en la ubicación del usuario
                marker.setPosition(userLocation); // Coloca el marcador en la ubicación del usuario
                document.getElementById('coordenadas').value = latitud;
                document.getElementById('coordenadas1').value = longitud;
            });
        }


        // Agrega un evento al botón "Obtener Ubicación Actual"
        document.getElementById('obtener-ubicacion').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    latitud = userLocation.lat;
                    longitud = userLocation.lng;

                    map.setCenter(userLocation); // Centra el mapa en la ubicación del usuario
                    marker.setPosition(userLocation); // Coloca el marcador en la ubicación del usuario
                    document.getElementById('coordenadas').value = latitud;
                    document.getElementById('coordenadas1').value = longitud;
                });
            }
        });
    } else if (containerId == "mapa-incidencias") {


        let map;
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 0, lng: 0 }, // Centrar inicialmente en coordenadas neutras
            zoom: 14,
        });
        // Verifica si el navegador admite la geolocalización
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitud = position.coords.latitude;
                const longitud = position.coords.longitude;

                // Centra el mapa en la ubicación actual del usuario
                map.setCenter({ lat: latitud, lng: longitud });

                // Realiza una solicitud AJAX para obtener las incidencias
                const base_url = 'http://localhost/Seguridad_Ciudadana/';
                $.ajax({
                    url: base_url + 'panel/getIncidencia', // URL del servidor que proporciona los datos
                    dataType: 'json',
                    success: function(data) {
                        // Itera sobre los datos de incidencias y crea marcadores en el mapa
                        // Itera sobre los datos de incidencias y crea marcadores en el mapa
                        for (let i = 0; i < data['alertas'].length; i++) {
                            let incidencia = data['alertas'][i];

                            let marker = new google.maps.Marker({
                                position: { lat: parseFloat(incidencia.latitud), lng: parseFloat(incidencia.longitud) },
                                map: map,
                                title: incidencia.tipo_incidencia,
                            });

                            // Define una función de cierre para crear el infowindow y vincularlo al marcador
                            (function(incidencia, marker) {
                                let infowindowContent = "<div style='max-width: 200px;'>"; // Establece la altura máxima y el desplazamiento vertical
                                infowindowContent += "<strong>Tipo: de incidencia:</strong> " + incidencia.tipo_incidencia + "<br>";
                                infowindowContent += "<strong>Descripción:</strong> " + incidencia.descripcion + "<br>";
                                infowindowContent += "<strong>Nivel de urgencia:</strong> " + incidencia.nivel_urgencia + "<br>";
                                infowindowContent += "<strong>Fecha:</strong> " + incidencia.fecha + "<br>";
                                infowindowContent += "<strong>Hora:</strong> " + incidencia.hora + "<br>";
                                infowindowContent += "<strong>Barrio:</strong> " + incidencia.barrio + "<br>";
                                infowindowContent += '<img src="' + base_url + "uploads/" + incidencia.imagen + '" alt="Imagen de la incidencia" width="200">';
                                infowindowContent += "</div>";

                                let infowindow = new google.maps.InfoWindow({
                                    content: infowindowContent,
                                });


                                // Agrega un evento de clic para abrir el infowindow
                                marker.addListener('click', function() {
                                    infowindow.open(map, marker);
                                });
                            })(incidencia, marker); // Llama a la función de cierre con los valores adecuados
                        }

                    },
                    error: function() {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Error al cargar las incidencias desde el servidor.',
                            showConfirmButton: false,
                            timer: 2200
                        })

                    }
                });
            });

            // Agrega un evento al botón "Obtener Ubicación Actual"
            document.getElementById('obtener-ubicacion').addEventListener('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        let userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        latitud = userLocation.lat;
                        longitud = userLocation.lng;

                        map.setCenter(userLocation); // Centra el mapa en la ubicación del usuario
                        marker.setPosition(userLocation); // Coloca el marcador en la ubicación del usuario
                        document.getElementById('coordenadas').value = latitud;
                        document.getElementById('coordenadas1').value = longitud;
                    });
                }
            });
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Tu navegador no admite la geolocalización.',
                showConfirmButton: false,
                timer: 2200
            })
        }
    }

}
//registrar incidencias
document.addEventListener('DOMContentLoaded', function() {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';
    let formIncidencias = document.querySelector("#formIncidencias");
    if (document.querySelector("#formIncidencias")) {
        formIncidencias.onsubmit = function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: base_url + 'panel/registrar_incidencia',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
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
                            location.reload();
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
    }

});
// miscript.js

document.addEventListener('DOMContentLoaded', function() {
    // Llama a la función de actualización cada 30 segundos (30000 milisegundos)
    setInterval(actualizarNumeroAlertas, 1000);
    // Otras funciones o lógica de JavaScript aquí
});

// Variable global para llevar el seguimiento de la cantidad de notificaciones
let cantidadNotificaciones = 0;

// Función para actualizar la visualización de la cantidad de notificaciones
function actualizarCantidadNotificaciones() {
    $('#cantidad-notificaciones').text(cantidadNotificaciones); // Actualiza la cantidad en un elemento HTML
}

// Inicializa la visualización de la cantidad de notificaciones al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    actualizarCantidadNotificaciones();
});

// Función para actualizar el número de alertas desde el servidor
function actualizarNumeroAlertas() {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    $.ajax({
        url: base_url + 'panel/obtenerNumeroAlertas', // Reemplaza con la URL correcta para obtener el número de alertas
        dataType: 'json',
        success: function(response) {

            // Calcula la cantidad de nuevas notificaciones
            const nuevasNotificaciones = response.numero_alertas - cantidadNotificaciones;

            // Si hay nuevas notificaciones, las muestra y las disminuye
            if (nuevasNotificaciones > 0) {
                $('#numero-alertas').text(response.numero_alertas);
            }
        },
        error: function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Error al obtener el número de alertas..',
                showConfirmButton: false,
                timer: 2200
            })
        }
    });
}
// finalizar alertas
function finalizarAlerta(alertaId) {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';
    $.ajax({
        url: base_url + 'panel/finalizarIncidencia', // Reemplaza con la URL correcta para obtener el número de alertas
        type: 'post',
        dataType: 'json',
        data: {
            alerta_id: alertaId,
            nuevo_estado: 'Finalizada' // Cambia el estado a "Finalizada"
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
                    window.location.href = base_url;
                }, 2000);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: response.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                setTimeout(function() {
                    window.location.href = base_url + 'ver/alert';
                }, 2000);
            }
        },
        error: function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Error de conexión al servidor.',
                showConfirmButton: false,
                timer: 2200
            })
        }
    });
}

//compartir alertas

function compartirUbicacion(latitud, longitud, nombreIncidencia) {
    if ('navigator' in window && 'share' in navigator) {
        const ubicacionURL = `https://www.google.com/maps?q=${latitud},${longitud}`;
        const textoCompartir = `Comparte la ubicación de la incidencia "${nombreIncidencia}"`;

        navigator.share({
            title: `Ubicación de "${nombreIncidencia}"`,
            text: textoCompartir,
            url: ubicacionURL,
        }).then(() => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Ubicación compartida con éxito',
                showConfirmButton: false,
                timer: 2200
            })
        }).catch((error) => {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Error al compartir la ubicación',
                showConfirmButton: false,
                timer: 2200
            })
        });
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'El navegador no admite la funcionalidad de compartir.',
            showConfirmButton: false,
            timer: 2200
        })
    }
}


//ocultar boton ubicacion actual
document.addEventListener('DOMContentLoaded', function() {
    // Verifica si estás en la vista de alertas
    const vistaAlertas = document.getElementById('vista-alertas');

    if (vistaAlertas) {
        // Estás en la vista de alertas, así que oculta el botón
        const obtenerUbicacion = document.getElementById('obtener-ubicacion');
        if (obtenerUbicacion) {
            obtenerUbicacion.style.display = 'none';
        }
    }
});
// listar incidencias creadas
document.addEventListener('DOMContentLoaded', function() {
    $('#tabla-incidencias').DataTable({
        "responsive": true,
        "columnDefs": [{
            "targets": 3, // Suponiendo que la columna del estado es la cuarta columna (el índice comienza desde 0)
            "render": function(data, type, row) {
                let btnClass = "btn btn-success btn-estado"; // Clase CSS para los botones

                if (data === "alto") {
                    btnClass = "btn btn-danger btn-estado";
                } else if (data === "medio") {
                    btnClass = "btn btn-warning btn-estado";
                }

                return '<button title="ver más" class="' + btnClass + '">' + data + '</button>';
            },
        }, ],
        "rowCallback": function(row, data, index) {
            $(row).find('td').css('text-align', 'left');
        }
    });
});
// listar incidencias cerradas y lineas de emergencias
document.addEventListener('DOMContentLoaded', function() {
    if ('#tabla-incidencias_cerrada') {
        $('#tabla-incidencias_cerrada').DataTable({
            "responsive": true,
            "columnDefs": [{
                "targets": 3, // Suponiendo que la columna del estado es la cuarta columna (el índice comienza desde 0)
                "render": function(data, type, row) {
                    let btnClass = "btn btn-success btn-estado"; // Clase CSS para los botones

                    if (data === "alto") {
                        btnClass = "btn btn-danger btn-estado";
                    } else if (data === "medio") {
                        btnClass = "btn btn-warning btn-estado";
                    }

                    return '<button title="ver más" class="' + btnClass + '">' + data + '</button>';
                },
            }, ],
            "rowCallback": function(row, data, index) {
                $(row).find('td').css('text-align', 'left');
            }
        });
    }

    // lineas de emergencias
    if ('#tabla-lineas') {
        $('#tabla-lineas').DataTable({
            "responsive": true,
            "columnDefs": [{
                "targets": 4, // Suponiendo que la columna del estado es la cuarta columna (el índice comienza desde 0)
                "render": function(data, type, row) {
                    let btnClass = "btn btn-danger"; // Clase CSS para los botones

                    return '<button title="Eliminar" class="' + btnClass + '">' + data + '</button>';
                },
            }, ],
            "rowCallback": function(row, data, index) {
                $(row).find('td').css('text-align', 'left');
            }
        });
    }
    // lineas de emergencias
    if ('#tabla-link') {
        $('#tabla-link').DataTable({
            "responsive": true,
            "columnDefs": [{
                "targets": 2, // Suponiendo que la columna del estado es la cuarta columna (el índice comienza desde 0)
                "render": function(data, type, row) {
                    let btnClass = "btn btn-danger"; // Clase CSS para los botones

                    return '<button title="Eliminar" class="' + btnClass + '">' + data + '</button>';
                },
            }, ],
            "rowCallback": function(row, data, index) {
                $(row).find('td').css('text-align', 'center');
            }
        });
    }
    // listar usuarios
    if ('#tabla-usuarios') {
        $('#tabla-usuarios').DataTable({
            "responsive": true,
            "columnDefs": [{
                "targets": 4, // Suponiendo que la columna del estado es la cuarta columna (el índice comienza desde 0)
                "render": function(data, type, row) {
                    let btnClass = "btn btn-danger"; // Clase CSS para los botones

                    return '<button title="Eliminar" class="' + btnClass + '">' + data + '</button>';
                },
            }, ],
            "rowCallback": function(row, data, index) {
                $(row).find('td').css('text-align', 'left');
            }
        });
    }

});

//editar nota
function editarIncidencia(id) {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    $.ajax({
        url: base_url + 'panel/editarIncidencia/' + id,
        type: "GET",
        dataType: "json",
        data: {
            id: id
        },
        success: function(resp) {
            $('#idIncidencia').val(resp[0].id);
            $('#notas').val(resp[0].nota);
            $('#modalAlerta').modal('show');
        }
    })
}
//registar avences d elas incidencias
function registrarAvances() {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    const idIncidencia = document.querySelector('#idIncidencia').value;
    const nota = document.querySelector('#notas').value;


    $.ajax({
        type: 'POST',
        url: base_url + 'panel/registrarAvances',
        dataType: "json",
        data: {
            id: idIncidencia,
            nota: nota,
        },
        success: function(dato) {
            $('#modalAlerta').modal('show');
            if (dato.ok == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                setTimeout(function() {
                    $('#modalAlerta').modal('hide');
                    location.reload();
                }, 2000);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                $('#modalAlerta').modal('hide');
            }

        }
    })
}
// ver detalles incidencias
function verMas(id) {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    $.ajax({
        url: base_url + 'panel/verMas/' + id,
        type: "GET",
        dataType: "json",
        data: {
            id: id
        },
        success: function(resp) {
            // Asigna los valores a las celdas del modal
            $('#celDescripcion').text(resp[0].descripcion);
            $('#celnota').text(resp[0].nota);
            $('#celfecha').text(resp[0].fecha);
            $('#celhora').text(resp[0].hora);
            if (resp[0].estado === 'En proceso') {
                $('#celestado').html('<span  class="badge badge-success">' + resp[0].estado + '</span>');
            } else {
                $('#celestado').html('<span  class="badge badge-danger">' + resp[0].estado + '</span>');
            }
            $('#celfecha_cierre').text(resp[0].fecha_finalizacion);
            $('#detalleIncidencia').modal('show');
        }
    });
}

// ver detalles incicdencias cerredas
function ver_Mas(id) {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    $.ajax({
        url: base_url + 'panel/ver_Mas/' + id,
        type: "GET",
        dataType: "json",
        data: {
            id: id
        },
        success: function(resp) {
            // Asigna los valores a las celdas del modal
            $('#celDescripcion').text(resp[0].descripcion);
            $('#celnota').text(resp[0].nota);
            $('#celfecha').text(resp[0].fecha);
            $('#celhora').text(resp[0].hora);
            $('#celestado').html('<span  class="badge badge-danger"">' + resp[0].estado + '</span>');
            $('#celfecha_cierre').text(resp[0].fecha_finalizacion);
            $('#detalleIncidencia_cerrada').modal('show');
        }
    });
}
// funcion para que abra la camara y tome la foto en el dspositivo movil
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('tomarFoto')) {
        const tomarFotoButton = document.getElementById('tomarFoto');
        const fotoInput = document.getElementById('fotoInput');
        const fotoPreview = document.getElementById('fotoPreview');

        // Función para tomar una foto
        tomarFotoButton.addEventListener('click', function() {
            fotoInput.click(); // Activa el input de archivo oculto para capturar la foto
        });

        // Cuando se selecciona una foto desde la cámara
        fotoInput.addEventListener('change', function() {
            const fotoFile = fotoInput.files[0];
            if (fotoFile) {
                const fotoURL = URL.createObjectURL(fotoFile);
                fotoPreview.src = fotoURL;
                fotoPreview.style.display = 'block';
            }
        });
    }

});
// control del menu desplagable
document.addEventListener('DOMContentLoaded', function() {
    // Agregar evento clic al botón para mostrar/ocultar el submenú
    $('#link').click(function(e) {
        e.preventDefault(); // Evita la navegación predeterminada
        $(this).siblings('ul').toggle(); // Muestra u oculta el submenú
    });
});
document.addEventListener('DOMContentLoaded', function() {
    let currentIndex = 0;
    let videos = $('.video-carousel iframe');
    let totalVideos = videos.length;

    // Ocultar todos los videos excepto el primero
    videos.hide();
    videos.eq(currentIndex).show();

    $('.btn-prev').click(function() {
        videos.eq(currentIndex).hide();
        currentIndex = (currentIndex - 1 + totalVideos) % totalVideos;
        videos.eq(currentIndex).show();
    });

    $('.btn-next').click(function() {
        videos.eq(currentIndex).hide();
        currentIndex = (currentIndex + 1) % totalVideos;
        videos.eq(currentIndex).show();
    });
});

//registrar lineas d eemergencias
function registrarLineas() {

    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    const entidad = document.querySelector('#entidad').value;
    const linea = document.querySelector('#linea').value;
    const nota = document.querySelector('#nota').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'panel/registrarLineas',
        dataType: "json",
        data: {
            entidad: entidad,
            linea: linea,
            nota: nota,
        },
        success: function(dato) {
            if (dato.ok == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
            }

        }
    })
}
//eliminar lineas
function EliminarLinea(id) {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';
    $.ajax({
        url: base_url + 'panel/Eliminar_linea/' + id,
        type: "GET",
        dataType: "json",
        data: {
            id: id
        },
        success: function(dato) {
            if (dato.ok == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
            }
        }
    });
}
//registrar link
function registrarLink() {

    const base_url = 'http://localhost/Seguridad_Ciudadana/';

    const link = document.querySelector('#link').value;
    $.ajax({
        type: 'POST',
        url: base_url + 'panel/set_link',
        dataType: "json",
        data: {
            link,
        },
        success: function(dato) {
            if (dato.ok == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
            }

        }
    })
}
//eliminar link
function EliminarLink(id) {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';
    $.ajax({
        url: base_url + 'panel/Eliminar_link/' + id,
        type: "GET",
        dataType: "json",
        data: {
            id: id
        },
        success: function(dato) {
            if (dato.ok == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
            }
        }
    });
}
// eliminar usuario
//eliminar link
function EliminarUsuario(id) {
    const base_url = 'http://localhost/Seguridad_Ciudadana/';
    $.ajax({
        url: base_url + 'panel/Eliminar_user/' + id,
        type: "GET",
        dataType: "json",
        data: {
            id: id
        },
        success: function(dato) {
            if (dato.ok == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: dato.post,
                    showConfirmButton: false,
                    timer: 2200
                })
            }
        }
    });
}
// animacion personaje policia y ladrón
document.addEventListener('DOMContentLoaded', function() {
    let vistaAlertas = $(".personaje policia");

    // Crear elementos de "policía" y "ladrón" y agregarlos a #vista-alertas
    for (let i = 1; i <= 5; i++) {
        let personaje = $("<div class='personaje'></div>");
        let tipo = i % 2 === 0 ? "policia" : "ladron"; // Alternar entre policía y ladrón
        personaje.addClass(tipo);
        vistaAlertas.append(personaje);
    }

    // Agregar animación a los personajes
    $(".personaje").each(function() {
        animatePersonaje($(this));
    });
});


function animatePersonaje(personaje) {
    let maxX = $(window).width() - 50;
    let duracion = Math.random() * 3000 + 4000;

    let startLeft = Math.random() * maxX;
    let endLeft = Math.random() * maxX;

    personaje.css("left", startLeft);

    personaje.animate({
            left: endLeft,
        },
        duracion,
        "linear",
        function() {
            animatePersonaje(personaje);
        }
    );
}
const policia = document.querySelector('.policia');
const ladron = document.querySelector('.ladron');
const contenedor = document.querySelector('.contenedor');

// Función para detectar colisión
function detectarColision() {
    const rectPolicia = policia.getBoundingClientRect();
    const rectLadron = ladron.getBoundingClientRect();

    if (
        rectPolicia.left < rectLadron.right &&
        rectPolicia.right > rectLadron.left &&
        rectPolicia.top < rectLadron.bottom &&
        rectPolicia.bottom > rectLadron.top
    ) {
        // Colisión detectada, oculta al ladrón
        ladron.style.opacity = '0';
    }
}

// Evento de movimiento del policía (puedes ajustar esto según tus necesidades)
policia.addEventListener('mousemove', (event) => {
    const x = event.clientX - contenedor.getBoundingClientRect().left;
    const y = event.clientY - contenedor.getBoundingClientRect().top;
    policia.style.transform = `translate(${x}px, ${y}px)`;
    detectarColision();
});