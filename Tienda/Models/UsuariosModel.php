<?php
class UsuariosModel extends Query{
 
    // Constructor de la clase
    public function __construct()
    {
        parent::__construct();
    }

    // Obtiene todos los usuarios de la base de datos
    public function getUsuarios()
    {
        $sql = "SELECT id, nombres, apellidos, correo, perfil FROM usuarios";
        return $this->selectAll($sql);
    }

    // Registra un nuevo usuario en la base de datos
    public function registrar($nombre, $apellido, $correo, $clave)
    {
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo, clave) VALUES (?,?,?,?)";
        $array = array($nombre, $apellido, $correo, $clave);
        return $this->insertar($sql, $array); 
    }

    // Verifica si existe un usuario con el correo especificado
    public function verificarCorreo($correo)
    {
        $sql = "SELECT correo FROM usuarios WHERE correo = ?";
        return $this->select($sql);
    }

    // Elimina un usuario de la base de datos
    public function eliminar($idUser)
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $array = array($idUser);
        return $this->save($sql, $array);
    }

    // Obtiene un usuario específico de la base de datos
    public function getUsuario($idUser)
    {
        $sql = "SELECT id, nombres, apellidos, correo, clave FROM usuarios WHERE id = $idUser";
        return $this->select($sql);
    }

    // Modifica los datos de un usuario en la base de datos
    public function modificar($nombre, $apellido, $correo, $id)
    {
        $sql = "UPDATE usuarios SET nombres=?, apellidos=?, correo=? WHERE id = ?";
        $array = array($nombre, $apellido, $correo, $id);
        return $this->save($sql, $array);
    }
}
 
?>