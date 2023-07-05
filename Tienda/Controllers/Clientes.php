<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Clientes extends Controller
{
    // Constructor de la clase
    public function __construct()
    {   
        parent::__construct();
        session_start(); 
    }

    // Página principal del perfil del cliente
    public function index()
    {
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        $data['perfil'] = 'si'; 
        $data['title'] = 'Perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }

    // Registro directo de un nuevo cliente
    public function registroDirecto()
    {
        if (isset($_POST['nombre']) && isset($_POST['clave'])) {
            if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['clave'])) {
                $mensaje = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $verificar = $this->model->getVerificar($correo);
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $data   = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                    if ($data > 0) {
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre;
                        $mensaje = array('msg' => 'Registrado con exito', 'icono' => 'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'Error al registrarse', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'Ya tienes una cuenta', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    // Envío de correo electrónico de verificación
    public function enviarCorreo()
    {
        if (isset($_POST['correo']) && ($_POST['token'])) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = HOST_SMTP;
                $mail->SMTPAuth   = true;
                $mail->Username   = USER_SMTP;;
                $mail->Password   = PASS_SMTP;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = PUERTO_SMTP;

                //Recipients
                $mail->setFrom('juanzg2.0.2.5@gmail.com', TITLE);
                $mail->addAddress($_POST['correo']);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Mensaje desde ' . TITLE;
                $mail->Body    = 'Para verificar tu correo <a href="' . BASE_URL . 'clientes/verificarCorreo/' . $_POST['token'] . '">Click aquí</a>';
                $mail->AltBody = 'Gracias por registrarte';

                $mail->send();
                $mensaje = array('msg' => 'Correo enviado, revisa también en SPAM', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje = array('msg' => 'Error al enviar correo: ' . $mail->ErrorInfo, 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error fatal', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Verificación del correo electrónico del cliente
    public function verificarCorreo($token)
    {
        $verificar = $this->model->getToken($token);
        if (!empty($verificar)) {
            $data = $this->model->actualizarVerify($verificar['id']);
            header('Location: ' . BASE_URL . 'clientes');
        }
    }

    // Realiza el inicio de sesión desde el formulario de inicio de sesión
    public function loginDirecto()
    {
        if (isset($_POST['correoLogin']) && isset($_POST['claveLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['claveLogin'])) {
                $mensaje = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $correo = $_POST['correoLogin'];
                $clave = $_POST['claveLogin'];
                $verificar = $this->model->getVerificar($correo);
                if (!empty($verificar)) {
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['idCliente'] = $verificar['id'];
                        $_SESSION['correoCliente'] = $verificar['correo'];
                        $_SESSION['nombreCliente'] = $verificar['nombre'];
                        $mensaje = array('msg' => 'Ingreso exitoso', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => 'Contraseña incorrecta', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'El correo no existe', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    // Registra un nuevo pedido en la base de datos
    public function registrarPedido()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $pedidos = $json['pedidos'];
        $productos = $json['productos'];
        if (is_array($pedidos) && is_array($productos)) {
            $id_transaccion = $pedidos['id'];
            $monto = $pedidos['purchase_units'][0]['amount']['value'];
            $estado = $pedidos['status'];
            $fecha = date('Y-m-d H:i:s');
            $email = $pedidos['payer']['email_address'];
            $nombre = $pedidos['payer']['name']['given_name'];
            $apellido = $pedidos['payer']['name']['surname'];
            $direccion = $pedidos['purchase_units'][0]['shipping']['address']['address_line_1'];
            $ciudad = $pedidos['purchase_units'][0]['shipping']['address']['admin_area_2'];
            $id_cliente = $_SESSION['idCliente'];
            $data = $this->model->registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $id_cliente);
            if ($data > 0) {
                foreach ($productos as $producto) {
                    $temp = $this->model->getProducto($producto['idProducto']);
                    $this->model->registrarDetalle($temp['nombre'], $temp['precio'], $producto['cantidad'], $data, $producto['idProducto']);
                }
                $mensaje = array('msg' => 'Pedido registrado', 'icono' => 'success');
            } else {
                $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
            }
            
        } else {
            $mensaje = array('msg' => 'Error fatal', 'icono' => 'error');
        }
        echo json_encode($mensaje);
        die();
    }

    // Obtiene la lista de pedidos pendientes del cliente actual
    public function listarPendientes()
    {
        $id_cliente = $_SESSION['idCliente'];
        $data = $this->model->getPedidos($id_cliente);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = '<div class="text-center"><button class="btn btn-info" type="button" onclick="verPedido('.$data[$i]['id'].')"><i class="fas fa-eye"></i></button></div>';
        }
        echo json_encode($data);
        die();
    }

    // Obtiene los detalles de un pedido en específico
    public function verPedido($idPedido)
    {
        $data['pedido'] = $this->model->getPedido($idPedido);
        $data['productos'] = $this->model->verPedidos($idPedido);
        $data['moneda'] = MONEDA;
        echo json_encode($data);
        die(); 
    }

    // Obtiene la lista de productos del cliente actual
    public function listarProductos()
    {
        $id_cliente = $_SESSION['idCliente'];
        $data = $this->model->getProductos($id_cliente);
        for ($i=0; $i < count($data); $i++) {
            $comprobar = $this->model->comprobarCalificacion($data[$i]['id_producto'], $id_cliente);
            $total = (empty($comprobar)) ? 0 : $comprobar['cantidad'] ;
            $uno = ($total >= 1) ? 'text-warning' : 'text-muted';
            $dos = ($total >= 2) ? 'text-warning' : 'text-muted';
            $tres = ($total >= 3) ? 'text-warning' : 'text-muted';
            $cuatro = ($total >= 4) ? 'text-warning' : 'text-muted';
            $cinco = ($total == 5) ? 'text-warning' : 'text-muted';
            $data[$i]['calificacion'] = '<ul class="list-unstyled d-flex justify-content-between">
                <li class="calificacion">
                  <i class="fas fa-star '.$uno.'" onclick="agregarCalificacion('.$data[$i]['id_producto'].', 1)"></i>
                  <i class="fas fa-star '.$dos.'" onclick="agregarCalificacion('.$data[$i]['id_producto'].', 2)"></i>
                  <i class="fas fa-star '.$tres.'" onclick="agregarCalificacion('.$data[$i]['id_producto'].', 3)"></i>
                  <i class="fas fa-star '.$cuatro.'" onclick="agregarCalificacion('.$data[$i]['id_producto'].', 4)"></i>
                  <i class="fas fa-star '.$cinco.'" onclick="agregarCalificacion('.$data[$i]['id_producto'].', 5)"></i>
                </li>
              </ul>';
        }
        echo json_encode($data);
        die();
    }

    // Agrega una calificación a un producto específico. Verifica si el cliente ya ha calificado el producto y realiza la acción correspondiente
    public function agregarCalificacion()
    {
        $id_cliente = $_SESSION['idCliente'];
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $comprobar = $this->model->comprobarCalificacion($json['id_producto'], $id_cliente);
        if (empty($comprobar)) {
            $data = $this->model->agregarCalificacion($json['cantidad'], $json['id_producto'], $id_cliente);
        if ($data > 0) {    
            $mensaje = array('msg' => 'Calificación agregada', 'icono' => 'success');
        } else {
            $mensaje = array('msg' => 'Error al calificar', 'icono' => 'error');
        }
        } else {
            $data = $this->model->cambiarCalificacion($json['cantidad'], $json['id_producto'], $id_cliente);
        if ($data == 1) {    
            $mensaje = array('msg' => 'Calificación modificada', 'icono' => 'success');
        } else {
            $mensaje = array('msg' => 'Error al calificar', 'icono' => 'error');
        }
        }
        echo json_encode($mensaje);
        die();
    }

    // Cierra la sesión del cliente actual y redirige a la página de inicio
    public function salir()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}
