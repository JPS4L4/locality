<?php 
    include_once 'Views/template/header-principal.php';
?>

    <!-- Inicio del detalle del producto -->
    <br><br><br>
    <section class="bg-light">
        <div class="container pb-5 ">
            <div class="row">
                <div class="col-lg-5 mt-5 ">
                    <div class="card mb-3 bordeRedondo">
                        <img class="card-img img-fluid bordeRedondo" src="<?php echo BASE_URL . $data['producto']['imagen']; ?>" alt="Card image cap"
                            id="product-detail">
                    </div>  
                </div>
                <!-- Fin de la columna -->
                <div class="col-lg-7 mt-5 ">
                    <div class="card bordeRedondo">
                        <div class="card-body">
                            <h1 class="h2 arregloTitulo"><?php echo $data['producto']['nombre']; ?></h1>
                            <p class="h3 py-2"><?php echo MONEDA . ' ' . $data['producto']['precio']; ?></p>
                            
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6><strong>Categoria: </strong></h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo $data['producto']['categoria']; ?></strong></p>
                                </li>
                            </ul>

                            <h6><strong>Descripción: </strong></h6>
                            <p><?php echo $data['producto']['descripcion']; ?></p>

                            <form action="" method="GET">
                                <input type="hidden" id="idProducto" value="<?php echo $data['producto']['id']; ?>">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Cantidad    
                                                <input type="hidden" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="badge btn-util" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="badge btn-util" id="btn-plus" max="<?php echo $data['producto']['cantidad']; ?>">+</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <!--<button type="submit" class="btn btn-util btn-lg" name="submit" value="buy">Comprar</button>-->
                                    </div>
                                    <div class="col d-grid">
                                        <button type="button" class="btn btn-util btn-lg bordeRedondo" id="btnAddCart">Añadir al carro</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin del detalle del producto -->

    <!-- Inicio de los productos relacionados -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Productos relacionados</h4>
            </div>

            <!-- Productos relacionados -->
            <div id="carousel-related-product">
                <?php foreach ($data['relacionados'] as $producto) { ?>
                <div class="p-2 pb-3 contornoProductos">
                    <div class="product-wap card rounded-0 cardProductos">
                        <div class="card rounded-0 cardProductosDos">
                            <img class="card-img rounded-0 img-fluid" src="<?php echo BASE_URL . $producto['imagen']; ?>">
                            <div
                                class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><a class="btn btn-util text-white btnAddDeseo" href="#" prod="<?php echo $producto['id']; ?>"><i
                                                class="fas fa-heart"></i></a></li>
                                    <li><a class="btn text-white mt-2 mirarDetalle" href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']; ?>"><i
                                                class="fas fa-eye"></i></a></li>
                                    <li><a class="btn btn-util text-white mt-2 btnAddCarrito" href="#" prod="<?php echo $producto['id']; ?>"><i
                                                class="fas fa-cart-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']; ?>" class="h3 text-decoration-none"><?php echo $producto['nombre']; ?></a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                
                                <li class="pt-2">
                                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    <span
                                        class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                    <span
                                        class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                    <span
                                        class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                    <span
                                        class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <?php
                                    $media = $producto['media_calificacion'];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $media) {
                                            echo '<i class="text-warning fas fa-star"></i>';
                                        } else {
                                            echo '<i class="text-muted fas fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </li>
                            </ul>

                            <p class="text-center mb-0"><?php echo MONEDA . ' ' .$producto['precio']; ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Fin de los productos relacionados -->

<?php 
    include_once 'Views/template/footer-principal.php';
?>

<script src="<?php echo BASE_URL; ?>assets/js/modulos/detail.js"></script>

    <script src="<?php echo BASE_URL; ?>assets/css/slick/slick.min.js"></script>
    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            dots: true,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            }
            ]
        });
    </script>

</body>

</html>