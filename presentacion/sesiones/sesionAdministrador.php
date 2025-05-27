<?php

if(!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "administrador"){
    header("Location: ?pid=" . base64_encode("presentacion/sesiones/noAutorizado.php"));
    exit();
}
?>
<body>
<?php 

include ("presentacion/sesiones/encabezado.php");
include ("presentacion/sesiones/menuAdministrador.php");
include ("presentacion/sesiones/Ficha.php");
?>
</body>

