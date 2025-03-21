<?php
include_once '../controllers/CtrVendedor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $carne = $_POST['carne'];
    $direccion = $_POST['direccion'];

    $ctrVendedor = new CtrVendedor();
    $ctrVendedor->crearVendedor($codigo, $email, $nombre, $telefono, $carne, $direccion);

    header('Location: ../views/frmVendedor.php'); // Redirigir al listado de vendedores
}
?>
