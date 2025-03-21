<?php include_once('header.php'); ?>

<div class="container">
    <h2>Gestionar Vendedores</h2>

    <!-- Formulario de búsqueda -->
    <form method="post" action="index.php?action=vendedor_search">
        <label for="search_query">Buscar Vendedor</label>
        <input type="text" name="search_query" placeholder="Buscar por código o nombre">
        <input type="submit" value="Buscar">
    </form>

    <!-- Formulario de creación o edición de Vendedor -->
    <form method="post" action="index.php?action=<?php echo isset($vendedor) ? 'vendedor_update&id='.$vendedor['id'] : 'vendedor_store'; ?>">
        <label for="codigo">Código</label>
        <input type="text" name="codigo" value="<?php echo isset($vendedor) ? $vendedor['codigo'] : ''; ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo isset($vendedor) ? $vendedor['email'] : ''; ?>" required>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?php echo isset($vendedor) ? $vendedor['nombre'] : ''; ?>" required>

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" value="<?php echo isset($vendedor) ? $vendedor['telefono'] : ''; ?>" required>

        <label for="carnet">Carnet</label>
        <input type="text" name="carnet" value="<?php echo isset($vendedor) ? $vendedor['carnet'] : ''; ?>" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" value="<?php echo isset($vendedor) ? $vendedor['direccion'] : ''; ?>" required>

        <label for="credito">Crédito</label>
        <input type="number" name="credito" value="<?php echo isset($vendedor) ? $vendedor['credito'] : ''; ?>" step="0.01" required>

        <label for="empresa_id">Empresa</label>
        <select name="empresa_id" required>
            <!-- Aquí se agregarán las empresas disponibles -->
            <?php foreach ($empresas as $empresa): ?>
            <option value="<?php echo $empresa['id']; ?>" <?php echo isset($vendedor) && $vendedor['empresa_id'] == $empresa['id'] ? 'selected' : ''; ?>>
                <?php echo $empresa['nombre']; ?>
            </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="<?php echo isset($vendedor) ? 'Actualizar Vendedor' : 'Guardar Vendedor'; ?>">
    </form>

    <!-- Tabla de vendedores -->
    <table>
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
            <?php foreach ($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor['codigo']; ?></td>
                <td><?php echo $vendedor['nombre']; ?></td>
                <td><?php echo $vendedor['email']; ?></td>
                <td><?php echo $vendedor['telefono']; ?></td>
                <td>
                    <a href="index.php?action=vendedor_edit&id=<?php echo $vendedor['id']; ?>" class="edit">Editar</a>
                    <a href="index.php?action=vendedor_delete&id=<?php echo $vendedor['id']; ?>" class="delete">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once('footer.php'); ?>
