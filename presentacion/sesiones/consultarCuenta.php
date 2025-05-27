<?php
require_once "logica/Propietario.php";
require_once "logica/Administrador.php";
require_once "persistencia/Conexion.php";
require_once "persistencia/CuentaCobroDAO.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id  = $_SESSION['id'];
$rol = $_SESSION['rol'];

$conexion = new Conexion();
$cuentaDAO = new CuentaCobroDAO();

switch ($rol) {
    case 'administrador':
        include("presentacion/sesiones/encabezado.php");
        include("presentacion/sesiones/menuAdministrador.php");

        $usuario = new Administrador($id);
        $usuario->consultar();

        $conexion->abrir();
        $conexion->ejecutar($cuentaDAO->consultarTodas());
        $cuentas = [];
        $resultado = $conexion->getResultado();
        while ($registro = $resultado->fetch_assoc()) {
            $cuentas[] = $registro;
        }
        $conexion->cerrar();

        $titulo = "Cuentas de cobro registradas";
        break;

    case 'propietario':
        include("presentacion/sesiones/encabezado.php");
        include("presentacion/sesiones/menuPropietario.php");

        $usuario = new Propietario($id);
        $usuario->consultar();

        $conexion->abrir();
        $conexion->ejecutar($cuentaDAO->consultarPorPropietario($id));
        $cuentas = [];
        $resultado = $conexion->getResultado();
        while ($registro = $resultado->fetch_assoc()) {
            $cuentas[] = $registro;
        }
        $conexion->cerrar();

        $titulo = "Mis cuentas de cobro";
        break;

    default:
        exit("Rol no reconocido");
}
?>
<div class="container mt-4">
  <h4 class="mb-3">Cuentas de cobro registradas</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle text-center">
      <thead class="table-light">
        <tr>
          <?php if ($_SESSION['rol'] === 'administrador'): ?>
            <th>Propietario</th>
          <?php endif; ?>
          <th>ID</th>
          <th>Apartamento</th>
          <th>Fecha</th>
          <th>Concepto</th>
          <th>Valor</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($cuentas)): ?>
          <?php foreach ($cuentas as $cuenta): ?>
            <tr>
              <?php if ($_SESSION['rol'] === 'administrador'): ?>
                <td><?= htmlspecialchars($cuenta['nombre'] . ' ' . $cuenta['apellido']) ?></td>
              <?php endif; ?>
              <td><?= htmlspecialchars($cuenta['idCuentaCobro']) ?></td>
              <td><?= htmlspecialchars(" {$cuenta['torre']} - Piso {$cuenta['piso']} - Apt {$cuenta['numero_identificador']}") ?></td>
              <td><?= htmlspecialchars($cuenta['fechaGeneracion']) ?></td>
              <td><?= htmlspecialchars($cuenta['concepto']) ?></td>
              <td>$<?= number_format($cuenta['monto'], 2) ?></td>
              <td>
                <?php if ($cuenta['estadoPago'] == 1): ?>
                  <span class="badge bg-success">Pagado</span>
                <?php else: ?>
                  <span class="badge bg-danger">Pendiente</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="<?= $_SESSION['rol'] === 'administrador' ? '7' : '6' ?>">No hay cuentas registradas.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

