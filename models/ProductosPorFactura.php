
<?php
require_once '../config/database.php';

class ProductosPorFactura extends Conexion {
    public function create($data) {
        $sql = "INSERT INTO productos_por_factura (factura_id, producto_id, cantidad, subtotal)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['factura_id'],
            $data['producto_id'],
            $data['cantidad'],
            $data['subtotal']
        ]);
    }

    public function read($factura_id) {
        $sql = "SELECT pf.*, p.nombre, p.valor_unitario
                FROM productos_por_factura pf
                JOIN productos p ON pf.producto_id = p.id
                WHERE pf.factura_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$factura_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM productos_por_factura WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}
