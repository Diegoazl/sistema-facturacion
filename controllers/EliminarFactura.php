<?php
include_once '../controllers/CtrFactura.php';

$id = $_GET['id'];
$ctrFactura = new CtrFactura();
$ctrFactura->eliminarFactura($id);

header('Location: ../views/frmFactura.php'); // Redirigir al listado de facturas
?>
