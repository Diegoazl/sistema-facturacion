
<?php
require_once '../models/ProductosPorFactura.php';
require_once '../models/Producto.php';
require_once '../models/Factura.php';

class ProductosPorFacturaController {
    public function create($data) {
        $productoModel = new Producto();
        $producto = $productoModel->getById($data['producto_id']);
        $data['subtotal'] = $producto['valor_unitario'] * $data['cantidad'];

        $model = new ProductosPorFactura();
        $model->create($data);

        // actualizar total en factura
        $facturaModel = new Factura();
        $items = $model->read($data['factura_id']);
        $total = array_sum(array_column($items, 'subtotal'));
        $facturaModel->updateTotal($data['factura_id'], $total);

        header("Location: frmProductosPorFactura.php?factura_id=" . $data['factura_id']);
    }

    public function read($factura_id) {
        $model = new ProductosPorFactura();
        return $model->read($factura_id);
    }

    public function delete($id, $factura_id) {
        $model = new ProductosPorFactura();
        $model->delete($id);

        // actualizar total
        $items = $model->read($factura_id);
        $total = array_sum(array_column($items, 'subtotal'));

        $facturaModel = new Factura();
        $facturaModel->updateTotal($factura_id, $total);

        header("Location: frmProductosPorFactura.php?factura_id=" . $factura_id);
    }
}
