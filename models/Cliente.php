<?php
include_once 'Persona.php';

class Cliente extends Persona {
    public function __construct($id, $codigo, $email, $nombre, $telefono, $credito, $empresa_id, $tipo_persona) {
        parent::__construct($id, $codigo, $email, $nombre, $telefono, 'cliente', null, null, $credito, $empresa_id, $tipo_persona);
    }
}
?>
