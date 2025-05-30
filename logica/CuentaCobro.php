<?php 
require_once "persistencia/Conexion.php";
require_once "persistencia/CuentaCobroDAO.php";

class CuentaCobro{
    private $idCuentaCobro;
    private $monto;  
    private $fechaGeneracion;
    private $fechaVencimiento;
    private $estadoPago;
    private $apartamento;
    private $concepto;
    private $admin;
    private $propietario;


    public function __construct($idCuentaCobro = 0, $monto = "", $fechaGeneracion = "", $fechaVencimiento = "", $estadoPago = "", $apartamento = null, $concepto = null, $admin = null, $propietario = null){
        $this ->idCuentaCobro = $idCuentaCobro;
        $this ->monto = $monto;
        $this ->fechaGeneracion = $fechaGeneracion;
        $this ->fechaVencimiento = $fechaVencimiento;
        $this ->estadoPago = $estadoPago;
        $this ->apartamento = $apartamento;
        $this ->concepto = $concepto;
        $this ->admin = $admin;
        $this ->propietario = $propietario;
    }
    
    public function consultarCuentas(){
        $conexion = new Conexion();
        $conexion->abrir();
        $cuentas = array();
        $cuentaDAO = new CuentaCobroDAO();
        $conexion->ejecutar($cuentaDAO->consultarCuentas());
        while ($fila = $conexion->registro()) {
            // Crear instancias de las clases relacionadas
            $apto = new Apartamento(
                idApartamento: $fila['1'],
                numero_identificador: $fila['8'],
                torre: $fila['7'],
                piso: $fila['9']
            );
            $concepto = new Concepto(
                idConcepto: $fila['2'],
                concepto: $fila['12']
            );
            $propietario = new Propietario(
                id: $fila['10'],
                nombre: $fila['11'],
                apellido: $fila['12']
            );
            $cuenta = new CuentaCobro(
                idCuentaCobro: $fila['0'],
                monto: $fila['3'],
                fechaGeneracion: $fila['4'],
                fechaVencimiento: $fila['5'],
                estadoPago: $fila['6'],
                apartamento: $apto,
                concepto: $concepto,
                propietario: $propietario
            );
            array_push($cuentas, $cuenta);
        }
        $conexion->cerrar();
        return $cuentas;
    }

    
    public function cuentasActuales(){
        $conexion = new Conexion();
        $conexion->abrir();
        $cuentaDAO = new CuentaCobroDAO();
        $conexion->ejecutar($cuentaDAO->cuentasActuales());
        if ($conexion->registro()) {
            $conexion->cerrar();
            return true;
        }
        $conexion->cerrar();    
        return false;
    }

    public function generarCuentas(){
        $conexion = new Conexion();
        $conexion->abrir();
        $cuentaDAO = new CuentaCobroDAO(idAdmin: $this -> admin -> getId()); 
        // echo $cuentaDAO -> generarCuentas();
        $conexion->ejecutar($cuentaDAO->generarCuentas());
        $conexion->cerrar();
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
    public function getPropietario(){
        return $this ->propietario;
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
    public function setPropietario($propietario){
        $this ->propietario = $propietario;
    }
}