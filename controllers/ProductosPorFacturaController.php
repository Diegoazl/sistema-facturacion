<?php
require_once 'models/ProductosPorFactura.php';

class ProductosPorFacturaController {
    private $productosPorFacturaModel;

    public function __construct($pdo) {
        $this->productosPorFacturaModel = new ProductosPorFactura($pdo);
    }

    // Mostrar productos de una factura
    public function mostrar($factura_id) {
        $productos = $this->productosPorFacturaModel->obtenerProductosPorFactura($factura_id);
        include 'views/frmProductosPorFactura.php'; // Mostrar la vista de productos por factura
    }

    // Agregar producto a una factura
    public function agregar($factura_id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $producto_id = $_POST['producto_id'];
            $cantidad = $_POST['cantidad'];
            $subtotal = $_POST['subtotal'];

            // Llamar al modelo para agregar el producto a la factura
            $this->productosPorFacturaModel->agregarProductoAFactura($factura_id, $producto_id, $cantidad, $subtotal);
            header("Location: index.php?action=mostrarProductosPorFactura&factura_id=" . $factura_id); // Redirigir a la lista de productos de la factura
        }
        include 'views/frmAgregarProducto.php'; // Mostrar la vista de agregar producto
    }

    // Actualizar cantidad de un producto en una factura
    public function actualizar($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cantidad = $_POST['cantidad'];
            $subtotal = $_POST['subtotal'];

            // Llamar al modelo para actualizar la cantidad y subtotal
            $this->productosPorFacturaModel->actualizarCantidad($id, $cantidad, $subtotal);
            header("Location: index.php?action=mostrarProductosPorFactura&factura_id=" . $_POST['factura_id']); // Redirigir después de actualizar
        }
    }

    // Eliminar producto de una factura
    public function eliminar($id, $factura_id) {
        $this->productosPorFacturaModel->eliminarProductoDeFactura($id);
        header("Location: index.php?action=mostrarProductosPorFactura&factura_id=" . $factura_id); // Redirigir después de eliminar
    }
}
?>
