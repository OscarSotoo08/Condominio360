<?php
class AdministradorDAO{
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

    public function autenticarse(){
        return "select idAdministrador
                from Administrador 
                where correo = '" . $this -> correo . "' and clave = '" . md5($this -> clave) . "'";
    }
    
    public function consultar(){
        return "select nombre, apellido, correo
                from Administrador
                where idAdministrador = '" . $this -> id . "'";
    }

    public function verificarCorreo(){
        return "select idAdministrador from Administrador where correo = '{$this->correo}'";
    }
    
    public function guardarCodigo(){
        return "update Administrador set codigoRecuperacion = '{$this->codigoRecuperacion}', fechaExpiracion = '{$this->fechaExpiracion}' where correo = '{$this->correo}'";
    }

    public function verificarCodigo(){
        return "select idAdministrador from Administrador where codigoRecuperacion = '{$this->codigoRecuperacion}' and fechaExpiracion > now()";
    }

    public function cambiarClave(){
        return "update Administrador set clave = '{$this->clave}' where idAdministrador = '{$this->id}'";
    }
}
  
