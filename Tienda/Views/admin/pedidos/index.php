<?php
include_once 'Views/template/header-admin.php';
?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <!-- Pedidos pendientes -->
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#listaPedidos" type="button"
      role="tab" aria-controls="listaPedidos" aria-selected="true">Pendientes</button>
  </li>
  <!-- Pedidos en proceso -->
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="proceso-tab" data-bs-toggle="tab" data-bs-target="#listaProceso" type="button"
      role="tab" aria-controls="listaProceso" aria-selected="false">Proceso</button>
  </li>
  <!-- Pedidos finalizados -->
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#pedidosFinalizados" type="button"
      role="tab" aria-controls="pedidosFinalizados" aria-selected="false">Finalizados</button>
  </li>
</ul>

<!-- Tabla de pedidos pendientes -->
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="listaPedidos" role="tabpanel" aria-labelledby="home-tab">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middler" style="width:100%;"
            id="tblPendientes">
            <thead>
              <tr>
                <th>Transaccion</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla de pedidos en proceso -->
  <div class="tab-pane fade" id="listaProceso" role="tabpanel" aria-labelledby="proceso-tab">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middler" style="width:100%;"
            id="tblProceso">
            <thead>
              <tr>
                <th>Transaccion</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla de pedidos finalizados -->
  <div class="tab-pane fade" id="pedidosFinalizados" role="tabpanel" aria-labelledby="profile-tab">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middler" style="width:100%;"
            id="tblFinalizados">
            <thead>
              <tr>
                <th>Transaccion</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Visualizar tablas -->
<div class="modal fade" id="modalPedidos" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Productos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-borderer table-striped table-hover align-middle" id="tablePedidos"
            style="width: 100%;">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var modalId = document.getElementById('modalId');

  modalId.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    let button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    let recipient = button.getAttribute('data-bs-whatever');

    // Use above variables to manipulate the DOM
  });
</script>


<?php
include_once 'Views/template/footer-admin.php';
?>
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL . 'assets/js/modulos/pedidos.js'; ?>"></script>

</body>

</html>