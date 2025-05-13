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
        return true;
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
}