<?php
include_once '../controllers/CtrVendedor.php';
$ctrVendedor = new CtrVendedor();
$id = $_GET['id'];
$vendedor = $ctrVendedor->obtenerVendedorPorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vendedor</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Vendedor</h2>
        <form method="post" action="../controllers/ActualizarVendedor.php">
            <input type="hidden" name="id" value="<?php echo $vendedor['id']; ?>">

            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $vendedor['codigo']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $vendedor['email']; ?>" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $vendedor['nombre']; ?>" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $vendedor['telefono']; ?>" required><br>

            <label for="carne">Carné:</label>
            <input type="text" id="carne" name="carne" value="<?php echo $vendedor['carne']; ?>"><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $vendedor['direccion']; ?>"><br>

            <input type="submit" value="Actualizar Vendedor">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Sistema de Facturación</p>
    </footer>
</body>
</html>
