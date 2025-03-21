<?php
// Incluir el controlador para obtener las facturas
include_once '../controllers/CtrFactura.php';
$ctrFactura = new CtrFactura();
$facturas = $ctrFactura->obtenerFacturas();
?>

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

<h2>Facturas Existentes</h2>
<table border="1">
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
            <a href="eliminarFactura.php?id=<?php echo $factura['id']; ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
