<?php 
class Concepto{
    private $idConcepto;
    private $concepto;

    public function __construct($idConcepto, $concepto){
        $this->idConcepto = $idConcepto;
        $this->concepto = $concepto;
    }


    public function getConcepto(){
        return $this->concepto;
    }
    public function getIdConcepto(){
        return $this->idConcepto;
    }


    public function setIdConcepto($idConcepto){
        $this->idConcepto = $idConcepto;
    }
    public function setConcepto($concepto){
        $this->concepto = $concepto;
    }
}