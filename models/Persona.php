<?php
class Persona {
    private $id;
    private $codigo;
    private $email;
    private $nombre;
    private $telefono;
    private $tipo;  // 'cliente' o 'vendedor'
    private $carne;
    private $direccion;
    private $credito;
    private $empresa_id;
    private $tipo_persona;

    public function __construct($id, $codigo, $email, $nombre, $telefono, $tipo, $carne = null, $direccion = null, $credito = null, $empresa_id = null, $tipo_persona = null) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->tipo = $tipo;
        $this->carne = $carne;
        $this->direccion = $direccion;
        $this->credito = $credito;
        $this->empresa_id = $empresa_id;
        $this->tipo_persona = $tipo_persona;
    }

    // Métodos getter y setter
    public function getId() { return $this->id; }
    public function getCodigo() { return $this->codigo; }
    public function getEmail() { return $this->email; }
    public function getNombre() { return $this->nombre; }
    public function getTelefono() { return $this->telefono; }
    public function getTipo() { return $this->tipo; }
    public function getCarne() { return $this->carne; }
    public function getDireccion() { return $this->direccion; }
    public function getCredito() { return $this->credito; }
    public function getEmpresaId() { return $this->empresa_id; }
    public function getTipoPersona() { return $this->tipo_persona; }

    public function setId($id) { $this->id = $id; }
    public function setCodigo($codigo) { $this->codigo = $codigo; }
    public function setEmail($email) { $this->email = $email; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function setCarne($carne) { $this->carne = $carne; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setCredito($credito) { $this->credito = $credito; }
    public function setEmpresaId($empresa_id) { $this->empresa_id = $empresa_id; }
    public function setTipoPersona($tipo_persona) { $this->tipo_persona = $tipo_persona; }
}
?>
