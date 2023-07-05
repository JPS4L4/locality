<?php
class HomeModel extends Query{
 
    // Constructor de la clase
    public function __construct()
    {
        parent::__construct();
    }

    // Obtiene una lista de categorías activas
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        return $this->selectAll($sql);
    }

    // Obtiene una lista de productos nuevos con su calificación promedio, limitados a 12 resultados
    public function getNuevoProductos()
    {
        $sql = "SELECT p.*, AVG(c.cantidad) AS media_calificacion
                FROM productos p
                LEFT JOIN calificaciones c ON p.id = c.id_producto
                WHERE p.cantidad > 5 AND p.estado = 1
                GROUP BY p.id
                ORDER BY p.id DESC
                LIMIT 12";

        return $this->selectAll($sql);  
    }


}
 
?>