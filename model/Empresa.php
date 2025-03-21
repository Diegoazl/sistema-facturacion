<?php
class Empresa {
    private $id;
    private $codigo;
    private $nombre;

    public function __construct($id, $codigo, $nombre) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
    }

    // Métodos getter y setter
    public function getId() { return $this->id; }
    public function getCodigo() { return $this->codigo; }
    public function getNombre() { return $this->nombre; }

    public function setId($id) { $this->id = $id; }
    public function setCodigo($codigo) { $this->codigo = $codigo; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
}
?>
