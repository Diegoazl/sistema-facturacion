<?php
require_once 'models/Cliente.php';

class ClienteController {
    private $clienteModel;

    public function __construct($pdo) {
        $this->clienteModel = new Cliente($pdo);
    }

    // Mostrar todos los clientes
    public function mostrar() {
        $clientes = $this->clienteModel->obtenerClientes();
        include 'views/frmCliente.php'; // Mostrar la vista con la lista de clientes
    }

    // Crear un cliente
    public function crear() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validar datos de entrada
            if (empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['email'])) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $tipo = $_POST['tipo'];

            // Llamar al modelo para crear el cliente
            $this->clienteModel->crearCliente($codigo, $nombre, $email, $telefono, $tipo);
            header("Location: index.php?action=mostrarClientes"); // Redirigir a la lista de clientes
        }
        include 'views/frmCliente.php'; // Mostrar la vista de creación de cliente
    }

    // Editar cliente
    public function editar($id) {
        $cliente = $this->clienteModel->obtenerClientePorId($id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validar datos de entrada
            if (empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['email'])) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $tipo = $_POST['tipo'];

            // Llamar al modelo para actualizar el cliente
            $this->clienteModel->actualizarCliente($id, $codigo, $nombre, $email, $telefono, $tipo);
            header("Location: index.php?action=mostrarClientes"); // Redirigir después de actualizar
        }
        include 'views/frmCliente.php'; // Mostrar la vista de edición de cliente
    }

    // Eliminar cliente
    public function eliminar($id) {
        $this->clienteModel->eliminarCliente($id);
        header("Location: index.php?action=mostrarClientes"); // Redirigir después de eliminar
    }
}
?>
