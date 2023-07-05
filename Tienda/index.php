<?php
// Importar archivo de configuración
require_once 'Config/Config.php';

// Obtener la ruta de la URL
$ruta = !empty($_GET['url']) ? $_GET['url'] : "home/index";

// Dividir la ruta en un arreglo utilizando "/" como separador
$array = explode("/", $ruta);

// Obtener el nombre del controlador (primer elemento del arreglo) y capitalizar la primera letra
$controller = ucfirst($array[0]);

// Establecer el método por defecto como "index"
$metodo = "index";

// Establecer el parámetro inicialmente como una cadena vacía
$parametro = "";

// Verificar si existe un segundo elemento en el arreglo (nombre del método)
if (!empty($array[1])) {
    if (!empty($array[1] != "")) {
        // Si existe, asignar el nombre del método
        $metodo = $array[1];
    }
}

// Verificar si existen más elementos en el arreglo (parámetros adicionales)
if (!empty($array[2])) {
    if (!empty($array[2] != "")) {
        // Recorrer los elementos adicionales y concatenarlos como parámetros separados por comas
        for ($i = 2; $i < count($array); $i++) {
            $parametro .= $array[$i] . ",";
        }
        // Eliminar la última coma
        $parametro = trim($parametro, ",");
    }
}

// Incluir el archivo de carga automática de clases
require_once 'Config/App/Autoload.php';

// Incluir archivo de funciones de ayuda
require_once 'Config/Helpers.php';

// Ruta del controlador
$dirControllers = "Controllers/" . $controller . ".php";

// Verificar si existe el archivo del controlador
if (file_exists($dirControllers)) {
    // Incluir el archivo del controlador
    require_once $dirControllers;

    // Crear una instancia del controlador
    $controller = new $controller();

    // Verificar si el método existe en el controlador
    if (method_exists($controller, $metodo)) {
        // Llamar al método del controlador y pasarle el parámetro
        $controller->$metodo($parametro);
    } else {
        // Redireccionar a una página de errores si el método no existe
        header('Location: '.BASE_URL.'errors');
    }
} else {
    // Redireccionar a una página de errores si el archivo del controlador no existe
    header('Location: ' . BASE_URL . 'errors');
}
?>