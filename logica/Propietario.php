<?php
require_once "persistencia/PropietarioDAO.php";
class Propietario extends Persona implements Usuario{
    private $saldo;
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $saldo = 0.0, $codigoRecuperacion = "", $fechaExpiracion = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $codigoRecuperacion, $fechaExpiracion);
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
        return 0;
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

    public function verificarCorreo() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $PDAO = new PropietarioDAO(correo: $this -> correo);
        $conexion -> ejecutar($PDAO -> verificarCorreo());
        if(($datos = $conexion -> registro()) != null) {
            $this -> id = $datos[0];
        }
        $conexion -> cerrar();
    }

    public function guardarCodigo(){
        
    }

    /**
     * @inheritDoc
     */
    public function verificarCodigo() {
    }
}