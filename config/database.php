<?php
// database.php

// Cambiar para usar variables de entorno o un archivo de configuración
$host = getenv('DB_HOST') ?: 'localhost'; // Si no está en las variables de entorno, se usa localhost
$dbname = getenv('DB_NAME') ?: 'sistema_facturacion';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mejorar el manejo de errores
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>
