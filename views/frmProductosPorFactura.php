<!-- frmProductosPorFactura.php -->
<div class="container">
    <h2>Productos de la Factura</h2>

    <!-- Tabla para mostrar los productos asociados a la factura -->
    <h3>Productos Asociados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Producto ID</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto['producto_id'] ?></td>
                    <td><?= $producto['cantidad'] ?></td>
                    <td><?= $producto['subtotal'] ?></td>
                    <td>
                        <a href="index.php?action=editarProductoPorFactura&id=<?= $producto['id'] ?>&factura_id=<?= $_GET['factura_id'] ?>" class="btn btn-info">Editar</a>
                        <a href="index.php?action=eliminarProductoDeFactura&id=<?= $producto['id'] ?>&factura_id=<?= $_GET['factura_id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto de la factura?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulario para agregar un nuevo producto a la factura -->
    <h3>Agregar Producto</h3>
    <form method="POST" action="index.php?action=agregarProducto&factura_id=<?= $_GET['factura_id'] ?>">
        <div class="form-group">
            <label for="producto_id">Producto ID:</label>
            <input type="text" id="producto_id" name="producto_id" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="subtotal">Subtotal:</label>
            <input type="number" step="0.01" id="subtotal" name="subtotal" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>
</div>
