<?php
include 'models/Factura.php';

class FacturaController {
    private $facturaModel;

    public function __construct($pdo) {
        $this->facturaModel = new Factura($pdo);
    }

    // Mostrar todas las facturas
    public function mostrarFacturas() {
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $facturasBuscadas = $this->facturaModel->buscarFacturas($searchTerm);
            include 'views/frmFactura.php';
        } else {
            $facturas = $this->facturaModel->obtenerFacturas();
            include 'views/frmFactura.php';
        }
    }

    // Crear una nueva factura
    public function crearFactura() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero = $_POST['numero'];
            $cliente_id = $_POST['cliente_id'];
            $total = $_POST['total'];
            $this->facturaModel->crearFactura($numero, $cliente_id, $total);
            header("Location: index.php?action=mostrarFacturas");
        }
    }

    // Editar factura
    public function editarFactura($id) {
        $factura = $this->facturaModel->obtenerFactura($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero = $_POST['numero'];
            $cliente_id = $_POST['cliente_id'];
            $total = $_POST['total'];
            $this->facturaModel->actualizarFactura($id, $numero, $cliente_id, $total);
            header("Location: index.php?action=mostrarFacturas");
        }
        include 'views/frmFactura.php';
    }

    // Eliminar factura
    public function eliminarFactura($id) {
        $this->facturaModel->eliminarFactura($id);
        header("Location: index.php?action=mostrarFacturas");
    }
}
?>
