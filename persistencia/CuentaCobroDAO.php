<?php
class CuentaCobroDAO {
    private $idCuentaCobro;
    private $monto;
    private $fechaGeneracion;
    private $fechaVencimiento;
    private $estadoPago;
    private $idApartamento;
    private $idConcepto;
    private $idAdmin;

    public function __construct($idCuentaCobro = "", $monto = "", $fechaGeneracion = "", $fechaVencimiento = "", $estadoPago = "", $idApartamento = "", $idConcepto = "", $idAdmin = "") {
        $this->idCuentaCobro = $idCuentaCobro;
        $this->monto = $monto;
        $this->fechaGeneracion = $fechaGeneracion;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->estadoPago = $estadoPago;
        $this->idApartamento = $idApartamento;
        $this->idConcepto = $idConcepto;
        $this->idAdmin = $idAdmin;
    }

    public function insertarCuenta($conexion) {
        $conexion->ejecutar("SELECT MAX(idCuentaCobro) FROM cuentacobro");
        $fila = $conexion->registro();
        $nuevoID = ($fila[0] !== null) ? $fila[0] + 1 : 1;

        $this->idCuentaCobro = $nuevoID;

        $sql = "INSERT INTO cuentacobro 
                (idCuentaCobro, idApartamentoFK, idAdministradorFK, idConceptoFK, monto, fechaGeneracion, fechaVencimiento, estadoPago)
                VALUES (
                    '{$this->idCuentaCobro}', 
                    '{$this->idApartamento}', 
                    '{$this->idAdmin}', 
                    '{$this->idConcepto}', 
                    '{$this->monto}', 
                    '{$this->fechaGeneracion}', 
                    '{$this->fechaVencimiento}', 
                    '{$this->estadoPago}'
                )";

        $conexion->ejecutar($sql);

        return $conexion->getResultado() !== false;
    }

    public function consultarPorPropietario($idPropietario) {
        $idPropietario = intval($idPropietario);

        return "
            SELECT 
                c.idCuentaCobro, 
                a.torre, 
                a.piso, 
                a.numero_identificador, 
                c.fechaGeneracion, 
                c.fechaVencimiento, 
                con.concepto AS concepto, 
                c.monto, 
                c.estadoPago
            FROM cuentacobro c
            INNER JOIN apartamento a ON c.idApartamentoFK = a.idApartamento
            INNER JOIN concepto con ON c.idConceptoFK = con.idConcepto
            WHERE a.idPropietarioFK = $idPropietario
            ORDER BY c.fechaGeneracion DESC
        ";
    }

    public function consultarTodas() {
    return "
        SELECT 
            c.idCuentaCobro, 
            a.torre, 
            a.piso, 
            a.numero_identificador, 
            c.fechaGeneracion, 
            c.fechaVencimiento, 
            con.concepto AS concepto, 
            c.monto, 
            c.estadoPago,
            p.nombre, p.apellido
        FROM cuentacobro c
        INNER JOIN apartamento a ON c.idApartamentoFK = a.idApartamento
        INNER JOIN concepto con ON c.idConceptoFK = con.idConcepto
        INNER JOIN propietario p ON a.idPropietarioFK = p.idPropietario
        ORDER BY c.fechaGeneracion DESC
    ";
}

    public function cambiarEstado($idCuentaCobro, $nuevoEstado) {
        $idCuentaCobro = intval($idCuentaCobro);
        $nuevoEstado = intval($nuevoEstado);

        return "
            UPDATE cuentaCobro 
            SET estadoPago = $nuevoEstado 
            WHERE idCuentaCobro = $idCuentaCobro
        ";
    }

    public function cuentasActuales(){
        return "SELECT cc.idCuentaCobro FROM `cuentacobro` as cc WHERE cc.fechaGeneracion >= CURRENT_DATE;";
    }


    public function consultarCuentas($idPropietario = null) {
        $sql = "select cc.idCuentaCobro as idCC, cc.idApartamentoFK as idApto, cc.idConceptoFK as idCon, cc.monto as monto, cc.fechaGeneracion as fechaIni, cc.fechaVencimiento as fechaFin, cc.estadoPago as estado, apt.torre as torre, apt.numero_identificador as nId, apt.piso as piso, prop.nombre as nombreProp, prop.apellido as apellido, con.concepto as con from cuentacobro as cc join apartamento as apt on apt.idApartamento = cc.idApartamentoFK join propietario as prop on prop.idPropietario = apt.idPropietarioFK join concepto as con on con.idConcepto = cc.idConceptoFK ";
        $sql .= $idPropietario !== null ? " WHERE idPropietarioFK = $idPropietario" : "";
        $sql .= " ORDER BY fechaIni DESC";
        return $sql;
    }

    public function generarCuentas(){
        return "INSERT INTO cuentacobro (idApartamentoFK, idAdministradorFK, idConceptoFK,monto, fechaGeneracion, fechaVencimiento,estadoPago, fechaPago) SELECT a.idApartamento, {$this->idAdmin}, 1, a.monto_administracion, CURRENT_DATE, LAST_DAY(NOW()), 0, NULL FROM apartamento AS a;";
    }
}
    
?>