<?php
if(session_status() === PHP_SESSION_NONE) session_start();

if(!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "propietario"){
    header("Location: ?pid=" . base64_encode("presentacion/sesiones/noAutorizado.php"));
    exit();
}
?>
<body>
<?php 
include ("presentacion/sesiones/encabezado.php");
include ("presentacion/sesiones/menuPropietario.php");
include ("presentacion/sesiones/Ficha.php");
?>
</body>

