<?php 
    include_once 'Views/template/header-principal.php';
?>

    <!-- Inicio de los productos por categorias -->
    <br><br><br>
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-inline shop-top-menu pb-3 pt-1">
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="#">Productos</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                <?php foreach ($data['productos'] as $producto) { ?>
                    <div class="col-md-3 contornoProductos">
                        <div class="card mb-4 product-wap rounded-0 cardProductos">
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
                                        <span
                                            class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
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

                                <p class="text-center mb-0"><?php echo MONEDA . ' '. $producto['precio']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <!-- Paginador de los productos por categorias -->
                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        <?php 
                            $anterior = $data['pagina'] - 1;
                            $siguiente = $data['pagina'] + 1;   
                            $url = BASE_URL . 'principal/categorias/' . $data['id_categoria'];
                            if ($data['pagina'] > 1){
                                echo '<li class="page-item">
                                <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="'. $url . '/' . $anterior.'"
                                    >Anterior</a>
                                </li>';
                            }
                            if ($data['total'] >= $siguiente){
                                echo '<li class="page-item">
                                <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-white"
                                    href="'. $url . '/' . $siguiente.'">Siguiente</a>
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- Inicio de los productos por categorias -->

<?php 
    include_once 'Views/template/footer-principal.php';
?>

    </body>
    
    </html>