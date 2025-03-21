<?php
class Empresa {
    private $id;
    private $codigo;
    private $nombre;
    
    public function __construct($codigo, $nombre, $id = null) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
    }

    // Guardar o actualizar empresa
    public function save() {
        global $pdo;

        if ($this->id) {
            // Actualizar empresa
            $sql = "UPDATE empresas SET codigo = :codigo, nombre = :nombre WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $this->id, ':codigo' => $this->codigo, ':nombre' => $this->nombre]);
        } else {
            // Crear nueva empresa
            $sql = "INSERT INTO empresas (codigo, nombre) VALUES (:codigo, :nombre)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':codigo' => $this->codigo, ':nombre' => $this->nombre]);
        }
    }

    // Eliminar empresa (verificar si tiene clientes o vendedores asociados)
    public function delete($id) {
        global $pdo;

        // Verificar si la empresa tiene clientes o vendedores asociados
        $sql = "SELECT COUNT(*) FROM clientes WHERE empresa_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $clientes = $stmt->fetchColumn();

        if ($clientes > 0) {
            echo "No se puede eliminar la empresa porque tiene clientes asociados.";
            return;
        }

        $sql = "DELETE FROM empresas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Obtener todos los registros de empresas
    public function getAll() {
        global $pdo;
        $sql = "SELECT * FROM empresas";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener empresa por ID
    public function getById($id) {
        global $pdo;
        $sql = "SELECT * FROM empresas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
