<?php include_once('header.php'); ?>

<h2>Productos en la Factura #<?php echo $factura['id']; ?></h2>

<!-- Formulario para agregar productos a la factura -->
<form method="post" action="index.php?action=productosporfactura_store&factura_id=<?php echo $factura['id']; ?>">
    <label for="producto_id">Producto</label>
    <select name="producto_id" required>
        <?php foreach ($productos as $producto): ?>
        <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="cantidad">Cantidad</label>
    <input type="number" name="cantidad" required>

    <label for="subtotal">Subtotal</label>
    <input type="number" name="subtotal" step="0.01" required>

    <input type="submit" value="Agregar Producto">
</form>

<!-- Tabla de productos asociados a la factura -->
<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productosPorFactura as $productoPorFactura): ?>
        <tr>
            <td><?php echo $productoPorFactura['producto_id']; ?></td>
            <td><?php echo $productoPorFactura['cantidad']; ?></td>
            <td><?php echo $productoPorFactura['subtotal']; ?></td>
            <td>
                <a href="index.php?action=productosporfactura_delete&id=<?php echo $productoPorFactura['id']; ?>&factura_id=<?php echo $factura['id']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once('footer.php'); ?>
