<?php
include_once '../controllers/CtrFactura.php';
$ctrFactura = new CtrFactura();
$facturas = $ctrFactura->obtenerFacturas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Facturas</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <!-- Formulario para agregar nueva factura -->
        <h2>Agregar Factura</h2>
        <form method="post" action="../controllers/CrearFactura.php">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required><br>

            <label for="numero">Número de Factura:</label>
            <input type="text" id="numero" name="numero" required><br>

            <label for="total">Total:</label>
            <input type="number" id="total" name="total" required><br>

            <label for="cliente_id">Cliente:</label>
            <input type="text" id="cliente_id" name="cliente_id" required><br>

            <label for="vendedor_id">Vendedor:</label>
            <input type="text" id="vendedor_id" name="vendedor_id" required><br>

            <input type="submit" value="Crear Factura">
        </form>

        <!-- Lista de facturas -->
        <h2>Facturas Existentes</h2>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Número</th>
                <th>Total</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($facturas as $factura): ?>
            <tr>
                <td><?php echo $factura['fecha']; ?></td>
                <td><?php echo $factura['numero']; ?></td>
                <td><?php echo $factura['total']; ?></td>
                <td><?php echo $factura['cliente_id']; ?></td>
                <td><?php echo $factura['vendedor_id']; ?></td>
                <td>
                    <a href="editarFactura.php?id=<?php echo $factura['id']; ?>">Editar</a> |
                    <a href="../controllers/eliminarFactura.php?id=<?php echo $factura['id']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 Sistema de Facturación</p>
    </footer>
</body>
</html>
