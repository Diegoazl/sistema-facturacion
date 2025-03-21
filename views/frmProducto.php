<?php include_once('header.php'); ?>

<div class="container">
    <h2>Gestionar Productos</h2>

    <!-- Formulario de creación o edición de Producto -->
    <form method="post" action="index.php?action=<?php echo isset($producto) ? 'producto_update&id='.$producto['id'] : 'producto_store'; ?>">
        <label for="codigo">Código</label>
        <input type="text" name="codigo" value="<?php echo isset($producto) ? $producto['codigo'] : ''; ?>" required>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?php echo isset($producto) ? $producto['nombre'] : ''; ?>" required>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?php echo isset($producto) ? $producto['stock'] : ''; ?>" required>

        <label for="valor_unitario">Valor Unitario</label>
        <input type="number" name="valor_unitario" value="<?php echo isset($producto) ? $producto['valor_unitario'] : ''; ?>" step="0.01" required>

        <input type="submit" value="<?php echo isset($producto) ? 'Actualizar Producto' : 'Guardar Producto'; ?>">
    </form>

    <!-- Tabla de productos -->
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Valor Unitario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo $producto['codigo']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['stock']; ?></td>
                <td><?php echo $producto['valor_unitario']; ?></td>
                <td>
                    <a href="index.php?action=producto_edit&id=<?php echo $producto['id']; ?>" class="edit">Editar</a>
                    <a href="index.php?action=producto_delete&id=<?php echo $producto['id']; ?>" class="delete">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once('footer.php'); ?>
