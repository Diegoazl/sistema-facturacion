<?php
class Producto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear producto
    public function crearProducto($codigo, $nombre, $stock, $valor_unitario) {
        $sql = "INSERT INTO productos (codigo, nombre, stock, valor_unitario) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo, $nombre, $stock, $valor_unitario]);
    }

    // Obtener todos los productos
    public function obtenerProductos() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar productos por nombre o código
    public function buscarProductos($searchTerm) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE ? OR codigo LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $searchTerm . '%', '%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener producto por ID
    public function obtenerProducto($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar producto
    public function actualizarProducto($id, $codigo, $nombre, $stock, $valor_unitario) {
        $sql = "UPDATE productos SET codigo = ?, nombre = ?, stock = ?, valor_unitario = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo, $nombre, $stock, $valor_unitario, $id]);
    }

    // Eliminar producto
    public function eliminarProducto($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
