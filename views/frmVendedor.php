
<?php
require_once '../controllers/VendedorController.php';
$controller = new VendedorController();

$vendedorEdit = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        $controller->update($_POST);
    } else {
        $controller->create($_POST);
    }
} elseif (isset($_GET['delete'])) {
    $controller->delete($_GET['delete']);
} elseif (isset($_GET['edit'])) {
    $vendedorEdit = $controller->getById($_GET['edit']);
}

$vendedores = $controller->read();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vendedores</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Vendedores</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $vendedorEdit['id'] ?? '' ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $vendedorEdit['nombre'] ?? '' ?>" required>
        <label>Correo:</label>
        <input type="email" name="correo" value="<?= $vendedorEdit['correo'] ?? '' ?>" required>
        <label>Teléfono:</label>
        <input type="tel" name="telefono" value="<?= $vendedorEdit['telefono'] ?? '' ?>" required>
        <button class="btn" type="submit"><?= $vendedorEdit ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <table>
        <thead>
            <tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $v): ?>
                <tr>
                    <td><?= $v['id'] ?></td>
                    <td><?= $v['nombre'] ?></td>
                    <td><?= $v['correo'] ?></td>
                    <td><?= $v['telefono'] ?></td>
                    <td>
                        <a class="btn" href="?edit=<?= $v['id'] ?>">Editar</a>
                        <a class="btn" href="?delete=<?= $v['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <br>
    <a href="../index.php" class="btn">← Volver</a>
</div>
</body>
</html>
