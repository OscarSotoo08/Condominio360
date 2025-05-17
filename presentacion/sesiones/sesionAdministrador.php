<?php
if(session_status() === PHP_SESSION_NONE) session_start();

if(!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "administrador"){
    header("Location: ?pid=" . base64_encode("presentacion/sesiones/noAutorizado.php"));
    exit();
}
?>
<body>
<?php 
include ("presentacion/sesiones/encabezado.php");
?>
</body>

