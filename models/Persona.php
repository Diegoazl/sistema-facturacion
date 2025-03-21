<?php
class Persona {
    private $conn;
    private $table_name = "personas";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las personas
    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una persona por su ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear una nueva persona
    public function crear($codigo, $email, $nombre, $telefono, $tipo, $carne, $direccion, $credito, $empresa_id, $tipo_persona) {
        $query = "INSERT INTO " . $this->table_name . " (codigo, email, nombre, telefono, tipo, carne, direccion, credito, empresa_id, tipo_persona)
                  VALUES (:codigo, :email, :nombre, :telefono, :tipo, :carne, :direccion, :credito, :empresa_id, :tipo_persona)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':carne', $carne);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':credito', $credito);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':tipo_persona', $tipo_persona);
        return $stmt->execute();
    }

    // Actualizar una persona existente
    public function actualizar($id, $codigo, $email, $nombre, $telefono, $tipo, $carne, $direccion, $credito, $empresa_id, $tipo_persona) {
        $query = "UPDATE " . $this->table_name . " SET codigo = :codigo, email = :email, nombre = :nombre, telefono = :telefono, tipo = :tipo, carne = :carne, direccion = :direccion, credito = :credito, empresa_id = :empresa_id, tipo_persona = :tipo_persona WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':carne', $carne);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':credito', $credito);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':tipo_persona', $tipo_persona);
        return $stmt->execute();
    }

    // Eliminar una persona
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
