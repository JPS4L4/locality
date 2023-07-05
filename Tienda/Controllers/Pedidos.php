<?php
class Pedidos extends Controller
{
    // Constructor de la clase. Inicia la sesión y redirige al inicio de sesión si no hay sesión activa
    public function __construct() {
        parent::__construct();
        session_start();
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
    }

    // Muestra la vista "index" de pedidos
    public function index()
    {
        $data['title'] = 'pedidos';
        $this->views->getView('admin/pedidos', "index", $data);
    }

    // Obtiene una lista de pedidos y agrega la acción correspondiente a cada pedido
    public function listarPedidos()
    {
        $data = $this->model->getPedidos(1);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-info" type="button" onClick="cambiarProceso('.$data[$i]['id'].', 2)"><i class="fas fa-check-circle"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }

    // Obtiene una lista de pedidos en proceso y agrega la acción correspondiente a cada pedido
    public function listarProceso()
    {
        $data = $this->model->getPedidos(2);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-info" type="button" onClick="cambiarProceso('.$data[$i]['id'].', 3)"><i class="fas fa-check-circle"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }

    // Obtiene una lista de pedidos finalizados y agrega la acción correspondiente a cada pedido
    public function listarFinalizados()
    {
        $data = $this->model->getPedidos(3);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-success" type="button" onClick="verPedido('.$data[$i]['id'].')"><i class="fas fa-eye"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }

    // Actualiza el estado de un pedido según los datos proporcionados
    public function update($datos)
    {
        $array = explode(',', $datos);
        $idPedido = $array[0];
        $proceso = $array[1];
        if (is_numeric($idPedido)) {
            $data = $this->model->actualizarEstado($proceso, $idPedido);
            if ($data == 1) {
                $respuesta = array('msg' => 'Pedido actualizado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al actualizar', 'icono' => 'error');
            }
            echo json_encode($respuesta);
        }
        die();
    }
}