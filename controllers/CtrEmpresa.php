<?php
require_once '../models/Empresa.php';

class CtrEmpresa {

    public function create($nombre, $direccion, $telefono) {
        $empresa = new Empresa(null, $nombre, $direccion, $telefono);
        return $empresa->create();
    }

    public function getAll() {
        return Empresa::getAll();
    }

    public function findById($id) {
        return Empresa::findById($id);
    }

    public function update($id, $nombre, $direccion, $telefono) {
        $empresa = new Empresa($id, $nombre, $direccion, $telefono);
        return $empresa->update();
    }

    public function delete($id) {
        $empresa = new Empresa($id);
        return $empresa->delete();
    }

    public function search($id = null, $nombre = null) {
        return Empresa::search($id, $nombre);
    }
}
?>
