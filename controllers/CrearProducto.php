<?php
include_once '../controllers/CtrProducto.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $ctrProducto = new CtrProducto();
    $ctrProducto->crearProducto($codigo, $nombre, $precio, $stock);

    header('Location: ../views/frmProducto.php'); // Redirigir al listado de productos
}
?>
