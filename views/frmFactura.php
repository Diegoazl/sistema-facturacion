<!-- frmFactura.php -->
<div class="container">
    <h2>Gestión de Facturas</h2>

    <!-- Formulario para agregar o editar factura -->
    <h3><?= isset($factura) ? 'Editar Factura' : 'Agregar Nueva Factura' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($factura) ? 'editarFactura&id=' . $factura['id'] : 'crearFactura' ?>">
        <div class="form-group">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" class="form-control" value="<?= isset($factura) ? $factura['numero'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="cliente_id">Cliente ID:</label>
            <input type="text" id="cliente_id" name="cliente_id" class="form-control" value="<?= isset($factura) ? $factura['cliente_id'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="vendedor_id">Vendedor ID:</label>
            <input type="text" id="vendedor_id" name="vendedor_id" class="form-control" value="<?= isset($factura) ? $factura['vendedor_id'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="total">Total:</label>
            <input type="number" step="0.01" id="total" name="total" class="form-control" value="<?= isset($factura) ? $factura['total'] : '' ?>" required>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($factura) ? 'Actualizar Factura' : 'Agregar Factura' ?></button>
    </form>

    <hr>

    <!-- Tabla para mostrar las facturas existentes -->
    <h3>Facturas Registradas</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Número</th>
                <th>Cliente ID</th>
                <th>Vendedor ID</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura): ?>
                <tr>
                    <td><?= $factura['numero'] ?></td>
                    <td><?= $factura['cliente_id'] ?></td>
                    <td><?= $factura['vendedor_id'] ?></td>
                    <td><?= $factura['total'] ?></td>
                    <td>
                        <a href="index.php?action=editarFactura&id=<?= $factura['id'] ?>" class="btn btn-info">Editar</a>
                        <a href="index.php?action=eliminarFactura&id=<?= $factura['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta factura?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
