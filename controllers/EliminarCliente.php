<?php
include_once '../controllers/CtrCliente.php';

$id = $_GET['id'];
$ctrCliente = new CtrCliente();
$ctrCliente->eliminarCliente($id);

header('Location: ../views/frmCliente.php'); // Redirigir al listado de clientes
?>
