
<?php
$persona = null;
?>
<body class="bg-info d-flex justify-content-center align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <?php
                    $error = "";
                    $success = "";

                    // Validación de sesión
                    if (!isset($_SESSION["id"])) {
                        header("Location: ?pid=" . base64_encode("presentacion/acceso/autenticarse.php"));
                        exit();
                    }

                    // Procesamiento del formulario
                    if (isset($_POST["cambiar"])) {
                        $nuevaClave = trim($_POST["nuevaClave"]);
                        $confirmarClave = trim($_POST["confirmarClave"]);

                        if ($nuevaClave === "" || $confirmarClave === "") {
                            $error = "Todos los campos son obligatorios.";
                        } elseif ($nuevaClave !== $confirmarClave) {
                            $error = "Las claves no coinciden. Intente nuevamente.";
                        } else {
                            $claveHasheada = md5($nuevaClave);
                            $persona = ($_SESSION["tipo"] === "administrador") ? new Administrador(id: $_SESSION["id"], clave: $claveHasheada) : new Propietario(id: $_SESSION["id"], clave: $claveHasheada);
                            if ($persona->cambiarClave()) {
                                $success = "Clave cambiada exitosamente. <a href='?pid=" . base64_encode("presentacion/acceso/autenticarse.php") . "'>Iniciar sesión</a>";
                                session_destroy(); // Se cierra la sesión después del cambio
                            } else {
                                $error = "Error al cambiar la clave. Intente nuevamente.";
                            }
                        }
                    }
                    ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php elseif ($success): ?>
                    <div class="alert alert-success text-center" role="alert">
                        <?= $success ?>
                    </div>
                <?php endif; ?>
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title text-center">Cambiar clave</h5>
                        <p class="card-text text-center">Por favor, ingrese su nueva clave.</p>
                        <form action="?pid=<?= base64_encode("presentacion/acceso/cambiarClave.php") ?>" method="post">
                            <div class="mb-3">
                                <label for="nuevaClave" class="form-label">Nueva clave</label>
                                <input type="password" class="form-control" id="nuevaClave" name="nuevaClave">
                            </div>
                            <div class="mb-3">
                                <label for="confirmarClave" class="form-label">Confirmar nueva clave</label>
                                <input type="password" class="form-control" id="confirmarClave" name="confirmarClave">
                            </div>
                            <button type="submit" name="cambiar" class="btn btn-primary w-100">Cambiar clave</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
