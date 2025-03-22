<?php
class Empresa {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear empresa
    public function crearEmpresa($codigo, $nombre) {
        $sql = "INSERT INTO empresas (codigo, nombre) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo, $nombre]);
    }

    // Obtener todas las empresas
    public function obtenerEmpresas() {
        $sql = "SELECT * FROM empresas";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar empresas por nombre o código
    public function buscarEmpresas($searchTerm) {
        $sql = "SELECT * FROM empresas WHERE nombre LIKE ? OR codigo LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $searchTerm . '%', '%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener empresa por ID
    public function obtenerEmpresa($id) {
        $sql = "SELECT * FROM empresas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar empresa
    public function actualizarEmpresa($id, $codigo, $nombre) {
        $sql = "UPDATE empresas SET codigo = ?, nombre = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo, $nombre, $id]);
    }

    // Eliminar empresa
    public function eliminarEmpresa($id) {
        $sql = "DELETE FROM empresas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
