<?php
require_once '../models/Usuario.php';
require_once '../config/db_config.php';

class CtrUsuario {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConnection();
    }

    // Crear usuario
    public function create($email, $contrasena) {
        $usuario = new Usuario($email, $contrasena);
        return $usuario->create($this->conexion);
    }

    // Autenticar usuario
    public function authenticate($email, $contrasena) {
        return Usuario::authenticate($this->conexion, $email, $contrasena);
    }

    // Actualizar la contraseña de un usuario
    public function updatePassword($email, $contrasena) {
        $usuario = new Usuario($email, $contrasena);
        return $usuario->updatePassword($this->conexion);
    }

    // Eliminar usuario
    public function delete($email) {
        $usuario = Usuario::findByEmail($this->conexion, $email);
        return $usuario ? $usuario->delete($this->conexion) : false;
    }
}
?>
