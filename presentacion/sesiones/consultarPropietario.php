<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: ?pid=" . base64_encode("presentacion/sesiones/noAutorizado.php"));
    exit();
}
include ("presentacion/sesiones/encabezado.php");
include ("presentacion/sesiones/menuAdministrador.php");
require_once "persistencia/PropietarioDAO.php";
$propietarioDAO = new PropietarioDAO();
$listaPropietarios = $propietarioDAO->consultarProp();
?>

<div class="container mt-4">
  <h3 class="mb-4">Consulta de Propietarios</h3>

  <?php if (empty($listaPropietarios)): ?>
    <div class="alert alert-warning">No se encontraron propietarios registrados.</div>
  <?php else: ?>
    <div class="card shadow-sm">
      <div class="card-header bg-light text-dark">
        <h5 class="mb-0">Propietarios registrados</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead class="thead-light">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Saldo</th>
                <th>Apartamento(s)</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listaPropietarios as $prop): ?>
                <?php
                  $apartamentos = !empty($prop['apartamentos']) ? explode("; ", $prop['apartamentos']) : [];
                  $rowspan = max(1, count($apartamentos));
                ?>
                <tr>
                  <td rowspan="<?= $rowspan ?>"><?= $prop['id'] ?></td>
                  <td rowspan="<?= $rowspan ?>"><?= htmlspecialchars($prop['nombre']) ?></td>
                  <td rowspan="<?= $rowspan ?>"><?= htmlspecialchars($prop['apellido']) ?></td>
                  <td rowspan="<?= $rowspan ?>"><?= htmlspecialchars($prop['correo']) ?></td>
                  <td rowspan="<?= $rowspan ?>">$<?= number_format($prop['saldo'], 2, ',', '.') ?></td>
                  <?php if (!empty($apartamentos)): ?>
                    <td>* <?= htmlspecialchars($apartamentos[0]) ?></td>
                </tr>
                    <?php for ($i = 1; $i < count($apartamentos); $i++): ?>
                      <tr>
                        <td>* <?= htmlspecialchars($apartamentos[$i]) ?></td>
                      </tr>
                    <?php endfor; ?>
                  <?php else: ?>
                    <td><em>Sin apartamentos</em></td>
                </tr>
                  <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
