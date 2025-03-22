
<?php
require_once '../controllers/ProductosPorFacturaController.php';
require_once '../controllers/ProductoController.php';

$controller = new ProductosPorFacturaController();
$productoController = new ProductoController();

$factura_id = $_GET['factura_id'] ?? null;
if (!$factura_id) die("Factura no especificada.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->create($_POST);
}

if (isset($_GET['delete'])) {
    $controller->delete($_GET['delete'], $factura_id);
}

$productos = $productoController->read();
$detalles = $controller->read($factura_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Productos por Factura</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Productos para la Factura #<?= $factura_id ?></h2>
    <form method="POST">
        <input type="hidden" name="factura_id" value="<?= $factura_id ?>">
        <label>Producto:</label>
        <select name="producto_id" required>
            <option value="">Seleccione</option>
            <?php foreach ($productos as $p): ?>
                <option value="<?= $p['id'] ?>"><?= $p['nombre'] ?> - $<?= $p['valor_unitario'] ?></option>
            <?php endforeach ?>
        </select>
        <label>Cantidad:</label>
        <input type="number" name="cantidad" required>
        <button class="btn" type="submit">Agregar</button>
    </form>

    <h3>Detalle</h3>
    <table>
        <thead>
            <tr><th>Producto</th><th>Valor Unitario</th><th>Cantidad</th><th>Subtotal</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $item): ?>
                <tr>
                    <td><?= $item['nombre'] ?></td>
                    <td>$<?= $item['valor_unitario'] ?></td>
                    <td><?= $item['cantidad'] ?></td>
                    <td>$<?= $item['subtotal'] ?></td>
                    <td><a class="btn" href="?factura_id=<?= $factura_id ?>&delete=<?= $item['id'] ?>" onclick="return confirm('¿Eliminar producto?')">Eliminar</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <br>
    <a href="frmFactura.php" class="btn">← Volver a Facturas</a>
</div>
</body>
</html>
