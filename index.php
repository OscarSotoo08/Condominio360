<?php 

$correo = $_POST["correo"];
$clave = md5($_POST["clave"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Condominio 360</title>
  <link rel="icon" href="img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-info">

  <div class="container-fluid">
    <div class="row w-100 vh-100">
      
      <div class="col-md-6 d-flex align-items-center">
        <div class="text-center mx-auto my-auto">
            <img src="img/logo.png" class="rounded-circle w-25" alt="...">
          <h1>Bienvenido a Condominio360</h1>
          <p class="lead">Un sistema intuitivo para gestionar propiedades, residentes y pagos.</p>
          <ul class="list-unstyled mt-4">
            <li><i class="bi bi-check-circle-fill text-white"></i> Controla tus cuentas de cobro fácilmente</li>
            <li><i class="bi bi-check-circle-fill text-white"></i> Visualiza reportes y pagos en tiempo real</li>
            <li><i class="bi bi-check-circle-fill text-white"></i> Diseñado para administradores y propietarios</li>
          </ul>
        </div>
      </div>

      <div class="col-md-6 d-flex justify-content-center align-items-center">
        <div class="w-75 p-5 border rounded-3 border-primary" style="outline: 3px solid #007bff;">
          <h4 class="text-center mb-4">Iniciar Sesión</h4>
          <form action="procesar_login.php" method="POST">
            <div class="mb-4">
              <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="clave" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            <p class="text-center mt-3"><a href="#">¿Olvidaste tu contraseña?</a></p>
          </form>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
