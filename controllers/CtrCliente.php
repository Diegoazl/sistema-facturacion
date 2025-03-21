<?php
include_once '../models/Cliente.php';
include_once '../config/database.php';

class CtrCliente {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function crearCliente($codigo, $email, $nombre, $telefono, $credito, $empresa_id, $tipo_persona) {
        $query = "INSERT INTO personas (codigo, email, nombre, telefono, tipo, credito, empresa_id, tipo_persona)
                  VALUES ('$codigo', '$email', '$nombre', '$telefono', 'cliente', '$credito', '$empresa_id', '$tipo_persona')";
        $this->conn->exec($query);
    }

    public function obtenerClientes() {
        $query = "SELECT * FROM personas WHERE tipo = 'cliente'";
        return $this->conn->query($query)->fetchAll();
    }

    public function obtenerClientePorId($id) {
        $query = "SELECT * FROM personas WHERE id = $id AND tipo = 'cliente'";
        return $this->conn->query($query)->fetch();
    }

    public function actualizarCliente($id, $codigo, $email, $nombre, $telefono, $credito, $empresa_id, $tipo_persona) {
        $query = "UPDATE personas SET codigo = '$codigo', email = '$email', nombre = '$nombre', telefono = '$telefono', credito = '$credito', empresa_id = '$empresa_id', tipo_persona = '$tipo_persona' WHERE id = $id AND tipo = 'cliente'";
        $this->conn->exec($query);
    }

    public function eliminarCliente($id) {
        $query = "DELETE FROM personas WHERE id = $id AND tipo = 'cliente'";
        $this->conn->exec($query);
    }
}
?>
