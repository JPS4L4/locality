<?php
class ProductosModel extends Query{
 
    // Constructor de la clase
    public function __construct()
    {
        parent::__construct();
    }

    // Obtiene todos los productos con el estado especificado de la base de datos
    public function getProductos($estado)
    {
        $sql = "SELECT * FROM productos WHERE estado = $estado";
        return $this->selectAll($sql);
    }

    // Obtiene todas las categorías activas de la base de datos
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        return $this->selectAll($sql);
    }

    // Registra un nuevo producto en la base de datos   
    public function registrar($nombre, $descripcion, $precio, $cantidad, $imagen, $categoria)
    {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen, id_categoria) VALUES (?,?,?,?,?,?)";
        $array = array($nombre, $descripcion, $precio, $cantidad, $imagen, $categoria);
        return $this->insertar($sql, $array);
        
    }

    // Elimina un producto de la base de datos
    public function eliminar($idPro)
    {
        $sql = "DELETE FROM productos WHERE id = ?";
        $array = array($idPro);
        return $this->save($sql, $array);
    }

    // Obtiene un producto específico de la base de datos
    public function getProducto($idPro)
    {
        $sql = "SELECT * FROM productos WHERE id = $idPro";
        return $this->select($sql);
    }

    // Modifica los datos de un producto en la base de datos
    public function modificar($nombre, $descripcion, $precio, $cantidad, $destino, $categoria, $id)
    {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, cantidad=?, imagen=?, id_categoria=? WHERE id = ?";
        $array = array($nombre, $descripcion, $precio, $cantidad, $destino, $categoria, $id);
        return $this->save($sql, $array);
    }
}
 
?>