<?php
include_once '../controllers/CtrVendedor.php';

$id = $_GET['id'];
$ctrVendedor = new CtrVendedor();
$ctrVendedor->eliminarVendedor($id);

header('Location: ../views/frmVendedor.php'); // Redirigir al listado de vendedores
?>
