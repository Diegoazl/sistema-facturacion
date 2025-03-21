<div class="container">
    <h2>Gestión de Clientes</h2>

    <!-- Formulario para agregar o editar cliente -->
    <h3><?= isset($cliente) ? 'Editar Cliente' : 'Agregar Nuevo Cliente' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($cliente) ? 'editarCliente&id=' . $cliente['id'] : 'crearCliente' ?>">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" class="form-control" value="<?= isset($cliente) ? $cliente['codigo'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= isset($cliente) ? $cliente['nombre'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= isset($cliente) ? $cliente['email'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" class="form-control" value="<?= isset($cliente) ? $cliente['telefono'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="cliente" <?= (isset($cliente) && $cliente['tipo'] == 'cliente') ? 'selected' : '' ?>>Cliente</option>
                <option value="vendedor" <?= (isset($cliente) && $cliente['tipo'] == 'vendedor') ? 'selected' : '' ?>>Vendedor</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($cliente) ? 'Actualizar Cliente' : 'Agregar Cliente' ?></button>
    </form>

    <hr>

    <!-- Tabla para mostrar los clientes existentes -->
    <h3>Clientes Registrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Tipo</th>
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
                    <td><?= ucfirst($cliente['tipo']) ?></td>
                    <td>
                        <!-- Botón de editar -->
                        <a href="index.php?action=editarCliente&id=<?= $cliente['id'] ?>" class="btn btn-info">Editar</a>
                        <!-- Botón de eliminar -->
                        <a href="index.php?action=eliminarCliente&id=<?= $cliente['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
