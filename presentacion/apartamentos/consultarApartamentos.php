<?php

$propietario = new Propietario(id: $_GET['idPropietario']);

if (isset($_GET['idPropietario']) ) {
    $apartamentos = $propietario->consultarApartamentos();
    foreach ($apartamentos as $apto) {
    $saldo = $apto->consultarSaldo();
    $estado = $saldo == null ? "Al dia" : "Deudor";
    $claseEstado = $estado == "Al dia" ? "bg-success" : "bg-danger";
        echo "
    <div class='mb-3 card shadow-sm h-100'>
      <div class='card-body d-flex flex-column'>
        <h5 class='card-title text-center fw-bold text-primary mb-3'>
          Apto - {$apto -> getNumeroIdentificador()}
        </h5>
        <p class='card-text text-muted mb-3 flex-grow-1'>
            <ul class='list-group text-center'>
                <li class='list-group-item'>{$apto->getTorre()}</li>
                <li class='list-group-item'>Piso  {$apto->getPiso()}</li>
                <li class='list-group-item'><span class='badge $claseEstado'>$estado</span></li>
            </ul>
        </p>
        <div class='mt-auto'>
          <div class='align-items-center mb-3 text-center'>
            <span class='h4 text-danger fw-bold mb-0'>$saldo</span>
          </div>
        </div>
      </div>
    </div>

        ";
    }
} else {
    echo "<p>No se encontró el ID del propietario.</p>";
}

?>