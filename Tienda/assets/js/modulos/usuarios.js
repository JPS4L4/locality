// Seleccionar elementos del DOM
const nuevo = document.querySelector('#nuevo_registro');
const frm = document.querySelector('#frmRegistro');
const titleModal = document.querySelector('#titleModal');
const btnAccion = document.querySelector('#btnAccion');
const myModal = new bootstrap.Modal(document.getElementById('nuevoModal'));
let tblUsuario;

// Evento que se ejecuta cuando el DOM se ha cargado
document.addEventListener('DOMContentLoaded', function () {
  tblUsuario = $('#tblUsuarios').DataTable({
    ajax: {
      url: base_url + 'usuarios/listar',
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'nombres' },
      { data: 'apellidos' },
      { data: 'correo' },
      { data: 'accion' }
    ],
    language,
    dom,
    buttons
  });

  // Evento click en el botón "Nuevo"
  nuevo.addEventListener('click', function () {
    // Restablecer los valores del formulario y mostrar el modal
    document.querySelector('#id').value = ''; 
    titleModal.textContent = 'NUEVO USUARIO';
    btnAccion.textContent = 'Registrar';
    frm.reset();
    document.querySelector('#clave').removeAttribute('readonly');
    document.querySelector('#correo').removeAttribute('readonly');
    myModal.show();
  })

  // Evento submit del formulario
  frm.addEventListener('submit', function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "usuarios/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText); 
        const res = JSON.parse(this.responseText);
        if (res.icono == 'success') {
          myModal.hide();
          tblUsuario.ajax.reload();
        }
        Swal.fire('Aviso?', res.msg.toUpperCase(), res.icono);
      }
    };
  });
});

// Función para eliminar un usuario
function eliminarUser(idUser) {
  // Mostrar confirmación de eliminación
  Swal.fire({
    title: 'Estas seguro?',
    text: "Quiere eliminar este registro!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Si, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "usuarios/delete/" + idUser;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == 'success') {
            tblUsuario.ajax.reload();
          }
          Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
        }
      }
    }
  });
}

// Función para editar un usuario
function editUser(idUser) {
  const url = base_url + "usuarios/edit/" + idUser;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        // Rellenar los campos del formulario con los datos del usuario
        document.querySelector('#id').value = res.id;   
        document.querySelector('#nombre').value = res.nombres;   
        document.querySelector('#apellido').value = res.apellidos;   
        document.querySelector('#correo').value = res.correo;
        document.querySelector('#clave').value = res.clave;
        document.querySelector('#clave').setAttribute('readonly', 'readonly');
        document.querySelector('#correo').setAttribute('readonly', 'readonly');
        btnAccion.textContent = 'Actualizar';
        titleModal.textContent = 'MODIFICAR USUARIO';
        myModal.show();
      }
    }
}
