<?php
class PrincipalModel extends Query{
 
    // Constructor de la clase
    public function __construct()
    {
        parent::__construct();
    }

    // Obtiene los datos de un producto específico de la base de datos
    public function getProducto($id_producto)
    {
        $sql = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.id = $id_producto AND p.estado = 1";
        return $this->select($sql);
    }   

    // Obtiene una lista de productos paginada desde una posición específica en la base de datos
    public function getProductos($desde, $porPagina)
    {
        $sql = "SELECT p.*, AVG(c.cantidad) AS media_calificacion
                FROM productos p
                LEFT JOIN calificaciones c ON p.id = c.id_producto
                WHERE p.cantidad >= 1
                AND p.estado = 1
                GROUP BY p.id
                LIMIT $desde, $porPagina";

        return $this->selectAll($sql);
    }

    // Obtiene el total de productos activos en la base de datos
    public function getTotalProductos()
    {
        $sql = "SELECT COUNT(*) AS total FROM productos WHERE estado = 1";
        return $this->select($sql);
    }

    // Obtiene una lista de productos de una categoría específica, paginada desde una posición específica en la base de datos
    public function getProductosCat($id_categoria, $desde, $porPagina)
    {
        $sql = "SELECT p.*, AVG(c.cantidad) AS media_calificacion
                FROM productos p
                LEFT JOIN calificaciones c ON p.id = c.id_producto
                WHERE p.id_categoria = $id_categoria
                AND p.cantidad >= 1
                AND p.estado = 1
                GROUP BY p.id
                LIMIT $desde, $porPagina";

        return $this->selectAll($sql);
    }

    // Obtiene el total de productos de una categoría específica en la base de datos
    public function getTotalProductosCat($id_categoria)
    {
        $sql = "SELECT COUNT(*) AS total FROM productos WHERE id_categoria = $id_categoria AND estado = 1";
        return $this->select($sql); 
    }

    // Obtiene una lista de productos aleatorios de una categoría específica, excluyendo un producto en particular
    public function getAleatorios($id_categoria, $id_producto)
    {
        $sql = "SELECT p.*, AVG(c.cantidad) AS media_calificacion
                FROM productos p
                LEFT JOIN calificaciones c ON p.id = c.id_producto
                WHERE p.id_categoria = $id_categoria
                AND p.id != $id_producto
                AND p.estado = 1
                AND p.cantidad >= 1
                GROUP BY p.id
                ORDER BY RAND()
                LIMIT 12";

        return $this->selectAll($sql);
    }

    // Realiza una búsqueda de productos en la base de datos por nombre o descripción
    public function getBusqueda($valor)
    {
        $sql = "SELECT p.*, AVG(c.cantidad) AS media_calificacion
                FROM productos p
                LEFT JOIN calificaciones c ON p.id = c.id_producto
                WHERE (p.nombre LIKE '%$valor%' OR p.descripcion LIKE '%$valor%')
                AND p.cantidad >= 1
                AND p.estado = 1
                GROUP BY p.id
                LIMIT 9";

        return $this->selectAll($sql);
    }

}
 
?>
