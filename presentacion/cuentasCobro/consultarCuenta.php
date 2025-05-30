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
      <i class="fa-solid fa-money-check"></i> Generar cuentas de cobro
    </a>
    <?php endif; ?>
  </div>
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
      <tbody id="cuentasTableBody">
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

<script> 
  $(document).ready(function(){
    $("#crearCuentaCobro").click(function(){
      $.ajax({
        url: "indexAjax.php",
        data: { 
          pid: '<?= base64_encode("presentacion/cuentasCobro/crearCuenta.php") ?>',
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