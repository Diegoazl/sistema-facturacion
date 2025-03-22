<div class="container">
    <h2>Clientes Registrados</h2>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="index.php">
        <label for="search">Buscar Cliente:</label>
        <input type="text" name="search" id="search" placeholder="Buscar por nombre o código">
        <button type="submit" name="action" value="buscarClientes">Buscar</button>
    </form>

    <!-- Formulario para crear o editar cliente -->
    <h3><?= isset($cliente) ? 'Editar Cliente' : 'Agregar Nuevo Cliente' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($cliente) ? 'editarCliente&id=' . $cliente['id'] : 'crearCliente' ?>">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" name="codigo" class="form-control" value="<?= isset($cliente) ? $cliente['codigo'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= isset($cliente) ? $cliente['nombre'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="<?= isset($cliente) ? $cliente['email'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" class="form-control" value="<?= isset($cliente) ? $cliente['telefono'] : '' ?>" required>
        </div>

        <button type="submit"><?= isset($cliente) ? 'Actualizar Cliente' : 'Agregar Cliente' ?></button>
    </form>

    <hr>

    <!-- Mostrar lista de clientes -->
    <h3>Clientes Registrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= $cliente['codigo'] ?></td>
                    <td><?= $cliente['nombre'] ?></td>
                    <td><?= $cliente['email'] ?></td>
                    <td><?= $cliente['telefono'] ?></td>
                    <td>
                        <a href="index.php?action=editarCliente&id=<?= $cliente['id'] ?>">Editar</a>
                        <a href="index.php?action=eliminarCliente&id=<?= $cliente['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Regresar</a>
</div>
