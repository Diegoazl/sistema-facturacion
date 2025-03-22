<?php
require_once '../controllers/CtrRol.php';

$ctrRol = new CtrRol();

// Crear rol
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'crear') {
    $nombre = $_POST['nombre'];
    $ctrRol->create($nombre);
}

// Obtener todos los roles
$roles = $ctrRol->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <link rel="stylesheet" href="/public/css/estilos.css">
</head>
<body>

<h1>Roles</h1>

<!-- Formulario para crear rol -->
<form method="post">
    <input type="hidden" name="action" value="crear">
    <label for="nombre">Nombre del Rol:</label>
    <input type="text" name="nombre" id="nombre" required><br>
    
    <input type="submit" value="Crear Rol">
</form>

<!-- Tabla de roles -->
<h2>Lista de Roles</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $rol): ?>
            <tr>
                <td><?php echo $rol->getId(); ?></td>
                <td><?php echo $rol->getNombre(); ?></td>
                <td>
                    <a href="editar_rol.php?id=<?php echo $rol->getId(); ?>">Editar</a> |
                    <a href="eliminar_rol.php?id=<?php echo $rol->getId(); ?>" onclick="return confirm('¿Estás seguro de eliminar este rol?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="/public/js/script.js"></script>
</body>
</html>
