<div class="container">
    <h2>Gestión de Vendedores</h2>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="index.php">
        <label for="search">Buscar Vendedor:</label>
        <input type="text" name="search" id="search" placeholder="Buscar por nombre o código">
        <button type="submit" name="action" value="buscarVendedores">Buscar</button>
    </form>

    <!-- Formulario para crear o editar vendedor -->
    <h3><?= isset($vendedor) ? 'Editar Vendedor' : 'Agregar Nuevo Vendedor' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($vendedor) ? 'editarVendedor&id=' . $vendedor['id'] : 'crearVendedor' ?>">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" name="codigo" class="form-control" value="<?= isset($vendedor) ? $vendedor['codigo'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= isset($vendedor) ? $vendedor['nombre'] : '' ?>" required>
        </div>

        <button type="submit"><?= isset($vendedor) ? 'Actualizar Vendedor' : 'Agregar Vendedor' ?></button>
    </form>

    <hr>

    <!-- Mostrar lista de vendedores -->
    <h3>Vendedores Registrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar vendedores según la búsqueda (si hay un término de búsqueda)
            $vendedores = isset($vendedoresBuscados) ? $vendedoresBuscados : $vendedores;
            foreach ($vendedores as $vendedor):
            ?>
                <tr>
                    <td><?= $vendedor['codigo'] ?></td>
                    <td><?= $vendedor['nombre'] ?></td>
                    <td>
                        <a href="index.php?action=editarVendedor&id=<?= $vendedor['id'] ?>">Editar</a>
                        <a href="index.php?action=eliminarVendedor&id=<?= $vendedor['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este vendedor?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Regresar</a>
</div>
