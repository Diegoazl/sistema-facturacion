
<?php
require_once '../config/database.php';

class Producto extends Conexion {
    public function create($data) {
        $sql = "INSERT INTO productos (codigo, nombre, precio, stock) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data['codigo'], $data['nombre'], $data['precio'], $data['stock']]);
    }

    public function read() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $sql = "UPDATE productos SET codigo = ?, nombre = ?, precio = ?, stock = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data['codigo'], $data['nombre'], $data['precio'], $data['stock'], $data['id']]);
    }

    public function delete($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getById($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
