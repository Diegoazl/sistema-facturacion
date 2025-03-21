<?php
// Incluir el controlador para obtener las personas
include_once '../controllers/CtrPersona.php';
$ctrPersona = new CtrPersona();
$personas = $ctrPersona->obtenerPersonas();
?>

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
<table border="1">
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
            <!-- Correcta ruta a los controladores -->
            <a href="../controllers/editarPersona.php?id=<?php echo $persona['id']; ?>">Editar</a> |
            <a href="../controllers/eliminarPersona.php?id=<?php echo $persona['id']; ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

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
