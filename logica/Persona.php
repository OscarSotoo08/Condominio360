<?php
abstract class Persona{
    protected String $id;
    protected String $nombre;
    protected String $apellido;
    protected String $correo;
    protected String $clave;
    protected String $codigoRecuperacion;
    protected String $fechaExpiracion;
    
    
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $codigoRecuperacion = "", $fechaExpiracion = ""){
        $this->codigoRecuperacion = $codigoRecuperacion;
        $this->fechaExpiracion = $fechaExpiracion;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
    }
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function getClave(){
        return $this->clave;
    }
    public function getCodigo(){
        return $this -> codigoRecuperacion;
    }
    public function getFechaExp(){
        return $this ->fechaExpiracion;
    }
    
    
    
    public function setId(String $id){
        $this->id = $id;
    }
    public function setNombre(String $nombre){
        $this->nombre = $nombre;
    }
    public function setApellido(String $apellido){
        $this->apellido = $apellido;
    }
    public function setCorreo(String $correo){
        $this->correo = $correo;
    }
    public function setClave(String $clave){
        $this->clave = $clave;
    }
    public function setCodigo(String $codigo){
        $this->codigoRecuperacion = $codigo;
    }

    public function setFechaExp(String $fechaExp){
        $this->fechaExpiracion = $fechaExp;
    }
}