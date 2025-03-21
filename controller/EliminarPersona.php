<?php
include_once '../controllers/CtrPersona.php';

$id = $_GET['id'];
$ctrPersona = new CtrPersona();
$ctrPersona->eliminarPersona($id);

header('Location: frmPersona.php'); // Redirigir al listado de personas
?>
