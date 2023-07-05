<?php
class Compradores extends Controller
{
    // Constructor de la clase
    public function __construct() {
        parent::__construct();
        session_start();
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
    }

    // Muestra la página de clientes
    public function index()
    {   
        $data['title'] = 'clientes';
        $this->views->getView('admin/comprador', "index", $data);
    }

    // Obtiene la lista de clientes
    public function listar()
    {
        $data = $this->model->getCompradores();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-primary" type="button" onClick="editarCliente('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onClick="eliminarCliente('.$data[$i]['id'].')"><i class="fas fa-trash"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }

    // Registra un nuevo cliente o modifica uno existente
    public function registrar()
    {
        if (isset($_POST['nombre'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            if (empty($_POST['nombre']) || empty($_POST['correo'])) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $result = $this->model->verificarCorreo($correo);
                    if (empty($result)) {
                        $data = $this->model->registrar($nombre, $correo, $hash);
                        if ($data > 0) {
                            $respuesta = array('msg' => 'Cliente registrado', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'Correo ya existente', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar($id, $nombre, $correo, $hash);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Cliente modificado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'error');
                    }
                }
            }
            
            echo json_encode($respuesta);
        }
        die();
    }

    // Elimina un cliente
    public function delete($idCliente)
    {
        if (is_numeric($idCliente)) {
            $data = $this->model->eliminar($idCliente);
            if ($data == 1) {
                $respuesta = array('msg' => 'Cliente eliminado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    // Obtiene los datos de un cliente para editar
    public function edit($idCliente)
    {
        if (is_numeric($idCliente)) {
            $data = $this->model->getComprador($idCliente);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}