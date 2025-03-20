<?php
include_once '../model/Persona.php';

class CtrPersona {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPersona($codigo) {
        $sql = "SELECT * FROM personas WHERE codigo = '$codigo'";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_assoc();
    }

    public function crearPersona($persona) {
        $sql = "INSERT INTO personas (codigo, email, nombre, telefono) 
                VALUES ('{$persona->getCodigo()}', '{$persona->getEmail()}', '{$persona->getNombre()}', '{$persona->getTelefono()}')";
        return $this->conexion->query($sql);
    }
}
?>
