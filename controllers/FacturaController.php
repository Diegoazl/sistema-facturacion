<?php
require_once 'models/Factura.php';

class FacturaController {

    // Mostrar todas las facturas
    public function index() {
        $facturas = Factura::getAll();
        require_once 'views/frmFactura.php';
    }

    // Guardar una nueva factura
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $factura = new Factura($_POST['fecha'], $_POST['numero'], $_POST['total'], $_POST['cliente_id'], $_POST['vendedor_id']);
            $factura->save();
            header("Location: index.php?action=factura_index");
        }
    }

    // Editar una factura
    public function edit($id) {
        $factura = Factura::getById($id);
        require_once 'views/frmFactura.php';
    }

    // Actualizar factura
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $factura = new Factura($_POST['fecha'], $_POST['numero'], $_POST['total'], $_POST['cliente_id'], $_POST['vendedor_id']);
            $factura->update($id);
            header("Location: index.php?action=factura_index");
        }
    }

    // Eliminar una factura
    public function delete($id) {
        Factura::delete($id);
        header("Location: index.php?action=factura_index");
    }

    // Buscar facturas
    public function search() {
        $facturas = [];
        if (isset($_POST['search_query'])) {
            $facturas = Factura::search($_POST['search_query']);
        }
        require_once 'views/frmFactura.php';
    }
}
?>
