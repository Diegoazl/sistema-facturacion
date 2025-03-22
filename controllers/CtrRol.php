<?php
require_once '../models/Rol.php';
require_once '../config/db_config.php';

class CtrRol {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConnection();
    }

    // Crear rol
    public function create($nombre) {
        $rol = new Rol(null, $nombre);
        return $rol->create($this->conexion);
    }

    // Obtener todos los roles
    public function getAll() {
        return Rol::getAll($this->conexion);
    }

    // Obtener un rol por su ID
    public function getById($id) {
        return Rol::findById($this->conexion, $id);
    }

    // Actualizar rol
    public function update($id, $nombre) {
        $rol = new Rol($id, $nombre);
        return $rol->update($this->conexion);
    }

    // Eliminar rol
    public function delete($id) {
        $rol = Rol::findById($this->conexion, $id);
        return $rol ? $rol->delete($this->conexion) : false;
    }
}
?>
