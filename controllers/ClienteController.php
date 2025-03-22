<?php
include 'models/Cliente.php';

class ClienteController {
    private $clienteModel;

    public function __construct($pdo) {
        $this->clienteModel = new Cliente($pdo);
    }

    // Mostrar todos los clientes
    public function mostrarClientes() {
        $clientes = $this->clienteModel->obtenerClientes();  // Obtener todos los clientes
        include 'views/frmCliente.php';  // Incluir la vista de clientes
    }

    // Crear un nuevo cliente
    public function crearCliente() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $this->clienteModel->crearCliente($codigo, $nombre, $email, $telefono);  // Crear cliente
            header("Location: index.php?action=mostrarClientes");  // Redirigir a la lista
        }
    }

    // Editar cliente
    public function editarCliente($id) {
        $cliente = $this->clienteModel->obtenerCliente($id);  // Obtener cliente por ID
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $this->clienteModel->actualizarCliente($id, $codigo, $nombre, $email, $telefono);  // Actualizar cliente
            header("Location: index.php?action=mostrarClientes");  // Redirigir a la lista
        }
        include 'views/frmCliente.php';  // Incluir vista de edición
    }

    // Eliminar cliente
    public function eliminarCliente($id) {
        $this->clienteModel->eliminarCliente($id);  // Eliminar cliente
        header("Location: index.php?action=mostrarClientes");  // Redirigir a la lista
    }
}
?>
