<?php
require_once 'config/database.php';

class Vendedor {

    private $id;
    private $codigo;
    private $email;
    private $nombre;
    private $telefono;
    private $tipo;
    private $carnet;
    private $direccion;
    private $empresa_id;
    private $tipo_persona;

    public function __construct($codigo = "", $email = "", $nombre = "", $telefono = "", $tipo = "", $carnet = "", $direccion = "", $empresa_id = 0, $tipo_persona = "") {
        $this->codigo = $codigo;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->tipo = $tipo;
        $this->carnet = $carnet;
        $this->direccion = $direccion;
        $this->empresa_id = $empresa_id;
        $this->tipo_persona = $tipo_persona;
    }

    public function save() {
        global $pdo;
        $sql = "INSERT INTO personas (codigo, email, nombre, telefono, tipo, carnet, direccion, empresa_id, tipo_persona) 
                VALUES (:codigo, :email, :nombre, :telefono, :tipo, :carnet, :direccion, :empresa_id, :tipo_persona)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':email' => $this->email,
            ':nombre' => $this->nombre,
            ':telefono' => $this->telefono,
            ':tipo' => $this->tipo,
            ':carnet' => $this->carnet,
            ':direccion' => $this->direccion,
            ':empresa_id' => $this->empresa_id,
            ':tipo_persona' => $this->tipo_persona
        ]);
    }

    public static function getAll() {
        global $pdo;
        $sql = "SELECT * FROM personas WHERE tipo = 'vendedor'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $sql = "SELECT * FROM personas WHERE id = :id AND tipo = 'vendedor'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        global $pdo;
        $sql = "UPDATE personas SET codigo = :codigo, email = :email, nombre = :nombre, telefono = :telefono, tipo = :tipo, carnet = :carnet, direccion = :direccion, empresa_id = :empresa_id, tipo_persona = :tipo_persona WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':email' => $this->email,
            ':nombre' => $this->nombre,
            ':telefono' => $this->telefono,
            ':tipo' => $this->tipo,
            ':carnet' => $this->carnet,
            ':direccion' => $this->direccion,
            ':empresa_id' => $this->empresa_id,
            ':tipo_persona' => $this->tipo_persona,
            ':id' => $this->id
        ]);
    }

    public static function delete($id) {
        global $pdo;
        $sql = "DELETE FROM personas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
