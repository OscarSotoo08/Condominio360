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
$objCuenta = new CuentaCobro();
$cuentas = [];

switch ($rol) {
    case 'administrador':
        include "presentacion/sesiones/encabezado.php";
        include "presentacion/sesiones/menuAdministrador.php";
        $usuario = new Administrador($id);
        $usuario->consultar();
        $cuentas = $objCuenta->consultarCuentas();
        $titulo = "Cuentas de cobro registradas";
        break;
    case 'propietario':
        include "presentacion/sesiones/encabezado.php";
        include "presentacion/sesiones/menuPropietario.php";
        $usuario = new Propietario($id);
        $usuario->consultar();
        $cuentas = $objCuenta->consultarCuentas($id);
        $titulo = "Cuentas de cobro registradas";
        break;
}
?>

<div class="container mt-4">
  <div id="alerta"></div>
  <div class="d-flex justify-content-between mb-3">
    <h4><?= $titulo ?></h4>
    <div class="row">
      <div class="col-8">
        <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="Buscar">
      </div>
      <div class="col-4">
        <select name="filtro" id="filtroSelect" class="form-select form-select-lg">
          <option value="">Todos</option>
          <option value="pagado">Pagado</option>
          <option value="pendiente">Pendiente</option>
        </select>
      </div>
    </div>
    <?php if ($rol === 'administrador'): ?>
    <a href="#" class="btn btn-primary" id="crearCuentaCobro">
      <i class="fa-solid fa-money-check"></i> Generar cuentas por administracion
    </a>
    <?php endif; ?>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>ID</th>
          <?php if ($_SESSION['rol'] === 'administrador'): ?>
            <th>Propietario</th>
          <?php endif; ?>
          <th>Apartamento</th>
          <th>Fecha</th>
          <th>Concepto</th>
          <th>Valor</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody id="cuentasTableBody">
        <?php if (!empty($cuentas)): ?>
          <?php foreach ($cuentas as $cuenta): ?>
            <tr>
              <td class="text-center"><?= htmlspecialchars($cuenta -> getIdCuentaCobro()) ?></td>
              <?php if ($_SESSION['rol'] === 'administrador'): ?>
                <td><?= htmlspecialchars($cuenta -> getPropietario() -> getNombre() . ' ' . $cuenta -> getPropietario() -> getApellido()) ?></td>
              <?php endif; ?>
              <td><?= htmlspecialchars(" {$cuenta -> getApartamento() -> getTorre()} - Piso {$cuenta -> getApartamento() -> getPiso()} - Apt {$cuenta -> getApartamento() -> getNumeroIdentificador()}") ?></td>
              <td class="text-center"><?= htmlspecialchars($cuenta -> getFechaGeneracion()) ?></td>
              <td><?= htmlspecialchars($cuenta -> getConcepto() -> getConcepto()) ?></td>
              <td class="text-center">$<?= number_format($cuenta -> getMonto(), 2) ?></td>
              <td>
                <?php 
                  $bg = "bg-success";
                  if($cuenta -> getEstadoPago() -> getId() == "3"){
                      $bg = "bg-danger";
                  }else if($cuenta -> getEstadoPago() -> getId() == "2"){
                      $bg = "bg-warning";
                  }
                ?>
                  <span class="badge <?= $bg ?>"><?= $cuenta -> getEstadoPago() -> getNombre() ?></span>
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

<script> 
  $(document).ready(function(){
    $("#crearCuentaCobro").click(function(){
      $.ajax({
        url: "indexAjax.php",
        data: { 
          pid: '<?= base64_encode("presentacion/cuentasCobro/generarCuenta.php") ?>',
          idAdmin: '<?= base64_encode($id) ?>'
        },
        type: "GET",
        success: function(response) {
          // Aquí puedes manejar la respuesta del servidor
          console.log(response);
          $("#cuentasTableBody").html(response.cuentas);
          $("#alerta").html(response.mensaje);
        },
        error: function() {
          alert("Error al cargar el formulario de creación de cuenta.");
        }
      });
    });
  })
</script>