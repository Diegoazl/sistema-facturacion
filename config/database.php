<?php
class Database {
    private $host = "localhost";
    private $db_name = "sistema_facturacion"; // Nombre de tu base de datos
    private $username = "root"; // Usuario de la base de datos
    private $password = ""; // Contraseña de la base de datos
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Establece la conexión con la base de datos
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
