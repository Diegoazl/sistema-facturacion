<?php
require_once 'models/Cliente.php';

class ClienteController {

    // Mostrar todos los clientes
    public function index() {
        $clientes = Cliente::getAll();
        require_once 'views/frmCliente.php';
    }

    // Guardar un nuevo cliente
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente = new Cliente($_POST['codigo'], $_POST['email'], $_POST['nombre'], $_POST['telefono'], $_POST['tipo'], $_POST['carnet'], $_POST['direccion'], $_POST['credito'], $_POST['empresa_id'], $_POST['tipo_persona']);
            $cliente->save();
            header("Location: index.php?action=cliente_index");
        }
    }

    // Editar un cliente
    public function edit($id) {
        $cliente = Cliente::getById($id);
        require_once 'views/frmCliente.php';
    }

    // Actualizar cliente
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente = new Cliente($_POST['codigo'], $_POST['email'], $_POST['nombre'], $_POST['telefono'], $_POST['tipo'], $_POST['carnet'], $_POST['direccion'], $_POST['credito'], $_POST['empresa_id'], $_POST['tipo_persona']);
            $cliente->update($id);
            header("Location: index.php?action=cliente_index");
        }
    }

    // Eliminar un cliente
    public function delete($id) {
        Cliente::delete($id);
        header("Location: index.php?action=cliente_index");
    }

    // Buscar clientes
    public function search() {
        $clientes = [];
        if (isset($_POST['search_query'])) {
            $clientes = Cliente::search($_POST['search_query']);
        }
        require_once 'views/frmCliente.php';
    }
}
?>
