<?php
if($_SESSION["rol"] != "Propietario") header("Location: ?pid=". base64_encode("presentacion/sinPermisos.php"));

$id = $_SESSION["id"];
$propietario = new Propietario(id: $id);
$propietario->consultar();

echo "<h1>Hola {$propietario->getNombre()} {$propietario->getApellido()}</h1>";
echo "<h2>Correo: {$propietario->getCorreo()}</h2>";
echo "<h2>Saldo: {$propietario->getSaldo()}</h2>";