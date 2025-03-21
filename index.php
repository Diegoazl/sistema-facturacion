<?php
include 'config/database.php';
include 'controllers/ProductosPorFacturaController.php';

$productosPorFacturaController = new ProductosPorFacturaController($pdo);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'mostrarProductosPorFactura':
            if (isset($_GET['factura_id']) && is_numeric($_GET['factura_id'])) {
                $factura_id = $_GET['factura_id'];
                $productosPorFacturaController->mostrar($factura_id);
            } else {
                echo "ID de factura no válido.";
                exit;
            }
            break;
        
        case 'agregarProducto':
            if (isset($_GET['factura_id']) && is_numeric($_GET['factura_id'])) {
                $factura_id = $_GET['factura_id'];
                $productosPorFacturaController->agregar($factura_id);
            } else {
                echo "ID de factura no válido.";
                exit;
            }
            break;

        case 'eliminarProductoDeFactura':
            if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['factura_id']) && is_numeric($_GET['factura_id'])) {
                $id = $_GET['id'];
                $factura_id = $_GET['factura_id'];
                $productosPorFacturaController->eliminar($id, $factura_id);
            } else {
                echo "Parámetros no válidos.";
                exit;
            }
            break;

        case 'editarProductoPorFactura':
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $productosPorFacturaController->actualizar($id);
            } else {
                echo "ID de producto no válido.";
                exit;
            }
            break;

        default:
            echo "Acción no válida.";
            break;
    }
} else {
    echo "Bienvenido al sistema de facturación.";
}
?>
