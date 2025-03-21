<?php
// Incluir el controlador para obtener las personas
include_once '../controllers/CtrPersona.php';
$ctrPersona = new CtrPersona();
$personas = $ctrPersona->obtenerPersonas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas - Sistema de Facturación</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Vincula el archivo CSS -->
</head>
<body>
    <div class="container">
        <!-- Formulario para agregar nueva persona -->
        <h2>Agregar Persona</h2>
        <form method="post" action="../controllers/CrearPersona.php">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required><br>

            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="cliente">Cliente</option>
                <option value="vendedor">Vendedor</option>
            </select><br>

            <!-- Campo adicional dependiendo del tipo -->
            <div id="clienteFields" style="display:none;">
                <label for="credito">Crédito:</label>
                <input type="number" id="credito" name="credito"><br>

                <label for="empresa_id">Empresa:</label>
                <input type="text" id="empresa_id" name="empresa_id"><br>
            </div>

            <div id="vendedorFields" style="display:none;">
                <label for="carne">Carné:</label>
                <input type="text" id="carne" name="carne"><br>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion"><br>
            </div>

            <input type="submit" value="Agregar Persona">
        </form>

        <!-- Lista de personas -->
        <h2>Personas Existentes</h2>
        <table>
            <tr>
                <th>Código</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($personas as $persona): ?>
            <tr>
                <td><?php echo $persona['codigo']; ?></td>
                <td><?php echo $persona['email']; ?></td>
                <td><?php echo $persona['nombre']; ?></td>
                <td><?php echo $persona['telefono']; ?></td>
                <td><?php echo $persona['tipo']; ?></td>
                <td>
                    <!-- Enlaces para editar y eliminar -->
                    <a href="editarPersona.php?id=<?php echo $persona['id']; ?>">Editar</a> |
                    <a href="../controllers/eliminarPersona.php?id=<?php echo $persona['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar esta persona?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 Sistema de Facturación</p>
    </footer>

    <script>
        // Mostrar campos adicionales según el tipo de persona
        document.getElementById('tipo').addEventListener('change', function() {
            if (this.value == 'cliente') {
                document.getElementById('clienteFields').style.display = 'block';
                document.getElementById('vendedorFields').style.display = 'none';
            } else {
                document.getElementById('clienteFields').style.display = 'none';
                document.getElementById('vendedorFields').style.display = 'block';
            }
        });
    </script>
</body>
</html>
