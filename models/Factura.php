<?php
require_once 'config/database.php';

class Factura {

    private $id;
    private $fecha;
    private $numero;
    private $total;
    private $cliente_id;
    private $vendedor_id;

    public function __construct($fecha = "", $numero = "", $total = 0.0, $cliente_id = 0, $vendedor_id = 0) {
        $this->fecha = $fecha;
        $this->numero = $numero;
        $this->total = $total;
        $this->cliente_id = $cliente_id;
        $this->vendedor_id = $vendedor_id;
    }

    public function save() {
        global $pdo;
        $sql = "INSERT INTO facturas (fecha, numero, total, cliente_id, vendedor_id) 
                VALUES (:fecha, :numero, :total, :cliente_id, :vendedor_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fecha' => $this->fecha,
            ':numero' => $this->numero,
            ':total' => $this->total,
            ':cliente_id' => $this->cliente_id,
            ':vendedor_id' => $this->vendedor_id
        ]);
    }

    public static function getAll() {
        global $pdo;
        $sql = "SELECT * FROM facturas";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $sql = "SELECT * FROM facturas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        global $pdo;
        $sql = "UPDATE facturas SET fecha = :fecha, numero = :numero, total = :total, cliente_id = :cliente_id, vendedor_id = :vendedor_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fecha' => $this->fecha,
            ':numero' => $this->numero,
            ':total' => $this->total,
            ':cliente_id' => $this->cliente_id,
            ':vendedor_id' => $this->vendedor_id,
            ':id' => $this->id
        ]);
    }

    public static function delete($id) {
        global $pdo;
        $sql = "DELETE FROM facturas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
