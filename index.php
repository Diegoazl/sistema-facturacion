<?php
include 'config/database.php';
include 'controllers/FacturaController.php';

$facturaController = new FacturaController($pdo);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'mostrarFacturas':
            $facturaController->mostrarFacturas();
            break;
        case 'crearFactura':
            $facturaController->crearFactura();
            break;
        case 'editarFactura':
            $id = $_GET['id'];
            $facturaController->editarFactura($id);
            break;
        case 'eliminarFactura':
            $id = $_GET['id'];
            $facturaController->eliminarFactura($id);
            break;
        case 'buscarFacturas':
            $facturaController->mostrarFacturas();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
    echo "Bienvenido al sistema de facturación.";
}
?>
