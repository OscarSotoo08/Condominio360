<?php 
$id = $_SESSION["id"];
$admin = new Administrador($id);
$admin->consultar();
?>
<div class="container">
	<nav class="navbar navbar-expand-lg" style="background-color: #0dcbf1;">
		<div class="container">
			<a class="navbar-brand text-dark" href="?pid=<?php echo base64_encode("presentacion/sesiones/sesionAdministrador.php") ?>">
				<i class="fa-solid fa-house"></i>
			</a>
			<button class="navbar-toggler" type="button"
				data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link text-dark active" href="?pid=<?php echo base64_encode("presentacion/sesiones/sesionAdministrador.php") ?>">Inicio</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Propietarios
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="?pid=<?= base64_encode("presentacion/sesiones/consultarPropietario.php") ?>">Consultar</a></li>
						</ul>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Cuentas de Cobro
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/cuentaCobro/consultarCuenta.php") ?>">Consultar</a></li>
							<li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/cuentaCobro/crearCuenta.php") ?>">Crear</a></li>
						</ul>
					</li>

					<li class="nav-item">
						<a class="nav-link text-dark" href="?pid=<?php echo base64_encode("presentacion/pago/consultarPago.php") ?>">Pagos</a>
					</li>
				</ul>

				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Administrador: <?php echo $admin->getNombre() . " " . $admin->getApellido(); ?>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="#">Editar Perfil</a></li>
							<li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/acceso/autenticarse.php")?>&sesion=false">Cerrar Sesion</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>


