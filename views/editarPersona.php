<?php
// Obtener la persona a editar
include_once '../controllers/CtrPersona.php';
$ctrPersona = new CtrPersona();
$id = $_GET['id'];
$persona = $ctrPersona->obtenerPersonaPorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Persona</h2>
        <form method="post" action="../controllers/ActualizarPersona.php">
            <input type="hidden" name="id" value="<?php echo $persona['id']; ?>">

            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $persona['codigo']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $persona['email']; ?>" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $persona['nombre']; ?>" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $persona['telefono']; ?>" required><br>

            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="cliente" <?php echo ($persona['tipo'] == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                <option value="vendedor" <?php echo ($persona['tipo'] == 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
            </select><br>

            <input type="submit" value="Actualizar Persona">
        </form>
    </div>
</body>
</html>
