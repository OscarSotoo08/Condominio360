<?php 
interface Usuario {
    public function autenticarse();
    public function cerrar_sesion();
    public function cambiarClave();
    public function registro();
}