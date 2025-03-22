<?php
// Aseguramos que el controlador para Factura esté instanciado
require_once '../controllers/CtrFactura.php';
$ctrFactura = new CtrFactura();

// Verificar si el formulario para eliminar una factura fue enviado
if (isset($_GET['eliminar']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $ctrFactura->delete($id);
    header("Location: FrmFactura.php?mensaje=Factura eliminada exitosamente");
    exit();
}

// Buscar facturas por número o ID
$facturas = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'buscar') {
    $id = $_POST['id_buscar'];
    $numero = $_POST['numero_buscar'];
    $facturas = $ctrFactura->search($id, $numero);
} else {
    // Obtener todas las facturas si no se busca nada
    $facturas = $ctrFactura->getAll();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/estilos.css">
</head>
<body class="container py-5">

<h1 class="mb-4 text-center">Facturas</h1>

<!-- Formulario para crear factura -->
<div class="card p-4 mb-4">
    <form method="post">
        <input type="hidden" name="action" value="crear">

        <div class="row">
            <div class="col-md-4">
                <label for="numero" class="form-label">Número de Factura:</label>
                <input type="text" name="numero" id="numero" class="form-control" placeholder="Número de factura" required>
            </div>
            <div class="col-md-4">
                <label for="total" class="form-label">Total:</label>
                <input type="number" name="total" id="total" class="form-control" placeholder="Total de la factura" required>
            </div>
            <div class="col-md-4">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" style="visibility:hidden;">Crear Factura</label>
                <button type="submit" class="btn btn-primary form-control">Crear Factura</button>
            </div>
        </div>
    </form>
</div>

<!-- Formulario de búsqueda de factura -->
<div class="card p-4 mb-4">
    <form method="post">
        <input type="hidden" name="action" value="buscar">

        <div class="row">
            <div class="col-md-4">
                <label for="id_buscar" class="form-label">ID Factura:</label>
                <input type="number" name="id_buscar" id="id_buscar" class="form-control" placeholder="Buscar por ID">
            </div>
            <div class="col-md-4">
                <label for="numero_buscar" class="form-label">Número Factura:</label>
                <input type="text" name="numero_buscar" id="numero_buscar" class="form-control" placeholder="Buscar por número">
            </div>
            <div class="col-md-4">
                <label class="form-label" style="visibility:hidden;">Buscar</label>
                <button type="submit" class="btn btn-primary form-control">Buscar</button>
            </div>
        </div>
    </form>
</div>

<!-- Tabla de facturas -->
<h2>Resultados de Facturas</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Número</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($facturas)) {
            foreach ($facturas as $factura): ?>
                <tr>
                    <td><?php echo $factura->getId(); ?></td>
                    <td><?php echo $factura->getNumero(); ?></td>
                    <td><?php echo $factura->getTotal(); ?></td>
                    <td><?php echo $factura->getFecha(); ?></td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal_<?php echo $factura->getId(); ?>">Editar</a> |
                        <a href="FrmFactura.php?eliminar=true&id=<?php echo $factura->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta factura?')">Eliminar</a>
                    </td>
                </tr>
                <!-- Modal de edición -->
                <div class="modal fade" id="editModal_<?php echo $factura->getId(); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Factura</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="action" value="editar">
                                    <input type="hidden" name="id_editar" value="<?php echo $factura->getId(); ?>">

                                    <div class="mb-3">
                                        <label for="numero_editar" class="form-label">Número de Factura:</label>
                                        <input type="text" name="numero_editar" class="form-control" value="<?php echo $factura->getNumero(); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_editar" class="form-label">Total:</label>
                                        <input type="number" name="total_editar" class="form-control" value="<?php echo $factura->getTotal(); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_editar" class="form-label">Fecha:</label>
                                        <input type="date" name="fecha_editar" class="form-control" value="<?php echo $factura->getFecha(); ?>" required>
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
            <tr><td colspan="5" class="text-center">No se encontraron facturas</td></tr>
        <?php } ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
