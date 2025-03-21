<?php
require_once 'models/Factura.php';

class FacturaController {

    public function create() {
        require_once 'views/frmFactura.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $factura = new Factura($_POST['fecha'], $_POST['numero'], $_POST['total'], $_POST['cliente_id'], $_POST['vendedor_id']);
            $factura->save();
            header("Location: index.php?action=factura_index");
        }
    }

    public function index() {
        $facturas = Factura::getAll();
        require_once 'views/frmFactura.php';
    }

    public function edit($id) {
        $factura = Factura::getById($id);
        require_once 'views/frmFactura.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $factura = new Factura($_POST['fecha'], $_POST['numero'], $_POST['total'], $_POST['cliente_id'], $_POST['vendedor_id']);
            $factura->update();
            header("Location: index.php?action=factura_index");
        }
    }

    public function delete($id) {
        Factura::delete($id);
        header("Location: index.php?action=factura_index");
    }
}
?>
