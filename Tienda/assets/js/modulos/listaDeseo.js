// Obtener elementos de la tabla de la lista de deseos
const tableLista = document.querySelector('#tableListaDeseo tbody');

// Evento que se ejecuta cuando el DOM ha sido cargado  
document.addEventListener('DOMContentLoaded', function() {
    getListaDeseo()
});

// Función para obtener la lista de deseos  
function getListaDeseo(){
    const url = base_url + 'principal/listaProductos';
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(JSON.stringify(listaDeseo));
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let html = '';
            res.productos.forEach(producto => {
                // Generar filas de la tabla con los datos de los productos
                html += `
                <tr>
                    <td>
                        <img class="img-thumbail" src="${base_url + producto.imagen}" alt="" width="140">
                    </td>
                    <td>${producto.nombre}</td>
                    <td>
                        <span class="badge bg-primary">${res.moneda + ' ' + producto.precio}</span>
                    </td>
                    <td>
                        <span class="badge bg-primary">${producto.cantidad}</span>
                    </td>
                    <td>
                        <button class="btn btn-danger btnEliminarDeseo" type="button" prod="${producto.id}"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-primary btnAddCart" type="button" prod="${producto.id}"><i class="fas fa-cart-plus"></i></button>
                    </td>
                </tr>
                `; 
            });
            tableLista.innerHTML = html; // Insertar las filas en la tabla
            btnEliminarDeseo();
            btnAgregarProducto();
        }
    }
}

// Función para configurar eventos de los botones de eliminar deseos
function btnEliminarDeseo(){
    let listaEliminar = document.querySelectorAll('.btnEliminarDeseo');
    for (let i = 0; i < listaEliminar.length; i++) {
        listaEliminar[i].addEventListener('click', function(){
            let idProducto = listaEliminar[i].getAttribute('prod');
            eliminarListaDeseo(idProducto); 
        })
    }   
}

// Función para eliminar un producto de la lista de deseos
function eliminarListaDeseo(idProducto){
    for (let i = 0; i < listaDeseo.length; i++) {
        if (listaDeseo[i]['idProducto'] == idProducto) {
            listaDeseo.splice(i, 1); // Eliminar el producto de la lista de deseos
        }
    }
    localStorage.setItem('listaDeseo', JSON.stringify(listaDeseo));
    getListaDeseo();
    cantidadDeseo();
    //alertaPersonalizada("Producto eliminado de la lista", "success");
}

// Función para configurar eventos de los botones de agregar productos al carrito
function btnAgregarProducto(){
    let listaAgregar = document.querySelectorAll('.btnAddCart');
    for (let i = 0; i < listaAgregar.length; i++) {
        listaAgregar[i].addEventListener('click', function(){
            let idProducto = listaAgregar[i].getAttribute('prod');
            agregarCarrito(idProducto, 1, true); // Agregar el producto al carrito
        })
    }   
}

// Función para mostrar una alerta personalizada
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