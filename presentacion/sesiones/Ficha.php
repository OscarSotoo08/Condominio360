<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$id  = $_SESSION['id'];
$rol = $_SESSION['rol'];

switch ($rol) {
    case 'administrador':
        require_once "logica/Administrador.php";
        $usuario = new Administrador($id);
        break;
    case 'propietario':
        require_once "logica/Propietario.php";
        require_once "logica/Apartamento.php";
        $usuario = new Propietario($id);
        break;
    default:
        exit("Rol no reconocido");
}
$usuario->consultar();
?>

<div class="container">
  <div class="row justify-content-center mt-3">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
      <div class="card">
        <div class="card-header"><h4>Ficha técnica</h4></div>
        <div class="card-body">
          <div class="row border-bottom mb-2">
            <div class="col-5 col-sm-4 font-weight-bold">Rol:</div>
            <div class="col-7 col-sm-8"><?= ucfirst($rol) ?></div>
          </div>
          <div class="row border-bottom mb-2">
            <div class="col-5 col-sm-4 font-weight-bold">Nombre:</div>
            <div class="col-7 col-sm-8"><?= htmlspecialchars($usuario->getNombre()) ?></div>
          </div>
          <div class="row border-bottom mb-2">
            <div class="col-5 col-sm-4 font-weight-bold">Apellido:</div>
            <div class="col-7 col-sm-8"><?= htmlspecialchars($usuario->getApellido()) ?></div>
          </div>
          <div class="row border-bottom mb-2">
            <div class="col-5 col-sm-4 font-weight-bold">Correo:</div>
            <div class="col-7 col-sm-8"><?= htmlspecialchars($usuario->getCorreo()) ?></div>
          </div>
          <?php if ($rol === 'propietario'): ?>
            <?php $apartamentos = $usuario->getApartamentos(); ?>
            <div class="row mb-2">
              <div class="col-5 col-sm-4 font-weight-bold">Apartamento(s):</div>
              <div class="col-7 col-sm-8">
                <?php if (count($apartamentos) === 0): ?>
                  No registra apartamentos.
                <?php else: ?>
                  <ul class="mb-0 pl-3">
                    <?php foreach ($apartamentos as $a): ?>
                      <li><?= htmlspecialchars($a->getTorre()) ?> – Piso <?= htmlspecialchars($a->getPiso()) ?> – Apto <?= htmlspecialchars($a->getNumeroIdentificador()) ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </div>
            </div>
            <div class="row border-bottom mb-2">
            <div class="col-5 col-sm-4 font-weight-bold">Saldo:</div>
            <div class="col-7 col-sm-8"><?= htmlspecialchars($usuario->getSaldo()) ?></div>
          </div>
          <?php endif; ?>
          
        </div>
      </div>
    </div>
  </div>
</div>




