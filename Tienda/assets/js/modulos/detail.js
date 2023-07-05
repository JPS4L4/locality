// Obtener elementos del formulario
const btnAddCart = document.querySelector('#btnAddCart');
const cantidad = document.querySelector('#product-quanity');
const idProducto = document.querySelector('#idProducto');

// Evento que se ejecuta cuando el DOM ha sido cargado
document.addEventListener('DOMContentLoaded', function() {
    btnAddCart.addEventListener('click', function() {
        agregarCarrito(idProducto.value, cantidad.value); // Llamar a la función agregarCarrito con los valores del producto y la cantidad seleccionada
    });
});