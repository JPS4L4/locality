<?php
class Controller{
    protected $views, $model;
    
    public function __construct()
    {
        // Constructor de la clase Controller. Crea una instancia de la clase Views y carga el modelo asociado al controlador
        $this->views = new Views();
        $this->cargarModel();
    }
    public function cargarModel()
    {
        // Carga el modelo asociado al controlador. Verifica si el archivo del modelo existe y lo requiere. Luego, crea una instancia del modelo y lo asigna a la propiedad $model del controlador.
        $model = get_class($this)."Model";
        $ruta = "Models/".$model.".php";
        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $model();
        }
    }
}
 
?>  