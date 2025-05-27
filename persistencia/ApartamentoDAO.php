<?php
require_once "persistencia/Conexion.php";
require_once "logica/Apartamento.php";

class ApartamentoDAO {
    private $id;
    private $torre;
    private $piso;
    private $numeroIdentificador;
    private $propietario;

    public function __construct($id = "", $torre = "", $piso = "", $numeroIdentificador = "", $propietario = "") {
        $this->id = $id;
        $this->torre = $torre;
        $this->piso = $piso;
        $this->numeroIdentificador = $numeroIdentificador;
        $this->propietario = $propietario;
    }

    public function consultarPorPropietario() {
        $conexion = new Conexion();
        $conexion->abrir();

        $propietario = $this->propietario;
        $sql = "SELECT torre_apartamento, piso_apartamento, numero_identificador 
                FROM apartamento 
                WHERE propietario_id = '$propietario'";

        $conexion->ejecutar($sql);

        $resultados = [];
        while ($fila = $conexion->registro()) {
            $a = new Apartamento("", $fila[0], $fila[1], $fila[2], $propietario);
            $resultados[] = $a;
        }

        $conexion->cerrar();

        return $resultados;
    }
}

