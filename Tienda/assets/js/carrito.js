// Seleccionar los elementos del DOM
const btnAddDeseo = document.querySelectorAll('.btnAddDeseo');
const btnAddCarrito = document.querySelectorAll('.btnAddCarrito');
const btnDeseo = document.querySelector('#btnCantidadDeseo');
const btnCarrito = document.querySelector('#btnCantidadCarrito');
const verCarrito = document.querySelector('#verCarrito');
const tableListaCarrito = document.querySelector('#tableListaCarrito tbody');

// Crear una instancia del modal de Bootstrap
const myModal = new bootstrap.Modal(document.getElementById('myModal'));

let listaDeseo, listaCarrito;
// Evento que se dispara cuando el DOM está cargado
document.addEventListener('DOMContentLoaded', function() {
    // Comprobar si existen listas en el almacenamiento local y cargarlas
    if (localStorage.getItem('listaDeseo') != null) {
        listaDeseo = JSON.parse(localStorage.getItem('listaDeseo'));
    }
    if (localStorage.getItem('listaCarrito') != null) {
        listaCarrito = JSON.parse(localStorage.getItem('listaCarrito'));
    } 
    // Agregar event listeners a los botones de "Agregar a la lista de deseos"
    for (let i = 0; i < btnAddDeseo.length; i++){
        btnAddDeseo[i].addEventListener('click', function(){
            let idProducto = btnAddDeseo[i].getAttribute('prod');
            agregarDeseo(idProducto);
        })
    }
    // Agregar event listeners a los botones de "Agregar al carrito"
    for (let i = 0; i < btnAddCarrito.length; i++) {
        btnAddCarrito[i].addEventListener('click', function(){
            let idProducto = btnAddCarrito[i].getAttribute('prod');
            agregarCarrito(idProducto, 1);
        })   
    }
    // Actualizar la cantidad de productos en la lista de deseos y en el carrito
    cantidadDeseo();
    cantidadCarrito();

    // Agregar event listener al botón de "Ver carrito"
    verCarrito.addEventListener('click', function(){
        // Obtener la lista de productos en el carrito y mostrar el modal
        getListaCarrito();
        myModal.show();
    })
});

// Función para agregar un producto a la lista de deseos
function agregarDeseo(idProducto){
    if (localStorage.getItem('listaDeseo') == null) {
        listaDeseo = [];
    } else {
        let listaExiste = JSON.parse(localStorage.getItem('listaDeseo'));
        for (let i = 0; i < listaExiste.length; i++){
            // Comprobar si el producto ya está en la lista de deseos
            if (listaExiste[i]['idProducto'] == idProducto) {
                alertaPersonalizada("El producto ya esta agregado", "warning");
                return;
            }
        }
        // Concatenar la lista de deseos existente con la lista almacenada en el localStorage
        listaDeseo.concat(localStorage.getItem('listaDeseo'));
    }
    // Agregar el producto a la lista de deseos
    listaDeseo.push({
        "idProducto": idProducto,
        "cantidad": 1
    })
    // Guardar la lista de deseos en el almacenamiento local
    localStorage.setItem('listaDeseo', JSON.stringify(listaDeseo));
    // Mostrar una alerta de éxito y actualizar la cantidad de productos en la lista de deseos
    alertaPersonalizada("Producto agregado con exito", "success");
    cantidadDeseo();
}

// Función para mostrar la cantidad de productos en la lista de deseos
function cantidadDeseo(){
    let listas = JSON.parse(localStorage.getItem('listaDeseo'));
    if (listas != null){
        btnDeseo.textContent = listas.length;
    } else {
        btnDeseo.textContent = 0;
    }
}

// Función para agregar un producto al carrito
function agregarCarrito(idProducto, cantidad, accion = false){
    if (localStorage.getItem('listaCarrito') == null) {
        listaCarrito = [];
    } else {
        let listaExiste = JSON.parse(localStorage.getItem('listaCarrito'));
        for (let i = 0; i < listaExiste.length; i++){
            if (accion) {
                eliminarListaDeseo(idProducto);
            }
            if (listaExiste[i]['idProducto'] == idProducto) {
                alertaPersonalizada("El producto ya esta agregado", "warning");
                return;
            }
        }
        listaCarrito.concat(localStorage.getItem('listaCarrito'));
    }
    // Agregar el producto al carrito
    listaCarrito.push({
        "idProducto": idProducto,
        "cantidad": cantidad,
    })
    // Guardar la lista de productos en el carrito en el almacenamiento local
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));
    // Mostrar una alerta de éxito y actualizar la cantidad de productos en el carrito
    alertaPersonalizada("Producto agregado al carrito", "success");
    cantidadCarrito();
}

// Función para mostrar la cantidad de productos en el carrito  
function cantidadCarrito(){
    let listas = JSON.parse(localStorage.getItem('listaCarrito'));
    if (listas != null){
        btnCarrito.textContent = listas.length;
    } else {
        btnCarrito.textContent = 0;
    }
}

// Función para obtener la lista de productos en el carrito
function getListaCarrito(){
    const url = base_url + 'principal/listaProductos';
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(JSON.stringify(listaCarrito));
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let html = '';
            res.productos.forEach(producto => {
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
                        ${producto.subTotal }
                    </td>
                    <td>                       
                        <button class="btn btn-warning btnDeleteCart" type="button" prod="${producto.id}"><i class="fas fa-times-circle"></i></button>
                    </td>
                </tr>
                `; 
            });
            // Insertar las filas de la tabla en el elemento correspondiente
            tableListaCarrito.innerHTML = html;
            document.querySelector('#totalGeneral').textContent = res.total;
            // Agregar event listeners a los botones de eliminación de productos del carrito
            btnEliminarCarrito();
        }
    }
}

// Función para agregar event listeners a los botones de eliminación de productos del carrito
function btnEliminarCarrito(){
    let listaEliminar = document.querySelectorAll('.btnDeleteCart');
    for (let i = 0; i < listaEliminar.length; i++) {
        listaEliminar[i].addEventListener('click', function(){
            let idProducto = listaEliminar[i].getAttribute('prod');
            eliminarListaCarrito(idProducto); 
        })
    }   
}

// Función para eliminar un producto del carrito
function eliminarListaCarrito(idProducto){
    for (let i = 0; i < listaCarrito.length; i++) {
        if (listaCarrito[i]['idProducto'] == idProducto) {
            listaCarrito.splice(i, 1);
        }
    }
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));
    getListaCarrito();
    cantidadCarrito();
    alertaPersonalizada("Producto eliminado del carrito", "success");
}



