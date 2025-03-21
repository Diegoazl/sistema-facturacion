<?php
require_once 'models/ProductosPorFactura.php';

class ProductosPorFacturaController {

    public function store($factura_id, $producto_id, $cantidad, $subtotal) {
        $productosPorFactura = new ProductosPorFactura($factura_id, $producto_id, $cantidad, $subtotal);
        $productosPorFactura->save();
        header("Location: index.php?action=factura_edit&id=" . $factura_id);
    }

    public function delete($id, $factura_id) {
        ProductosPorFactura::deleteById($id);
        header("Location: index.php?action=factura_edit&id=" . $factura_id);
    }

    public function deleteByFacturaId($factura_id) {
        ProductosPorFactura::deleteByFacturaId($factura_id);
        header("Location: index.php?action=factura_edit&id=" . $factura_id);
    }

    public function getAllByFacturaId($factura_id) {
        return ProductosPorFactura::getAllByFacturaId($factura_id);
    }
}
?>
