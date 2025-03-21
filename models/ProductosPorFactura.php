<?php
class ProductosPorFactura {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Agregar producto a una factura
    public function agregarProductoAFactura($factura_id, $producto_id, $cantidad, $subtotal) {
        $sql = "INSERT INTO productos_por_factura (factura_id, producto_id, cantidad, subtotal) 
                VALUES (:factura_id, :producto_id, :cantidad, :subtotal)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':factura_id' => $factura_id,
            ':producto_id' => $producto_id,
            ':cantidad' => $cantidad,
            ':subtotal' => $subtotal
        ]);
    }

    // Obtener productos de una factura
    public function obtenerProductosPorFactura($factura_id) {
        $sql = "SELECT * FROM productos_por_factura WHERE factura_id = :factura_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':factura_id' => $factura_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar la cantidad de un producto en una factura
    public function actualizarCantidad($id, $cantidad, $subtotal) {
        $sql = "UPDATE productos_por_factura SET cantidad = :cantidad, subtotal = :subtotal WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':cantidad' => $cantidad,
            ':subtotal' => $subtotal
        ]);
    }

    // Eliminar producto de una factura
    public function eliminarProductoDeFactura($id) {
        $sql = "DELETE FROM productos_por_factura WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
