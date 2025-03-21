<?php
include_once '../controllers/CtrFactura.php';
$ctrFactura = new CtrFactura();
$id = $_GET['id'];
$factura = $ctrFactura->obtenerFacturaPorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Factura</h2>
        <form method="post" action="../controllers/ActualizarFactura.php">
            <input type="hidden" name="id" value="<?php echo $factura['id']; ?>">

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $factura['fecha']; ?>" required><br>

            <label for="numero">Número de Factura:</label>
            <input type="text" id="numero" name="numero" value="<?php echo $factura['numero']; ?>" required><br>

            <label for="total">Total:</label>
            <input type="number" id="total" name="total" value="<?php echo $factura['total']; ?>" required><br>

            <label for="cliente_id">Cliente:</label>
            <input type="text" id="cliente_id" name="cliente_id" value="<?php echo $factura['cliente_id']; ?>" required><br>

            <label for="vendedor_id">Vendedor:</label>
            <input type="text" id="vendedor_id" name="vendedor_id" value="<?php echo $factura['vendedor_id']; ?>" required><br>

            <input type="submit" value="Actualizar Factura">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Sistema de Facturación</p>
    </footer>
</body>
</html>
