<?php
class Categorias extends Controller
{
    // Constructor de la clase. Verifica la sesión del usuario administrador.
    public function __construct() {
        parent::__construct();
        session_start();
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
    }

    // Método para cargar la vista principal de categorías
    public function index()
    {
        $data['title'] = 'categorias';
        $this->views->getView('admin/categorias', "index", $data);
    }

    // Obtiene la lista de categorías en formato JSON
    public function listar()
    {
        $data = $this->model->getCategorias(1);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="'.$data[$i]['imagen'].'" alt="'.$data[$i]['categoria'].'" width="75">';
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-primary" type="button" onClick="editCat('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onClick="eliminarCat('.$data[$i]['id'].')"><i class="fas fa-trash"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }

    // Registra o modifica una categoría. Verifica los campos y realiza las operaciones correspondientes
    public function registrar()
    {
        if (isset($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $id = $_POST['id'];
            $ruta = 'assets/images/categorias/';
            $nombreImg = date('YmdHis');
            if (empty($_POST['categoria'])) {
            $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            }else {
                if (!empty($imagen['name'])) {
                    $destino = $ruta . $nombreImg . '.jpg';
                } else if (!empty($_POST['imagen_actual']) && empty($imagen['name'])) {
                    $destino = $_POST['imagen_actual'];
                } else {
                    $destino = $ruta . 'default.png';
                }
                
                if (empty($id)) {
                    $result = $this->model->verificarCategoria($categoria);
                if (empty($result)) {
                    $data = $this->model->registrar($categoria, $destino);
                    if ($data > 0) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'Categoria registrada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                    }
                } else {
                    $respuesta = array('msg' => 'Categoria ya existente', 'icono' => 'warning');
                }
                } else {
                    $data = $this->model->modificar($categoria, $destino, $id);
                    if ($data == 1) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'Categoria modificada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'error');
                    }
                }
                
            }
            echo json_encode($respuesta);
        }
        die();
    }

    // Elimina una categoría especificada
    public function delete($idCat)
    {
        if (is_numeric($idCat)) {
            $data = $this->model->eliminar($idCat);
            if ($data == 1) {
                $respuesta = array('msg' => 'Categoria eliminada', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    // Obtiene los datos de una categoría para su edición
    public function edit($idCat)
    {
        if (is_numeric($idCat)) {
            $data = $this->model->getCategoria($idCat);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}