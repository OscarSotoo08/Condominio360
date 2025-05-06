<?php
abstract class Persona{
    protected String $id;
    protected String $nombre;
    protected String $apellido;
    protected String $correo;
    protected String $clave;

    
    
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = ""){
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
}