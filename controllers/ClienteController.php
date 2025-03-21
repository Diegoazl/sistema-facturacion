<?php
require_once 'models/Cliente.php';
require_once 'models/Empresa.php';

class ClienteController {

    public function create() {
        // Obtener las empresas para el formulario
        $empresas = Empresa::getAll();
        require_once 'views/frmCliente.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente = new Cliente(
                $_POST['codigo'], $_POST['email'], $_POST['nombre'], 
                $_POST['telefono'], $_POST['tipo'], $_POST['carnet'], 
                $_POST['direccion'], $_POST['credito'], $_POST['empresa_id'], $_POST['tipo_persona']
            );
            $cliente->save();
            header("Location: index.php?action=cliente_index");
        }
    }

    public function index() {
        $clientes = Cliente::getAll();
        require_once 'views/frmCliente.php';
    }

    public function edit($id) {
        $cliente = Cliente::getById($id);
        $empresas = Empresa::getAll(); // Obtener empresas
        require_once 'views/frmCliente.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente = new Cliente(
                $_POST['codigo'], $_POST['email'], $_POST['nombre'], 
                $_POST['telefono'], $_POST['tipo'], $_POST['carnet'], 
                $_POST['direccion'], $_POST['credito'], $_POST['empresa_id'], $_POST['tipo_persona']
            );
            $cliente->update();
            header("Location: index.php?action=cliente_index");
        }
    }

    public function delete($id) {
        Cliente::delete($id);
        header("Location: index.php?action=cliente_index");
    }
}
?>
