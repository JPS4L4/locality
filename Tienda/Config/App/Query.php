<?php
class Query extends Conexion{
    private $pdo, $con, $sql, $datos;
    public function __construct() {
        // Crea una conexión a la base de datos
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conect();
    }

    public function select(string $sql)
    {
        // Ejecuta una consulta SELECT y retorna el primer resultado
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectAll(string $sql)
    {
        // Ejecuta una consulta SELECT y retorna todos los resultados
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function save(string $sql, array $datos)
    {
        // Ejecuta una consulta INSERT, UPDATE o DELETE y retorna el resultado
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if ($data) {
            $res = 1;
        }else{
            $res = 0;
        }
        return $res;
    }
    
    public function insertar(string $sql, array $datos)
    {
        // Ejecuta una consulta INSERT y retorna el ID del registro insertado
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if ($data) {
            $res = $this->con->lastInsertId();
        } else {
            $res = 0;
        }
        return $res;
    }

    public function query($sql, $params = []) {
        // Ejecuta una consulta SQL con parámetros opcionales
        $statement = $this->con->prepare($sql);
        $statement->execute($params);
        return $statement;
    }
    
    public function getOne($result) {
        // Obtiene el primer resultado de una consulta
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
?>