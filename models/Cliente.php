<?php
class Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear un cliente
    public function crearCliente($codigo, $nombre, $email, $telefono, $tipo) {
        $sql = "INSERT INTO personas (codigo, nombre, email, telefono, tipo) 
                VALUES (:codigo, :nombre, :email, :telefono, :tipo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $codigo,
            ':nombre' => $nombre,
            ':email' => $email,
            ':telefono' => $telefono,
            ':tipo' => $tipo
        ]);
    }

    // Obtener todos los clientes
    public function obtenerClientes() {
        $sql = "SELECT * FROM personas WHERE tipo = 'cliente'";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener cliente por ID
    public function obtenerClientePorId($id) {
        $sql = "SELECT * FROM personas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un cliente
    public function actualizarCliente($id, $codigo, $nombre, $email, $telefono, $tipo) {
        $sql = "UPDATE personas SET codigo = :codigo, nombre = :nombre, email = :email, 
                telefono = :telefono, tipo = :tipo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':codigo' => $codigo,
            ':nombre' => $nombre,
            ':email' => $email,
            ':telefono' => $telefono,
            ':tipo' => $tipo
        ]);
    }

    // Eliminar un cliente
    public function eliminarCliente($id) {
        $sql = "DELETE FROM personas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
