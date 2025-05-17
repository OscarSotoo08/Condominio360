<?php 
interface Usuario {
    public function autenticarse();
    public function cerrar_sesion();
    public function verificarCorreo();
    public function cambiarClave();
    public function registro();
    public function verificarCodigo();
}