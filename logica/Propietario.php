<?php
class Propietario extends Persona implements Usuario{
    private $saldo;
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $saldo = 0.0){
        parent::__construct($id, $nombre, $apellido, $correo, $clave);
        $this->saldo = $saldo;
    }

    public function getSaldo(){
        return $this->saldo;
    }
    public function setSaldo($saldo){
        $this->saldo = $saldo;
    }

    /**
     * @inheritDoc
     */
    public function autenticarse() {
    }

    /**
     * @inheritDoc
     */
    public function cambiarClave() {
    }

    /**
     * @inheritDoc
     */
    public function cerrar_sesion() {
    }

    /**
     * @inheritDoc
     */
    public function registro() {
    }
}