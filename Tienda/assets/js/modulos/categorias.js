// Obtener elementos del formulario y del modal
const nuevo = document.querySelector('#nuevo_registro');
const frm = document.querySelector('#frmRegistro');
const titleModal = document.querySelector('#titleModal');
const btnAccion = document.querySelector('#btnAccion');
const myModal = new bootstrap.Modal(document.getElementById('nuevoModal'));
let tblCategorias;

// Evento que se ejecuta cuando el DOM ha sido cargado
document.addEventListener('DOMContentLoaded', function () {
    tblCategorias = $('#tblCategorias').DataTable({
    ajax: {
      url: base_url + 'categorias/listar',
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'categoria' },
      { data: 'imagen' },
      { data: 'accion' }
    ],
    language,
    dom,
    buttons
  });

  // Evento para agregar una nueva categoría
  nuevo.addEventListener('click', function () {
    document.querySelector('#id').value = ''; 
    document.querySelector('#imagen').value = '';
    document.querySelector('#imagen_actual').value = ''; 
    titleModal.textContent = 'NUEVA CATEGORIA';
    btnAccion.textContent = 'Registrar';
    frm.reset();
    myModal.show();
  })

  // Evento para enviar el formulario de registro
  frm.addEventListener('submit', function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "categorias/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText); 
        const res = JSON.parse(this.responseText);
        if (res.icono == 'success') {
          myModal.hide();
          tblCategorias.ajax.reload();
          document.querySelector('#imagen').value = ''; 
        }
        Swal.fire('Aviso?', res.msg.toUpperCase(), res.icono);
      }
    };
  });
});

// Función para eliminar una categoría
function eliminarCat(idCat) {
  Swal.fire({
    title: 'Estas seguro?',
    text: "Quiere eliminar este registro!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Si, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "categorias/delete/" + idCat;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == 'success') {
            tblCategorias.ajax.reload();
          }
          Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
        }
      }
    }
  });
}

// Función para editar una categoría
function editCat(idCat) {
  const url = base_url + "categorias/edit/" + idCat;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        document.querySelector('#id').value = res.id;   
        document.querySelector('#categoria').value = res.categoria;   
        document.querySelector('#imagen_actual').value = res.imagen;
        btnAccion.textContent = 'Actualizar';
        titleModal.textContent = 'MODIFICAR CATEGORIA';
        myModal.show();
      }
    }
}
