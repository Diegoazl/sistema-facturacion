
<?php
require_once '../models/Factura.php';

class FacturaController {
    public function create($data) {
        $factura = new Factura();
        $factura->create($data);
        header("Location: ../views/frmFactura.php");
    }

    public function read() {
        $factura = new Factura();
        return $factura->read();
    }

    public function update($data) {
        $factura = new Factura();
        $factura->update($data);
        header("Location: ../views/frmFactura.php");
    }

    public function delete($id) {
        $factura = new Factura();
        $factura->delete($id);
        header("Location: ../views/frmFactura.php");
    }

    public function getById($id) {
        $factura = new Factura();
        return $factura->getById($id);
    }
}
