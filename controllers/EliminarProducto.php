<?php
include_once '../controllers/CtrProducto.php';

$id = $_GET['id'];
$ctrProducto = new CtrProducto();
$ctrProducto->eliminarProducto($id);

header('Location: ../views/frmProducto.php'); // Redirigir al listado de productos
?>
