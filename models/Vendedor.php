<?php
class Vendedor {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear un vendedor
    public function crearVendedor($persona_id) {
        $sql = "INSERT INTO vendedores (fk_persona_id) VALUES (:persona_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':persona_id' => $persona_id]);
    }

    // Obtener todos los vendedores
    public function obtenerVendedores() {
        $sql = "SELECT * FROM vendedores";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener vendedor por ID
    public function obtenerVendedorPorId($id) {
        $sql = "SELECT * FROM vendedores WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un vendedor
    public function actualizarVendedor($id, $persona_id) {
        $sql = "UPDATE vendedores SET fk_persona_id = :persona_id WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':persona_id' => $persona_id
        ]);
    }

    // Eliminar un vendedor
    public function eliminarVendedor($id) {
        $sql = "DELETE FROM vendedores WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
