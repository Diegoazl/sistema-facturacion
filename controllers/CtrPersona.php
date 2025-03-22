<?php
class Persona {
    private $id;
    private $nombre;
    private $email;
    private $telefono;
    private $fk_id_rol;
    private $fk_id_empresa;

    // Constructor
    public function __construct($id = null, $nombre = "", $email = "", $telefono = "", $fk_id_rol = 1, $fk_id_empresa = 1) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->fk_id_rol = $fk_id_rol;
        $this->fk_id_empresa = $fk_id_empresa;
    }

    // Métodos Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getRol($conexion) {
        $query = "SELECT nombre FROM rol WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$this->fk_id_rol]);
        $result = $stmt->fetch();
        return $result['nombre'];
    }

    public function getEmpresa($conexion) {
        $query = "SELECT nombre FROM empresa WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$this->fk_id_empresa]);
        $result = $stmt->fetch();
        return $result['nombre'];
    }

    // Método para crear persona
    public function create($conexion) {
        $query = "INSERT INTO persona (nombre, email, telefono, fk_id_rol, fk_id_empresa) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->nombre, $this->email, $this->telefono, $this->fk_id_rol, $this->fk_id_empresa]);
    }

    // Método para obtener todas las personas
    public static function getAll($conexion) {
        $query = "SELECT * FROM persona";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $personas = [];
        foreach ($result as $row) {
            $personas[] = new Persona($row['id'], $row['nombre'], $row['email'], $row['telefono'], $row['fk_id_rol'], $row['fk_id_empresa']);
        }
        return $personas;
    }

    // Buscar persona por nombre o código
    public static function search($conexion, $nombre, $codigo) {
        $query = "SELECT * FROM persona WHERE 1=1";
        $params = [];

        if ($codigo != "") {
            $query .= " AND id LIKE ?";
            $params[] = "%$codigo%";
        }

        if ($nombre != "") {
            $query .= " AND nombre LIKE ?";
            $params[] = "%$nombre%";
        }

        $stmt = $conexion->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll();

        $personas = [];
        foreach ($result as $row) {
            $personas[] = new Persona($row['id'], $row['nombre'], $row['email'], $row['telefono'], $row['fk_id_rol'], $row['fk_id_empresa']);
        }
        return $personas;
    }

    // Actualizar persona
    public function update($conexion) {
        $query = "UPDATE persona SET nombre = ?, email = ?, telefono = ?, fk_id_rol = ?, fk_id_empresa = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->nombre, $this->email, $this->telefono, $this->fk_id_rol, $this->fk_id_empresa, $this->id]);
    }

    // Eliminar persona
    public function delete($conexion) {
        $query = "DELETE FROM persona WHERE id = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->id]);
    }
}
?>
