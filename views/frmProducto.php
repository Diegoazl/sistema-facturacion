<?php
// Incluir el controlador para obtener los productos
include_once '../controllers/CtrProducto.php';
$ctrProducto = new CtrProducto();
$productos = $ctrProducto->obtenerProductos();
?>

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

    <input type="submit" value="Agregar Producto">
</form>

<h2>Productos Existentes</h2>
<table border="1">
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
            <a href="../controllers/editarProducto.php?id=<?php echo $producto['id']; ?>">Editar</a> |
            <a href="../controllers/eliminarProducto.php?id=<?php echo $producto['id']; ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
