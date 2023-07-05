<?php
class Conexion{
    private $conect;
    public function __construct()
    {
        // Constructor de la clase Conexion. Establece una conexión con la base de datos utilizando los valores de configuración
        $pdo = "mysql:host=".HOST.";dbname=".DB.";".CHARSET;
        try {
            // Crear una instancia de PDO para establecer la conexión
            $this->conect = new PDO($pdo, USER, PASS);
            // Configurar el modo de error de PDO para que lance excepciones en caso de errores
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Capturar y mostrar cualquier excepción lanzada durante la conexión
            echo "Error en la conexion".$e->getMessage();
        }
    }
    public function conect()
    {
        // Obtener la conexión establecida
        return $this->conect;
    }
}
 
?>