<?php
class Producto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear un producto
    public function crearProducto($codigo, $nombre, $stock, $valor_unitario) {
        $sql = "INSERT INTO productos (codigo, nombre, stock, valor_unitario) 
                VALUES (:codigo, :nombre, :stock, :valor_unitario)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $codigo,
            ':nombre' => $nombre,
            ':stock' => $stock,
            ':valor_unitario' => $valor_unitario
        ]);
    }

    // Obtener todos los productos
    public function obtenerProductos() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener producto por ID
    public function obtenerProductoPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un producto
    public function actualizarProducto($id, $codigo, $nombre, $stock, $valor_unitario) {
        $sql = "UPDATE productos SET codigo = :codigo, nombre = :nombre, stock = :stock, valor_unitario = :valor_unitario 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':codigo' => $codigo,
            ':nombre' => $nombre,
            ':stock' => $stock,
            ':valor_unitario' => $valor_unitario
        ]);
    }

    // Eliminar un producto
    public function eliminarProducto($id) {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
