<?php
class Persona {
    private $codigo;
    private $email;
    private $nombre;
    private $telefono;

    public function __construct($codigo, $email, $nombre, $telefono) {
        $this->codigo = $codigo;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTelefono() {
        return $this->telefono;
    }
}
?>
