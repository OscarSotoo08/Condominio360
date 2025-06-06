<?php 
if(isset($_GET["sesion"])){
    if($_GET["sesion"] == "false"){
        session_destroy();
    }
}
$error=false;

if(isset($_POST["ingresar"])){
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $administrador = new Administrador("", "", "", $correo, md5($clave));
    if($administrador -> autenticarse()){
        $_SESSION["id"] = $administrador -> getId();
        $_SESSION["rol"] = "administrador";
        header("Location: ?pid=" . base64_encode("presentacion/sesiones/sesionAdministrador.php"));
    }else {
        $propietario = new Propietario("", "", "", $correo, $clave);
        if($propietario -> autenticarse()){
            $_SESSION["id"] = $propietario -> getId();
            $_SESSION["rol"] = "propietario";
            header("Location: ?pid=" . base64_encode("presentacion/sesiones/sesionPropietario.php"));
            }else{
                $error=true;
            }
        }
    }

?>

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
          <form action="?pid=<?php echo base64_encode("presentacion/acceso/autenticarse.php") ?>" method="POST">
            <div class="mb-4">
              <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="clave" placeholder="Contraseña" required>
            </div>
            <button type="submit" name="ingresar" class="btn btn-primary w-100">Ingresar</button>
            <p class="text-center mt-3">
              <a href="?pid=<?php echo base64_encode("presentacion/acceso/recuperarClave.php") ?>">¿Olvidaste tu contraseña?</a>
            </p>
          </form>
          <?php 
          if ($error) {
              echo "<div class='alert alert-danger mt-3' role='alert'>Correo o contraseña incorrectos</div>";
          }
          ?>
        </div>
      </div>

    </div>
  </div>
</body>