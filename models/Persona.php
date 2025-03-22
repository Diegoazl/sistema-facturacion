
<?php
abstract class Persona extends Conexion {
    public $id, $codigo, $nombre, $email, $telefono, $carnet, $direccion, $credito, $empresa_id, $tipo_persona;

    public function __construct() {
        parent::__construct();
    }
}
