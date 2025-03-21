<?php
// Obtener la persona a editar
include_once '../controllers/CtrPersona.php';
$ctrPersona = new CtrPersona();
$id = $_GET['id'];
$persona = $ctrPersona->obtenerPersonaPorId($id);
?>

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

    <!-- Campos adicionales dependiendo del tipo -->
    <div id="clienteFields" style="<?php echo ($persona['tipo'] == 'cliente') ? 'display:block;' : 'display:none;'; ?>">
        <label for="credito">Crédito:</label>
        <input type="number" id="credito" name="credito" value="<?php echo $persona['credito']; ?>"><br>

        <label for="empresa_id">Empresa:</label>
        <input type="text" id="empresa_id" name="empresa_id" value="<?php echo $persona['empresa_id']; ?>"><br>
    </div>

    <div id="vendedorFields" style="<?php echo ($persona['tipo'] == 'vendedor') ? 'display:block;' : 'display:none;'; ?>">
        <label for="carne">Carné:</label>
        <input type="text" id="carne" name="carne" value="<?php echo $persona['carne']; ?>"><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $persona['direccion']; ?>"><br>
    </div>

    <input type="submit" value="Actualizar Persona">
</form>

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
