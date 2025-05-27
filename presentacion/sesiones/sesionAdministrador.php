<?php
if($_SESSION["rol"] != "Administrador") header("Location: ?pid=". base64_encode("presentacion/sinPermisos.php"));

$id = $_SESSION["id"];
$administrador = new Administrador(id: $id);
$administrador->consultar();

echo "Hola {$administrador->getNombre()} {$administrador->getApellido()}<br>";
echo "Correo: {$administrador->getCorreo()}<br>";