
<?php
require_once '../models/Vendedor.php';

class VendedorController {
    public function create($data) {
        $vendedor = new Vendedor();
        $vendedor->create($data);
        header("Location: ../views/frmVendedor.php");
    }

    public function read() {
        $vendedor = new Vendedor();
        return $vendedor->read();
    }

    public function update($data) {
        $vendedor = new Vendedor();
        $vendedor->update($data);
        header("Location: ../views/frmVendedor.php");
    }

    public function delete($id) {
        $vendedor = new Vendedor();
        $vendedor->delete($id);
        header("Location: ../views/frmVendedor.php");
    }

    public function getById($id) {
        $vendedor = new Vendedor();
        return $vendedor->getById($id);
    }
}
