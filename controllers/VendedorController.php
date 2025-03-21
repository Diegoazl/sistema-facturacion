<?php
require_once 'models/Vendedor.php';

class VendedorController {

    // Mostrar todos los vendedores
    public function index() {
        $vendedores = Vendedor::getAll();
        require_once 'views/frmVendedor.php';
    }

    // Guardar un nuevo vendedor
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vendedor = new Vendedor($_POST['codigo'], $_POST['email'], $_POST['nombre'], $_POST['telefono'], $_POST['carnet'], $_POST['direccion'], $_POST['credito'], $_POST['empresa_id']);
            $vendedor->save();
            header("Location: index.php?action=vendedor_index");
        }
    }

    // Editar un vendedor
    public function edit($id) {
        $vendedor = Vendedor::getById($id);
        require_once 'views/frmVendedor.php';
    }

    // Actualizar vendedor
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vendedor = new Vendedor($_POST['codigo'], $_POST['email'], $_POST['nombre'], $_POST['telefono'], $_POST['carnet'], $_POST['direccion'], $_POST['credito'], $_POST['empresa_id']);
            $vendedor->update($id);
            header("Location: index.php?action=vendedor_index");
        }
    }

    // Eliminar un vendedor
    public function delete($id) {
        Vendedor::delete($id);
        header("Location: index.php?action=vendedor_index");
    }

    // Buscar vendedores
    public function search() {
        $vendedores = [];
        if (isset($_POST['search_query'])) {
            $vendedores = Vendedor::search($_POST['search_query']);
        }
        require_once 'views/frmVendedor.php';
    }
}
?>
