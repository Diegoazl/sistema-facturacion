<?php
class Factura {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear una factura
    public function crearFactura($numero, $cliente_id, $vendedor_id, $total) {
        $sql = "INSERT INTO facturas (numero, cliente_id, vendedor_id, total) 
                VALUES (:numero, :cliente_id, :vendedor_id, :total)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':numero' => $numero,
            ':cliente_id' => $cliente_id,
            ':vendedor_id' => $vendedor_id,
            ':total' => $total
        ]);
    }

    // Obtener todas las facturas
    public function obtenerFacturas() {
        $sql = "SELECT * FROM facturas";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener factura por ID
    public function obtenerFacturaPorId($id) {
        $sql = "SELECT * FROM facturas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar una factura
    public function actualizarFactura($id, $numero, $cliente_id, $vendedor_id, $total) {
        $sql = "UPDATE facturas SET numero = :numero, cliente_id = :cliente_id, vendedor_id = :vendedor_id, total = :total 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':numero' => $numero,
            ':cliente_id' => $cliente_id,
            ':vendedor_id' => $vendedor_id,
            ':total' => $total
        ]);
    }

    // Eliminar una factura
    public function eliminarFactura($id) {
        $sql = "DELETE FROM facturas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
