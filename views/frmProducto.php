<div class="container">
    <h2>Gestión de Productos</h2>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="index.php">
        <label for="search">Buscar Producto:</label>
        <input type="text" name="search" id="search" placeholder="Buscar por nombre o código">
        <button type="submit" name="action" value="buscarProductos">Buscar</button>
    </form>

    <!-- Formulario para crear o editar producto -->
    <h3><?= isset($producto) ? 'Editar Producto' : 'Agregar Nuevo Producto' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($producto) ? 'editarProducto&id=' . $producto['id'] : 'crearProducto' ?>">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" name="codigo" class="form-control" value="<?= isset($producto) ? $producto['codigo'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= isset($producto) ? $producto['nombre'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" class="form-control" value="<?= isset($producto) ? $producto['stock'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="valor_unitario">Valor Unitario:</label>
            <input type="number" name="valor_unitario" class="form-control" value="<?= isset($producto) ? $producto['valor_unitario'] : '' ?>" required>
        </div>

        <button type="submit"><?= isset($producto) ? 'Actualizar Producto' : 'Agregar Producto' ?></button>
    </form>

    <hr>

    <!-- Mostrar lista de productos -->
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
            <?php
            // Mostrar productos según la búsqueda (si hay un término de búsqueda)
            $productos = isset($productosBuscados) ? $productosBuscados : $productos;
            foreach ($productos as $producto):
            ?>
                <tr>
                    <td><?= $producto['codigo'] ?></td>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= $producto['stock'] ?></td>
                    <td><?= $producto['valor_unitario'] ?></td>
                    <td>
                        <a href="index.php?action=editarProducto&id=<?= $producto['id'] ?>">Editar</a>
                        <a href="index.php?action=eliminarProducto&id=<?= $producto['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Regresar</a>
</div>
