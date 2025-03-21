<?php
include_once '../models/Cliente.php';
include_once '../config/database.php';

class CtrCliente {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function crearCliente($codigo, $email, $nombre, $telefono, $credito, $empresa_id) {
        $query = "INSERT INTO clientes (codigo, email, nombre, telefono, credito, empresa_id) 
                  VALUES ('$codigo', '$email', '$nombre', '$telefono', '$credito', '$empresa_id')";
        $this->conn->exec($query);
    }

    public function obtenerClientes() {
        $query = "SELECT * FROM clientes";
        return $this->conn->query($query)->fetchAll();
    }

    public function obtenerClientePorId($id) {
        $query = "SELECT * FROM clientes WHERE id = $id";
        return $this->conn->query($query)->fetch();
    }

    public function actualizarCliente($id, $codigo, $email, $nombre, $telefono, $credito, $empresa_id) {
        $query = "UPDATE clientes SET codigo = '$codigo', email = '$email', nombre = '$nombre', telefono = '$telefono', credito = '$credito', empresa_id = '$empresa_id' WHERE id = $id";
        $this->conn->exec($query);
    }

    public function eliminarCliente($id) {
        $query = "DELETE FROM clientes WHERE id = $id";
        $this->conn->exec($query);
    }
}
?>
