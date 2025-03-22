<?php
require_once '../config/db_config.php';

class Empresa {
    private $id;
    private $nombre;
    private $direccion;
    private $telefono;

    public function __construct($id = null, $nombre = "", $direccion = "", $telefono = "") {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }

    // Métodos de acceso y getters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getDireccion() { return $this->direccion; }
    public function getTelefono() { return $this->telefono; }

    // Crear empresa
    public function create() {
        $conexion = Conexion::getConnection();
        $query = "INSERT INTO empresa (nombre, direccion, telefono) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->nombre, $this->direccion, $this->telefono]);
    }

    // Obtener todas las empresas
    public static function getAll() {
        $conexion = Conexion::getConnection();
        $query = "SELECT * FROM empresa";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar empresa por ID
    public static function findById($id) {
        $conexion = Conexion::getConnection();
        $query = "SELECT * FROM empresa WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result ? new Empresa($result['id'], $result['nombre'], $result['direccion'], $result['telefono']) : null;
    }

    // Actualizar empresa
    public function update() {
        $conexion = Conexion::getConnection();
        $query = "UPDATE empresa SET nombre = ?, direccion = ?, telefono = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->nombre, $this->direccion, $this->telefono, $this->id]);
    }

    // Eliminar empresa
    public function delete() {
        $conexion = Conexion::getConnection();
        $query = "DELETE FROM empresa WHERE id = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->id]);
    }

    // Método de búsqueda (por ID o nombre)
    public static function search($id = null, $nombre = null) {
        $conexion = Conexion::getConnection();
        $query = "SELECT * FROM empresa WHERE 1";

        if ($id) {
            $query .= " AND id = :id";
        }
        if ($nombre) {
            $query .= " AND nombre LIKE :nombre";
        }

        $stmt = $conexion->prepare($query);

        if ($id) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }
        if ($nombre) {
            $stmt->bindParam(':nombre', '%' . $nombre . '%', PDO::PARAM_STR);
        }

        $stmt->execute();
        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $resultado = [];
        foreach ($empresas as $empresa) {
            $resultado[] = new Empresa($empresa['id'], $empresa['nombre'], $empresa['direccion'], $empresa['telefono']);
        }

        return $resultado;
    }
}
?>
