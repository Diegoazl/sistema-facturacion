<?php
require_once 'models/Producto.php';

class ProductoController {

    public function create() {
        require_once 'views/frmProducto.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto($_POST['codigo'], $_POST['nombre'], $_POST['stock'], $_POST['valor_unitario']);
            $producto->save();
            header("Location: index.php?action=index");
        }
    }

    public function index() {
        $productos = Producto::getAll();
        require_once 'views/frmProducto.php';
    }

    public function edit($id) {
        $producto = Producto::getById($id);
        require_once 'views/frmProducto.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto($_POST['codigo'], $_POST['nombre'], $_POST['stock'], $_POST['valor_unitario']);
            $producto->update();
            header("Location: index.php?action=index");
        }
    }

    public function delete($id) {
        Producto::delete($id);
        header("Location: index.php?action=index");
    }
}
?>
