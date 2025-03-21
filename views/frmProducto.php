<?php
include_once '../controllers/CtrProducto.php';
$ctrProducto = new CtrProducto();
$productos = $ctrProducto->obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Productos</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <!-- Formulario para agregar nuevo producto -->
        <h2>Agregar Producto</h2>
        <form method="post" action="../controllers/CrearProducto.php">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required><br>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required><br>

            <input type="submit" value="Crear Producto">
        </form>

        <!-- Lista de productos -->
        <h2>Productos Existentes</h2>
        <table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo $producto['codigo']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['stock']; ?></td>
                <td>
                    <a href="editarProducto.php?id=<?php echo $producto['id']; ?>">Editar</a> |
                    <a href="../controllers/eliminarProducto.php?id=<?php echo $producto['id']; ?>">Eliminar</a>
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
