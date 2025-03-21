<?php
require_once 'models/Vendedor.php';

class VendedorController {

    public function create() {
        require_once 'views/frmVendedor.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vendedor = new Vendedor($_POST['codigo'], $_POST['email'], $_POST['nombre'], $_POST['telefono'], $_POST['tipo'], $_POST['carnet'], $_POST['direccion'], $_POST['empresa_id'], $_POST['tipo_persona']);
            $vendedor->save();
            header("Location: index.php?action=index");
        }
    }

    public function index() {
        $vendedores = Vendedor::getAll();
        require_once 'views/frmVendedor.php';
    }

    public function edit($id) {
        $vendedor = Vendedor::getById($id);
        require_once 'views/frmVendedor.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vendedor = new Vendedor($_POST['codigo'], $_POST['email'], $_POST['nombre'], $_POST['telefono'], $_POST['tipo'], $_POST['carnet'], $_POST['direccion'], $_POST['empresa_id'], $_POST['tipo_persona']);
            $vendedor->update();
            header("Location: index.php?action=index");
        }
    }

    public function delete($id) {
        Vendedor::delete($id);
        header("Location: index.php?action=index");
    }
}
?>
