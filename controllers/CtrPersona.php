<?php
include_once '../models/Persona.php';
include_once '../config/database.php';

class CtrPersona {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function crearPersona($codigo, $email, $nombre, $telefono, $tipo, $carne = null, $direccion = null, $credito = null, $empresa_id = null, $tipo_persona = null) {
        $query = "INSERT INTO personas (codigo, email, nombre, telefono, tipo, carne, direccion, credito, empresa_id, tipo_persona)
                  VALUES ('$codigo', '$email', '$nombre', '$telefono', '$tipo', '$carne', '$direccion', '$credito', '$empresa_id', '$tipo_persona')";
        $this->conn->exec($query);
    }

    public function obtenerPersonas() {
        $query = "SELECT * FROM personas";
        return $this->conn->query($query)->fetchAll();
    }

    public function obtenerPersonaPorId($id) {
        $query = "SELECT * FROM personas WHERE id = $id";
        return $this->conn->query($query)->fetch();
    }

    public function actualizarPersona($id, $codigo, $email, $nombre, $telefono, $tipo, $carne, $direccion, $credito, $empresa_id, $tipo_persona) {
        $query = "UPDATE personas SET codigo = '$codigo', email = '$email', nombre = '$nombre', telefono = '$telefono', tipo = '$tipo', carne = '$carne', direccion = '$direccion', credito = '$credito', empresa_id = '$empresa_id', tipo_persona = '$tipo_persona' WHERE id = $id";
        $this->conn->exec($query);
    }

    public function eliminarPersona($id) {
        $query = "DELETE FROM personas WHERE id = $id";
        $this->conn->exec($query);
    }
}
?>
