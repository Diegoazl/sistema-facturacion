<?php
require_once '../config/db_config.php';

class Factura {
    private $id;
    private $numero;
    private $total;
    private $fecha;
    private $fkidcliente;
    private $fkidvendedor;

    public function __construct($id = null, $numero = "", $total = 0.0, $fecha = "", $fkidcliente = null, $fkidvendedor = null) {
        $this->id = $id;
        $this->numero = $numero;
        $this->total = $total;
        $this->fecha = $fecha;
        $this->fkidcliente = $fkidcliente;
        $this->fkidvendedor = $fkidvendedor;
    }

    // Métodos de acceso y getters
    public function getId() { return $this->id; }
    public function getNumero() { return $this->numero; }
    public function getTotal() { return $this->total; }
    public function getFecha() { return $this->fecha; }
    public function getFkIdCliente() { return $this->fkidcliente; }
    public function getFkIdVendedor() { return $this->fkidvendedor; }

    // Crear factura
    public function create() {
        $conexion = Conexion::getConnection();
        $query = "INSERT INTO factura (numero, total, fecha, fkidcliente, fkidvendedor) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->numero, $this->total, $this->fecha, $this->fkidcliente, $this->fkidvendedor]);
    }

    // Obtener todas las facturas
    public static function getAll() {
        $conexion = Conexion::getConnection();
        $query = "SELECT * FROM factura";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar factura por ID
    public static function findById($id) {
        $conexion = Conexion::getConnection();
        $query = "SELECT * FROM factura WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result ? new Factura($result['id'], $result['numero'], $result['total'], $result['fecha'], $result['fkidcliente'], $result['fkidvendedor']) : null;
    }

    // Actualizar factura
    public function update() {
        $conexion = Conexion::getConnection();
        $query = "UPDATE factura SET numero = ?, total = ?, fecha = ?, fkidcliente = ?, fkidvendedor = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->numero, $this->total, $this->fecha, $this->fkidcliente, $this->fkidvendedor, $this->id]);
    }

    // Eliminar factura
    public function delete() {
        $conexion = Conexion::getConnection();
        $query = "DELETE FROM factura WHERE id = ?";
        $stmt = $conexion->prepare($query);
        return $stmt->execute([$this->id]);
    }

    // Método de búsqueda (por número o cliente)
    public static function search($numero = null, $cliente = null) {
        $conexion = Conexion::getConnection();
        $query = "SELECT * FROM factura WHERE 1";

        if ($numero) {
            $query .= " AND numero LIKE :numero";
        }
        if ($cliente) {
            $query .= " AND fkidcliente = :cliente";
        }

        $stmt = $conexion->prepare($query);

        if ($numero) {
            $stmt->bindParam(':numero', '%' . $numero . '%', PDO::PARAM_STR);
        }
        if ($cliente) {
            $stmt->bindParam(':cliente', $cliente, PDO::PARAM_INT);
        }

        $stmt->execute();
        $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $resultado = [];
        foreach ($facturas as $factura) {
            $resultado[] = new Factura($factura['id'], $factura['numero'], $factura['total'], $factura['fecha'], $factura['fkidcliente'], $factura['fkidvendedor']);
        }

        return $resultado;
    }
}
?>
