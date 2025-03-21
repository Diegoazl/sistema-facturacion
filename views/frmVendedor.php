<?php include_once('header.php'); ?>

<h2>Gestionar Vendedores</h2>

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

    <label for="tipo">Tipo</label>
    <select name="tipo" required>
        <option value="vendedor" <?php echo isset($vendedor) && $vendedor['tipo'] == 'vendedor' ? 'selected' : ''; ?>>Vendedor</option>
    </select>

    <label for="carnet">Carnet</label>
    <input type="text" name="carnet" value="<?php echo isset($vendedor) ? $vendedor['carnet'] : ''; ?>" required>

    <label for="direccion">Dirección</label>
    <input type="text" name="direccion" value="<?php echo isset($vendedor) ? $vendedor['direccion'] : ''; ?>" required>

    <label for="empresa_id">Empresa ID</label>
    <input type="number" name="empresa_id" value="<?php echo isset($vendedor) ? $vendedor['empresa_id'] : ''; ?>" required>

    <label for="tipo_persona">Tipo Persona</label>
    <input type="text" name="tipo_persona" value="<?php echo isset($vendedor) ? $vendedor['tipo_persona'] : ''; ?>" required>

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
                <a href="index.php?action=vendedor_edit&id=<?php echo $vendedor['id']; ?>">Editar</a>
                <a href="index.php?action=vendedor_delete&id=<?php echo $vendedor['id']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once('footer.php'); ?>
