<?php
class Producto{
    private $conn;
    private $table = "productos";

    public $id;
    public $codigo;
    public $nombre;
    public $precio;
    public $stock;

    public function __construct(){
        $this->conn = (new Database())->getConnection();
    }

    // Crear un nuevo producto
    public function crearProducto(){
        $query = "INSERT INTO " . $this->table . " SET codigo=:codigo, nombre=:nombre, precio=:precio, stock=:stock";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':codigo', $this->codigo);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':stock', $this->stock);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Obtener producto por ID
    public function obtenerProductoPorId(){
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->codigo = $row['codigo'];
        $this->nombre = $row['nombre'];
        $this->precio = $row['precio'];
        $this->stock = $row['stock'];
    }

    // Editar un producto existente
    public function editarProducto(){
        $query = "UPDATE " . $this->table . " SET codigo=:codigo, nombre=:nombre, precio=:precio, stock=:stock WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':codigo', $this->codigo);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Eliminar un producto
    public function eliminarProducto(){
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
