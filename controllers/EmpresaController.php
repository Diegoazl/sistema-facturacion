<?php
require_once 'models/Empresa.php';

class EmpresaController {

    // Mostrar todas las empresas
    public function index() {
        $empresas = Empresa::getAll();
        require_once 'views/frmEmpresa.php';
    }

    // Guardar una nueva empresa
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $empresa = new Empresa($_POST['codigo'], $_POST['nombre']);
            $empresa->save();
            header("Location: index.php?action=empresa_index");
        }
    }

    // Editar una empresa
    public function edit($id) {
        $empresa = Empresa::getById($id);
        require_once 'views/frmEmpresa.php';
    }

    // Actualizar empresa
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $empresa = new Empresa($_POST['codigo'], $_POST['nombre']);
            $empresa->update($id);
            header("Location: index.php?action=empresa_index");
        }
    }

    // Eliminar una empresa
    public function delete($id) {
        Empresa::delete($id);
        header("Location: index.php?action=empresa_index");
    }
}
?>
