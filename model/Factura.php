<?php
class Factura {
    private $id;
    private $fecha;
    private $numero;
    private $total;
    private $cliente_id;
    private $vendedor_id;

    public function __construct($id, $fecha, $numero, $total, $cliente_id, $vendedor_id) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->numero = $numero;
        $this->total = $total;
        $this->cliente_id = $cliente_id;
        $this->vendedor_id = $vendedor_id;
    }

    // Métodos getter y setter
    public function getId() { return $this->id; }
    public function getFecha() { return $this->fecha; }
    public function getNumero() { return $this->numero; }
    public function getTotal() { return $this->total; }
    public function getClienteId() { return $this->cliente_id; }
    public function getVendedorId() { return $this->vendedor_id; }

    public function setId($id) { $this->id = $id; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setNumero($numero) { $this->numero = $numero; }
    public function setTotal($total) { $this->total = $total; }
    public function setClienteId($cliente_id) { $this->cliente_id = $cliente_id; }
    public function setVendedorId($vendedor_id) { $this->vendedor_id = $vendedor_id; }
}
?>
