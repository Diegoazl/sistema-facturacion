<?php
require_once '../models/ProductosPorFactura.php';
require_once '../config/db_config.php';

class CtrProductosPorFactura {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConnection();
    }

    // Agregar producto a factura
    public function create($fknumfactura, $fkcodproducto, $cantidad, $subtotal) {
        $productoPorFactura = new ProductosPorFactura($fknumfactura, $fkcodproducto, $cantidad, $subtotal);
        return $productoPorFactura->create($this->conexion);
    }

    // Obtener productos de una factura
    public function getByFactura($fknumfactura) {
        return ProductosPorFactura::getByFactura($this->conexion, $fknumfactura);
    }

    // Actualizar un producto en la factura
    public function update($fknumfactura, $fkcodproducto, $cantidad, $subtotal) {
        $productoPorFactura = new ProductosPorFactura($fknumfactura, $fkcodproducto, $cantidad, $subtotal);
        return $productoPorFactura->update($this->conexion);
    }

    // Eliminar producto de una factura
    public function delete($fknumfactura, $fkcodproducto) {
        $productoPorFactura = ProductosPorFactura::getByFactura($this->conexion, $fknumfactura);
        return $productoPorFactura ? $productoPorFactura->delete($this->conexion) : false;
    }
}
?>
Este controlador maneja las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para los productos asociados a una factura. Utiliza la clase `ProductosPorFactura` para interactuar con la base de datos.