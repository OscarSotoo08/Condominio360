<?php 
class Apartamento{
    private $idApartamento;
    private $numero_identificador;
    private $torre;
    private $piso;
    private $propietario;

    public function __construct($idApartamento = "", $numero_identificador = "", $torre = "", $piso = "", $propietario = null)  {
        $this->idApartamento = $idApartamento;
        $this->numero_identificador = $numero_identificador;
        $this->torre = $torre;
        $this->piso = $piso;
        $this->propietario = $propietario;
    }

    public function getIdApartamento(){
        return $this->idApartamento;
    }
    public function getNumeroIdentificador(){
        return $this->numero_identificador;
    }
    public function getPiso(){
        return $this->piso;
    }
    public function getTorre(){
        return $this->torre;
    }
    public function getPropietario(){
        return $this->propietario;
    }


    public function setIdApartamento($idApartamento){
        $this->idApartamento = $idApartamento;
    }
    public function setPiso($piso){
        $this->piso = $piso;
    }
    public function setNumeroIdentificador( $numero_identificador){
        $this->numero_identificador = $numero_identificador;
    }
    public function setTorre($torre){
        $this->torre = $torre;
    }
    public function setPropietario( $propietario){
        $this->propietario = $propietario;
    }
    public static function consultarPorPropietario($idPropietario) {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT idApartamento, numero_identificador, torre, piso 
                FROM apartamento 
                WHERE idPropietarioFK = '$idPropietario'";
        $conexion->ejecutar($sql);

        $apartamentos = [];
        while ($registro = $conexion->registro()) {
            $apartamento = new Apartamento(
                $registro[0],  // idApartamento
                $registro[1],  // numero_identificador
                $registro[2],  // torre
                $registro[3]   // piso
            );
            $apartamentos[] = $apartamento;
        }

        $conexion->cerrar();
        return $apartamentos;
    }

    public function consultarSaldo(){
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "select sum(cc.monto)\n"

    . "from cuentacobro as cc\n"

    . "where cc.idApartamentoFK = '{$this->idApartamento}' and cc.estadoPago=0;";
        $conexion->ejecutar($sql);
        $datos = $conexion->registro();
        if ($datos != null) {
            return $datos[0]; // Retorna el saldo del propietario
        }
        $conexion->cerrar();
        return null; // Si no se encuentra el propietario, retorna null
    }
}