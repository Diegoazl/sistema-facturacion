<?php
require_once '../controllers/CtrProducto.php';

$ctrProducto = new CtrProducto();

// Crear producto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'crear') {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $stock = $_POST['stock'];
    $valorunitario = $_POST['valorunitario'];
    $ctrProducto->create($codigo, $nombre, $stock, $valorunitario);
}

// Eliminar producto
if (isset($_GET['eliminar']) && isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $ctrProducto->delete($codigo);
    header("Location: FrmProducto.php?mensaje=Producto eliminado exitosamente");
    exit();
}

// Buscar productos por nombre o código
$productos = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'buscar') {
    $codigo = $_POST['codigo_buscar'];
    $nombre = $_POST['nombre_buscar'];
    $productos = $ctrProducto->search($codigo, $nombre); // Esta función debe devolver objetos Producto
} else {
    // Obtener todos los productos si no se busca nada
    $productos = $ctrProducto->getAll(); // Esta función también debe devolver objetos Producto
}

// Lógica para editar producto
if (isset($_POST['action']) && $_POST['action'] == 'editar' && isset($_POST['codigo_editar'])) {
    $codigo = $_POST['codigo_editar'];
    $nombre = $_POST['nombre_editar'];
    $stock = $_POST['stock_editar'];
    $valorunitario = $_POST['valorunitario_editar'];
    
    $ctrProducto->update($codigo, $nombre, $stock, $valorunitario);
    header("Location: FrmProducto.php?mensaje=Producto actualizado exitosamente");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/estilos.css">
</head>
<body class="container py-5">

<h1 class="mb-4 text-center">Productos</h1>

<!-- Formulario para crear producto -->
<div class="card p-4 mb-4">
    <form method="post">
        <input type="hidden" name="action" value="crear">

        <div class="row">
            <div class="col-md-4">
                <label for="codigo" class="form-label">Código Producto:</label>
                <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Código del producto" required>
            </div>
            <div class="col-md-4">
                <label for="nombre" class="form-label">Nombre Producto:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del producto" required>
            </div>
            <div class="col-md-4">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" name="stock" id="stock" class="form-control" placeholder="Cantidad en stock" required>
            </div>
            <div class="col-md-4">
                <label for="valorunitario" class="form-label">Valor Unitario:</label>
                <input type="number" step="0.01" name="valorunitario" id="valorunitario" class="form-control" placeholder="Precio unitario" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" style="visibility:hidden;">Crear Producto</label>
                <button type="submit" class="btn btn-primary form-control">Crear Producto</button>
            </div>
        </div>
    </form>
</div>

<!-- Formulario de búsqueda -->
<div class="card p-4 mb-4">
    <form method="post">
        <input type="hidden" name="action" value="buscar">

        <div class="row">
            <div class="col-md-4">
                <label for="codigo_buscar" class="form-label">Código Producto:</label>
                <input type="text" name="codigo_buscar" id="codigo_buscar" class="form-control" placeholder="Buscar por código">
            </div>
            <div class="col-md-4">
                <label for="nombre_buscar" class="form-label">Nombre Producto:</label>
                <input type="text" name="nombre_buscar" id="nombre_buscar" class="form-control" placeholder="Buscar por nombre">
            </div>
            <div class="col-md-4">
                <label class="form-label" style="visibility:hidden;">Buscar</label>
                <button type="submit" class="btn btn-primary form-control">Buscar</button>
            </div>
        </div>
    </form>
</div>

<!-- Tabla de productos -->
<h2>Resultados de Productos</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Valor Unitario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Verificamos si la variable $productos contiene datos antes de acceder a sus propiedades
        if (!empty($productos)) {
            foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto->getCodigo(); ?></td>
                    <td><?php echo $producto->getNombre(); ?></td>
                    <td><?php echo $producto->getStock(); ?></td>
                    <td><?php echo $producto->getValorUnitario(); ?></td>
                    <td>
                        <!-- Enlace para editar producto -->
                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal_<?php echo $producto->getCodigo(); ?>">Editar</a> |
                        
                        <!-- Enlace para eliminar producto -->
                        <a href="FrmProducto.php?eliminar=true&codigo=<?php echo $producto->getCodigo(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
                <!-- Modal de edición para cada producto -->
                <div class="modal fade" id="editModal_<?php echo $producto->getCodigo(); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="action" value="editar">
                                    <input type="hidden" name="codigo_editar" value="<?php echo $producto->getCodigo(); ?>">

                                    <div class="mb-3">
                                        <label for="nombre_editar" class="form-label">Nombre Producto:</label>
                                        <input type="text" name="nombre_editar" class="form-control" value="<?php echo $producto->getNombre(); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock_editar" class="form-label">Stock:</label>
                                        <input type="number" name="stock_editar" class="form-control" value="<?php echo $producto->getStock(); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="valorunitario_editar" class="form-label">Valor Unitario:</label>
                                        <input type="number" step="0.01" name="valorunitario_editar" class="form-control" value="<?php echo $producto->getValorUnitario(); ?>" required>
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
            <tr><td colspan="5" class="text-center">No se encontraron productos</td></tr>
        <?php } ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
