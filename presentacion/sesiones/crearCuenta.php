<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: ?pid=" . base64_encode("presentacion/sesiones/noAutorizado.php"));
    exit();
}

include("presentacion/sesiones/encabezado.php");
include("presentacion/sesiones/menuAdministrador.php");
include_once("persistencia/conexion.php");
include_once("persistencia/CuentaCobroDAO.php");

$conexion = new Conexion();
$conexion->abrir();

// Obtener apartamentos
$conexion->ejecutar("SELECT idApartamento, torre, piso, numero_identificador FROM apartamento");
$apartamentos = [];
while ($fila = $conexion->registro()) {
    $apartamentos[] = [
        'id' => $fila[0],
        'torre' => $fila[1],
        'piso' => $fila[2],
        'numero' => $fila[3]
    ];
}

// Obtener conceptos
$conexion->ejecutar("SELECT idConcepto, concepto FROM concepto");
$conceptos = [];
while ($fila = $conexion->registro()) {
    $conceptos[] = [
        'id' => $fila[0],
        'nombre' => $fila[1]
    ];
}
$fechaActual = date("Y-m-d H:i:s");

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $monto = $_POST["monto"];
    if ($monto < 0) {
        echo "<script>alert('El monto no puede ser negativo'); history.back();</script>";
        exit;
    }
    $fechaGeneracion = date("Y-m-d H:i:s");
    $fechaVencimiento = $_POST["fechaVencimiento"];
    if (new DateTime($fechaVencimiento) < new DateTime($fechaGeneracion)) {
        echo "<script>alert('La fecha de vencimiento no puede ser anterior a la de generación'); history.back();</script>";
        exit;
    }
    $estadoPago = 0;
    $idApartamento = $_POST["idApartamento"];
    $idConcepto = $_POST["idConcepto"];
    $idAdmin = $_SESSION["id"];

    $cuentaDAO = new CuentaCobroDAO("", $monto, $fechaGeneracion, $fechaVencimiento, $estadoPago, $idApartamento, $idConcepto, $idAdmin);

    if ($cuentaDAO->insertarCuenta($conexion)) {
        echo "<script>alert('Cuenta creada correctamente'); history.back();</script>";
    } else {
        echo "<script>alert('Error al crear la cuenta de cobro'); history.back();</script>";
    }
}

$conexion->cerrar();
?>

<!-- Formulario HTML para crear la cuenta -->
<div class="container mt-4">
    <h2>Crear Cuenta de Cobro</h2>
    <form method="post">
        <div class="mb-3">
            <label>Monto:</label>
            <input type="number" step="0.01" name="monto" class="form-control" required>
        </div>
       <div class="mb-3">
            <label>Fecha de Generación (automática):</label>
            <input type="text" class="form-control" value="<?= $fechaActual ?>" readonly>
        </div>

        <div class="mb-3">
            <label>Fecha de Vencimiento:</label>
            <input type="datetime-local" name="fechaVencimiento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Apartamento:</label>
            <select name="idApartamento" class="form-control" required>
                <option value="">Seleccione</option>
                <?php foreach ($apartamentos as $a): ?>
                    <option value="<?= $a['id'] ?>">Torre <?= $a['torre'] ?> - Piso <?= $a['piso'] ?> - Nº <?= $a['numero'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Concepto:</label>
            <select name="idConcepto" class="form-control" required>
                <option value="">Seleccione</option>
                <?php foreach ($conceptos as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Cuenta</button>
    </form>
</div>
