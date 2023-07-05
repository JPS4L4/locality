// Obtener elementos del formulario y del modal
const nuevo = document.querySelector('#nuevo_registro');
const frm = document.querySelector('#frmRegistro');
const titleModal = document.querySelector('#titleModal');
const btnAccion = document.querySelector('#btnAccion');
const myModal = new bootstrap.Modal(document.getElementById('nuevoModal'));
let tblComprador;

// Evento que se ejecuta cuando el DOM ha sido cargado
document.addEventListener('DOMContentLoaded', function () {
    tblComprador = $('#tblComprador').DataTable({
    ajax: {
      url: base_url + 'compradores/listar',
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'nombre' },
      { data: 'correo' },
      { data: 'clave'},
      { data: 'accion' }
    ],
    language,
    dom,
    buttons
  });

  // Evento para agregar un nuevo cliente
  nuevo.addEventListener('click', function () {
    document.querySelector('#id').value = ''; 
    titleModal.textContent = 'NUEVO CLIENTE';
    btnAccion.textContent = 'Registrar';
    frm.reset();
    document.querySelector('#correo').removeAttribute('readonly');
    myModal.show();
  })

  // Evento para enviar el formulario de registro
  frm.addEventListener('submit', function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "compradores/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText); 
        const res = JSON.parse(this.responseText);
        if (res.icono == 'success') {
          myModal.hide();
          tblComprador.ajax.reload();
        }
        Swal.fire('Aviso', res.msg.toUpperCase(), res.icono);
      }
    };
  });
});

// Función para eliminar un cliente
function eliminarCliente(idCliente) {
  Swal.fire({
    title: 'Estas seguro?',
    text: "Quiere eliminar este registro!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Si, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "compradores/delete/" + idCliente;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == 'success') {
            tblComprador.ajax.reload();
          }
          Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
        }
      }
    }
  });
}

// Función para editar un cliente
function editarCliente(idCliente) {
    const url = base_url + "compradores/edit/" + idCliente;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#id').value = res.id;
            document.querySelector('#nombre').value = res.nombre;
            document.querySelector('#correo').value = res.correo;
            document.querySelector('#clave').value = res.clave;
            //document.querySelector('#clave').setAttribute('readonly', 'readonly');
            btnAccion.textContent = 'Actualizar';
            titleModal.textContent = 'MODIFICAR CLIENTE';
            myModal.show();
        }
    }
}
