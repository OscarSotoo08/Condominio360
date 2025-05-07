<?php 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperar Contraseña - Condominio360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-info d-flex justify-content-center align-items-center min-vh-100">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="text-center">
          <a href="?" target="_blank" rel="noopener noreferrer">
            <img src="img/logo.png" class="rounded-circle w-25 mb-5" alt="...">
        </a>
        </div>
        <div class="card border-0 shadow-lg rounded-4">
          <div class="card-body p-4">
            <div class="text-center mb-4">
              <h4 class="fw-semibold">Recuperar Contraseña</h4>
              <p class="text-muted mb-0">Te enviaremos un enlace para restablecerla</p>
            </div>
            <form action="#" method="post">
              <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control form-control-lg" id="correo" name="correo" required placeholder="ejemplo@correo.com">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Enviar instrucciones</button>
              </div>
            </form>
            <div class="text-center mt-3">
              <a href="?" class="text-decoration-none link-primary">Volver al inicio de sesión</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
