<?php
class PropietarioDAO{
    private String $id;
    private String $nombre;
    private String $apellido;
    private String $correo;
    private String $clave;
    private String $codigoRecuperacion;
    private String $fechaExpiracion;

    public function __construct(String $id = "", String $nombre = "", String $apellido = "", String $correo = "", String $clave = "", String $codigoRecuperacion = "", String $fechaExpiracion = ""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
        $this -> codigoRecuperacion = $codigoRecuperacion;
        $this->fechaExpiracion = $fechaExpiracion;
    }

    public function autenticarse(){
        return "select idPropietario
                from Propietario 
                where correo = '" . $this -> correo . "' and clave = '" . $this -> clave . "'";
    }
    
    public function consultar() {
        return "SELECT nombre, apellido, correo FROM Propietario WHERE idPropietario = '{$this->id}'";
    }

    public function consultarProp() {
        $lista = [];
        $conexion = new Conexion();
        $conexion->abrir();

        $sql = "SELECT 
                    p.idPropietario AS id, 
                    p.nombre, 
                    p.apellido, 
                    p.correo, 
                    p.saldo,
                    GROUP_CONCAT(CONCAT('Torre ', a.torre, ', Piso ', a.piso, ', N° ', a.numero_identificador) SEPARATOR '; ') AS apartamentos
                FROM 
                    Propietario p
                LEFT JOIN 
                    Apartamento a ON p.idPropietario = a.idPropietarioFK
                GROUP BY
                    p.idPropietario
                ORDER BY 
                    p.apellido, p.nombre";

        $conexion->ejecutar($sql);
        $resultado = $conexion->getResultado();

        while ($fila = $resultado->fetch_assoc()) {
            $lista[] = [
                'id' => $fila['id'],
                'nombre' => $fila['nombre'],
                'apellido' => $fila['apellido'],
                'correo' => $fila['correo'],
                'saldo' => $fila['saldo'],
                'apartamentos' => $fila['apartamentos'] ?? null
            ];
        }

        $conexion->cerrar();
        return $lista;
    }

    public function verificarCorreo(){
        return "select idPropietario from Propietario where correo = '{$this->correo}'";
    }

    
    public function guardarCodigo(){
        return "update Propietario set codigoRecuperacion = '{$this->codigoRecuperacion}', fechaExpiracion = '{$this->fechaExpiracion}' where correo = '{$this->correo}'";
    }

    public function verificarCodigo(){
        return "select idPropietario from Propietario where codigoRecuperacion = '{$this->codigoRecuperacion}' and fechaExpiracion > now()";
    }

    public function cambiarClave(){
        return "update Propietario set clave = '{$this->clave}' where idPropietario = '{$this->id}'";
    }
    
}

