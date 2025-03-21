<?php
require_once 'models/Producto.php';

class ProductoController {

    // Mostrar todos los productos
    public function index() {
        $productos = Producto::getAll();
        require_once 'views/frmProducto.php';
    }

    // Guardar un nuevo producto
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto($_POST['codigo'], $_POST['nombre'], $_POST['stock'], $_POST['valor_unitario']);
            $producto->save();
            header("Location: index.php?action=producto_index");
        }
    }

    // Editar un producto
    public function edit($id) {
        $producto = Producto::getById($id);
        require_once 'views/frmProducto.php';
    }

    // Actualizar producto
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto($_POST['codigo'], $_POST['nombre'], $_POST['stock'], $_POST['valor_unitario']);
            $producto->update($id);
            header("Location: index.php?action=producto_index");
        }
    }

    // Eliminar un producto
    public function delete($id) {
        Producto::delete($id);
        header("Location: index.php?action=producto_index");
    }

    // Buscar productos
    public function search() {
        $productos = [];
        if (isset($_POST['search_query'])) {
            $productos = Producto::search($_POST['search_query']);
        }
        require_once 'views/frmProducto.php';
    }
}
?>
