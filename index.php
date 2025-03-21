<?php
// Incluir archivo de conexión
include_once 'config/database.php';

// Crear una instancia de la base de datos
$database = new Database();
$conn = $database->getConnection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Facturación</title>
    <link rel="stylesheet" href="styles.css"> <!-- Aquí puedes incluir tu CSS -->
</head>
<body>
    <header>
        <h1>Sistema de Facturación</h1>
        <nav>
            <ul>
                <li><a href="views/frmPersona.php">Personas</a></li>
                <li><a href="views/frmVendedor.php">Vendedores</a></li>
                <li><a href="views/frmCliente.php">Clientes</a></li>
                <li><a href="views/frmProducto.php">Productos</a></li>
                <li><a href="views/frmFactura.php">Facturas</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Bienvenido al Sistema de Facturación</h2>
        <p>Selecciona una opción en el menú para empezar a gestionar la información.</p>
    </main>

    <footer>
        <p>&copy; 2025 Sistema de Facturación</p>
    </footer>
</body>
</html>
