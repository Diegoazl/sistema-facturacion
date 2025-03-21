<?php
include_once '../models/Producto.php';
include_once '../config/database.php';

class CtrProducto {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function crearProducto($codigo, $nombre, $stock, $valor_unitario) {
        $query = "INSERT INTO productos (codigo, nombre, stock, valor_unitario)
                  VALUES ('$codigo', '$nombre', '$stock', '$valor_unitario')";
        $this->conn->exec($query);
    }

    public function obtenerProductos() {
        $query = "SELECT * FROM productos";
        return $this->conn->query($query)->fetchAll();
    }

    public function obtenerProductoPorId($id) {
        $query = "SELECT * FROM productos WHERE id = $id";
        return $this->conn->query($query)->fetch();
    }

    public function actualizarProducto($id, $codigo, $nombre, $stock, $valor_unitario) {
        $query = "UPDATE productos SET codigo = '$codigo', nombre = '$nombre', stock = '$stock', valor_unitario = '$valor_unitario' WHERE id = $id";
        $this->conn->exec($query);
    }

    public function eliminarProducto($id) {
        $query = "DELETE FROM productos WHERE id = $id";
        $this->conn->exec($query);
    }
}
?>
