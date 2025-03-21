<?php
include_once '../controllers/CtrCliente.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $credito = $_POST['credito'];
    $empresa_id = $_POST['empresa_id'];

    $ctrCliente = new CtrCliente();
    $ctrCliente->actualizarCliente($id, $codigo, $email, $nombre, $telefono, $credito, $empresa_id);

    header('Location: ../views/frmCliente.php'); // Redirigir al listado de clientes
}
?>
