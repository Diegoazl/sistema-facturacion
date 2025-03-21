<!-- frmVendedor.php -->
<div class="container">
    <h2>Gestión de Vendedores</h2>

    <!-- Formulario para agregar o editar vendedor -->
    <h3><?= isset($vendedor) ? 'Editar Vendedor' : 'Agregar Nuevo Vendedor' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($vendedor) ? 'editarVendedor&id=' . $vendedor['id'] : 'crearVendedor' ?>">
        <div class="form-group">
            <label for="persona_id">Persona ID:</label>
            <input type="text" id="persona_id" name="persona_id" class="form-control" value="<?= isset($vendedor) ? $vendedor['fk_persona_id'] : '' ?>" required>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($vendedor) ? 'Actualizar Vendedor' : 'Agregar Vendedor' ?></button>
    </form>

    <hr>

    <!-- Tabla para mostrar los vendedores existentes -->
    <h3>Vendedores Registrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Persona ID</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td><?= $vendedor['fk_persona_id'] ?></td>
                    <td>
                        <a href="index.php?action=editarVendedor&id=<?= $vendedor['id'] ?>" class="btn btn-info">Editar</a>
                        <a href="index.php?action=eliminarVendedor&id=<?= $vendedor['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este vendedor?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
