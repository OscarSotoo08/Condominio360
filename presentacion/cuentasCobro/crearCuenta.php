<?php

header("Content-Type: application/json; charset=UTF-8");

$cc = new CuentaCobro();
$admin = new Administrador(id:base64_decode($_GET["idAdmin"]));
$cc -> setAdmin($admin);

$respuesta = array();
if($cc -> cuentasActuales() == true){ // si no hay cuentas de cobro generadas para el mes actual
    // no generar cuentas de cobro
    $respuesta["mensaje"] = "<div class='alert alert-warning text-center'>Las cuentas de cobro para este mes ya se han generado.</div>";
    $respuesta["estado"] = "error";
}else{
    // generar cuentas de cobro
    $cc -> generarCuentas();
    $respuesta["mensaje"] = "<div class='alert alert-success text-center'>Cuentas de cobro generadas exitosamente.</div>";
    $respuesta["estado"] = "success";
    $respuesta["cuentas"] = "";
    $datos = $cc -> consultarCuentas();
    foreach($datos as $cuenta):
        $respuesta["cuentas"] .= "<tr>";
        $respuesta["cuentas"] .= "<td>" . htmlspecialchars($cuenta -> getPropietario() -> getNombre()) . "</td>";
        $respuesta["cuentas"] .= "<td>" . htmlspecialchars($cuenta -> getIdCuentaCobro()) . "</td>";
        $respuesta["cuentas"] .= "<td>" . htmlspecialchars(" {$cuenta -> getApartamento() -> getTorre()} - Piso {$cuenta -> getApartamento() -> getPiso()} - Apt {$cuenta -> getApartamento() -> getNumeroIdentificador()}") . "</td>";
        $respuesta["cuentas"] .= "<td>" . htmlspecialchars($cuenta -> getFechaGeneracion()) . "</td>";
        $respuesta["cuentas"] .= "<td>" . htmlspecialchars($cuenta -> getConcepto() -> getConcepto()) . "</td>";
        $respuesta["cuentas"] .= "<td>$" . number_format($cuenta -> getMonto(), 2) . "</td>";
        $respuesta["cuentas"] .= "<td>" . ($cuenta -> getEstadoPago() == 1 ? "<span class='badge bg-success'>Pagado</span>" : "<span class='badge bg-danger'>Pendiente</span>") . "</td>";
        $respuesta["cuentas"] .= "</tr>";
    endforeach;
}

echo json_encode($respuesta);
exit;
