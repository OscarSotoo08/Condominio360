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
}
?>