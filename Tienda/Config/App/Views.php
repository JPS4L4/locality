<?php
class Views{
    // Carga la vista especificada
    public function getView($ruta, $vista, $data="")
    {
        // Verificar si la ruta es "home" para cargar la vista en la carpeta raíz "Views"
        if ($ruta == "home") {
            $vista = "Views/".$vista.".php";
        }else{
            // Cargar la vista en la carpeta especificada en la ruta
            $vista = "Views/".$ruta."/".$vista.".php";
        }
        require $vista;
    }
}
?>