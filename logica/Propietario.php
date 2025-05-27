<?php
require_once "persistencia/PropietarioDAO.php";

class Propietario extends Persona implements Usuario {
    private $saldo;
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $saldo = 0.0, $codigoRecuperacion = "", $fechaExpiracion = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $codigoRecuperacion, $fechaExpiracion);
        $this->saldo = $saldo;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function getApartamentos() {
        return $this->apartamentos;
    }

    public function setApartamentos(array $apartamentos) {
        $this->apartamentos = $apartamentos;
    }

    public function autenticarse() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $PDAO = new PropietarioDAO(correo: $this -> correo, clave: $this -> clave);
        $conexion -> ejecutar($PDAO -> autenticarse());
        if(($datos = $conexion -> registro()) != null) {
            $this -> id = $datos[0];
            $conexion -> cerrar();
            return true;
        }else{
            $conexion -> cerrar();
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function cambiarClave() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $PDAO = new PropietarioDAO(id: $this -> id, clave: $this -> clave);
        $conexion -> ejecutar($PDAO -> cambiarClave());
        if($conexion -> getResultado() === TRUE){
            $conexion -> cerrar();
            return true;
        }else{
            $conexion -> cerrar();
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function cerrar_sesion() {
        session_destroy();
    }

    public function registro() {
        // No implementado aún
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
        $conexion = new Conexion();
        $conexion -> abrir();
        $PDAO = new PropietarioDAO(correo: $this -> correo, codigoRecuperacion: md5($this -> codigoRecuperacion), fechaExpiracion: $this -> fechaExpiracion);
        $conexion -> ejecutar($PDAO -> guardarCodigo());
        $conexion -> cerrar();  
    }

    /**
     * @inheritDoc
     */
    public function verificarCodigo() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $PDAO = new PropietarioDAO(codigoRecuperacion: $this -> codigoRecuperacion);
        $conexion -> ejecutar($PDAO -> verificarCodigo());
        if(($datos = $conexion -> registro()) != null) {
            $conexion -> cerrar();
            return $datos[0];
        }else {
            $conexion -> cerrar();
            return null;
        }
    }

    public function consultar() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $PDAO = new PropietarioDAO(id: $this -> id);
        $conexion -> ejecutar($PDAO -> consultar());
        if(($datos = $conexion -> registro()) != null) {
            $this -> nombre = $datos[0];
            $this -> apellido = $datos[1];
            $this -> correo = $datos[2];
            $this -> saldo = $datos[3];
            $conexion -> cerrar();
            return true;
        }else{
            $conexion -> cerrar();
            return false;
        }
    }
}