<?php

class ProductosPorFactura {
    private $fknumfactura;
    private $fkcodproducto;
    private $cantidad;
    private $subtotal;

    // Constructor
    public function __construct($fknumfactura = null, $fkcodproducto = "", $cantidad = 0, $subtotal = 0.0) {
        $this->fknumfactura = $fknumfactura;
        $this->fkcodproducto = $fkcodproducto;
        $this->cantidad = $cantidad;
        $this->subtotal = $subtotal;
    }

    // Métodos getter y setter
    public function getFknumfactura() {
        return $this->fknumfactura;
    }

    public function setFknumfactura($fknumfactura) {
        $this->fknumfactura = $fknumfactura;
    }

    public function getFkcodproducto() {
        return $this->fkcodproducto;
    }

    public function setFkcodproducto($fkcodproducto) {
        $this->fkcodproducto = $fkcodproducto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    // Método para agregar un producto a la factura
    public function create($conexion) {
        $query = "INSERT INTO productosporfactura (fknumfactura, fkcodproducto, cantidad, subtotal) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->fknumfactura, $this->fkcodproducto, $this->cantidad, $this->subtotal]);
    }

    // Método para obtener productos de una factura
    public static function getByFactura($conexion, $fknumfactura) {
        $query = "SELECT * FROM productosporfactura WHERE fknumfactura = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$fknumfactura]);
        $result = $stmt->fetchAll();

        $productosPorFactura = [];
        foreach ($result as $row) {
            $productosPorFactura[] = new ProductosPorFactura($row['fknumfactura'], $row['fkcodproducto'], $row['cantidad'], $row['subtotal']);
        }
        return $productosPorFactura;
    }

    // Método para actualizar la cantidad o subtotal
    public function update($conexion) {
        $query = "UPDATE productosporfactura SET cantidad = ?, subtotal = ? WHERE fknumfactura = ? AND fkcodproducto = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->cantidad, $this->subtotal, $this->fknumfactura, $this->fkcodproducto]);
    }

    // Método para eliminar un producto de una factura
    public function delete($conexion) {
        $query = "DELETE FROM productosporfactura WHERE fknumfactura = ? AND fkcodproducto = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->fknumfactura, $this->fkcodproducto]);
    }
}
?>
