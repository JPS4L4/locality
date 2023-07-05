<?php
class CompradoresModel extends Query{
 
    // Constructor de la clase  
    public function __construct()
    {
        parent::__construct();
    }

    // Obtiene una lista de compradores con su información básica
    public function getCompradores()
    {
        $sql = "SELECT id, nombre, correo, clave FROM clientes";
        return $this->selectAll($sql);
    }

    // Registra un nuevo comprador en la base de datos
    public function registrar($nombre, $correo, $clave)
    {
        $sql = "INSERT INTO clientes (nombre, correo, clave) VALUES (?,?,?)";
        $array = array($nombre, $correo, $clave);
        return $this->insertar($sql, $array);
        
    }

    // Verifica si un correo electrónico ya existe en la tabla de compradores

    public function verificarCorreo($correo)
    {
        $sql = "SELECT correo FROM clientes WHERE correo = '$correo'";
        return $this->select($sql);
    }

    // Elimina un comprador de la base de datos
    public function eliminar($idCliente)
    {
        $sql = "DELETE FROM clientes WHERE id = ?";
        $array = array($idCliente);
        return $this->save($sql, $array);
    }

    // Obtiene la información de un comprador específico por su ID
    public function getComprador($idCliente)
    {
        $sql = "SELECT id, nombre, correo, clave FROM clientes WHERE id = $idCliente";
        return $this->select($sql);
    }

    // Modifica la información de un comprador en la base de datos
    public function modificar($id, $nombre, $correo, $clave)
    {
        $sql = "UPDATE clientes SET nombre=?, correo=?, clave=? WHERE id = ?";
        $array = array($nombre, $correo, $clave, $id);
        return $this->save($sql, $array);
    }
}
 
?>