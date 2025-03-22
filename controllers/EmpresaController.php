<?php
include 'models/Empresa.php';

class EmpresaController {
    private $empresaModel;

    public function __construct($pdo) {
        $this->empresaModel = new Empresa($pdo);
    }

    // Mostrar todas las empresas
    public function mostrarEmpresas() {
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $empresasBuscadas = $this->empresaModel->buscarEmpresas($searchTerm);
            include 'views/frmEmpresa.php';
        } else {
            $empresas = $this->empresaModel->obtenerEmpresas();
            include 'views/frmEmpresa.php';
        }
    }

    // Crear una nueva empresa
    public function crearEmpresa() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $this->empresaModel->crearEmpresa($codigo, $nombre);
            header("Location: index.php?action=mostrarEmpresas");
        }
    }

    // Editar empresa
    public function editarEmpresa($id) {
        $empresa = $this->empresaModel->obtenerEmpresa($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $this->empresaModel->actualizarEmpresa($id, $codigo, $nombre);
            header("Location: index.php?action=mostrarEmpresas");
        }
        include 'views/frmEmpresa.php';
    }

    // Eliminar empresa
    public function eliminarEmpresa($id) {
        $this->empresaModel->eliminarEmpresa($id);
        header("Location: index.php?action=mostrarEmpresas");
    }
}
?>
