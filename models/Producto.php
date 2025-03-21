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

    public function save() {
        global $pdo;
        $sql = "INSERT INTO productos (codigo, nombre, stock, valor_unitario) VALUES (:codigo, :nombre, :stock, :valor_unitario)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':nombre' => $this->nombre,
            ':stock' => $this->stock,
            ':valor_unitario' => $this->valor_unitario
        ]);
    }

    public static function getAll() {
        global $pdo;
        $sql = "SELECT * FROM productos";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        global $pdo;
        $sql = "UPDATE productos SET codigo = :codigo, nombre = :nombre, stock = :stock, valor_unitario = :valor_unitario WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':nombre' => $this->nombre,
            ':stock' => $this->stock,
            ':valor_unitario' => $this->valor_unitario,
            ':id' => $this->id
        ]);
    }

    public static function delete($id) {
        global $pdo;
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
