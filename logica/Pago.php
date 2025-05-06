<?php
class Pago{
    private $idPago;
    private $valorPagado;
    private $fechaPago;
    private $observaciones;
    private $cuentaCobro;
    
    public function __construct($idPago = 0, $valorPagado = 0.0, $fechaPago = "", $observaciones = "", $cuentaCobro = null){
        $this->idPago = $idPago;
        $this->valorPagado = $valorPagado;
        $this->fechaPago = $fechaPago;
        $this->observaciones = $observaciones;
    }

    public function getIdPago(){
        return $this->idPago;
    }
    public function getValorPagado(){
        return $this->valorPagado;
    }
    public function getObservaciones(){
        return $this->observaciones;
    }
    public function getFechaPago(){
        return $this->fechaPago;
    }
    public function getCuentaCobro(){
        return $this -> cuentaCobro;
    }



    public function setIdPago($idPago){
        $this->idPago = $idPago;
    }
    public function setValorPagado($valorPagado){
        $this->valorPagado = $valorPagado;
    }
    public function setObservaciones($observaciones){
        $this->observaciones = $observaciones;
    }
    public function setFechaPago( $fechaPago){
        $this->fechaPago = $fechaPago;
    }
    public function setCuentaCobro($cuentaCobro){
        $this->cuentaCobro = $cuentaCobro;
    }

}