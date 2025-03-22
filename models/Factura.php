<?php
class Factura {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear factura
    public function crearFactura($numero, $cliente_id, $total) {
        $sql = "INSERT INTO facturas (numero, cliente_id, total) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$numero, $cliente_id, $total]);
    }

    // Obtener todas las facturas
    public function obtenerFacturas() {
        $sql = "SELECT * FROM facturas";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar facturas por número
    public function buscarFacturas($searchTerm) {
        $sql = "SELECT * FROM facturas WHERE numero LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener factura por ID
    public function obtenerFactura($id) {
        $sql = "SELECT * FROM facturas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar factura
    public function actualizarFactura($id, $numero, $cliente_id, $total) {
        $sql = "UPDATE facturas SET numero = ?, cliente_id = ?, total = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$numero, $cliente_id, $total, $id]);
    }

    // Eliminar factura
    public function eliminarFactura($id) {
        $sql = "DELETE FROM facturas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
