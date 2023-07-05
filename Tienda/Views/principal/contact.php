<?php 
    include_once 'Views/template/header-principal.php';
?>

    <!-- Start Content Page -->
    <br><br><br>
    <div class="container-fluid bgContactanos bg-light text-dark py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1 fw-bold">Contáctanos</h1>
            <p>
               ¡Aquí podrás enviar un mensaje a nuestro centro de comunicaciones para resolver cualquier inquietud, recuerda rellenar todos los datos correctamente para asegurar que llegue tu mensaje!.
            </p>
        </div>
    </div>

    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">
            <form class="col-md-9 m-auto" method="post" role="form">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname"><i class="fas fa-list"></i> Nombre</label>
                        <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Nombre completo">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputemail"><i class="fas fa-envelope"></i> Correo electrónico</label>
                        <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Correo electrónico">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputsubject"><i class="fas fa-envelope"></i> Sujeto</label>
                    <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Destinatario">
                </div>
                <div class="mb-3">
                    <label for="inputmessage"><i class="fas fa-envelope"></i> Mensaje</label>
                    <textarea class="form-control mt-1" id="message" name="message" placeholder="Escribe tu mensaje"
                        rows="8"></textarea>
                </div>
                <div class="row">
                    <div class="col text-center rounded-1 mt-2">
                        <button type="submit" class="btn btn-util btn-lg px-3">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Contact -->

<?php 
    include_once 'Views/template/footer-principal.php';
?>

</body>

</html>