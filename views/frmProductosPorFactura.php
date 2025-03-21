<?php include_once('header.php'); ?>

<div class="container">
    <h2>Gestionar Productos en la Factura</h2>

    <!-- Formulario de búsqueda -->
    <form method="post" action="index.php?action=productosporfactura_search&factura_id=<?php echo $factura_id; ?>">
        <label for="search_query">Buscar Producto</label>
        <input type="text" name="search_query" placeholder="Buscar por producto">
        <input type="submit" value="Buscar">
    </form>

    <!-- Formulario de agregar producto a la factura -->
    <form method="post" action="index.php?action=productosporfactura_store&factura_id=<?php echo $factura_id; ?>">
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

    <!-- Tabla de productos por factura -->
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
                    <a href="index.php?action=productosporfactura_delete&id=<?php echo $productoPorFactura['id']; ?>&factura_id=<?php echo $factura_id; ?>" class="delete">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once('footer.php'); ?>
