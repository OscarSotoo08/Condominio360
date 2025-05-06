<?php
class Administrador extends Persona implements Usuario{
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = ""){
        parent::__construct($id, $nombre, $apellido, $correo, $clave);
    }
    /**
     * @inheritDoc
     */
    public function autenticarse() {
    }

    /**
     * @inheritDoc
     */
    public function cambiarClave() {
    }

    /**
     * @inheritDoc
     */
    public function cerrar_sesion() {
    }

    /**
     * @inheritDoc
     */
    public function registro() {
    }
}