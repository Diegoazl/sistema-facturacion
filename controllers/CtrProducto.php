<?php
require_once '../models/Producto.php';
require_once '../config/db_config.php';

class CtrProducto {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConnection();
    }

    // Crear producto
    public function create($codigo, $nombre, $stock, $valorunitario) {
        $producto = new Producto($codigo, $nombre, $stock, $valorunitario);
        return $producto->create($this->conexion);
    }

    // Obtener todos los productos
    public function getAll() {
        return Producto::getAll($this->conexion); // Devuelve un array de objetos Producto
    }

    // Obtener un producto por código
    public function getByCodigo($codigo) {
        return Producto::findByCodigo($this->conexion, $codigo);
    }

    // Actualizar producto
    public function update($codigo, $nombre, $stock, $valorunitario) {
        $producto = new Producto($codigo, $nombre, $stock, $valorunitario);
        return $producto->update($this->conexion);
    }

    // Eliminar producto
    public function delete($codigo) {
        $producto = Producto::findByCodigo($this->conexion, $codigo);
        return $producto ? $producto->delete($this->conexion) : false;
    }

    // Buscar productos por código o nombre
    public function search($codigo, $nombre) {
        $query = "SELECT * FROM producto WHERE 1=1";
        $params = [];

        if ($codigo != "") {
            $query .= " AND codigo LIKE ?";
            $params[] = "%$codigo%";
        }

        if ($nombre != "") {
            $query .= " AND nombre LIKE ?";
            $params[] = "%$nombre%";
        }

        $stmt = $this->conexion->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll();

        $productos = [];
        foreach ($result as $row) {
            $productos[] = new Producto($row['codigo'], $row['nombre'], $row['stock'], $row['valorunitario']);
        }
        return $productos;
    }
}
