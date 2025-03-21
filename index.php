<?php
require_once 'controllers/ProductoController.php';
require_once 'controllers/ClienteController.php';
require_once 'controllers/VendedorController.php';
require_once 'controllers/FacturaController.php';
require_once 'controllers/ProductosPorFacturaController.php';
require_once 'controllers/EmpresaController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Controladores
$productoController = new ProductoController();
$clienteController = new ClienteController();
$vendedorController = new VendedorController();
$facturaController = new FacturaController();
$productosPorFacturaController = new ProductosPorFacturaController();
$empresaController = new EmpresaController();

switch ($action) {
    // Acciones de Producto
    case 'producto_store':
        $productoController->store();
        break;
    case 'producto_index':
        $productoController->index();
        break;
    case 'producto_edit':
        $productoController->edit($_GET['id']);
        break;
    case 'producto_update':
        $productoController->update($_GET['id']);
        break;
    case 'producto_delete':
        $productoController->delete($_GET['id']);
        break;
    
    // Acciones de Cliente
    case 'cliente_store':
        $clienteController->store();
        break;
    case 'cliente_index':
        $clienteController->index();
        break;
    case 'cliente_edit':
        $clienteController->edit($_GET['id']);
        break;
    case 'cliente_update':
        $clienteController->update($_GET['id']);
        break;
    case 'cliente_delete':
        $clienteController->delete($_GET['id']);
        break;

    // Acciones de Vendedor
    case 'vendedor_store':
        $vendedorController->store();
        break;
    case 'vendedor_index':
        $vendedorController->index();
        break;
    case 'vendedor_edit':
        $vendedorController->edit($_GET['id']);
        break;
    case 'vendedor_update':
        $vendedorController->update($_GET['id']);
        break;
    case 'vendedor_delete':
        $vendedorController->delete($_GET['id']);
        break;

    // Acciones de Factura
    case 'factura_store':
        $facturaController->store();
        break;
    case 'factura_index':
        $facturaController->index();
        break;
    case 'factura_edit':
        $facturaController->edit($_GET['id']);
        break;
    case 'factura_update':
        $facturaController->update($_GET['id']);
        break;
    case 'factura_delete':
        $facturaController->delete($_GET['id']);
        break;

    // Acciones de ProductosPorFactura
    case 'productosporfactura_store':
        $productosPorFacturaController->store($_GET['factura_id'], $_POST['producto_id'], $_POST['cantidad'], $_POST['subtotal']);
        break;
    case 'productosporfactura_delete':
        $productosPorFacturaController->delete($_GET['id'], $_GET['factura_id']);
        break;

    // Acciones de Empresa
    case 'empresa_store':
        $empresaController->store();
        break;
    case 'empresa_index':
        $empresaController->index();
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

    default:
        $productoController->index();
}
?>
