<?php
class Usuarios extends Controller
{
    // Constructor de la clase. Verifica el inicio de sesión del administrador
    public function __construct() {
        parent::__construct();
        session_start();
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
    }

    // Muestra la vista principal de usuarios
    public function index()
    {   
        $data['title'] = 'usuarios';
        $this->views->getView('admin/usuarios', "index", $data);
    }

    // Obtiene la lista de usuarios y agrega acciones de edición y eliminación. Devuelve los datos en formato JSON
    public function listar()
    {
        $data = $this->model->getUsuarios(1);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-primary" type="button" onClick="editUser('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onClick="eliminarUser('.$data[$i]['id'].')"><i class="fas fa-trash"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }

    // Registra o modifica un usuario según los datos enviados por POST
    public function registrar()
    {
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $id = $_POST['id'];
            $hash = password_hash($clave, PASSWORD_DEFAULT);

            if (empty($_POST['nombre']) || empty($_POST['apellido'])) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                // Verificar si es una modificación o un nuevo registro
                if (empty($id)) {
                    $data = $this->model->registrar($nombre, $apellido, $correo, $hash);
                    if ($data > 0) {
                        $respuesta = array('msg' => 'Usuario registrado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                    }
                } else {
                    $data = $this->model->modificar($nombre, $apellido, $correo, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Usuario modificado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }

    // Elimina un usuario según el ID proporcionado
    public function delete($idUser)
    {
        if (is_numeric($idUser)) {
            $data = $this->model->eliminar($idUser);
            if ($data == 1) {
                $respuesta = array('msg' => 'Usuario eliminado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    // Obtiene los datos de un usuario según el ID proporcionado
    public function edit($idUser)
    {
        if (is_numeric($idUser)) {
            $data = $this->model->getUsuario($idUser);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}