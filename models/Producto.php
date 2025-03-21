<?php
require_once 'config/database.php';

class Producto {

    private $id;
    private $codigo;
    private $nombre;
    private $stock;
    private $valor_unitario;

    public function __construct($codigo = "", $nombre = "", $stock = 0, $valor_unitario = 0.0) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->stock = $stock;
        $this->valor_unitario = $valor_unitario;
    }

    // Guardar producto
    public function save() {
        global $pdo;
        $sql = "INSERT INTO productos (codigo, nombre, stock, valor_unitario) 
                VALUES (:codigo, :nombre, :stock, :valor_unitario)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':nombre' => $this->nombre,
            ':stock' => $this->stock,
            ':valor_unitario' => $this->valor_unitario
        ]);
    }

    // Obtener todos los productos
    public static function getAll() {
        global $pdo;
        $sql = "SELECT * FROM productos";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un producto por su ID
    public static function getById($id) {
        global $pdo;
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar producto
    public function update($id) {
        global $pdo;
        $sql = "UPDATE productos SET codigo = :codigo, nombre = :nombre, stock = :stock, valor_unitario = :valor_unitario WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':nombre' => $this->nombre,
            ':stock' => $this->stock,
            ':valor_unitario' => $this->valor_unitario,
            ':id' => $id
        ]);
    }

    // Eliminar producto
    public static function delete($id) {
        global $pdo;
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Buscar productos por código o nombre
    public static function search($query) {
        global $pdo;
        $sql = "SELECT * FROM productos WHERE codigo LIKE :query OR nombre LIKE :query";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':query' => '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
