<div class="container">
    <h2>Gestión de Empresas</h2>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="index.php">
        <label for="search">Buscar Empresa:</label>
        <input type="text" name="search" id="search" placeholder="Buscar por código o nombre">
        <button type="submit" name="action" value="buscarEmpresas">Buscar</button>
    </form>

    <!-- Formulario para crear o editar empresa -->
    <h3><?= isset($empresa) ? 'Editar Empresa' : 'Agregar Nueva Empresa' ?></h3>
    <form method="POST" action="index.php?action=<?= isset($empresa) ? 'editarEmpresa&id=' . $empresa['id'] : 'crearEmpresa' ?>">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" name="codigo" class="form-control" value="<?= isset($empresa) ? $empresa['codigo'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= isset($empresa) ? $empresa['nombre'] : '' ?>" required>
        </div>

        <button type="submit"><?= isset($empresa) ? 'Actualizar Empresa' : 'Agregar Empresa' ?></button>
    </form>

    <hr>

    <!-- Mostrar lista de empresas -->
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
            <?php
            // Mostrar empresas según la búsqueda (si hay un término de búsqueda)
            $empresas = isset($empresasBuscadas) ? $empresasBuscadas : $empresas;
            foreach ($empresas as $empresa):
            ?>
                <tr>
                    <td><?= $empresa['codigo'] ?></td>
                    <td><?= $empresa['nombre'] ?></td>
                    <td>
                        <a href="index.php?action=editarEmpresa&id=<?= $empresa['id'] ?>">Editar</a>
                        <a href="index.php?action=eliminarEmpresa&id=<?= $empresa['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar esta empresa?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Regresar</a>
</div>
