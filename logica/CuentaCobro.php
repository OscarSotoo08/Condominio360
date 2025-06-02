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
    
    public function consultarCuentas($idPropietario = null): array{
        $conexion = new Conexion();
        $conexion->abrir();
        $cuentas = array();
        $cuentaDAO = new CuentaCobroDAO();
        $conexion->ejecutar($cuentaDAO->consultarCuentas($idPropietario));
        while ($fila = $conexion->registro()) {
            // Crear instancias de las clases relacionadas
            $apto = new Apartamento(
                idApartamento: $fila['0'],
                numero_identificador: $fila['1'],
                torre: $fila['2'],
                piso: $fila['3']
            );
            $concepto = new Concepto(
                idConcepto: $fila['4'],
                concepto: $fila['5']
            );
            $propietario = new Propietario(
                id: $fila['6'],
                nombre: $fila['7'],
                apellido: $fila['8']
            );
            $estado = new EstadoPago(
                id: $fila['9'],
                nombre: $fila['10']
            );

            $cuenta = new CuentaCobro(
                idCuentaCobro: $fila['11'],
                monto: $fila['12'],
                fechaGeneracion: $fila['13'],
                fechaVencimiento: $fila['14'],
                estadoPago: $estado,
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