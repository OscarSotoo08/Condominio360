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
        return "SELECT cc.idCuentaCobro FROM cuentacobro AS cc WHERE cc.fechaGeneracion BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND LAST_DAY(CURDATE());";
    }


    public function consultarCuentas($idPropietario = null) {
        $sql = "select apt.idApartamento, apt.numero_identificador, apt.torre, apt.piso, con.idConcepto, con.concepto, prop.idPropietario, prop.nombre, prop.apellido, est.idEstadoPago, est.nombre, cc.idCuentaCobro, cc.monto, cc.fechaGeneracion, cc.fechaVencimiento from cuentacobro as cc join apartamento as apt on apt.idApartamento = cc.idApartamentoFK join propietario as prop on prop.idPropietario = apt.idPropietarioFK join concepto as con on con.idConcepto = cc.idConceptoFK join estadopago as est on est.idEstadoPago = cc.EstadoPago_idEstadoPago ";
        $sql .= $idPropietario !== null ? " WHERE idPropietarioFK = $idPropietario" : "";
        $sql .= " ORDER BY cc.idCuentaCobro ASC";
        return $sql;
    }

    public function generarCuentas(){
        return "INSERT INTO cuentacobro (idApartamentoFK, idAdministradorFK, idConceptoFK, monto, fechaGeneracion, fechaVencimiento, fechaPago, EstadoPago_idEstadoPago) SELECT a.idApartamento, {$this -> idAdmin}, 1, a.valorAdministracion, CURRENT_DATE, LAST_DAY(NOW()), NULL, 3 FROM apartamento as a;";
    }
}
    
?>