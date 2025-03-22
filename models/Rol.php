<?php

class Rol {
    private $id;
    private $nombre;

    // Constructor
    public function __construct($id = null, $nombre = "") {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    // Métodos getter y setter
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Método para crear un nuevo rol
    public function create($conexion) {
        $query = "INSERT INTO rol (nombre) VALUES (?)";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->nombre]);
    }

    // Método para obtener un rol por su ID
    public static function findById($conexion, $id) {
        $query = "SELECT * FROM rol WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        
        if ($result) {
            return new Rol($result['id'], $result['nombre']);
        }
        return null;
    }

    // Método para obtener todos los roles
    public static function getAll($conexion) {
        $query = "SELECT * FROM rol";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $roles = [];
        foreach ($result as $row) {
            $roles[] = new Rol($row['id'], $row['nombre']);
        }
        return $roles;
    }

    // Método para actualizar un rol
    public function update($conexion) {
        $query = "UPDATE rol SET nombre = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->nombre, $this->id]);
    }

    // Método para eliminar un rol
    public function delete($conexion) {
        $query = "DELETE FROM rol WHERE id = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->id]);
    }
}
?>
