<?php
require_once 'config/database.php';

class Vendedor {

    private $id;
    private $codigo;
    private $email;
    private $nombre;
    private $telefono;
    private $carnet;
    private $direccion;
    private $credito;
    private $empresa_id;

    public function __construct($codigo = "", $email = "", $nombre = "", $telefono = "", $carnet = "", $direccion = "", $credito = 0.0, $empresa_id = 0) {
        $this->codigo = $codigo;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->carnet = $carnet;
        $this->direccion = $direccion;
        $this->credito = $credito;
        $this->empresa_id = $empresa_id;
    }

    // Guardar vendedor
    public function save() {
        global $pdo;
        $sql = "INSERT INTO personas (codigo, email, nombre, telefono, tipo, carnet, direccion, credito, empresa_id, tipo_persona) 
                VALUES (:codigo, :email, :nombre, :telefono, 'vendedor', :carnet, :direccion, :credito, :empresa_id, 'vendedor')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':email' => $this->email,
            ':nombre' => $this->nombre,
            ':telefono' => $this->telefono,
            ':carnet' => $this->carnet,
            ':direccion' => $this->direccion,
            ':credito' => $this->credito,
            ':empresa_id' => $this->empresa_id
        ]);
    }

    // Obtener todos los vendedores
    public static function getAll() {
        global $pdo;
        $sql = "SELECT * FROM personas WHERE tipo = 'vendedor'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un vendedor por su ID
    public static function getById($id) {
        global $pdo;
        $sql = "SELECT * FROM personas WHERE id = :id AND tipo = 'vendedor'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar vendedor
    public function update($id) {
        global $pdo;
        $sql = "UPDATE personas SET codigo = :codigo, email = :email, nombre = :nombre, telefono = :telefono, carnet = :carnet, direccion = :direccion, credito = :credito, empresa_id = :empresa_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $this->codigo,
            ':email' => $this->email,
            ':nombre' => $this->nombre,
            ':telefono' => $this->telefono,
            ':carnet' => $this->carnet,
            ':direccion' => $this->direccion,
            ':credito' => $this->credito,
            ':empresa_id' => $this->empresa_id,
            ':id' => $id
        ]);
    }

    // Eliminar vendedor
    public static function delete($id) {
        global $pdo;
        $sql = "DELETE FROM personas WHERE id = :id AND tipo = 'vendedor'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Buscar vendedor
    public static function search($query) {
        global $pdo;
        $sql = "SELECT * FROM personas WHERE nombre LIKE :query OR codigo LIKE :query";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':query' => '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
