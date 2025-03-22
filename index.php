<?php
// Incluir la base de datos y los controladores
include 'config/database.php';   // Asegúrate de que la ruta a database.php sea correcta
include 'controllers/ClienteController.php'; // Asegúrate de que la ruta al controlador sea correcta
include 'controllers/ProductoController.php'; // Asegúrate de incluir el controlador para productos si se necesita

// Crear una instancia de los controladores
$clienteController = new ClienteController($pdo);  // Asegúrate de que $pdo esté configurado correctamente
$productoController = new ProductoController($pdo); // Instanciar ProductoController si es necesario

// Verificar si se recibe una acción a través de GET
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'mostrarClientes':
            $clienteController->mostrarClientes();
            break;

        case 'crearCliente':
            $clienteController->crearCliente();
            break;

        case 'editarCliente':
            $id = $_GET['id'];
            $clienteController->editarCliente($id);
            break;

        case 'eliminarCliente':
            $id = $_GET['id'];
            $clienteController->eliminarCliente($id);
            break;

        case 'mostrarProductos':
            $productoController->mostrarProductos();
            break;

        case 'crearProducto':
            $productoController->crearProducto();
            break;

        case 'editarProducto':
            $id = $_GET['id'];
            $productoController->editarProducto($id);
            break;

        case 'eliminarProducto':
            $id = $_GET['id'];
            $productoController->eliminarProducto($id);
            break;

        default:
            echo "Acción no válida.";  // Agregar mensajes más descriptivos en caso de error
            break;
    }
} else {
    // Si no se recibe ninguna acción, mostrar un mensaje de bienvenida
    echo "
    <div class='container'>
        <h2>Bienvenido al Sistema de Facturación</h2>
        <p>Seleccione una opción en el menú para empezar.</p>
    </div>";
}
?>
