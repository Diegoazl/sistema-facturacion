<?php
require_once 'config/database.php';

class Empresa {

    private $id;
    private $codigo;
    private $nombre;

    public function __construct($codigo = "", $nombre = "") {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
    }

    public function save() {
        global $pdo;
        $sql = "INSERT INTO empresas (codigo, nombre) 
                VALUES (:codigo, :nombre)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':nombre' => $this->nombre
        ]);
    }

    public static function getAll() {
        global $pdo;
        $sql = "SELECT * FROM empresas";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $sql = "SELECT * FROM empresas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        global $pdo;
        $sql = "UPDATE empresas SET codigo = :codigo, nombre = :nombre WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':nombre' => $this->nombre,
            ':id' => $this->id
        ]);
    }

    public static function delete($id) {
        global $pdo;
        $sql = "DELETE FROM empresas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
