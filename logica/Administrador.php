<?php
require_once "logica/Persona.php";
require_once "logica/Usuario.php";
require_once "persistencia/AdministradorDAO.php";
require_once "persistencia/Conexion.php";


class Administrador extends Persona implements Usuario{
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $codigoRecuperacion = "", $fechaExpiracion = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $codigoRecuperacion, $fechaExpiracion);
    }

    /**
     * @inheritDoc
     */
    public function cambiarClave() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $ADAO = new AdministradorDAO(id: $this -> id, clave: $this -> clave);
        $conexion -> ejecutar($ADAO -> cambiarClave());
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
        session_destroy();
    }

    /**
     * @inheritDoc
     */
    public function registro() {
    }

    /**
     * @inheritDoc
     */
    public function autenticarse() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $ADAO = new AdministradorDAO(correo: $this -> correo, clave: $this -> clave);
        $conexion -> ejecutar($ADAO -> autenticarse());
        if(($datos = $conexion -> registro()) != null) {
            $this -> id = $datos[0];
            $conexion -> cerrar();
            return true;
        }else{
            $conexion -> cerrar();
            return false;
        }
    }
    public function obtenerCuentasCobro() {
    $conexion = new Conexion();
    $conexion->abrir();
    $dao = new CuentaCobroDAO($this->id, "", "", "", "", "", $conexion);
    $sql = $dao->consultarTodas();
    $conexion->ejecutar($sql);
    $cuentas = [];
    while ($fila = $conexion->registro()) {
        $cuentas[] = $fila;
    }
    $conexion->cerrar();
    return $cuentas;
}
    /**
     * @inheritDoc
     */
    public function verificarCorreo() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $ADAO = new AdministradorDAO(correo: $this -> correo);
        $conexion -> ejecutar($ADAO -> verificarCorreo());
        if(($datos = $conexion -> registro()) != null) {
            $this -> id = $datos[0];
        }
        $conexion -> cerrar();
    }

    public function guardarCodigo(){
        $conexion = new Conexion();
        $conexion -> abrir();
        $ADAO = new AdministradorDAO(correo: $this -> correo, codigoRecuperacion: md5($this -> codigoRecuperacion), fechaExpiracion: $this -> fechaExpiracion);
        $conexion -> ejecutar($ADAO -> guardarCodigo());
        $conexion -> cerrar();
    }



    /**
     * @inheritDoc
     */
    public function verificarCodigo() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $ADAO = new AdministradorDAO(codigoRecuperacion: $this -> codigoRecuperacion);
        $conexion -> ejecutar($ADAO -> verificarCodigo());
        if(($datos = $conexion -> registro()) != null) {
            $conexion -> cerrar();
            return $datos[0];
        }else{
            $conexion -> cerrar();
            return null;
        }
    }

    public function consultar() {
        $conexion = new Conexion();
        $conexion -> abrir();
        $ADAO = new AdministradorDAO(id: $this -> id);
        $conexion -> ejecutar($ADAO -> consultar());
        if(($datos = $conexion -> registro()) != null) {
            $this -> nombre = $datos[0];
            $this -> apellido = $datos[1];
            $this -> correo = $datos[2];
            $conexion -> cerrar();
            return true;
        }else{
            $conexion -> cerrar();
            return false;
        }
    }
}