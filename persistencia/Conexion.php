<?php

class Conexion{
    private $conexion;
    private $resultado;
    
    public function abrir(){
        $this -> conexion = new mysqli("localhost", "root", "", "Condominio360");
    }
    
    public function cerrar(){
        $this -> conexion -> close();
    }
    
    public function ejecutar($sentencia){
        $this -> resultado = $this -> conexion -> query($sentencia);
    }
    
    public function registro(){
        return $this -> resultado -> fetch_row();
    }

    public function getResultado(){
        return $this -> resultado;
    }

    public function filas(){
        return $this->resultado->num_rows;
    }
}

