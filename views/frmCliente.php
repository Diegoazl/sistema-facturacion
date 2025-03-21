<?php include_once('header.php'); ?>

<div class="container">
    <h2>Gestionar Clientes</h2>

    <!-- Formulario de creación o edición de Cliente -->
    <form method="post" action="index.php?action=<?php echo isset($cliente) ? 'cliente_update&id='.$cliente['id'] : 'cliente_store'; ?>">
        <label for="codigo">Código</label>
        <input type="text" name="codigo" value="<?php echo isset($cliente) ? $cliente['codigo'] : ''; ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo isset($cliente) ? $cliente['email'] : ''; ?>" required>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?php echo isset($cliente) ? $cliente['nombre'] : ''; ?>" required>

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" value="<?php echo isset($cliente) ? $cliente['telefono'] : ''; ?>" required>

        <label for="tipo">Tipo</label>
        <select name="tipo" required>
            <option value="cliente" <?php echo isset($cliente) && $cliente['tipo'] == 'cliente' ? 'selected' : ''; ?>>Cliente</option>
        </select>

        <label for="carnet">Carnet</label>
        <input type="text" name="carnet" value="<?php echo isset($cliente) ? $cliente['carnet'] : ''; ?>">

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" value="<?php echo isset($cliente) ? $cliente['direccion'] : ''; ?>" required>

        <label for="credito">Crédito</label>
        <input type="number" name="credito" value="<?php echo isset($cliente) ? $cliente['credito'] : ''; ?>" step="0.01" required>

        <label for="empresa_id">Empresa</label>
        <select name="empresa_id" required>
            <?php foreach ($empresas as $empresa): ?>
            <option value="<?php echo $empresa['id']; ?>" <?php echo isset($cliente) && $cliente['empresa_id'] == $empresa['id'] ? 'selected' : ''; ?>>
                <?php echo $empresa['nombre']; ?>
            </option>
            <?php endforeach; ?>
        </select>

        <label for="tipo_persona">Tipo Persona</label>
        <input type="text" name="tipo_persona" value="<?php echo isset($cliente) ? $cliente['tipo_persona'] : ''; ?>" required>

        <input type="submit" value="<?php echo isset($cliente) ? 'Actualizar Cliente' : 'Guardar Cliente'; ?>">
    </form>

    <!-- Tabla de clientes -->
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Empresa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?php echo $cliente['codigo']; ?></td>
                <td><?php echo $cliente['nombre']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td><?php echo $cliente['telefono']; ?></td>
                <td><?php echo $empresa['nombre']; ?></td>
                <td>
                    <a href="index.php?action=cliente_edit&id=<?php echo $cliente['id']; ?>" class="edit">Editar</a>
                    <a href="index.php?action=cliente_delete&id=<?php echo $cliente['id']; ?>" class="delete">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once('footer.php'); ?>
