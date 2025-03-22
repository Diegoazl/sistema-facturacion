<?php
require_once '../models/Factura.php';

class CtrFactura {

    public function create($numero, $total, $fecha, $fkidcliente, $fkidvendedor) {
        $factura = new Factura(null, $numero, $total, $fecha, $fkidcliente, $fkidvendedor);
        return $factura->create();
    }

    public function getAll() {
        return Factura::getAll();
    }

    public function findById($id) {
        return Factura::findById($id);
    }

    public function update($id, $numero, $total, $fecha, $fkidcliente, $fkidvendedor) {
        $factura = new Factura($id, $numero, $total, $fecha, $fkidcliente, $fkidvendedor);
        return $factura->update();
    }

    public function delete($id) {
        $factura = new Factura($id);
        return $factura->delete();
    }

    public function search($numero = null, $cliente = null) {
        return Factura::search($numero, $cliente);
    }
}
?>
