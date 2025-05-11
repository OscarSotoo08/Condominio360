<?php
class PropietarioDAO{
    private String $id;
    private String $nombre;
    private String $apellido;
    private String $correo;
    private String $clave;
    private String $codigoRecuperacion;
    private String $fechaExpiracion;

    public function __construct(String $id = "", String $nombre = "", String $apellido = "", String $correo = "", String $clave = "", String $codigoRecuperacion = "", String $fechaExpiracion = ""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
        $this -> codigoRecuperacion = $codigoRecuperacion;
        $this->fechaExpiracion = $fechaExpiracion;
    }

    public function verificarCorreo(){
        return "select idPropietario from Propietario where correo = '{$this->correo}'";
    }
    
}