<?php
include_once '../models/Vendedor.php';
include_once '../config/database.php';

class CtrVendedor {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function crearVendedor($codigo, $email, $nombre, $telefono, $carne, $direccion, $tipo_persona) {
        $query = "INSERT INTO personas (codigo, email, nombre, telefono, tipo, carne, direccion, tipo_persona)
                  VALUES ('$codigo', '$email', '$nombre', '$telefono', 'vendedor', '$carne', '$direccion', '$tipo_persona')";
        $this->conn->exec($query);
    }

    public function obtenerVendedores() {
        $query = "SELECT * FROM personas WHERE tipo = 'vendedor'";
        return $this->conn->query($query)->fetchAll();
    }

    public function obtenerVendedorPorId($id) {
        $query = "SELECT * FROM personas WHERE id = $id AND tipo = 'vendedor'";
        return $this->conn->query($query)->fetch();
    }

    public function actualizarVendedor($id, $codigo, $email, $nombre, $telefono, $carne, $direccion, $tipo_persona) {
        $query = "UPDATE personas SET codigo = '$codigo', email = '$email', nombre = '$nombre', telefono = '$telefono', carne = '$carne', direccion = '$direccion', tipo_persona = '$tipo_persona' WHERE id = $id AND tipo = 'vendedor'";
        $this->conn->exec($query);
    }

    public function eliminarVendedor($id) {
        $query = "DELETE FROM personas WHERE id = $id AND tipo = 'vendedor'";
        $this->conn->exec($query);
    }
}
?>
