<?php
require_once 'config/database.php';

class ProductosPorFactura {

    private $id;
    private $factura_id;
    private $producto_id;
    private $cantidad;
    private $subtotal;

    public function __construct($factura_id = 0, $producto_id = 0, $cantidad = 0, $subtotal = 0.0) {
        $this->factura_id = $factura_id;
        $this->producto_id = $producto_id;
        $this->cantidad = $cantidad;
        $this->subtotal = $subtotal;
    }

    // Guardar productos en una factura
    public function save() {
        global $pdo;
        $sql = "INSERT INTO productos_por_factura (factura_id, producto_id, cantidad, subtotal) 
                VALUES (:factura_id, :producto_id, :cantidad, :subtotal)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':factura_id' => $this->factura_id,
            ':producto_id' => $this->producto_id,
            ':cantidad' => $this->cantidad,
            ':subtotal' => $this->subtotal
        ]);
    }

    // Obtener todos los productos por factura
    public static function getByFacturaId($factura_id) {
        global $pdo;
        $sql = "SELECT * FROM productos_por_factura WHERE factura_id = :factura_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':factura_id' => $factura_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar productos de una factura
    public static function delete($id) {
        global $pdo;
        $sql = "DELETE FROM productos_por_factura WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Buscar productos por factura
    public static function searchByFactura($factura_id) {
        global $pdo;
        $sql = "SELECT * FROM productos_por_factura WHERE factura_id = :factura_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':factura_id' => $factura_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
