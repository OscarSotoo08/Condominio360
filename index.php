<?php
if(PHP_SESSION_NONE == session_status()) session_start();

require_once "logica/Administrador.php";
require_once "logica/Propietario.php";

if(isset($_GET["cerrarSesion"])){
    session_destroy();
}

$paginasSinSesion = [
    "presentacion/acceso/recuperarClave.php",
    "presentacion/acceso/registro.php",
];

$paginasConSesion = [
    "presentacion/sesiones/sesionAdministrador.php",
    "presentacion/sesiones/sesionPropietario.php",
    "presentacion/acceso/cambiarClave.php",
];


?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<link href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/14596e32cc.js" crossorigin="anonymous"></script>
<title>Condominio - 360</title>
<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
</head>
<?php 
if(!isset($_GET["pid"])){
    include "presentacion/acceso/autenticarse.php"; 
}else{
    $pid = base64_decode($_GET["pid"]);
    if(in_array($pid, $paginasSinSesion)){
        include $pid;
    }else if(in_array($pid, $paginasConSesion)){
        if(isset($_SESSION["id"])){
            include $pid;
        }else{
            include "presentacion/acceso/autenticarse.php";
        }
    }else{
        echo "<h1>Error 404</h1>";        
    }
}
?>
</html>