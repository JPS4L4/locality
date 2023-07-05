<?php
class Principal extends Controller
{
    // Constructor de la clase. Inicia la sesión
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    // Muestra la vista "about"
    public function about()
    {
        $data['perfil'] = 'no'; 
        $data['title'] = 'Servicios';
        $this->views->getView('principal', "about", $data);
    }

    // Muestra la vista "shop" con una lista de productos paginada
    public function shop($page)
    {
        $data['perfil'] = 'no'; 
        $pagina = (empty($page)) ? 1 : $page;
        $porPagina = 16;
        $desde = ($pagina - 1) * $porPagina;
        $data['title'] = 'Productos';
        $data['productos'] = $this->model->getProductos($desde, $porPagina);
        $data['pagina'] = $pagina;
        $total = $this->model->getTotalProductos();
        $data['total'] = ceil($total['total'] / $porPagina);
        $this->views->getView('principal', "shop", $data);
    }

    // Muestra la vista "detail" con los detalles de un producto
    public function detail($id_producto)
    {
        $data['perfil'] = 'no'; 
        $data['producto'] = $this->model->getProducto($id_producto);
        $id_categoria = $data['producto']['id_categoria'];
        $data['relacionados'] = $this->model->getAleatorios($id_categoria, $data['producto']['id']);
        $data['title'] = $data['producto']['nombre'];
        $this->views->getView('principal', "detail", $data);
    }

    // Muestra la vista "categorias" con una lista de productos de una categoría específica
    public function categorias($datos)
    {
        $data['perfil'] = 'no'; 
        $id_categoria = 1;
        $page = 1;

        $array = explode(',', $datos);
        if (isset($array[0])) {
            if (!empty($array[0])) {
                $id_categoria = $array[0];
            }
        }
        if (isset($array[1])) {
            if (!empty($array[1])) {
                $page = $array[1];
            }
        }
        $pagina = (empty($page)) ? 1 : $page;
        $porPagina = 8;
        $desde = ($pagina - 1) * $porPagina;

        $data['pagina'] = $pagina;
        $total = $this->model->getTotalProductosCat($id_categoria);
        $data['total'] = ceil($total['total'] / $porPagina);

        $data['productos'] = $this->model->getProductosCat($id_categoria, $desde, $porPagina);
        $data['title'] = 'Categorias';
        $data['id_categoria'] = $id_categoria;
        $this->views->getView('principal', "categorias", $data);
    }

    // Muestra la vista "contact" de contactos
    public function contactos()
    {
        $data['perfil'] = 'no'; 
        $data['title'] = 'Contactos';
        $this->views->getView('principal', "contact", $data);
    }

    // Muestra la vista "deseo" con la lista de deseos
    public function deseo()
    {
        $data['perfil'] = 'no'; 
        $data['title'] = 'Lista de deseo';
        $this->views->getView('principal', "deseo", $data);
    }

    // Obtiene una lista de productos y sus detalles según los datos proporcionados
    public function listaProductos()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $array['productos'] = array();
        $total = 0.00;
        if (!empty($json)) {
            foreach ($json as $producto) {
                $result = $this->model->getProducto($producto['idProducto']);
                $data['id'] = $result['id'];
                $data['nombre'] = $result['nombre'];
                $data['precio'] = $result['precio'];
                $data['cantidad'] = $producto['cantidad'];
                $data['imagen'] = $result['imagen'];
                $subTotal = $result['precio'] * $producto['cantidad'];
                $data['subTotal'] = number_format($subTotal, 2);
                array_push($array['productos'], $data);
                $total += $subTotal;
            }
        }
        $array['total'] = number_format($total, 2);
        $array['totalPaypal'] = number_format($total, 2, '.', '');
        $array['moneda'] = MONEDA;
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Realiza una búsqueda de productos según el valor proporcionado
    public function busqueda($valor)
    {   
        $data = $this->model->getBusqueda($valor);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}   
/*Email: sb-juobf24602040@personal.example.com  ~~ 
System Generated Password: UG14top$  */