<?php
require_once "persistencia/PropietarioDAO.php";

class Propietario extends Persona implements Usuario {
    private $saldo;
    private $apartamentos = [];

    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $saldo = 0.0, $codigoRecuperacion = "", $fechaExpiracion = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $codigoRecuperacion, $fechaExpiracion);
        $this->saldo = $saldo;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function getApartamentos() {
        return $this->apartamentos;
    }

    public function setApartamentos(array $apartamentos) {
        $this->apartamentos = $apartamentos;
    }

    public function autenticarse() {
        $conexion = new Conexion();
        $propietarioDAO = new PropietarioDAO("", "", "", $this->correo, $this->clave, "", "");
        $conexion->abrir();
        $conexion->ejecutar($propietarioDAO->autenticarse());
        if ($conexion->filas() == 1) {
            $this->id = $conexion->registro()[0];
            $conexion->cerrar();
            return true;
        } else {
            $conexion->cerrar();
            return false;
        }
    }

    public function consultar() {
        $DAO = new PropietarioDAO($this->id, "", "", "", "", "", "");
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($DAO->consultar());
        $datos = $conexion->registro();
        if ($datos != null) {
            $this->nombre = $datos[0];
            $this->apellido = $datos[1];
            $this->correo = $datos[2];
        }
        require_once "logica/Apartamento.php";
        $this->apartamentos = Apartamento::consultarPorPropietario($this->id);
        $conexion->cerrar();
    }

    public function consultarApartamentos() {
        $conexion = new Conexion();
        $conexion->abrir();
        $dao = new PropietarioDAO(id: $this->id);
        $resultado = $conexion->ejecutar($dao->consultarApartamentos());

        $apartamentos = [];

        while ($registro = $conexion->registro()) {
            $apartamento = new Apartamento(
                idApartamento: $registro[0],
                numero_identificador: $registro[1],
                torre: $registro[2],
                piso: $registro[3],
                propietario: $this
            );
            array_push($apartamentos, $apartamento);
        }

        return $apartamentos;
    }

    public function consultarProp() {
        $conexion = new Conexion();
        $conexion->abrir();
        $PDAO = new PropietarioDAO();
        $conexion->ejecutar($PDAO->consultarProp());
        $datos = [];
        while (($fila = $conexion->registro()) != null) {
            $datos[] = [
                'id' => $fila[0],
                'nombre' => $fila[1],
                'apellido' => $fila[2],
                'correo' => $fila[3],
                'saldo' => $fila[4]
            ];
        }
        return $datos;
    }

public function cambiarClave() {
        $conexion = new Conexion();
        $conexion->abrir();
        $PDAO = new PropietarioDAO($this->id, "", "", "", $this->clave, "", "");
        $conexion->ejecutar($PDAO->cambiarClave());
        $resultado = $conexion->getResultado();
        $conexion->cerrar();
        return $resultado === TRUE;
    }

    public function cerrar_sesion() {
        session_destroy();
    }

    public function registro() {
        // No implementado aún
    }

    public function verificarCorreo() {
        $conexion = new Conexion();
        $conexion->abrir();
        $PDAO = new PropietarioDAO("", "", "", $this->correo, "", "", "");
        $conexion->ejecutar($PDAO->verificarCorreo());
        if (($datos = $conexion->registro()) != null) {
            $this->id = $datos[0];
        }
        $conexion->cerrar();
    }

    public function guardarCodigo() {
        $conexion = new Conexion();
        $conexion->abrir();
        $PDAO = new PropietarioDAO("", "", "", $this->correo, "", md5($this->codigoRecuperacion), $this->fechaExpiracion);
        $conexion->ejecutar($PDAO->guardarCodigo());
        $conexion->cerrar();
    }

    public function verificarCodigo() {
        $conexion = new Conexion();
        $conexion->abrir();
        $PDAO = new PropietarioDAO("", "", "", "", "", $this->codigoRecuperacion, "");
        $conexion->ejecutar($PDAO->verificarCodigo());
        $datos = $conexion->registro();
        $conexion->cerrar();
        return $datos != null ? $datos[0] : null;
    }
}