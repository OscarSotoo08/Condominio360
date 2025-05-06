<?php 
class CuentaCobro{
    private $idCuentaCobro;
    private $monto;  
    private $fechaGeneracion;
    private $fechaVencimiento;
    private $estadoPago;
    private $apartamento;
    private $concepto;
    private $admin;

    public function __construct($idCuentaCobro = 0, $monto = "", $fechaGeneracion = "", $fechaVencimiento = "", $estadoPago = "", $apartamento = null, $concepto = null, $admin = null){
        $this ->idCuentaCobro = $idCuentaCobro;
        $this ->monto = $monto;
        $this ->fechaGeneracion = $fechaGeneracion;
        $this ->fechaVencimiento = $fechaVencimiento;
        $this ->estadoPago = $estadoPago;
        $this ->apartamento = $apartamento;
        $this ->concepto = $concepto;
        $this ->admin = $admin;
    }

    public function getIdCuentaCobro(){
        return $this ->idCuentaCobro;
    }

    public function getMonto(){
        return $this ->monto;
    }

    public function getFechaGeneracion(){
        return $this ->fechaGeneracion;
    }
    public function getFechaVencimiento(){
        return $this ->fechaVencimiento;
    }

    public function getEstadoPago(){
        return $this -> estadoPago;
    }
    public function getApartamento(){
        return $this -> apartamento;
    }
    public function getConcepto(){
        return $this -> concepto;
    }
    public function getAdmin(){
        return $this ->admin;
    }




    public function setIdCuentaCobro($idCuentaCobro){
        $this ->idCuentaCobro = $idCuentaCobro;
    }
    public function setMonto( $monto){
        $this ->monto = $monto;
    }
    public function setFechaGeneracion($fechaGeneracion){
        $this -> fechaGeneracion = $fechaGeneracion;
    }
    
    public function setFechaVencimiento( $fechaVencimiento){
        $this ->fechaVencimiento = $fechaVencimiento;
    }
    public function setEstadoPago( $estadoPago){
        $this ->estadoPago = $estadoPago;
    }
    public function setApartamento($apartamento){
        $this -> apartamento = $apartamento;
    }
    public function setConcepto($concepto){
        $this -> concepto = $concepto;
    }
    public function setAdmin($admin){
        $this ->admin = $admin;
    }

}