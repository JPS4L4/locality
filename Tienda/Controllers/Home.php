<?php
class Home extends Controller
{
    // Constructor de la clase. Inicia la sesión
    public function __construct() {
        parent::__construct();
        session_start();
    }

    // Muestra la página principal. Obtiene las categorías y los nuevos productos desde el modelo
    public function index()
    {
        $data['perfil'] = 'no'; 
        $data['title'] = 'Pagina principal';
        $data['categorias'] = $this->model->getCategorias();
        $data['nuevoProductos'] = $this->model->getNuevoProductos();
        $this->views->getView('home', "index", $data);
    }

}