
<?php
require_once '../config/database.php';

class Factura extends Conexion {
    public function create($data) {
        $sql = "INSERT INTO facturas (cliente_id, vendedor_id, fecha) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data['cliente_id'], $data['vendedor_id'], $data['fecha']]);
    }

    public function read() {
        $sql = "SELECT f.id, f.fecha, f.cliente_id, f.vendedor_id,
                       c.nombre AS cliente_nombre,
                       v.nombre AS vendedor_nombre
                FROM facturas f
                JOIN clientes c ON f.cliente_id = c.id
                JOIN vendedores v ON f.vendedor_id = v.id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $sql = "UPDATE facturas SET cliente_id = ?, vendedor_id = ?, fecha = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data['cliente_id'], $data['vendedor_id'], $data['fecha'], $data['id']]);
    }

    public function delete($id) {
        $sql = "DELETE FROM facturas WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getById($id) {
        $sql = "SELECT * FROM facturas WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

    public function updateTotal($id, $total) {
        $sql = "UPDATE facturas SET total = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$total, $id]);
    }
