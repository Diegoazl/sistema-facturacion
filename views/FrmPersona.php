<?php
require_once '../controllers/CtrPersona.php';

$ctrPersona = new CtrPersona();

// Crear persona
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'crear') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fk_id_rol = $_POST['fk_id_rol'];
    $fk_id_empresa = $_POST['fk_id_empresa'];
    $ctrPersona->create($nombre, $email, $telefono, $fk_id_rol, $fk_id_empresa);
}

// Buscar persona
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'buscar') {
    $codigo = $_POST['codigo_buscar'];
    $nombre = $_POST['nombre_buscar'];
    $personas = $ctrPersona->search($nombre, $codigo);
} else {
    // Obtener todas las personas
    $personas = $ctrPersona->getAll();
}

// Editar persona
if (isset($_GET['editar']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $persona = $ctrPersona->getPersonaById($id);
}

// Eliminar persona
if (isset($_GET['eliminar']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $ctrPersona->delete($id);
    header("Location: FrmPersona.php?mensaje=Persona eliminada exitosamente");
    exit();
}
?>

<!-- Aquí va el formulario de la vista -->
<form method="post">
    <input type="hidden" name="action" value="crear">
    <!-- Campos del formulario -->
    <input type="text" name="nombre" required>
    <input type="text" name="email" required>
    <input type="text" name="telefono" required>
    <input type="text" name="fk_id_rol" required>
    <input type="text" name="fk_id_empresa" required>
    <button type="submit">Crear Persona</button>
</form>

<!-- Buscar persona -->
<form method="post">
    <input type="hidden" name="action" value="buscar">
    <input type="text" name="codigo_buscar" placeholder="Código">
    <input type="text" name="nombre_buscar" placeholder="Nombre">
    <button type="submit">Buscar</button>
</form>

<!-- Lista de personas -->
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personas as $persona): ?>
            <tr>
                <td><?php echo $persona->getNombre(); ?></td>
                <td><?php echo $persona->getEmail(); ?></td>
                <td><?php echo $persona->getTelefono(); ?></td>
                <td>
                    <a href="FrmPersona.php?editar=true&id=<?php echo $persona->getId(); ?>">Editar</a> |
                    <a href="FrmPersona.php?eliminar=true&id=<?php echo $persona->getId(); ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
