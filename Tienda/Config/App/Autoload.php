<?php
spl_autoload_register(function($class){
    // Función de registro automático de clases
    if (file_exists("Config/App/".$class.".php")) {
        // Verificar si el archivo de la clase existe en la carpeta "Config/App"
        require_once "Config/App/" . $class . ".php";
    }
})
?>