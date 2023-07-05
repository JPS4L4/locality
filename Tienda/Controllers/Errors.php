<?php
class Errors extends Controller
{
    // Constructor de la clase
    public function __construct()
    {
        parent::__construct();
    }

    // Muestra la página de errores
    public function index()
    {
        $this->views->getView('errors', "index");
    }
}