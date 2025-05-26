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

    public function autenticarse(){
        return "select idPropietario
                from Propietario 
                where correo = '" . $this -> correo . "' and clave = '" . $this -> clave . "'";
    }
    
    public function consultar() {
        return "SELECT nombre, apellido, correo FROM Propietario WHERE idPropietario = '{$this->id}'";
    }

    public function consultarTodosConApartamentos() {
    return "SELECT p.id, p.nombre, p.apellido, p.correo, p.saldo,
                   a.torre, a.piso, a.numeroIdentificador
            FROM propietario p
            LEFT JOIN apartamento a ON p.id = a.propietario_id
            ORDER BY p.apellido, p.nombre";
    }

    public function verificarCorreo(){
        return "select idPropietario from Propietario where correo = '{$this->correo}'";
    }

    
    public function guardarCodigo(){
        return "update Propietario set codigoRecuperacion = '{$this->codigoRecuperacion}', fechaExpiracion = '{$this->fechaExpiracion}' where correo = '{$this->correo}'";
    }

    public function verificarCodigo(){
        return "select idPropietario from Propietario where codigoRecuperacion = '{$this->codigoRecuperacion}' and fechaExpiracion > now()";
    }

    public function cambiarClave(){
        return "update Propietario set clave = '{$this->clave}' where idPropietario = '{$this->id}'";
    }
    
}

