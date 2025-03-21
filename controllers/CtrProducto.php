<?php
include_once '../models/Producto.php';
include_once '../config/database.php';

class CtrProducto {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function crearProducto($codigo, $nombre, $precio, $stock) {
        $query = "INSERT INTO productos (codigo, nombre, precio, stock) 
                  VALUES ('$codigo', '$nombre', '$precio', '$stock')";
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

    public function actualizarProducto($id, $codigo, $nombre, $precio, $stock) {
        $query = "UPDATE productos SET codigo = '$codigo', nombre = '$nombre', precio = '$precio', stock = '$stock' WHERE id = $id";
        $this->conn->exec($query);
    }

    public function eliminarProducto($id) {
        $query = "DELETE FROM productos WHERE id = $id";
        $this->conn->exec($query);
    }
}
?>
