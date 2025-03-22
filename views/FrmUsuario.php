<?php
require_once '../controllers/CtrUsuario.php';

$ctrUsuario = new CtrUsuario();

// Crear usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'crear') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $ctrUsuario->create($email, $contrasena);
}

// Autenticación de usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    if ($ctrUsuario->authenticate($email, $contrasena)) {
        echo "Usuario autenticado con éxito.";
    } else {
        echo "Credenciales incorrectas.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="/public/css/estilos.css">
</head>
<body>

<h1>Usuarios</h1>

<!-- Formulario para crear usuario -->
<form method="post">
    <input type="hidden" name="action" value="crear">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>
    
    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" id="contrasena" required><br>
    
    <input type="submit" value="Crear Usuario">
</form>

<!-- Formulario para autenticación -->
<h2>Iniciar sesión</h2>
<form method="post">
    <input type="hidden" name="action" value="login">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>
    
    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" id="contrasena" required><br>
    
    <input type="submit" value="Iniciar sesión">
</form>

<script src="/public/js/script.js"></script>
</body>
</html>
