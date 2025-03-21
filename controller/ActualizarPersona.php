<?php
include_once '../controllers/CtrPersona.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $tipo = $_POST['tipo'];
    $carne = isset($_POST['carne']) ? $_POST['carne'] : null;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
    $credito = isset($_POST['credito']) ? $_POST['credito'] : null;
    $empresa_id = isset($_POST['empresa_id']) ? $_POST['empresa_id'] : null;
    $tipo_persona = isset($_POST['tipo_persona']) ? $_POST['tipo_persona'] : null;

    $ctrPersona = new CtrPersona();
    $ctrPersona->actualizarPersona($id, $codigo, $email, $nombre, $telefono, $tipo, $carne, $direccion, $credito, $empresa_id, $tipo_persona);
    
    header('Location: frmPersona.php'); // Redirigir al listado de personas
}
?>
