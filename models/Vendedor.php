
<?php
require_once 'Persona.php';

class Vendedor extends Persona {
    public function create($data) {
        $sql = "INSERT INTO personas (codigo, email, nombre, telefono, tipo, carnet, direccion, credito, empresa_id, tipo_persona)
                VALUES (?, ?, ?, ?, 'vendedor', ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data['codigo'], $data['email'], $data['nombre'], $data['telefono'], $data['carnet'], $data['direccion'], $data['credito'], $data['empresa_id'], $data['tipo_persona']]);
    }

    public function read() {
        $stmt = $this->conn->query("SELECT * FROM personas WHERE tipo = 'vendedor'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $sql = "UPDATE personas SET codigo = ?, email = ?, nombre = ?, telefono = ?, carnet = ?, direccion = ?, credito = ?, empresa_id = ?, tipo_persona = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data['codigo'], $data['email'], $data['nombre'], $data['telefono'], $data['carnet'], $data['direccion'], $data['credito'], $data['empresa_id'], $data['tipo_persona'], $data['id']]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM personas WHERE id = ? AND tipo = 'vendedor'");
        $stmt->execute([$id]);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM personas WHERE id = ? AND tipo = 'vendedor'");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
