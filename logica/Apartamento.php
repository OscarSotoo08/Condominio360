<?php 
class Apartamento{
    private $idApartamento;
    private $numero_identificador;
    private $torre;
    private $piso;
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
    public function setIdApartamento($idApartamento){
        $this->idApartamento = $idApartamento;
    }
    public function setPiso($piso){
        $this->piso = $piso;
    }
    
}