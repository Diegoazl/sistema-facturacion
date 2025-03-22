<div class="container">
    <h2>Gestión de Clientes</h2>

    <!-- Formulario para crear o editar cliente -->
    <form method="POST" action="index.php?action=<?php echo isset($cliente) ? 'editarCliente&id='.$cliente['id'] : 'crearCliente'; ?>">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" value="<?php echo isset($cliente) ? $cliente['codigo'] : ''; ?>" required>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo isset($cliente) ? $cliente['nombre'] : ''; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($cliente) ? $cliente['email'] : ''; ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo isset($cliente) ? $cliente['telefono'] : ''; ?>" required>

        <button type="submit"><?php echo isset($cliente) ? 'Actualizar Cliente' : 'Agregar Cliente'; ?></button>
    </form>

    <!-- Mostrar lista de clientes -->
    <h3>Clientes Registrados</h3>
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
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['codigo']; ?></td>
                    <td><?php echo $cliente['nombre']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $cliente['telefono']; ?></td>
                    <td>
                        <a href="index.php?action=editarCliente&id=<?php echo $cliente['id']; ?>">Editar</a>
                        <a href="index.php?action=eliminarCliente&id=<?php echo $cliente['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
