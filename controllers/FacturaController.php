<?php
require_once 'models/Factura.php';

class FacturaController {
    private $facturaModel;

    public function __construct($pdo) {
        $this->facturaModel = new Factura($pdo);
    }

    // Mostrar todas las facturas
    public function mostrar() {
        $facturas = $this->facturaModel->obtenerFacturas();
        include 'views/frmFactura.php'; // Mostrar la vista de facturas
    }

    // Crear una factura
    public function crear() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validar datos de entrada
            if (empty($_POST['numero']) || empty($_POST['cliente_id']) || empty($_POST['vendedor_id']) || empty($_POST['total'])) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            $numero = $_POST['numero'];
            $cliente_id = $_POST['cliente_id'];
            $vendedor_id = $_POST['vendedor_id'];
            $total = $_POST['total'];

            // Llamar al modelo para crear la factura
            $this->facturaModel->crearFactura($numero, $cliente_id, $vendedor_id, $total);
            header("Location: index.php?action=mostrarFacturas"); // Redirigir a la lista de facturas
        }
        include 'views/frmFactura.php'; // Mostrar la vista de creación de factura
    }

    // Editar factura
    public function editar($id) {
        $factura = $this->facturaModel->obtenerFacturaPorId($id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validar datos de entrada
            if (empty($_POST['numero']) || empty($_POST['cliente_id']) || empty($_POST['vendedor_id']) || empty($_POST['total'])) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            $numero = $_POST['numero'];
            $cliente_id = $_POST['cliente_id'];
            $vendedor_id = $_POST['vendedor_id'];
            $total = $_POST['total'];

            // Llamar al modelo para actualizar la factura
            $this->facturaModel->actualizarFactura($id, $numero, $cliente_id, $vendedor_id, $total);
            header("Location: index.php?action=mostrarFacturas"); // Redirigir después de actualizar
        }
        include 'views/frmFactura.php'; // Mostrar la vista de edición de factura
    }

    // Eliminar factura
    public function eliminar($id) {
        $this->facturaModel->eliminarFactura($id);
        header("Location: index.php?action=mostrarFacturas"); // Redirigir después de eliminar
    }
}
?>
