<?php
include_once '../models/Vendedor.php';
include_once '../config/database.php';

class CtrVendedor {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function crearVendedor($codigo, $email, $nombre, $telefono, $carne, $direccion) {
        $query = "INSERT INTO vendedores (codigo, email, nombre, telefono, carne, direccion)
                  VALUES ('$codigo', '$email', '$nombre', '$telefono', '$carne', '$direccion')";
        $this->conn->exec($query);
    }

    public function obtenerVendedores() {
        $query = "SELECT * FROM vendedores";
        return $this->conn->query($query)->fetchAll();
    }

    public function obtenerVendedorPorId($id) {
        $query = "SELECT * FROM vendedores WHERE id = $id";
        return $this->conn->query($query)->fetch();
    }

    public function actualizarVendedor($id, $codigo, $email, $nombre, $telefono, $carne, $direccion) {
        $query = "UPDATE vendedores SET codigo = '$codigo', email = '$email', nombre = '$nombre', telefono = '$telefono', carne = '$carne', direccion = '$direccion' WHERE id = $id";
        $this->conn->exec($query);
    }

    public function eliminarVendedor($id) {
        $query = "DELETE FROM vendedores WHERE id = $id";
        $this->conn->exec($query);
    }
}
?>
