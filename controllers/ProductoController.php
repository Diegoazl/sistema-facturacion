<?php
include 'models/Producto.php';

class ProductoController {
    private $productoModel;

    public function __construct($pdo) {
        $this->productoModel = new Producto($pdo);
    }

    // Mostrar todos los productos
    public function mostrarProductos() {
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $productosBuscados = $this->productoModel->buscarProductos($searchTerm);
            include 'views/frmProducto.php';
        } else {
            $productos = $this->productoModel->obtenerProductos();
            include 'views/frmProducto.php';
        }
    }

    // Crear un nuevo producto
    public function crearProducto() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $stock = $_POST['stock'];
            $valor_unitario = $_POST['valor_unitario'];
            $this->productoModel->crearProducto($codigo, $nombre, $stock, $valor_unitario);
            header("Location: index.php?action=mostrarProductos");
        }
    }

    // Editar producto
    public function editarProducto($id) {
        $producto = $this->productoModel->obtenerProducto($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $stock = $_POST['stock'];
            $valor_unitario = $_POST['valor_unitario'];
            $this->productoModel->actualizarProducto($id, $codigo, $nombre, $stock, $valor_unitario);
            header("Location: index.php?action=mostrarProductos");
        }
        include 'views/frmProducto.php';
    }

    // Eliminar producto
    public function eliminarProducto($id) {
        $this->productoModel->eliminarProducto($id);
        header("Location: index.php?action=mostrarProductos");
    }
}
?>
