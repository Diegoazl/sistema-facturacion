
<?php
require_once '../controllers/EmpresaController.php';
$controller = new EmpresaController();

$empresaEdit = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        $controller->update($_POST);
    } else {
        $controller->create($_POST);
    }
} elseif (isset($_GET['delete'])) {
    $controller->delete($_GET['delete']);
} elseif (isset($_GET['edit'])) {
    $empresaEdit = $controller->getById($_GET['edit']);
}

$empresas = $controller->read();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Empresas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Empresas</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $empresaEdit['id'] ?? '' ?>">
        <label>Código:</label>
        <input type="text" name="codigo" value="<?= $empresaEdit['codigo'] ?? '' ?>" required>
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $empresaEdit['nombre'] ?? '' ?>" required>
        <button class="btn" type="submit"><?= $empresaEdit ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <table>
        <thead>
            <tr><th>ID</th><th>Código</th><th>Nombre</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($empresas as $e): ?>
                <tr>
                    <td><?= $e['id'] ?></td>
                    <td><?= $e['codigo'] ?></td>
                    <td><?= $e['nombre'] ?></td>
                    <td>
                        <a class="btn" href="?edit=<?= $e['id'] ?>">Editar</a>
                        <a class="btn" href="?delete=<?= $e['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
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
