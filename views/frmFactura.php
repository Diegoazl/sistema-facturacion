<?php include_once('header.php'); ?>

<div class="container">
    <h2>Gestionar Facturas</h2>

    <!-- Formulario de búsqueda -->
    <form method="post" action="index.php?action=factura_search">
        <label for="search_query">Buscar Factura</label>
        <input type="text" name="search_query" placeholder="Buscar por número o cliente">
        <input type="submit" value="Buscar">
    </form>

    <!-- Formulario de creación o edición de Factura -->
    <form method="post" action="index.php?action=<?php echo isset($factura) ? 'factura_update&id='.$factura['id'] : 'factura_store'; ?>">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" value="<?php echo isset($factura) ? $factura['fecha'] : ''; ?>" required>

        <label for="numero">Número</label>
        <input type="text" name="numero" value="<?php echo isset($factura) ? $factura['numero'] : ''; ?>" required>

        <label for="total">Total</label>
        <input type="number" name="total" value="<?php echo isset($factura) ? $factura['total'] : ''; ?>" step="0.01" required>

        <label for="cliente_id">Cliente</label>
        <input type="number" name="cliente_id" value="<?php echo isset($factura) ? $factura['cliente_id'] : ''; ?>" required>

        <label for="vendedor_id">Vendedor</label>
        <input type="number" name="vendedor_id" value="<?php echo isset($factura) ? $factura['vendedor_id'] : ''; ?>" required>

        <input type="submit" value="<?php echo isset($factura) ? 'Actualizar Factura' : 'Guardar Factura'; ?>">
    </form>

    <!-- Tabla de facturas -->
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Número</th>
                <th>Total</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura): ?>
            <tr>
                <td><?php echo $factura['fecha']; ?></td>
                <td><?php echo $factura['numero']; ?></td>
                <td><?php echo $factura['total']; ?></td>
                <td><?php echo $factura['cliente_id']; ?></td>
                <td><?php echo $factura['vendedor_id']; ?></td>
                <td>
                    <a href="index.php?action=factura_edit&id=<?php echo $factura['id']; ?>" class="edit">Editar</a>
                    <a href="index.php?action=factura_delete&id=<?php echo $factura['id']; ?>" class="delete">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once('footer.php'); ?>
