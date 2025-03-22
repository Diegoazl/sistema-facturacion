<?php
include 'models/Cliente.php';

class ClienteController {
    private $clienteModel;

    public function __construct($pdo) {
        $this->clienteModel = new Cliente($pdo);
    }

    // Mostrar todos los clientes
    public function mostrarClientes() {
        $clientes = $this->clienteModel->obtenerClientes();
        include 'views/frmCliente.php';
    }

    // Crear un nuevo cliente
    public function crearCliente() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $this->clienteModel->crearCliente($codigo, $nombre, $email, $telefono);
            header("Location: index.php?action=mostrarClientes");
        }
    }

    // Editar cliente
    public function editarCliente($id) {
        $cliente = $this->clienteModel->obtenerCliente($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $this->clienteModel->actualizarCliente($id, $codigo, $nombre, $email, $telefono);
            header("Location: index.php?action=mostrarClientes");
        }
        include 'views/frmCliente.php';
    }

    // Eliminar cliente
    public function eliminarCliente($id) {
        $this->clienteModel->eliminarCliente($id);
        header("Location: index.php?action=mostrarClientes");
    }
}
?>
