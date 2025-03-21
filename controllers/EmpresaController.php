<?php
require_once 'models/Empresa.php';

class EmpresaController {

    public function create() {
        require_once 'views/frmEmpresa.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $empresa = new Empresa($_POST['codigo'], $_POST['nombre']);
            $empresa->save();
            header("Location: index.php?action=empresa_index");
        }
    }

    public function index() {
        $empresas = Empresa::getAll();
        require_once 'views/frmEmpresa.php';
    }

    public function edit($id) {
        $empresa = Empresa::getById($id);
        require_once 'views/frmEmpresa.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $empresa = new Empresa($_POST['codigo'], $_POST['nombre']);
            $empresa->update();
            header("Location: index.php?action=empresa_index");
        }
    }

    public function delete($id) {
        Empresa::delete($id);
        header("Location: index.php?action=empresa_index");
    }
}
?>
