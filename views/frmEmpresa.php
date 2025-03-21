<!-- frmEmpresa.php -->
<div class="container">
    <h2>Gestión de Empresas</h2>

    <!-- Formulario para crear o editar empresa -->
    <h3><?= isset($empresa) ? 'Editar Empresa' : 'Agregar Nueva Empresa' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($empresa) ? 'storeOrUpdate&id=' . $empresa['id'] : 'storeOrUpdate' ?>">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" class="form-control" value="<?= isset($empresa) ? $empresa['codigo'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= isset($empresa) ? $empresa['nombre'] : '' ?>" required>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($empresa) ? 'Actualizar Empresa' : 'Guardar Empresa' ?></button>
    </form>

    <hr>

    <!-- Tabla de empresas existentes -->
    <h3>Empresas Registradas</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empresas as $empresa): ?>
            <tr>
                <td><?= $empresa['codigo'] ?></td>
                <td><?= $empresa['nombre'] ?></td>
                <td>
                    <a href="index.php?action=empresa_edit&id=<?= $empresa['id'] ?>" class="btn btn-info">Editar</a>
                    <a href="index.php?action=empresa_delete&id=<?= $empresa['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta empresa?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
