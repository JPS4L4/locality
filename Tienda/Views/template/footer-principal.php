<!-- Carrito de compras -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="fas fa-cart-arrow-down"></i>Carrito</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">

        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-borderer table-striped table-hover align-middle" id="tableListaCarrito">
            <thead>
              <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="d-flex justify-content-around mb-3">
        <h3 id="totalGeneral"></h3>
        <?php if (!empty($_SESSION['correoCliente'])) { ?>
          <a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'clientes'; ?>">Procesar pedido</a>
        <?php } else { ?>
          <a class="btn btn-outline-primary" href="#" onclick="abrirModalLogin();">Ingresar</a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<!-- Forulario del login -->
<div id="modalLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="titleLogin">Iniciar sesión</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">

        </button>
      </div>
      <div class="modal-body m-3">
        <form method="get" action="">
          <div class="text-center">
            <img class="img-thumbnail" src="<?php echo BASE_URL . 'assets/images/carrito.png'; ?>" alt="" width="120">
          </div>
          <div class="row">
            <div class="col-md-12" id="frmLogin">
              <div class="form-group mb-3">
                <label for="correoLogin"><i class="fas fa-envelope"></i> Correo</label>
                <input id="correoLogin" class="form-control" type="text" name="correoLogin"
                  placeholder="Correo electrónico">
              </div>
              <div class="form-group mb-3">
                <label for="claveLogin"><i class="fas fa-key"></i> Contraseña</label>
                <input id="claveLogin" class="form-control" type="password" name="claveLogin" placeholder="Contraseña">
              </div>
              <a href="#" id="btnRegister">¿No estas registrado?</a>
              <div class="float-end">
                <button class="btn btn-primary btn-lg" type="button" id="login">Ingresar</button>
              </div>
              <br>
            </div>

            <!-- Formulario de registro -->
            <div class="col-md-12 d-none" id="frmRegister">
              <div class="form-group mb-3">
                <label for="nombreRegistro"><i class="fas fa-list"></i> Nombre</label>
                <input id="nombreRegistro" class="form-control" type="text" name="nombreRegistro"
                  placeholder="Nombre completo">
              </div>
              <div class="form-group mb-3">
                <label for="correoRegistro"><i class="fas fa-envelope"></i> Correo</label>
                <input id="correoRegistro" class="form-control" type="text" name="correoRegistro"
                  placeholder="Correo electrónico">
              </div>
              <div class="form-group mb-3">
                <label for="  claveRegistro"><i class="fas fa-key"></i> Contraseña</label>
                <input id="claveRegistro" class="form-control" type="password" name="claveRegistro"
                  placeholder="Contraseña">
              </div>
              <a href="#" id="btnLogin">¿Ya tienes una cuenta?</a>
              <div class="float-end">
                <button class="btn btn-primary btn-lg" type="button" id="registrarse">Registrarse</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Inicio del Footer -->
<footer class="footerStyle bg-dark" id="tempaltemo_footer">
  <div class="container">
    <div class="row">

      <div class="col-md-4 pt-5">
        <h2 class="h2 text-util border-bottom pb-3 border-light logo">Información</h2>
        <ul class="list-unstyled text-light footer-link-list">
          <li>
            <i class="fas fa-map-marker-alt fa-fw"></i>
            <a class="text-decoration-none" href="https://goo.gl/maps/ztEufNuy79twuqcQ8">#104, Complejo Norte Carrera
              68, Medellín, Antioquia</a>
          </li>
          <li>
            <i class="fa fa-phone fa-fw"></i>
            <a class="text-decoration-none" href="tel:44442800">44442800</a>
          </li>
          <li>
            <i class="fa fa-envelope fa-fw"></i>
            <a class="text-decoration-none" href="http://tecnologia-manufactura-avanzada.blogspot.com/">CTMA
              Blogspot</a>
          </li>
        </ul>
      </div>

      <div class="col-md-4 pt-5">
        <h2 class="h2 text-util border-bottom pb-3 border-light logo">Ubicación</h2>
        <ul class="list-unstyled text-light footer-link-list">
          <iframe class="arregloMapa"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.716495243431!2d-75.573171511145!3d6.300933600000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e442f25d6670d4d%3A0x8043999e5e767b96!2sSENA%20-%20Centro%20de%20Tecnolog%C3%ADa%20de%20la%20Manufactura%20Avanzada!5e0!3m2!1ses-419!2sco!4v1686710864232!5m2!1ses-419!2sco"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </ul>
      </div>

      <div class="col-md-4 pt-5">
        <h2 class="h2 text-util border-bottom pb-3 border-light logo">Secciones</h2>
        <ul class="list-unstyled text-light footer-link-list">
          <li><a class="text-decoration-none" href="<?php echo BASE_URL; ?>">Inicio</a></li>
          <li><a class="text-decoration-none" href="<?php echo BASE_URL . 'principal/about' ?>">Sobre Nosotros</a></li>
          <li><a class="text-decoration-none" href="<?php echo BASE_URL . 'principal/shop' ?>">Tienda</a></li>
          <!-- <li><a class="text-decoration-none" href="<?php echo BASE_URL . 'principal/contactos' ?>">Contactanos</a></li> -->
        </ul>
      </div>

    </div>

    <div class="col-auto me-auto">
      <ul class="list-inline text-left footer-icons">
        <li class="list-inline-item border border-light rounded-circle text-center">
          <a class="text-light text-decoration-none" target="_blank" href="https://www.facebook.com/SENAAntioquia/?locale=es_LA">
            <i class="fab fa-facebook-f fa-lg fa-fw facebook-color"></i>
          </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
          <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/senacomunica/?hl=es-la">
            <i class="fab fa-instagram fa-lg fa-fw instagram-color"></i>
          </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
          <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/SENAComunica?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">
            <i class="fab fa-twitter fa-lg fa-fw twitter-color"></i>
          </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
          <a class="text-light text-decoration-none" target="_blank" href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwixuNzMhdb_AhWgg4QIHRF_DrkQFnoECA0QAQ&url=https%3A%2F%2Fco.linkedin.com%2Fschool%2Fservicio-nacional-de-aprendizaje-sena-%2F&usg=AOvVaw1UwzghF0aUp-qLLkspKSBR&opi=89978449">
            <i class="fab fa-linkedin fa-lg fa-fw linkedin-color"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
  </div>

  <div class="w-100 bg-black py-3">
    <div class="container">
      <div class="row pt-2">
        <div class="col-12">
          <p class="text-left text-light">
            Copyright &copy; 2023 Locality
          </p>
        </div>
      </div>
    </div>
  </div>

</footer>
<!-- Fin del  Footer -->

<!-- Inicio de los Script -->
<script src="<?php echo BASE_URL; ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/templatemo.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/all.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  const base_url = '<?php echo BASE_URL; ?>';

  function alertaPersonalizada(mensaje, type, titulo = '') {
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
</script>
<script src="<?php echo BASE_URL; ?>assets/js/carrito.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/login.js"></script>
<!-- Fin de los Script -->