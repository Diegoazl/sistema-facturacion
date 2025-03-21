<?php
include_once 'Persona.php';

class Vendedor extends Persona {
    public function __construct($id, $codigo, $email, $nombre, $telefono, $carne, $direccion, $tipo_persona) {
        parent::__construct($id, $codigo, $email, $nombre, $telefono, 'vendedor', $carne, $direccion, null, null, $tipo_persona);
    }
}
?>
