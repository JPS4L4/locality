<?php
class Admin extends Controller
{
    // Constructor de la clase. Inicia la sesión
    public function __construct() {
        parent::__construct();
        session_start();
    }

    // Carga la vista de inicio de sesión
    public function index()
    {   
        $data['title'] = 'Acceso al sistema';
        $this->views->getView('admin', "login", $data);
    }

    // Valida las credenciales de inicio de sesión. Verifica los campos de email y clave
    public function validar()
    {
        if (isset($_POST['email']) && isset($_POST['clave'])) {
            if (empty($_POST['email']) || empty($_POST['clave'])) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $data = $this->model->getUsuario($_POST['email']);
                if (empty($data)) {
                    $respuesta = array('msg' => 'El correo no esta registrado', 'icono' => 'warning');
                } else {
                    if (password_verify($_POST['clave'], $data['clave'])) {
                        $_SESSION['email'] = $data['correo'];
                        $_SESSION['nombre_usuario'] = $data['nombres'];
                        $respuesta = array('msg' => 'Datos correctos', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Contraseña incorrecta', 'icono' => 'warning');
                    }
                }
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Carga la vista del panel administrativo. Verifica la sesión del usuario
    // Obtiene los totales de pendientes, en proceso y finalizados. Obtiene los productos
    public function home()
    {
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
        $data['title'] = 'Panel administrativo';
        $data['pendientes'] = $this->model->getTotales(1);
        $data['procesos'] = $this->model->getTotales(2);
        $data['finalizados'] = $this->model->getTotales(3);
        $data['productos'] = $this->model->getProductos(3);
        $this->views->getView('admin/administracion', "index", $data);
    }

    // Obtiene los productos mínimos en formato JSON
    public function productosMinimos()
    {
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
        $data = $this->model->productosMinimos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Obtiene los productos más populares en formato JSON
    public function topProductos()
    {
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
        $data = $this->model->topProductos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Cierra la sesión del usuario y redirige al inicio
    public function salir()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}