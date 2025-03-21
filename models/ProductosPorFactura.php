<?php
class ProductosPorFactura {
    private $id;
    private $factura_id;
    private $producto_id;
    private $cantidad;
    private $subtotal;

    public function __construct($id, $factura_id, $producto_id, $cantidad, $subtotal) {
        $this->id = $id;
        $this->factura_id = $factura_id;
        $this->producto_id = $producto_id;
        $this->cantidad = $cantidad;
        $this->subtotal = $subtotal;
    }

    // Métodos getter y setter
    public function getId() { return $this->id; }
    public function getFacturaId() { return $this->factura_id; }
    public function getProductoId() { return $this->producto_id; }
    public function getCantidad() { return $this->cantidad; }
    public function getSubtotal() { return $this->subtotal; }

    public function setId($id) { $this->id = $id; }
    public function setFacturaId($factura_id) { $this->factura_id = $factura_id; }
    public function setProductoId($producto_id) { $this->producto_id = $producto_id; }
    public function setCantidad($cantidad) { $this->cantidad = $cantidad; }
    public function setSubtotal($subtotal) { $this->subtotal = $subtotal; }
}
?>
