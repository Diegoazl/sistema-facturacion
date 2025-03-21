<?php
require_once 'models/Vendedor.php';

class VendedorController {
    private $vendedorModel;

    public function __construct($pdo) {
        $this->vendedorModel = new Vendedor($pdo);
    }

    // Mostrar todos los vendedores
    public function mostrar() {
        $vendedores = $this->vendedorModel->obtenerVendedores();
        include 'views/frmVendedor.php'; // Mostrar la vista de vendedores
    }

    // Crear un vendedor
    public function crear() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validar datos de entrada
            if (empty($_POST['persona_id'])) {
                echo "El ID de persona es obligatorio.";
                return;
            }

            $persona_id = $_POST['persona_id'];

            // Llamar al modelo para crear el vendedor
            $this->vendedorModel->crearVendedor($persona_id);
            header("Location: index.php?action=mostrarVendedores"); // Redirigir a la lista de vendedores
        }
        include 'views/frmVendedor.php'; // Mostrar la vista de creación de vendedor
    }

    // Editar vendedor
    public function editar($id) {
        $vendedor = $this->vendedorModel->obtenerVendedorPorId($id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validar datos de entrada
            if (empty($_POST['persona_id'])) {
                echo "El ID de persona es obligatorio.";
                return;
            }

            $persona_id = $_POST['persona_id'];

            // Llamar al modelo para actualizar el vendedor
            $this->vendedorModel->actualizarVendedor($id, $persona_id);
            header("Location: index.php?action=mostrarVendedores"); // Redirigir después de actualizar
        }
        include 'views/frmVendedor.php'; // Mostrar la vista de edición de vendedor
    }

    // Eliminar vendedor
    public function eliminar($id) {
        $this->vendedorModel->eliminarVendedor($id);
        header("Location: index.php?action=mostrarVendedores"); // Redirigir después de eliminar
    }
}
?>
