<?php
require_once 'controllers/ProductoController.php';
require_once 'controllers/ClienteController.php';
require_once 'controllers/VendedorController.php';
require_once 'controllers/FacturaController.php';
require_once 'controllers/ProductosPorFacturaController.php';
require_once 'controllers/EmpresaController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

// Controladores
$productoController = new ProductoController();
$clienteController = new ClienteController();
$vendedorController = new VendedorController();
$facturaController = new FacturaController();
$productosPorFacturaController = new ProductosPorFacturaController();
$empresaController = new EmpresaController();

switch ($action) {
    // Página de inicio (Dashboard)
    case 'dashboard':
        require_once 'views/dashboard.php';
        break;

    // Acciones de Empresa
    case 'empresa_index':
        $empresaController->index();
        break;
    case 'empresa_store':
        $empresaController->store();
        break;
    case 'empresa_edit':
        $empresaController->edit($_GET['id']);
        break;
    case 'empresa_update':
        $empresaController->update($_GET['id']);
        break;
    case 'empresa_delete':
        $empresaController->delete($_GET['id']);
        break;

    // Otros casos (Producto, Cliente, Vendedor, Factura)

    default:
        require_once 'views/dashboard.php';
}
?>
