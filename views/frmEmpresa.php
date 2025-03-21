<?php include_once('header.php'); ?>

<h2>Gestionar Empresas</h2>

<!-- Formulario de creación o edición de Empresa -->
<form method="post" action="index.php?action=<?php echo isset($empresa) ? 'empresa_update&id='.$empresa['id'] : 'empresa_store'; ?>">
    <label for="codigo">Código</label>
    <input type="text" name="codigo" value="<?php echo isset($empresa) ? $empresa['codigo'] : ''; ?>" required>

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?php echo isset($empresa) ? $empresa['nombre'] : ''; ?>" required>

    <input type="submit" value="<?php echo isset($empresa) ? 'Actualizar Empresa' : 'Guardar Empresa'; ?>">
</form>

<!-- Tabla de empresas -->
<table>
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
            <td><?php echo $empresa['codigo']; ?></td>
            <td><?php echo $empresa['nombre']; ?></td>
            <td>
                <a href="index.php?action=empresa_edit&id=<?php echo $empresa['id']; ?>">Editar</a>
                <a href="index.php?action=empresa_delete&id=<?php echo $empresa['id']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once('footer.php'); ?>
