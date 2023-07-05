<?php
class AdminModel extends Query{
 
    // Constructor de la clase
    public function __construct()
    {
        parent::__construct();
    }

    // Obtiene un usuario por su correo electrónico
    public function getUsuario($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        return $this->select($sql);
    }

    // Obtiene el total de pedidos según su estado
    public function getTotales($estado)
    {
        $sql = "SELECT COUNT(*) AS total FROM pedidos WHERE proceso = $estado";
        return $this->select($sql);
    }

    // Obtiene el total de productos activos
    public function getProductos()
    {
        $sql = "SELECT COUNT(*) AS total FROM productos WHERE estado = 1";
        return $this->select($sql);
    }

    // Obtiene los productos con una cantidad menor a 4 y estado activo
    public function productosMinimos()
    {
        $sql = "SELECT * FROM productos WHERE cantidad < 4 AND estado = 1 ORDER BY cantidad ASC LIMIT 3";
        return $this->selectAll($sql);
    }

    // Obtiene los productos más vendidos
    public function topProductos()
    {
        $sql = "SELECT producto, SUM(cantidad) AS total FROM detalle_pedidos GROUP BY id_producto ORDER BY total DESC LIMIT 3";
        return $this->selectAll($sql);
    }
    
}
 
?>