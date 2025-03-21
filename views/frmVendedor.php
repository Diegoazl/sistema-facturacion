<?php
include_once '../controllers/CtrVendedor.php';
$ctrVendedor = new CtrVendedor();
$vendedores = $ctrVendedor->obtenerVendedores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Vendedores</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <!-- Formulario para agregar nuevo vendedor -->
        <h2>Agregar Vendedor</h2>
        <form method="post" action="../controllers/CrearVendedor.php">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required><br>

            <label for="carne">Carné:</label>
            <input type="text" id="carne" name="carne" required><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required><br>

            <input type="submit" value="Agregar Vendedor">
        </form>

        <!-- Lista de vendedores -->
        <h2>Vendedores Existentes</h2>
        <table>
            <tr>
                <th>Código</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Carné</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor['codigo']; ?></td>
                <td><?php echo $vendedor['email']; ?></td>
                <td><?php echo $vendedor['nombre']; ?></td>
                <td><?php echo $vendedor['telefono']; ?></td>
                <td><?php echo $vendedor['carne']; ?></td>
                <td>
                    <a href="editarVendedor.php?id=<?php echo $vendedor['id']; ?>">Editar</a> |
                    <a href="../controllers/eliminarVendedor.php?id=<?php echo $vendedor['id']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 Sistema de Facturación</p>
    </footer>
</body>
</html>
