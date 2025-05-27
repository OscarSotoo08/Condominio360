<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'propietario') {
    header("Location: ?pid=" . base64_encode("presentacion/sesiones/noAutorizado.php"));
    exit();
}

include("presentacion/sesiones/encabezado.php");
include("presentacion/sesiones/menuPropietario.php");

require_once "logica/Propietario.php";

$propietario = new Propietario($_SESSION['id']);
$propietario->consultar();
$apartamentos = $propietario->getApartamentos();
?>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <div class="card shadow-sm">
        <div class="card-header bg-light text-dark">
          <h5 class="mb-0">Mis apartamentos</h5>
        </div>
        <div class="card-body p-0">
          <?php if (empty($apartamentos)): ?> 
            <div class="alert alert-warning m-3">No tienes apartamentos registrados.</div>
          <?php else: ?>
            <table class="table mb-0 table-bordered">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Torre</th>
                  <th scope="col">Piso</th>
                  <th scope="col">Número</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($apartamentos as $apt): ?>
                  <tr>
                    <td><?= htmlspecialchars($apt->getTorre()) ?></td>
                    <td><?= htmlspecialchars($apt->getPiso()) ?></td>
                    <td><?= htmlspecialchars($apt->getNumeroIdentificador()) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
