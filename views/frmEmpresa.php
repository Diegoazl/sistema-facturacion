<?php
// Aseguramos que el controlador para Empresa esté instanciado
require_once '../controllers/CtrEmpresa.php';
$ctrEmpresa = new CtrEmpresa();

// Verificar si el formulario para eliminar una empresa fue enviado
if (isset($_GET['eliminar']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $ctrEmpresa->delete($id);
    header("Location: FrmEmpresa.php?mensaje=Empresa eliminada exitosamente");
    exit();
}

// Buscar empresas por nombre o ID
$empresas = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'buscar') {
    $id = $_POST['id_buscar'];
    $nombre = $_POST['nombre_buscar'];
    $empresas = $ctrEmpresa->search($id, $nombre);
} else {
    // Obtener todas las empresas si no se busca nada
    $empresas = $ctrEmpresa->getAll();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/estilos.css">
</head>
<body class="container py-5">

<h1 class="mb-4 text-center">Empresas</h1>

<!-- Formulario para crear empresa -->
<div class="card p-4 mb-4">
    <form method="post">
        <input type="hidden" name="action" value="crear">

        <div class="row">
            <div class="col-md-4">
                <label for="nombre" class="form-label">Nombre Empresa:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la empresa" required>
            </div>
            <div class="col-md-4">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección de la empresa" required>
            </div>
            <div class="col-md-4">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono de la empresa" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" style="visibility:hidden;">Crear Empresa</label>
                <button type="submit" class="btn btn-primary form-control">Crear Empresa</button>
            </div>
        </div>
    </form>
</div>

<!-- Formulario de búsqueda de empresa -->
<div class="card p-4 mb-4">
    <form method="post">
        <input type="hidden" name="action" value="buscar">

        <div class="row">
            <div class="col-md-4">
                <label for="id_buscar" class="form-label">ID Empresa:</label>
                <input type="number" name="id_buscar" id="id_buscar" class="form-control" placeholder="Buscar por ID">
            </div>
            <div class="col-md-4">
                <label for="nombre_buscar" class="form-label">Nombre Empresa:</label>
                <input type="text" name="nombre_buscar" id="nombre_buscar" class="form-control" placeholder="Buscar por nombre">
            </div>
            <div class="col-md-4">
                <label class="form-label" style="visibility:hidden;">Buscar</label>
                <button type="submit" class="btn btn-primary form-control">Buscar</button>
            </div>
        </div>
    </form>
</div>

<!-- Tabla de empresas -->
<h2>Resultados de Empresas</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($empresas)) {
            foreach ($empresas as $empresa): ?>
                <tr>
                    <td><?php echo $empresa->getId(); ?></td>
                    <td><?php echo $empresa->getNombre(); ?></td>
                    <td><?php echo $empresa->getDireccion(); ?></td>
                    <td><?php echo $empresa->getTelefono(); ?></td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal_<?php echo $empresa->getId(); ?>">Editar</a> |
                        <a href="FrmEmpresa.php?eliminar=true&id=<?php echo $empresa->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta empresa?')">Eliminar</a>
                    </td>
                </tr>
                <!-- Modal de edición -->
                <div class="modal fade" id="editModal_<?php echo $empresa->getId(); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Empresa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="action" value="editar">
                                    <input type="hidden" name="id_editar" value="<?php echo $empresa->getId(); ?>">

                                    <div class="mb-3">
                                        <label for="nombre_editar" class="form-label">Nombre Empresa:</label>
                                        <input type="text" name="nombre_editar" class="form-control" value="<?php echo $empresa->getNombre(); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion_editar" class="form-label">Dirección:</label>
                                        <input type="text" name="direccion_editar" class="form-control" value="<?php echo $empresa->getDireccion(); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono_editar" class="form-label">Teléfono:</label>
                                        <input type="text" name="telefono_editar" class="form-control" value="<?php echo $empresa->getTelefono(); ?>" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        } else { ?>
            <tr><td colspan="5" class="text-center">No se encontraron empresas</td></tr>
        <?php } ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
