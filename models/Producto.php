<?php

class Producto {
    private $codigo;
    private $nombre;
    private $stock;
    private $valorunitario;

    public function __construct($codigo = "", $nombre = "", $stock = 0, $valorunitario = 0.0) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->stock = $stock;
        $this->valorunitario = $valorunitario;
    }

    // Getters para acceder a las propiedades privadas
    public function getCodigo() { return $this->codigo; }
    public function getNombre() { return $this->nombre; }
    public function getStock() { return $this->stock; }
    public function getValorUnitario() { return $this->valorunitario; }

    // Crear producto
    public function create($conexion) {
        $query = "INSERT INTO producto (codigo, nombre, stock, valorunitario) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->codigo, $this->nombre, $this->stock, $this->valorunitario]);
    }

    // Obtener todos los productos
    public static function getAll($conexion) {
        $query = "SELECT * FROM producto";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $productos = [];
        foreach ($result as $row) {
            $productos[] = new Producto($row['codigo'], $row['nombre'], $row['stock'], $row['valorunitario']);
        }
        return $productos;
    }

    // Obtener un producto por código
    public static function findByCodigo($conexion, $codigo) {
        $query = "SELECT * FROM producto WHERE codigo = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$codigo]);
        $result = $stmt->fetch();
        return $result ? new Producto($result['codigo'], $result['nombre'], $result['stock'], $result['valorunitario']) : null;
    }

    // Actualizar producto
    public function update($conexion) {
        $query = "UPDATE producto SET nombre = ?, stock = ?, valorunitario = ? WHERE codigo = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->nombre, $this->stock, $this->valorunitario, $this->codigo]);
    }

    // Eliminar producto
    public function delete($conexion) {
        $query = "DELETE FROM producto WHERE codigo = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->codigo]);
    }
}
