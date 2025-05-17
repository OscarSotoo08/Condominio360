<?php 
class Apartamento{
    private $idApartamento;
    private $numero_identificador;
    private $torre;
    private $piso;
    private $propietario;

    public function __construct($idApartamento = "", $numero_identificador = "", $torre = "", $piso = "") {
        $this->idApartamento = $idApartamento;
        $this->numero_identificador = $numero_identificador;
        $this->torre = $torre;
        $this->piso = $piso;
    }

    public function getIdApartamento(){
        return $this->idApartamento;
    }
    public function getNumeroId(){
        return $this->numero_identificador;
    }
    public function getPiso(){
        return $this->piso;
    }
    public function getTorre(){
        return $this->torre;
    }
    public function getPropietario(){
        return $this->propietario;
    }


    public function setIdApartamento($idApartamento){
        $this->idApartamento = $idApartamento;
    }
    public function setPiso($piso){
        $this->piso = $piso;
    }
    public function setNumeroIdentificador( $numero_identificador){
        $this->numero_identificador = $numero_identificador;
    }
    public function setTorre($torre){
        $this->torre = $torre;
    }
    public function setPropietario( $propietario){
        $this->propietario = $propietario;
    }

}