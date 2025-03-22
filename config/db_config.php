<?php
// Establecer la conexión a la base de datos
class Conexion {
    private static $conexion = null;

    public static function getConnection() {
        if (self::$conexion === null) {
            try {
                // Configuración de la base de datos
                $host = 'localhost'; // Cambiar si es necesario
                $dbname = 'sistema_facturacion'; // Cambiar si es necesario
                $username = 'root'; // Cambiar si es necesario
                $password = ''; // Cambiar si es necesario

                // Crear la conexión
                self::$conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}
?>
