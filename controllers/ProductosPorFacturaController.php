<?php
require_once 'models/ProductosPorFactura.php';

class ProductosPorFacturaController {

    // Mostrar los productos asociados a una factura
    public function index($factura_id) {
        $productosPorFactura = ProductosPorFactura::getByFacturaId($factura_id);
        require_once 'views/frmProductosPorFactura.php';
    }

    // Agregar un producto a una factura
    public function store($factura_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productoPorFactura = new ProductosPorFactura(
                $factura_id,
                $_POST['producto_id'],
                $_POST['cantidad'],
                $_POST['subtotal']
            );
            $productoPorFactura->save();
            header("Location: index.php?action=productosporfactura_index&factura_id=".$factura_id);
        }
    }

    // Eliminar un producto de la factura
    public function delete($id, $factura_id) {
        ProductosPorFactura::delete($id);
        header("Location: index.php?action=productosporfactura_index&factura_id=".$factura_id);
    }

    // Buscar productos por factura
    public function search($factura_id) {
        $productosPorFactura = [];
        if (isset($_POST['search_query'])) {
            $productosPorFactura = ProductosPorFactura::searchByFactura($factura_id);
        }
        require_once 'views/frmProductosPorFactura.php';
    }
}
?>
