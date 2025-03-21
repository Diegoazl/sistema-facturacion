<?php
class Producto {
    private $id;
    private $codigo;
    private $nombre;
    private $stock;
    private $valor_unitario;

    public function __construct($id, $codigo, $nombre, $stock, $valor_unitario) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->stock = $stock;
        $this->valor_unitario = $valor_unitario;
    }

    // Métodos getter y setter
    public function getId() { return $this->id; }
    public function getCodigo() { return $this->codigo; }
    public function getNombre() { return $this->nombre; }
    public function getStock() { return $this->stock; }
    public function getValorUnitario() { return $this->valor_unitario; }

    public function setId($id) { $this->id = $id; }
    public function setCodigo($codigo) { $this->codigo = $codigo; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setStock($stock) { $this->stock = $stock; }
    public function setValorUnitario($valor_unitario) { $this->valor_unitario = $valor_unitario; }
}
?>
