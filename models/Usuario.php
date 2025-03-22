<?php

class Usuario {
    private $email;
    private $contrasena;

    // Constructor
    public function __construct($email = "", $contrasena = "") {
        $this->email = $email;
        $this->contrasena = $contrasena;
    }

    // Métodos getter y setter
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    // Método para crear un nuevo usuario
    public function create($conexion) {
        $query = "INSERT INTO usuario (email, contrasena) VALUES (?, ?)";
        $stmt = $conexion->prepare($query);
        $hashedPassword = password_hash($this->contrasena, PASSWORD_BCRYPT);  // Encriptar la contraseña
        return $stmt->execute([$this->email, $hashedPassword]);
    }

    // Método para obtener un usuario por su email
    public static function findByEmail($conexion, $email) {
        $query = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        
        if ($result) {
            return new Usuario($result['email'], $result['contrasena']);
        }
        return null;
    }

    // Método para autenticar un usuario
    public static function authenticate($conexion, $email, $contrasena) {
        $usuario = self::findByEmail($conexion, $email);
        if ($usuario && password_verify($contrasena, $usuario->getContrasena())) {
            return true;  // Autenticación exitosa
        }
        return false;  // Autenticación fallida
    }

    // Método para actualizar la contraseña de un usuario
    public function updatePassword($conexion) {
        $query = "UPDATE usuario SET contrasena = ? WHERE email = ?";
        $stmt = $conexion->prepare($query);
        $hashedPassword = password_hash($this->contrasena, PASSWORD_BCRYPT);  // Encriptar la nueva contraseña
        return $stmt->execute([$hashedPassword, $this->email]);
    }

    // Método para eliminar un usuario
    public function delete($conexion) {
        $query = "DELETE FROM usuario WHERE email = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->email]);
    }
}
?>
