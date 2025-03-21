<!-- frmProducto.php -->
<div class="container">
    <h2>Gestión de Productos</h2>

    <!-- Formulario para agregar o editar producto -->
    <h3><?= isset($producto) ? 'Editar Producto' : 'Agregar Nuevo Producto' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($producto) ? 'editarProducto&id=' . $producto['id'] : 'crearProducto' ?>">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" class="form-control" value="<?= isset($producto) ? $producto['codigo'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= isset($producto) ? $producto['nombre'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" class="form-control" value="<?= isset($producto) ? $producto['stock'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="valor_unitario">Valor Unitario:</label>
            <input type="number" step="0.01" id="valor_unitario" name="valor_unitario" class="form-control" value="<?= isset($producto) ? $producto['valor_unitario'] : '' ?>" required>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($producto) ? 'Actualizar Producto' : 'Agregar Producto' ?></button>
    </form>

    <hr>

    <!-- Tabla para mostrar los productos existentes -->
    <h3>Productos Registrados</h3>
    <table class="table">
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
                <td><?= $producto['codigo'] ?></td>
                <td><?= $producto['nombre'] ?></td>
                <td><?= $producto['stock'] ?></td>
                <td><?= $producto['valor_unitario'] ?></td>
                <td>
                    <!-- Botón de editar -->
                    <a href="index.php?action=editarProducto&id=<?= $producto['id'] ?>" class="btn btn-info">Editar</a>
                    <!-- Botón de eliminar -->
                    <a href="index.php?action=eliminarProducto&id=<?= $producto['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
