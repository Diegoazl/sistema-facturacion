<div class="container">
    <h2>Gestión de Facturas</h2>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="index.php">
        <label for="search">Buscar Factura:</label>
        <input type="text" name="search" id="search" placeholder="Buscar por número de factura">
        <button type="submit" name="action" value="buscarFacturas">Buscar</button>
    </form>

    <!-- Formulario para crear o editar factura -->
    <h3><?= isset($factura) ? 'Editar Factura' : 'Agregar Nueva Factura' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($factura) ? 'editarFactura&id=' . $factura['id'] : 'crearFactura' ?>">
        <div class="form-group">
            <label for="numero">Número de Factura:</label>
            <input type="text" name="numero" class="form-control" value="<?= isset($factura) ? $factura['numero'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" class="form-control">
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id'] ?>" <?= isset($factura) && $factura['cliente_id'] == $cliente['id'] ? 'selected' : '' ?>>
                        <?= $cliente['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="total">Total:</label>
            <input type="number" name="total" class="form-control" value="<?= isset($factura) ? $factura['total'] : '' ?>" required>
        </div>

        <button type="submit"><?= isset($factura) ? 'Actualizar Factura' : 'Crear Factura' ?></button>
    </form>

    <hr>

    <!-- Mostrar lista de facturas -->
    <h3>Facturas Registradas</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Número de Factura</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar facturas según la búsqueda (si hay un término de búsqueda)
            $facturas = isset($facturasBuscadas) ? $facturasBuscadas : $facturas;
            foreach ($facturas as $factura):
            ?>
                <tr>
                    <td><?= $factura['numero'] ?></td>
                    <td><?= $factura['cliente_id'] ?></td>
                    <td><?= $factura['total'] ?></td>
                    <td>
                        <a href="index.php?action=editarFactura&id=<?= $factura['id'] ?>">Editar</a>
                        <a href="index.php?action=eliminarFactura&id=<?= $factura['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar esta factura?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Regresar</a>
</div>
