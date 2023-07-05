// Declaración de variables
let tblPendientes, tblFinalizados, tblProceso;

// Creación de instancia de modal
const myModal = new bootstrap.Modal(document.getElementById('modalPedidos'));

// Evento que se ejecuta cuando el DOM ha sido cargado
document.addEventListener('DOMContentLoaded', function () {
    // Inicialización de la tabla de pedidos pendientes
    tblPendientes = $('#tblPendientes').DataTable({
        ajax: {
            url: base_url + 'pedidos/listarPedidos',
            dataSrc: ''
        },
        columns: [
            { data: 'id_transaccion' },
            { data: 'monto' },
            { data: 'estado' },
            { data: 'fecha' },
            { data: 'email' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'direccion' },
            { data: 'accion' }
        ],
        language,
        dom,
        buttons
    });

    // Inicialización de la tabla de pedidos en proceso
    tblProceso = $('#tblProceso').DataTable({
        ajax: {
            url: base_url + 'pedidos/listarProceso',
            dataSrc: ''
        },
        columns: [
            { data: 'id_transaccion' },
            { data: 'monto' },
            { data: 'estado' },
            { data: 'fecha' },
            { data: 'email' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'direccion' },
            { data: 'accion' }
        ],
        language,
        dom,
        buttons
    });

    // Inicialización de la tabla de pedidos finalizados
    tblFinalizados = $('#tblFinalizados').DataTable({
        ajax: {
            url: base_url + 'pedidos/listarFinalizados',
            dataSrc: ''
        },
        columns: [
            { data: 'id_transaccion' },
            { data: 'monto' },
            { data: 'estado' },
            { data: 'fecha' },
            { data: 'email' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'direccion' }
        ],
        language,
        dom,
        buttons
    });
});

// Función para cambiar el estado de un pedido
function cambiarProceso(idPedido, proceso) {
    Swal.fire({
        title: 'Estas seguro',
        text: "De cambiar el estado del pedido?", // Mensaje de confirmación
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Si, cambiar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "pedidos/update/" + idPedido + "/" + proceso;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        // Recargar las tablas de los pedidos
                        tblPendientes.ajax.reload();
                        tblProceso.ajax.reload();
                        tblFinalizados.ajax.reload();
                    }
                    Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
                }
            };
        }
    });
}

/* function verPedido(idPedido) {
    const url = base_url + "clientes/verPedido/" + idPedido;
    const http = new XMLHttpRequest();
    http.open('GET', url, true);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            if (res.pedido.proceso == 1) {
              listarPendientes.classList.add('services-icon-wap');
            } else if(res.pedido.proceso == 2){
              estadoProceso.classList.add('services-icon-wap');
            } else {
              estadoCompletado.classList.add('services-icon-wap');
            }
            res.productos.forEach(row => {
              let subTotal = parseFloat(row.precio) * parseInt(row.cantidad);
                html += `
                <tr>
                    <td>${row.producto}</td>
                    <td>
                        <span class="badge bg-primary">${res.moneda + ' ' + row.precio}</span>
                    </td>
                    <td>
                        <span class="badge bg-primary">${row.cantidad}</span>
                    </td>
                    <td>
                        ${subTotal.toFixed(2)}
                    </td>
                </tr>
                `; 
            });
            document.querySelector('#tablePedidos tbody').innerHTML = html;
            myModal.show(); 
        }
    }
} */
