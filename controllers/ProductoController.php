
<?php
require_once '../models/Producto.php';

class ProductoController {
    public function create($data) {
        $producto = new Producto();
        $producto->create($data);
        header("Location: ../views/frmProducto.php");
    }

    public function read() {
        $producto = new Producto();
        return $producto->read();
    }

    public function update($data) {
        $producto = new Producto();
        $producto->update($data);
        header("Location: ../views/frmProducto.php");
    }

    public function delete($id) {
        $producto = new Producto();
        $producto->delete($id);
        header("Location: ../views/frmProducto.php");
    }

    public function getById($id) {
        $producto = new Producto();
        return $producto->getById($id);
    }
}
