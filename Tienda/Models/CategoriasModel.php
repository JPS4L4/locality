<?php
class CategoriasModel extends Query{
 
    // Constructor de la clase
    public function __construct()
    {
        parent::__construct();
    }

    // Obtiene las categorías según su estado
    public function getCategorias($estado)
    {
        $sql = "SELECT * FROM categorias WHERE estado = $estado";
        return $this->selectAll($sql);
    }

    // Registra una nueva categoría en la base de datos
    public function registrar($categoria, $imagen)
    {
        $sql = "INSERT INTO categorias (categoria, imagen) VALUES (?,?)";
        $array = array($categoria, $imagen);
        return $this->insertar($sql, $array);
        
    }

    // Verifica si una categoría existe y está activa
    public function verificarCategoria($categoria)
    {
        $sql = "SELECT categoria FROM categorias WHERE categoria = '$categoria' AND estado = 1";
        return $this->select($sql);
    }

    // Elimina una categoría de la base de datos
    public function eliminar($idCat)
    {
        $sql = "DELETE FROM categorias WHERE id = ?";
        $array = array($idCat);
        return $this->save($sql, $array);
    }

    // Obtiene la información de una categoría por su ID
    public function getCategoria($idCat)
    {
        $sql = "SELECT * FROM categorias WHERE id = $idCat";
        return $this->select($sql);
    }

    // Modifica la información de una categoría existente
    public function modificar($categoria, $imagen, $id)
    {
        $sql = "UPDATE categorias SET categoria=?, imagen=? WHERE id = ?";
        $array = array($categoria, $imagen, $id);
        return $this->save($sql, $array);
    }
}
 
?>