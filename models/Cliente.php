<?php
class Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear cliente
    public function crearCliente($codigo, $nombre, $email, $telefono) {
        $sql = "INSERT INTO clientes (codigo, nombre, email, telefono) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo, $nombre, $email, $telefono]);
    }

    // Obtener todos los clientes
    public function obtenerClientes() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener cliente por ID
    public function obtenerCliente($id) {
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar cliente
    public function actualizarCliente($id, $codigo, $nombre, $email, $telefono) {
        $sql = "UPDATE clientes SET codigo = ?, nombre = ?, email = ?, telefono = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo, $nombre, $email, $telefono, $id]);
    }

    // Eliminar cliente
    public function eliminarCliente($id) {
        $sql = "DELETE FROM clientes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
