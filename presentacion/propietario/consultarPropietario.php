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

$propietario = new Propietario();
$listaPropietarios = $propietario->consultarProp();
$apartamentos = [];
$idPropietario = "";
?>

<div class="container mt-4">
  <div class="row">
  <?php if (empty($listaPropietarios)): ?>
    <div class="alert alert-warning">No se encontraron propietarios registrados.</div>
  <?php else: ?>
    <div class="col-2"></div>
    <div class="card shadow-sm col-7">
      <div class="card-header bg-light text-dark">
        <h5 class="mb-0 text-center">Propietarios registrados</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered mb-0" id="tablaPropietarios">
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
                <tr>
                  <td><?= $prop['id'] ?></td>
                  <td><?= htmlspecialchars($prop['nombre']) ?></td>
                  <td><?= htmlspecialchars($prop['apellido']) ?></td>
                  <td><?= htmlspecialchars($prop['correo']) ?></td>
                  <td>$<?= number_format($prop['saldo'], 2, ',', '.') ?></td>
                  <td class="text-center"><a type="button" id="mostrarCarta" class="btn btn-info">Ver</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
      </div>
      <?php endif; ?>
      </div>
    </div>
    <div class="collapse col-3" id="miCarta">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="card-title mb-0">Título de la Carta ID=<?= $idPropietario ?></h6>
          <button type="button" class="btn-close" id="cerrarCarta"></button>
        </div>
        <div class="card-body">
          <p class="card-text">Este es el contenido de la carta que aparece cuando haces clic en el enlace.</p>
        </div>
      </div> 
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $("#tablaPropietarios").on("click", ".btn-info", function() {
      var idPropietario = $(this).closest('tr').find('td:first').text(); // Obtiene el ID del propietario de la fila
      var nombre = $(this).closest('tr').find('td:nth-child(2)').text(); // Obtiene el nombre del propietario

      $("#miCarta .card-title").text("Apartamentos de " + nombre);
      $("#miCarta .card-text").text("");
      $.ajax({
        url: "indexAjax.php?pid=<?php echo base64_encode("presentacion/apartamentos/consultarApartamentos.php") ?>",
        type: "GET",
        data: { idPropietario: idPropietario },
        success: function(response) {
          // Manejar la respuesta del servidor
          $("#miCarta .card-text").append(response);
        },
        error: function(xhr, status, error) {
          // Manejar errores
          console.error("Error al cargar los apartamentos: " + error);
          $("#miCarta .card-text").append("<p>Error al cargar los apartamentos.</p>");
        }
      });
      $("#miCarta").collapse('show'); // Alterna la visibilidad de la carta
    });
    $("#cerrarCarta").click(function() {
      $("#miCarta").collapse('hide'); // Oculta la carta al hacer clic en el botón de cerrar
    });
  });
</script>