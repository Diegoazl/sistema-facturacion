<?php
include 'models/Vendedor.php';

class VendedorController {
    private $vendedorModel;

    public function __construct($pdo) {
        $this->vendedorModel = new Vendedor($pdo);
    }

    // Mostrar todos los vendedores
    public function mostrarVendedores() {
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $vendedoresBuscados = $this->vendedorModel->buscarVendedores($searchTerm);
            include 'views/frmVendedor.php';
        } else {
            $vendedores = $this->vendedorModel->obtenerVendedores();
            include 'views/frmVendedor.php';
        }
    }

    // Crear un nuevo vendedor
    public function crearVendedor() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $this->vendedorModel->crearVendedor($codigo, $nombre);
            header("Location: index.php?action=mostrarVendedores");
        }
    }

    // Editar vendedor
    public function editarVendedor($id) {
        $vendedor = $this->vendedorModel->obtenerVendedor($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $this->vendedorModel->actualizarVendedor($id, $codigo, $nombre);
            header("Location: index.php?action=mostrarVendedores");
        }
        include 'views/frmVendedor.php';
    }

    // Eliminar vendedor
    public function eliminarVendedor($id) {
        $this->vendedorModel->eliminarVendedor($id);
        header("Location: index.php?action=mostrarVendedores");
    }
}
?>
