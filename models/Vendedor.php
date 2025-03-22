<?php
class Vendedor {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear vendedor
    public function crearVendedor($codigo, $nombre) {
        $sql = "INSERT INTO vendedores (codigo, nombre) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo, $nombre]);
    }

    // Obtener todos los vendedores
    public function obtenerVendedores() {
        $sql = "SELECT * FROM vendedores";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar vendedores por nombre o código
    public function buscarVendedores($searchTerm) {
        $sql = "SELECT * FROM vendedores WHERE nombre LIKE ? OR codigo LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $searchTerm . '%', '%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener vendedor por ID
    public function obtenerVendedor($id) {
        $sql = "SELECT * FROM vendedores WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar vendedor
    public function actualizarVendedor($id, $codigo, $nombre) {
        $sql = "UPDATE vendedores SET codigo = ?, nombre = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo, $nombre, $id]);
    }

    // Eliminar vendedor
    public function eliminarVendedor($id) {
        $sql = "DELETE FROM vendedores WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
