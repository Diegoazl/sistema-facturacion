<?php
// Incluimos el controlador para obtener los clientes
include_once '../controllers/CtrCliente.php';
$ctrCliente = new CtrCliente();
$clientes = $ctrCliente->obtenerClientes();
?>

<!-- Formulario para agregar nuevo cliente -->
<h2>Agregar Cliente</h2>
<form method="post" action="../controllers/CrearCliente.php">
    <label for="codigo">Código:</label>
    <input type="text" id="codigo" name="codigo" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required><br>

    <label for="credito">Crédito:</label>
    <input type="number" id="credito" name="credito" required><br>

    <label for="empresa_id">Empresa:</label>
    <input type="text" id="empresa_id" name="empresa_id" required><br>

    <input type="submit" value="Agregar Cliente">
</form>

<!-- Lista de clientes -->
<h2>Clientes Existentes</h2>
<table border="1">
    <tr>
        <th>Código</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Crédito</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($clientes as $cliente): ?>
    <tr>
        <td><?php echo $cliente['codigo']; ?></td>
        <td><?php echo $cliente['email']; ?></td>
        <td><?php echo $cliente['nombre']; ?></td>
        <td><?php echo $cliente['telefono']; ?></td>
        <td><?php echo $cliente['credito']; ?></td>
        <td>
            <a href="editarCliente.php?id=<?php echo $cliente['id']; ?>">Editar</a> |
            <a href="eliminarCliente.php?id=<?php echo $cliente['id']; ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
