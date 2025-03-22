<?php
require_once '../controllers/CtrProductosPorFactura.php';

$ctrProductosPorFactura = new CtrProductosPorFactura();

// Crear producto en factura
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'agregar') {
    $fknumfactura = $_POST['fknumfactura'];
    $fkcodproducto = $_POST['fkcodproducto'];
    $cantidad = $_POST['cantidad'];
    $subtotal = $_POST['subtotal'];
    $ctrProductosPorFactura->create($fknumfactura, $fkcodproducto, $cantidad, $subtotal);
}

// Obtener productos de la factura
$fknumfactura = isset($_GET['fknumfactura']) ? $_GET['fknumfactura'] : 0;
$productosPorFactura = $ctrProductosPorFactura->getByFactura($fknumfactura);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos por Factura</title>
    <link rel="stylesheet" href="/public/css/estilos.css">
</head>
<body>

<h1>Productos de la Factura</h1>

<!-- Formulario para agregar producto a factura -->
<form method="post">
    <input type="hidden" name="action" value="agregar">
    <label for="fknumfactura">Número de Factura:</label>
    <input type="text" name="fknumfactura" id="fknumfactura" value="<?php echo $fknumfactura; ?>" readonly><br>
    
    <label for="fkcodproducto">Código Producto:</label>
    <input type="text" name="fkcodproducto" id="fkcodproducto" required><br>
    
    <label for="cantidad">Cantidad:</label>
    <input type="number" name="cantidad" id="cantidad" required><br>
    
    <label for="subtotal">Subtotal:</label>
    <input type="number" name="subtotal" id="subtotal" required><br>
    
    <input type="submit" value="Agregar Producto">
</form>

<!-- Tabla de productos en la factura -->
<h2>Lista de Productos en la Factura</h2>
<table>
    <thead>
        <tr>
            <th>Código Producto</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productosPorFactura as $producto): ?>
            <tr>
                <td><?php echo $producto->getFkcodproducto(); ?></td>
                <td><?php echo $producto->getCantidad(); ?></td>
                <td><?php echo $producto->getSubtotal(); ?></td>
                <td>
                    <a href="editar_producto_factura.php?fknumfactura=<?php echo $producto->getFknumfactura(); ?>&fkcodproducto=<?php echo $producto->getFkcodproducto(); ?>">Editar</a> |
                    <a href="eliminar_producto_factura.php?fknumfactura=<?php echo $producto->getFknumfactura(); ?>&fkcodproducto=<?php echo $producto->getFkcodproducto(); ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="/public/js/script.js"></script>
</body>
</html>
