<?php
include_once '../models/Factura.php';
include_once '../config/database.php';

class CtrFactura {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    // Crear factura
    public function crearFactura($fecha, $numero, $total, $cliente_id, $vendedor_id) {
        $query = "INSERT INTO facturas (fecha, numero, total, cliente_id, vendedor_id)
                  VALUES ('$fecha', '$numero', '$total', '$cliente_id', '$vendedor_id')";
        $this->conn->exec($query);
    }

    // Obtener todas las facturas
    public function obtenerFacturas() {
        $query = "SELECT * FROM facturas";
        return $this->conn->query($query)->fetchAll();
    }

    // Obtener factura por ID
    public function obtenerFacturaPorId($id) {
        $query = "SELECT * FROM facturas WHERE id = $id";
        return $this->conn->query($query)->fetch();
    }

    // Actualizar factura
    public function actualizarFactura($id, $fecha, $numero, $total, $cliente_id, $vendedor_id) {
        $query = "UPDATE facturas SET fecha = '$fecha', numero = '$numero', total = '$total', cliente_id = '$cliente_id', vendedor_id = '$vendedor_id' WHERE id = $id";
        $this->conn->exec($query);
    }

    // Eliminar factura
    public function eliminarFactura($id) {
        $query = "DELETE FROM facturas WHERE id = $id";
        $this->conn->exec($query);
    }
}
?>
