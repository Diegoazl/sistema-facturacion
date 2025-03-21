<?php
include_once '../controllers/CtrProducto.php';
$ctrProducto = new CtrProducto();
$id = $_GET['id'];
$producto = $ctrProducto->obtenerProductoPorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Producto</h2>
        <form method="post" action="../controllers/ActualizarProducto.php">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $producto['codigo']; ?>" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required><br>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" step="0.01" required><br>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required><br>

            <input type="submit" value="Actualizar Producto">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Sistema de Facturación</p>
    </footer>
</body>
</html>
