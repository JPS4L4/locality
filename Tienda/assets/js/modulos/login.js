// Obtener elementos del formulario
const frm = document.querySelector('#formulario');
const email = document.querySelector('#email');
const clave = document.querySelector('#clave');

// Evento que se ejecuta cuando el DOM ha sido cargado
document.addEventListener('DOMContentLoaded', function() {

    // Evento para el envío del formulario
    frm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Validar que los campos no estén vacíos
        if (email.value == '' || clave.value == '') {
            alertas('Todos los campos son requeridos', 'warning');
        } else {
            let data = new FormData(this);
            const url = base_url + "admin/validar";
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        // Redireccionar a la página de inicio del administrador después de un segundo
                        setTimeout(() => {
                            window.location = base_url + 'admin/home';
                        }, 1000)
                    }
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
});

// Función para mostrar alertas
function alertas(msg, icono) {
    Swal.fire(
        'Aviso?',
        msg.toUpperCase(),
        icono
    )
}