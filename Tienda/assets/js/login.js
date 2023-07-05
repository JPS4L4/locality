// Selección de elementos del DOM
const btnRegister = document.querySelector('#btnRegister');
const btnLogin = document.querySelector('#btnLogin');
const frmLogin = document.querySelector('#frmLogin');
const frmRegister = document.querySelector('#frmRegister');
const registrarse = document.querySelector('#registrarse');
const login = document.querySelector('#login'); 

const nombreRegistro = document.querySelector('#nombreRegistro');
const correoRegistro = document.querySelector('#correoRegistro');
const claveRegistro = document.querySelector('#claveRegistro');

const correoLogin = document.querySelector('#correoLogin');
const claveLogin = document.querySelector('#claveLogin');

//const btnModalLogin = document.querySelector('#btnModalLogin'); id="btnModalLogin"

const modalLogin = new bootstrap.Modal(document.getElementById('modalLogin'));

const inputBusqueda = document.querySelector('#inputModalSearch');

// Evento DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    // Evento clic en btnRegister
    btnRegister.addEventListener('click', function() {
        frmLogin.classList.add('d-none');
        frmRegister.classList.remove('d-none');
    })
    // Evento clic en btnLogin
    btnLogin.addEventListener('click', function() {
        frmRegister.classList.add('d-none');
        frmLogin.classList.remove('d-none');
    })
    // Evento clic en registrarse
    registrarse.addEventListener('click', function() {
        if (nombreRegistro.value == '' || correoRegistro.value == '' || claveRegistro.value == '') {
            alertaPersonalizada("Todos los campos son requeridos", "warning");
            return;
        } else {
            let formData = new FormData();
        formData.append('nombre', nombreRegistro.value);
        formData.append('correo', correoRegistro.value);
        formData.append('clave', claveRegistro.value);

        const url = base_url + 'clientes/registroDirecto';
        const http = new XMLHttpRequest();
        http.open('POST', url, true);
        http.send(formData);
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            alertaPersonalizada(res.msg, res.icono);
            if (res.icono == 'success') {
                setTimeout(() => {
                    enviarCorreo(correoRegistro.value, res.token);
                }, 500);
            }
          }
        }  
        }
    });

    // Evento clic en login
    login.addEventListener('click', function() {
        if (correoLogin.value == '' || claveLogin.value == '') {
            alertaPersonalizada("Todos los campos son requeridos", "warning");
            return;
        } else {
            let formData = new FormData();
        formData.append('correoLogin', correoLogin.value);
        formData.append('claveLogin', claveLogin.value);

        const url = base_url + 'clientes/loginDirecto';
        const http = new XMLHttpRequest();
        http.open('POST', url, true);
        http.send(formData);
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            alertaPersonalizada(res.msg, res.icono);
            if (res.icono == 'success') {
                setTimeout(() => {
                    window.location.reload();  
                }, 1000);
            }
          }
            }  
        }
    });

    // Evento de teclado en inputBusqueda
    inputBusqueda.addEventListener('keyup', function(e) { 
        const url = base_url + 'principal/busqueda/' + e.target.value;
        const http = new XMLHttpRequest();
        http.open('GET', url, true);
        http.send();
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let html = '';
                res.forEach(producto => {
                    const media = producto.media_calificacion;
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= media) {
                            starsHtml += '<i class="text-warning fas fa-star"></i>';
                        } else {
                            starsHtml += '<i class="text-muted fas fa-star"></i>';
                        }
                    }
    
                    html += `
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card h-100">
                            <a href="${base_url + 'principal/detail/' + producto.id}">
                                <img src="${base_url + producto.imagen}" class="card-img-top" alt="${producto.nombre}">
                            </a>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>${starsHtml}</li>
                                    <li class="text-muted text-right">${producto.precio}</li>
                                </ul>
                                <a href="${base_url + 'principal/detail/' + producto.id}" class="h2 text-decoration-none text-dark">${producto.nombre}</a>
                                <p class="card-text">
                                    ${producto.descripcion}
                                </p>
                            </div>
                        </div>
                    </div>
                    `;
                });
    
                document.querySelector('#resultBusqueda').innerHTML = html;
            }
        };
    });


});

function enviarCorreo(correo, token){
        let formData = new FormData();
        formData.append('token', token);
        formData.append('correo', correo);

        const url = base_url + 'clientes/enviarCorreo';
        const http = new XMLHttpRequest();
        http.open('POST', url, true);
        http.send(formData);
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            alertaPersonalizada(res.msg, res.icono);
            if (res.icono == 'success') {
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            }
          }
        }  
}

function abrirModalLogin(){
    myModal.hide();
    modalLogin.show();
}

function alertaPersonalizada(mensaje, type, titulo = ''){
    toastr[type](mensaje, titulo)

    toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
}