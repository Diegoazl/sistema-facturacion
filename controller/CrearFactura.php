<?php
include_once '../controllers/CtrFactura.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $numero = $_POST['numero'];
    $total = $_POST['total'];
    $cliente_id = $_POST['cliente_id'];
    $vendedor_id = $_POST['vendedor_id'];

    $ctrFactura = new CtrFactura();
    $ctrFactura->crearFactura($fecha, $numero, $total, $cliente_id, $vendedor_id);
    
    header('Location: frmFactura.php'); // Redirigir al listado de facturas
}
?>
