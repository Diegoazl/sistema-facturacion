<?php
include_once '../controllers/CtrCliente.php';
$ctrCliente = new CtrCliente();
$id = $_GET['id'];
$cliente = $ctrCliente->obtenerClientePorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Cliente</h2>
        <form method="post" action="../controllers/ActualizarCliente.php">
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $cliente['codigo']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombre']; ?>" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $cliente['telefono']; ?>" required><br>

            <label for="credito">Crédito:</label>
            <input type="number" id="credito" name="credito" value="<?php echo $cliente['credito']; ?>"><br>

            <label for="empresa_id">Empresa:</label>
            <input type="text" id="empresa_id" name="empresa_id" value="<?php echo $cliente['empresa_id']; ?>"><br>

            <input type="submit" value="Actualizar Cliente">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Sistema de Facturación</p>
    </footer>
</body>
</html>
