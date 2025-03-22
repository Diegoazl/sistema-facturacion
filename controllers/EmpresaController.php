
<?php
require_once '../models/Empresa.php';

class EmpresaController {
    public function create($data) {
        $empresa = new Empresa();
        $empresa->create($data);
        header("Location: ../views/frmEmpresa.php");
    }

    public function read() {
        $empresa = new Empresa();
        return $empresa->read();
    }

    public function update($data) {
        $empresa = new Empresa();
        $empresa->update($data);
        header("Location: ../views/frmEmpresa.php");
    }

    public function delete($id) {
        $empresa = new Empresa();
        $empresa->delete($id);
        header("Location: ../views/frmEmpresa.php");
    }

    public function getById($id) {
        $empresa = new Empresa();
        return $empresa->getById($id);
    }
}
