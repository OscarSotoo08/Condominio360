<?php
require_once "logica/Conexion.php";
require_once "logica/Propietario.php";
require_once "logica/PropietarioDAO.php";

$conexion = new Conexion();
$propietarios = Propietario::obtenerTodosConApartamentos($conexion);
?>

<div class="container mt-4">
    <h3 class="mb-3">Propietarios registrados</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
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
                <?php foreach ($propietarios as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nombre']) ?></td>
                        <td><?= htmlspecialchars($p['apellido']) ?></td>
                        <td><?= htmlspecialchars($p['correo']) ?></td>
                        <td>$<?= number_format($p['saldo'], 2) ?></td>
                        <td>
                            <?php if (empty($p['apartamentos'])): ?>
                                No registra apartamentos.
                            <?php else: ?>
                                <ul class="mb-0 ps-3">
                                    <?php foreach ($p['apartamentos'] as $a): ?>
                                        <li><?= htmlspecialchars($a['torre']) ?> – Piso <?= $a['piso'] ?> – Apto <?= $a['numero'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
